<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
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

    public function createTransaction($response, $transaction) : void{
        /**
         * parsing parsing dan insert via modules Transaction models
         */
        // dd($response, $transaction);
        $creteTransaction = Transaction::create([
            'uuid' => Uuid::uuid4(),
            'doc_no' => $response['id'],
            'token' => $response['external_id'],
            'date' => $transaction['transactions']['date'],
            'gateway' => $transaction['transactions']['gateway'],
            'type' => 'PENDING',
            'method' => 'PENDING',
            'invoice_url' => $response['invoice_url'],
            'total_quantity' => $transaction['transactions']['total_quantity'],
            'total_weight' => $transaction['transactions']['total_weight'],
            'sub_total' => $transaction['transactions']['sub_total'],
            'grand_total' => $transaction['transactions']['grand_total'],
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

        //insert histories
        $this->insertHistories([
            'transaction_id' => $creteTransaction->id,
            'response_raw' => $response,
            'response_status' => 'CREATED',
            'response_code' => 200,
            'response_message' => '',
        ]);

        //insert histories again with status
        $this->insertHistories([
            'transaction_id' => $creteTransaction->id,
            'response_raw' => $response,
            'response_status' => $response['status'],
            'response_code' => 200,
            'response_message' => '',
        ]);
    }

    public function insertHistories($data){
        $transaction_before = TransactionHistories::where('transaction_id', $data['transaction_id'])->orderBy('created_at', 'desc')->first();

        TransactionHistories::create([
            'transaction_id' => $data['transaction_id'],
            'transaction_history_id' => $transaction_before ? $transaction_before->id : NULL,
            'response_raw' => json_encode($data['response_raw']),
            'response_status' => $data['response_status'],
            'response_code' => $data['response_code'],
            'response_message' => $data['response_message'],
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);
    }
}
