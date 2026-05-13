<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Product\Repositories\ProductRepository;
use App\Facades\Cart;
use Modules\Product\Entities\ProductDetail;

class CartController extends Controller
{
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function cartCheckout(Request $request) {
        foreach(Cart::content() as $item){
                $get_product = $this->productRepository->getProductDetailByIdAndSize($item['id'], $item['size']);
                // if($get_product->qty - $item['quantity'] < 0) {
                //     // dd('qty not valid');
                // }
        }
        return view('bootstrap.cart');
    }

    public function createOrder(Request $request) {
        foreach (Cart::content() as $item) {
            $detail = ProductDetail::query()->find($item['size_id']);
            $stock = $detail ? (int) $detail->qty : 0;
            if ($stock <= 0) {
                return redirect()
                    ->route('customer.cart')
                    ->with('toast_error', 'One or more items are no longer in stock. Remove them from your cart and try again.');
            }
        }

        // Guest checkout is now allowed - no authentication check needed
        $data['total'] = Cart::total();
        $data['items'] = Cart::content();
        $data['notes'] = $request->note;
        return view('bootstrap.checkout-order', $data);
    }
}
