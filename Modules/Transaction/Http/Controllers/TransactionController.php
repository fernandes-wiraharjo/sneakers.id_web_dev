<?php

namespace Modules\Transaction\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Transaction\Entities\TransactionDatatables;
use Modules\Transaction\Entities\TransactionShippings;
use Alert;
use App\Facades\CekOngkir;
use App\Services\CekOngkirService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Modules\Transaction\Entities\Transaction;
use Modules\Transaction\Entities\TransactionDestination;
use Modules\Transaction\Entities\TransactionHistories;
use Modules\Transaction\Entities\TransactionItems;
use Modules\Transaction\Entities\Refund;
use Modules\Reporting\Services\SyncTransactionToReportService;
use Intervention\Image\Facades\Image;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(TransactionDatatables $dataTable)
    {
        ladmin()->allow('administrator.transaction.index');

        $counts = Transaction::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return $dataTable->render('transaction::index', [
            'statusTab' => request('status', 'all'),
            'tabCounts' => [
                'all' => $counts->sum(),
                'pending' => (int) ($counts['CREATED'] ?? 0) + (int) ($counts['PENDING'] ?? 0),
                'success' => (int) ($counts['SUCCESS'] ?? 0),
                'completed' => (int) ($counts['COMPLETED'] ?? 0),
                'failed' => (int) ($counts['FAILED'] ?? 0)
                    + (int) ($counts['CANCELLED'] ?? 0)
                    + (int) ($counts['EXPIRED'] ?? 0)
                    + (int) ($counts['DENIED'] ?? 0)
                    + (int) ($counts['REFUNDED'] ?? 0),
            ],
        ]);
    }

    public function updateResi(Request $request) {
        if(!$request->id) {
            Alert::error('invalid shipping id');
            return redirect()->back()->withErrors('invalid shipping id');
        }

        $shipping = TransactionShippings::findOrFail($request->id);
        $status = '';

        $status_shipping = 'DIKEMAS';
        if($request->shipping_waybill != "" || $request->shipping_waybill != NULL || $shipping->status != 'DIKIRIM' || $shipping->status != 'DELIVERED' ) {
            $status_shipping = 'DIKIRIM';
        }

        try {
            // Mulai transaksi
            DB::beginTransaction();

            $phoneNumber = TransactionDestination::where('transaction_id', $shipping->transaction_id)->value('phone_number');
            $lastFiveDigitPhoneNumber = substr(preg_replace('/[^0-9]/', '', $phoneNumber), -5);
            $courierCode = $shipping->courier_code;
            $response = CekOngkir::CheckWaybill($request->shipping_waybill, $courierCode, $lastFiveDigitPhoneNumber);

            if (!$response) {
                throw new \Exception('Failed to check waybill, empty response.');
            }

            $history_created = TransactionHistories::create([
                'transaction_id' => $shipping->transaction_id,
                'response_raw' => json_encode($response),
                'response_status' => $response['data']['delivered'] ?? 'ERROR',
                'response_code' =>  $response['meta']['code'] ?? '400',
                'response_message' =>  $response['meta']['status'] != 'OK' ? $response['meta']['status'] : 'Update Shipping status',
                'created_by' =>  auth()->user()->id,
            ]);

            if (intval($request->complete)) {
                $status = 'COMPLETED';
                $transaction = Transaction::findOrFail($shipping->transaction_id);
                $transaction->update(['status' => $status]);

                $email = $transaction->destination->email;
                $data = [
                    'transaction_details' => route('customer.transaction.detail', $transaction->token),
                    'review_url' => route('customer.transaction.review', $transaction->token),
                    'customer_name' => $transaction->destination->first_name . " " . $transaction->destination->last_name,
                    'order_id' => $transaction->token
                ];
                Mail::send('email.order-complete', $data, function($message) use($email) {
                    $message->to($email);
                    $message->subject('SNEAKERS.ID Your Order is complete.');
                });

            }

            $history_created = TransactionHistories::create([
                'transaction_id' => $shipping->transaction_id,
                'response_raw' => json_encode($response),
                'response_status' => $response['data']['delivered'] ?? 'ERROR',
                'response_code' => $response['meta']['code'] ?? '400',
                'response_message' => $response['meta']['status'] != 'OK' ? $response['meta']['status'] : 'Unknown',
                'created_by' => auth()->user()->id,
            ]);

            if (!$history_created) {
                throw new \Exception('Failed to create transaction history.');
            }

            $shipping->update([
                'shipping_waybill' => $request->shipping_waybill,
                'status' => $response['data']['summary']['status'] ?? 'RESI NOT VALID'
            ]);

            $transaction = Transaction::find($shipping->transaction_id);
            if ($transaction) {
                app(SyncTransactionToReportService::class)->syncTransaction($transaction);
            }

            DB::commit();

            Alert::success('Success update resi & status');
            return redirect()->back()->withSuccess('Success update resi & status');

        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Failed update resi', $e->getMessage());
            return redirect()->back()->withErrors('Failed update resi');
        }

        Alert::error('Failed update resi & status');
        return redirect()->back()->withErrors('Failed update resi & status');
    }

    public function ajaxCheckResi(Request $request)
    {
        $transactionDestination = TransactionDestination::where('transaction_id', $request->id)->first();
        $lastFiveDigitPhoneNumber = substr(preg_replace('/[^0-9]/', '', $transactionDestination->phone_number), -5);
        $transactionShipping = TransactionShippings::where('transaction_id', $request->id)->first();
        
        $response = CekOngkir::CheckWaybill($request->shipping_waybill, $transactionShipping->courier_code, $lastFiveDigitPhoneNumber);

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('transaction::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('transaction::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('transaction::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Store refund
     * @param Request $request
     * @return Renderable
     */
    public function storeRefund(Request $request)
    {
        ladmin()->allow('administrator.transaction.index');

        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'proof_image' => 'nullable|image',
            'reason' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $refundData = [
                'transaction_id' => $request->transaction_id,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'account_holder_name' => $request->account_holder_name,
                'amount' => $request->amount,
                'reason' => $request->reason,
                'processed_by' => auth()->user()->id,
                'processed_at' => now(),
            ];

            // Handle image upload with Intervention Image
            if ($request->hasFile('proof_image')) {
                $image = $request->file('proof_image');
                $imageName = 'refund_' . time() . '_' . uniqid() . '.webp';
                
                // Process image with Intervention Image
                $img = Image::make($image);
                
                // Resize if needed (maintain aspect ratio, max width 1200px)
                if ($img->width() > 1200) {
                    $img->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }
                
                // Convert to WebP and save using Storage
                $encodedImage = $img->encode('webp', 85);
                Storage::disk('public_directory')->put('refunds/' . $imageName, $encodedImage);
                
                $refundData['proof_image'] = $imageName;
            }

            $refund = Refund::create($refundData);

            // Update transaction status to REFUNDED
            $transaction = Transaction::findOrFail($request->transaction_id);
            $transaction->update(['status' => 'REFUNDED']);

            DB::commit();

            Alert::success('Success', 'Refund processed successfully');
            return redirect()->route('administrator.transaction.index');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Refund creation failed: ' . $e->getMessage());
            Alert::error('Failed', 'Failed to create refund request: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

}
