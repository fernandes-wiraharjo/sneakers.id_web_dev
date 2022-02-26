<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Brand\Repositories\BrandRepository;
use Modules\Product\Repositories\ProductRepository;

class StoreController extends Controller
{
    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }
    public function index(BrandRepository $brandRepository) {
        $data['brand'] = $brandRepository->getAllBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('welcome', $data);
    }

    public function productDetail($id){
        $data['product'] = $this->productRepository->getProductByIdWithEager($id);
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('product-detail', $data);
    }

    public function collections($filter){
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('collections', $data);
    }

    public function lookbook($page){
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('lookbook', $data);
    }
}
