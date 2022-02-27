<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Brand\Repositories\BrandRepository;
use Modules\Product\Repositories\ProductRepository;
use Modules\LookBook\Repositories\LookBookRepository;
use Modules\Size\Repositories\SizeRepository;

class StoreController extends Controller
{
    public function __construct(ProductRepository $productRepository, LookBookRepository $lookBookRepository, SizeRepository $sizeRepository) {
        $this->productRepository = $productRepository;
        $this->lookBookRepository = $lookBookRepository;
        $this->sizeRepository = $sizeRepository;
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
        $data['next_page'] = $this->lookBookRepository->getNextLookBook($page);
        $data['prev_page'] = $this->lookBookRepository->getPrevLookBook($page);
        $data['lookbook'] = $this->lookBookRepository->getLookBookByPageNumber(intval($page));
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('lookbook', $data);
    }

    public function sizeChart(){
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('size-chart', $data);
    }
}
