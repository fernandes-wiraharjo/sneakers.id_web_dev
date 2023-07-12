<?php

namespace Modules\Transaction\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transaction\Entities\TransactionDatatables;
use Modules\Transaction\Entities\TransactionShippings;
use Alert;
use App\Facades\CekOngkir;
use App\Services\CekOngkirService;
use Modules\Transaction\Entities\Transaction;
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

        $shipping = TransactionShippings::findOrFail($request->id)->first();
        $status = '';

        if(intval($request->complete)){
            $status = 'COMPLETED';
            $update_transactions = Transaction::findOrFail($shipping->transaction_id)->update(['status' => $status]);
        }

        $status_shipping = 'DIKEMAS';
        if($request->shipping_waybill != "" || $shipping->status != 'DIKIRIM' || $shipping->status != 'DELIVERED') {
            $status_shipping = 'DIKIRIM';
        }

        $updated = $shipping->update(['shipping_waybill' => $request->shipping_waybill, 'status' => $status_shipping]);
        if($updated) {
            //create shipping history and get Raja Ongkir cek resi
            $response = CekOngkir::CheckWaybill($request->shipping_waybill, 'jnt');

            $history_created = TransactionHistories::create([
                'transaction_id' => $shipping->transaction_id,
                'response_raw' => json_encode($response),
                'response_status' => $response['rajaongkir']['result']['delivery_status']['status'] ?? 'ERROR',
                'response_code' =>  $response['rajaongkir']['status']['code'] ?? '400',
                'response_message' =>  $response['rajaongkir']['status']['description'] != 'OK' ? $response['rajaongkir']['status']['description'] : 'Update Shipping status',
                'created_by' =>  auth()->user()->id,
            ]);

            if($history_created) {
                $shipping->update(['status' => $response['rajaongkir']['result']['delivery_status']['status'] ?? 'RESI NOT VALID']);
            }

            //if status complete update quantity
            if(intval($request->complete)) {
                $transaction = TransactionItems::where('transaction_id', $shipping->transaction_id)->get();

                foreach($transaction as $item) {
                    $qty_sold = $item->quantity;
                    $current_item = $item->detail;
                    $current_item->update(['qty' => $current_item->qty - $qty_sold]);
                }
            }

            Alert::success('Success update resi & status');
            return redirect()->back()->withSuccess('Success update resi & status');
        }

        Alert::error('Failed update resi & status');
        return redirect()->back()->withErrors('Failed update resi & status');
    }

    public function ajaxCheckResi(Request $request)
    {
        $response = CekOngkir::CheckWaybill($request->shipping_waybill, 'jnt');

        return $response['rajaongkir'];
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
