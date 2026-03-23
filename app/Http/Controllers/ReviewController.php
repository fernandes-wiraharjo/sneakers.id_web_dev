<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Transaction\Entities\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index($transaction_token)
    {
        $transaction = Transaction::where('token', $transaction_token)->first();
        
        if (!$transaction) {
            return redirect()->route('store')->with('error', 'Transaction not found.');
        }

        // Check if user is authorized (must be the transaction owner)
        $user = Auth::user();
        $transactionDestination = $transaction->destination()->first();
        
        if (!$user || ($transactionDestination && $transactionDestination->user_id != $user->id)) {
            return redirect()->route('store')->with('error', 'Unauthorized access.');
        }

        // Check if shipping waybill exists
        $shipping = $transaction->shipping()->first();
        if (!$shipping || !$shipping->shipping_waybill) {
            return redirect()->route('customer.transaction.detail', $transaction_token)
                ->with('error', 'AWB has not been inputted yet.');
        }

        // Get all items with their products
        $items = $transaction->items()->with('detail.product')->get();
        
        // Get existing reviews
        $reviews = \App\Models\ReviewProduct::where('transaction_token', $transaction_token)
            ->where('user_id', $user->id)
            ->get()
            ->keyBy(function($review) {
                return $review->product_id . '_' . $review->product_size;
            });

        $data = [
            'transaction' => $transaction,
            'items' => $items,
            'reviews' => $reviews,
        ];

        return view('bootstrap.review', $data);
    }
}

