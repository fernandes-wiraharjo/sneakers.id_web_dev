<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Brand\Repositories\BrandRepository;
use Modules\Product\Repositories\ProductRepository;
use Modules\LookBook\Repositories\LookBookRepository;
use Modules\Size\Repositories\SizeRepository;
use Modules\Faq\Repositories\FaqRepository;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Tag\Repositories\TagRepository;
use Modules\SignaturePlayer\Repositories\SignaturePlayerRepository;
use Illuminate\Support\Facades\Storage;
use App\Facades\Cart;

class CartController extends Controller
{
    public function __construct(
        BrandRepository $brandRepository,
        ProductRepository $productRepository,
        LookBookRepository $lookBookRepository,
        SizeRepository $sizeRepository,
        FaqRepository $faqRepository,
        CategoryRepository $categoryRepository,
        TagRepository $tagRepository,
        SignaturePlayerRepository $signaturePlayerRepository) {
            $this->brandRepository = $brandRepository;
            $this->productRepository = $productRepository;
            $this->lookBookRepository = $lookBookRepository;
            $this->sizeRepository = $sizeRepository;
            $this->faqRepository = $faqRepository;
            $this->categoryRepository = $categoryRepository;
            $this->tagRepository = $tagRepository;
            $this->signaturePlayerRepository = $signaturePlayerRepository;
    }

    public function cartCheckout(Request $request) {
        foreach(Cart::content() as $item){
            $get_product = $this->productRepository->getProductDetailByIdAndSize($item['id'], $item['size'])->first();
            if($get_product->qty - $item['quantity'] < 0) {
                // dd('qty not valid');
            }
        }
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('display-store.cart.checkout', $data);
    }

    public function createOrder(Request $request) {
        if(!auth()->check()){
            return redirect()->route('customer.login');
        }

        $data['total'] = Cart::total();
        $data['items'] = Cart::content();
        $data['notes'] = $request->note;
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('display-store.cart.checkout-order', $data);
    }
}
