<?php

namespace App\Http\Controllers;

use App\Models\ReviewProduct;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;
use Modules\Transaction\Entities\Transaction;

class ReviewController extends Controller
{
    protected $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function all(Request $request)
    {
        $rating = $request->query('rating');
        $ratingFilter = null;

        if ($rating !== null && $rating !== '' && $rating !== 'all') {
            $ratingFilter = (int) $rating;
            if ($ratingFilter < 1 || $ratingFilter > 5) {
                $ratingFilter = null;
            }
        }

        return view('bootstrap.reviews-all', [
            'summary' => $this->reviewRepository->getGlobalSummary(),
            'reviews' => $this->reviewRepository->getPaginatedReviews($ratingFilter),
            'ratingFilter' => $ratingFilter,
        ]);
    }

    public function index($transaction_token)
    {
        $transaction = Transaction::where('token', $transaction_token)->first();

        if (! $transaction) {
            return redirect()->route('store')->with('error', 'Transaction not found.');
        }

        if (! $transaction->destination()->exists()) {
            return redirect()->route('store')->with('error', 'Transaction destination not found.');
        }

        $shipping = $transaction->shipping()->first();
        if (! $shipping || ! $shipping->shipping_waybill) {
            return redirect()->route('customer.transaction.detail', $transaction_token)
                ->with('error', 'AWB has not been inputted yet.');
        }

        $items = $transaction->items()->with('detail.product')->get();

        $reviews = ReviewProduct::where('transaction_token', $transaction_token)
            ->get()
            ->keyBy(function ($review) {
                return $review->product_id . '_' . $review->product_size;
            });

        return view('bootstrap.review', [
            'transaction' => $transaction,
            'items' => $items,
            'reviews' => $reviews,
        ]);
    }

    public static function canAccessReview(Transaction $transaction): bool
    {
        return $transaction->destination()->exists();
    }
}
