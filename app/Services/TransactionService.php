<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Modules\Transaction\Entities\Transaction;
use Modules\Transaction\Entities\TransactionDestination;
use Modules\Transaction\Entities\TransactionHistories;
use Modules\Transaction\Entities\TransactionItems;
use Modules\Transaction\Entities\TransactionShippings;
use Ramsey\Uuid\Uuid;

class TransactionService {
    const DEFAULT_INSTANCE = 'shopping-cart';

    protected $session;
    protected $instance;

    /**
     * Constructs a new cart object.
     *
     * @param Illuminate\Session\SessionManager $session
     */
    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function createTransaction($data, $transaction) : void{
        /**
         * parsing parsing dan insert via modules Transaction models
         */
        // dd($response, $transaction);
        try {
            DB::beginTransaction();

            $creteTransaction = Transaction::create([
                'uuid' => Uuid::uuid4(),
                'doc_no' => Uuid::uuid4(),
                'token' => $data['args']['transaction_details']['order_id'],
                'date' => $transaction['transactions']['date'],
                'gateway' => $transaction['transactions']['gateway'],
                'type' => 'PENDING',
                'method' => 'PENDING',
                'invoice_url' => $data['invoice_url'],
                'snap_payment_url' => $data['snap_payment_url'] ?? null,
                'total_quantity' => $transaction['transactions']['total_quantity'],
                'total_weight' => $transaction['transactions']['total_weight'],
                'sub_total' => $transaction['transactions']['sub_total'],
                'grand_total' => $transaction['transactions']['grand_total'],
                'discount_voucher_id' => $transaction['transactions']['discount_voucher_id'] ?? null,
                'voucher_code' => $transaction['transactions']['voucher_code'] ?? null,
                'voucher_discount' => $transaction['transactions']['voucher_discount'] ?? null,
                'description' => $transaction['transactions']['description'],
                'status' => 'CREATED'
            ]);

            $transaction['transaction_destinations']['transaction_id'] = $creteTransaction->id;
            $transaction['transaction_shippings']['transaction_id'] = $creteTransaction->id;

            TransactionDestination::create($transaction['transaction_destinations']);

            $transactionItems = [];

            foreach($transaction['transaction_items']['items'] as $items){
                $transactionItems[] = [
                    'transaction_id' => $creteTransaction->id,
                    'product_detail_id' => $items['size_id'],
                    'quantity' => $items['quantity'],
                    'weight' => $items['weight'],
                    'price' => intval($items['discount_price']) != 0 ? intval($items['discount_price']) : intval($items['retail_price'])
                ];
            }

            TransactionItems::insert($transactionItems);

            TransactionShippings::create($transaction['transaction_shippings']);

            // Record voucher usage if voucher was used
            if (isset($transaction['transactions']['discount_voucher_id']) && $transaction['transactions']['discount_voucher_id']) {
                $email = $transaction['transaction_destinations']['email'] ?? null;
                
                // Record usage by email
                if ($email) {
                    $voucherRepo = app(\Modules\DiscountVoucher\Repositories\DiscountVoucherRepository::class);
                    $voucherRepo->recordUsage(
                        $transaction['transactions']['discount_voucher_id'], 
                        $email,
                        $creteTransaction->id
                    );
                }
            }

            //insert histories
            $this->insertHistories([
                'transaction_id' => $creteTransaction->id,
                'response_raw' => '',
                'response_status' => 'CREATED',
                'response_code' => 200,
                'response_message' => '',
            ]);

            //insert histories again with status
            $this->insertHistories([
                'transaction_id' => $creteTransaction->id,
                'response_raw' => '',
                'response_status' => '',
                'response_code' => 200,
                'response_message' => '',
            ]);

            $email = $data['args']['customer_details']['email'];
            $data = [
                'invoice_url' => $data['invoice_url'],
                'customer_name' => $data['args']['customer_details']['first_name']." ".$data['args']['customer_details']['last_name'],
                'order_id' => $data['args']['transaction_details']['order_id']
            ];
            // send email create invoices
            $sendMail = Mail::send('email.invoice', $data , function($message) use($email){
                $message->to($email);
                $message->subject('SNEAKERS.ID Invoice Payment');
            });
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating transaction: '.$e->getMessage());
            throw $e;
        }
    }

    public function insertHistories($data){
        $transaction_before = TransactionHistories::where('transaction_id', $data['transaction_id'])->orderBy('created_at', 'desc')->first();

        $history = TransactionHistories::create([
            'transaction_id' => $data['transaction_id'],
            'transaction_history_id' => $transaction_before ? $transaction_before->id : NULL,
            'response_raw' => json_encode($data['response_raw']),
            'response_status' => $data['response_status'],
            'response_code' => $data['response_code'],
            'response_message' => $data['response_message'],
            'created_by' => auth()->user()->id ?? 'SYSTEM',
            'updated_by' => auth()->user()->id ?? 'SYSTEM',
        ]);
        return $history;
    }
}
