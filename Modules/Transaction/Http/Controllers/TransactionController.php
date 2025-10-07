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
use Modules\Transaction\Entities\Transaction;
use Modules\Transaction\Entities\TransactionDestination;
use Modules\Transaction\Entities\TransactionHistories;
use Modules\Transaction\Entities\TransactionItems;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(TransactionDatatables $dataTable)
    {
        ladmin()->allow('administrator.transaction.index');
        return $dataTable->render('transaction::index');
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

            $updated = $shipping->update(['shipping_waybill' => $request->shipping_waybill, 'status' => $status_shipping]);

            if (!$updated) {
                throw new \Exception('Failed to update shipping data.');
            }
          
            $history_created = TransactionHistories::create([
                'transaction_id' => $shipping->transaction_id,
                'response_raw' => json_encode($response),
                'response_status' => $response['data']['delivered'] ?? 'ERROR',
                'response_code' =>  $response['meta']['code'] ?? '400',
                'response_message' =>  $response['meta']['status'] != 'OK' ? $response['meta']['status'] : 'Update Shipping status',
                'created_by' =>  auth()->user()->id,
            ]);

            if($history_created) {
                $shipping->update(['status' => $response['data']['delivered'] ?? 'RESI NOT VALID']);
            }

            $phoneNumber = TransactionDestination::where('transaction_id', $shipping->transaction_id)->value('phone_number');
            $response = CekOngkir::CheckWaybill($request->shipping_waybill, 'jnt', substr($phoneNumber, -5));

            if (!$response) {
                throw new \Exception('Failed to check waybill, empty response.');
            }

            if (intval($request->complete)) {
                $status = 'COMPLETED';
                $transaction = Transaction::findOrFail($shipping->transaction_id);
                $transaction->update(['status' => $status]);

                $email = $transaction->destination->email;
                $data = [
                    'transaction_details' => route('customer.transaction.detail', $transaction->token),
                    'customer_name' => $transaction->destination->first_name . " " . $transaction->destination->last_name,
                    'order_id' => $transaction->token
                ];
                Mail::send('email.order-complete', $data, function($message) use($email) {
                    $message->to($email);
                    $message->subject('SNEAKERS.ID Your Order is complete.');
                });

                // Stock Update
                $transactionItems = TransactionItems::where('transaction_id', $shipping->transaction_id)->get();
                foreach ($transactionItems as $item) {
                    $current_item = $item->detail;
                    $current_item->update(['qty' => $current_item->qty - $item->quantity]);
                }
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

            $shipping->update(['status' => $response['data']['delivered'] ?? 'RESI NOT VALID']);

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
        $phoneNumber = TransactionDestination::where('transaction_id', $request->id)
        ->value('phone_number');
        $lastFiveDigitPhoneNumber = substr($phoneNumber, -5);

    //     Log::info('ajaxCheckResi phoneNumber', [
    //     'transaction_id' => $request->id,
    //     'phone_number'   => $phoneNumber,
    //     'last_five'   => $lastFiveDigitPhoneNumber,
    // ]);
        $response = CekOngkir::CheckWaybill($request->shipping_waybill, 'jnt', $lastFiveDigitPhoneNumber);

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
}
