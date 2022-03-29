<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Brand\Repositories\BrandRepository;
use Modules\Product\Repositories\ProductRepository;
use Modules\LookBook\Repositories\LookBookRepository;
use Modules\Size\Repositories\SizeRepository;
use Modules\Faq\Repositories\FaqRepository;

class StoreController extends Controller
{
    public function __construct(
        BrandRepository $brandRepository,
        ProductRepository $productRepository,
        LookBookRepository $lookBookRepository,
        SizeRepository $sizeRepository,
        FaqRepository $faqRepository) {
            $this->brandRepository = $brandRepository;
            $this->productRepository = $productRepository;
            $this->lookBookRepository = $lookBookRepository;
            $this->sizeRepository = $sizeRepository;
            $this->faqRepository = $faqRepository;
    }
    public function index() {
        $data['featured_air_jordan'] = $this->productRepository->getProductOneFeaturedAirJordan();
        $data['featured_nike'] = $this->productRepository->getProductOneFeaturedNike();
        $data['brand'] = $this->brandRepository->getAllBrand();
        $data['brand_menu'] = $this->brandRepository->getBrandMenu();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('welcome', $data);
    }

    public function productDetail($id){
        $data['product'] = $this->productRepository->getProductByIdWithEager($id);
        $data['brand_menu'] = $this->brandRepository->getBrandMenu();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('product-detail', $data);
    }

    public function search(Request $request){
        //dd($request->all());
        $data = $request->all();
        $keyword = $data['q'];
        $data['keyword'] = $keyword;
        $data['brand_menu'] = $this->brandRepository->getBrandMenu();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('collections', $data);
    }

    public function collections($keyword){
        $data['keyword'] = $keyword;
        $data['brand_menu'] = $this->brandRepository->getBrandMenu();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('collections', $data);
    }

    public function lookbook($page){
        $data['next_page'] = $this->lookBookRepository->getNextLookBook($page);
        $data['prev_page'] = $this->lookBookRepository->getPrevLookBook($page);
        $data['lookbook'] = $this->lookBookRepository->getAllLookBookPaginate(20);
        $data['brand_menu'] = $this->brandRepository->getBrandMenu();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('lookbook', $data);
    }

    public function sizeChart(){
        $data['sizes'] = $this->sizeRepository->getAllActiveSizes();
        $data['brand_menu'] = $this->brandRepository->getBrandMenu();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('size-chart', $data);
    }

    public function aboutUs(){
        $data['brand_menu'] = $this->brandRepository->getBrandMenu();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('about-us', $data);
    }

    public function faq(){
        $data['faq'] = $this->faqRepository->getAllFaq();
        $data['brand_menu'] = $this->brandRepository->getBrandMenu();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('qna', $data);
    }
}
