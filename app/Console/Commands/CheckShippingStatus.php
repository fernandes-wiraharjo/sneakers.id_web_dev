<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Transaction\Entities\Transaction;
use Modules\Transaction\Entities\TransactionShippings;
use Modules\Transaction\Entities\TransactionDestination;
use Modules\Transaction\Entities\TransactionHistories;
use App\Facades\CekOngkir;

class CheckShippingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipping:check-status
                            {--dry-run : Preview the transactions without updating}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check shipping status for non-completed transactions with AWB and mark as COMPLETED if delivered';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        if ($dryRun) {
            $this->info('🔍 DRY RUN MODE - No changes will be made');
            $this->newLine();
        }

        $this->info('🚚 Starting shipping status check...');
        $this->newLine();

        // Get all transactions that are not completed but have shipping waybill
        $transactions = Transaction::where('status', '!=', 'COMPLETED')
            ->whereHas('shipping', function($query) {
                $query->whereNotNull('shipping_waybill')
                      ->where('shipping_waybill', '!=', '');
            })
            ->with(['shipping', 'destination'])
            ->get();

        if ($transactions->isEmpty()) {
            $this->info('✅ No transactions found requiring status check.');
            return 0;
        }

        $this->info("Found {$transactions->count()} transaction(s) to check");
        $this->newLine();

        $updated = 0;
        $errors = 0;
        $skipped = 0;

        foreach ($transactions as $transaction) {
            $this->line("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
            $this->info("📦 Checking Transaction: {$transaction->token}");
            $this->line("   Order #: {$transaction->doc_no}");
            $this->line("   Current Status: {$transaction->status}");

            $shipping = $transaction->shipping;
            $destination = $transaction->destination;

            if (!$shipping || !$destination) {
                $this->error("   ❌ Missing shipping or destination data - SKIPPED");
                $skipped++;
                continue;
            }

            $this->line("   AWB: {$shipping->shipping_waybill}");
            $this->line("   Courier: {$shipping->courier_code}");
            $this->line("   Shipping Status: {$shipping->status}");

            try {
                // Get last 5 digits of phone number
                $phoneNumber = $destination->phone_number;
                $lastFiveDigitPhoneNumber = substr(preg_replace('/[^0-9]/', '', $phoneNumber), -5);

                // Check waybill status
                $this->line("   🔍 Checking waybill status...");
                $response = CekOngkir::CheckWaybill(
                    $shipping->shipping_waybill,
                    $shipping->courier_code,
                    $lastFiveDigitPhoneNumber
                );

                if (!$response || !isset($response['meta']['code'])) {
                    throw new \Exception('Invalid API response');
                }

                if ($response['meta']['code'] != 200) {
                    $errorMsg = $response['meta']['status'] ?? 'Unknown error';
                    $this->warn("   ⚠️  API Error: {$errorMsg} - SKIPPED");
                    $skipped++;
                    
                    // Log the error in transaction history
                    if (!$dryRun) {
                        TransactionHistories::create([
                            'transaction_id' => $transaction->id,
                            'response_raw' => json_encode($response),
                            'response_status' => 'ERROR',
                            'response_code' => $response['meta']['code'] ?? '400',
                            'response_message' => 'Auto-check failed: ' . $errorMsg,
                            'created_by' => 'SYSTEM',
                        ]);
                    }
                    continue;
                }

                $shippingStatus = $response['data']['summary']['status'] ?? null;
                $delivered = $response['data']['delivered'] ?? false;

                $this->line("   📋 API Response:");
                $this->line("      - Status: {$shippingStatus}");
                $this->line("      - Delivered: " . ($delivered ? 'YES' : 'NO'));

                // Check if delivered
                if ($delivered || strtoupper($shippingStatus) === 'DELIVERED') {
                    if ($dryRun) {
                        $this->info("   ✅ [DRY RUN] Would mark as COMPLETED");
                    } else {
                        // Begin transaction
                        DB::beginTransaction();

                        try {
                            // Update shipping status
                            $shipping->update([
                                'status' => $shippingStatus ?? 'DELIVERED'
                            ]);

                            // Update transaction status to COMPLETED
                            $transaction->update([
                                'status' => 'COMPLETED'
                            ]);

                            // Log the status check in history
                            TransactionHistories::create([
                                'transaction_id' => $transaction->id,
                                'response_raw' => json_encode($response),
                                'response_status' => $delivered ? 'DELIVERED' : 'UNKNOWN',
                                'response_code' => $response['meta']['code'],
                                'response_message' => 'Auto-check: Package delivered, marked as COMPLETED',
                                'created_by' => 'SYSTEM',
                            ]);

                            // Send completion email
                            $email = $destination->email;
                            $emailData = [
                                'transaction_details' => route('customer.transaction.detail', $transaction->token),
                                'review_url' => route('customer.transaction.review', $transaction->token),
                                'customer_name' => $destination->first_name . " " . $destination->last_name,
                                'order_id' => $transaction->token
                            ];

                            Mail::send('email.order-complete', $emailData, function($message) use($email) {
                                $message->to($email);
                                $message->subject('SNEAKERS.ID Your Order is complete.');
                            });

                            DB::commit();

                            $this->info("   ✅ SUCCESS - Marked as COMPLETED and email sent");
                            $updated++;

                            // Log to Laravel log
                            Log::info("Transaction {$transaction->token} automatically marked as COMPLETED", [
                                'transaction_id' => $transaction->id,
                                'awb' => $shipping->shipping_waybill,
                                'courier' => $shipping->courier_code,
                            ]);

                        } catch (\Exception $e) {
                            DB::rollback();
                            throw $e;
                        }
                    }
                } else {
                    $this->line("   ℹ️  Not yet delivered - No action taken");
                    $skipped++;

                    // Still log the status check
                    if (!$dryRun) {
                        TransactionHistories::create([
                            'transaction_id' => $transaction->id,
                            'response_raw' => json_encode($response),
                            'response_status' => $shippingStatus ?? 'UNKNOWN',
                            'response_code' => $response['meta']['code'],
                            'response_message' => 'Auto-check: Not delivered yet',
                            'created_by' => 'SYSTEM',
                        ]);

                        // Update shipping status even if not delivered
                        $shipping->update([
                            'status' => $shippingStatus ?? $shipping->status
                        ]);
                    }
                }

            } catch (\Exception $e) {
                $this->error("   ❌ Error: " . $e->getMessage());
                $errors++;

                Log::error("Error checking shipping status for transaction {$transaction->token}", [
                    'transaction_id' => $transaction->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                // Log error in transaction history
                if (!$dryRun) {
                    try {
                        TransactionHistories::create([
                            'transaction_id' => $transaction->id,
                            'response_raw' => json_encode(['error' => $e->getMessage()]),
                            'response_status' => 'ERROR',
                            'response_code' => '500',
                            'response_message' => 'Auto-check error: ' . $e->getMessage(),
                            'created_by' => 'SYSTEM',
                        ]);
                    } catch (\Exception $historyError) {
                        Log::error("Failed to log error in transaction history", [
                            'transaction_id' => $transaction->id,
                            'error' => $historyError->getMessage()
                        ]);
                    }
                }
            }

            $this->newLine();
        }

        // Summary
        $this->line("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->info("📊 SUMMARY");
        $this->line("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->line("Total checked: {$transactions->count()}");
        $this->line("✅ Updated to COMPLETED: {$updated}");
        $this->line("ℹ️  Skipped (not delivered): {$skipped}");
        $this->line("❌ Errors: {$errors}");
        $this->line("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");

        if ($dryRun) {
            $this->newLine();
            $this->warn('This was a DRY RUN - no actual changes were made.');
            $this->info('Run without --dry-run to apply changes.');
        }

        return 0;
    }
}

