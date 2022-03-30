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
        // $data = $request->all();
        // $keyword = $data['q'];
        // $data['keyword'] = $keyword;
        // $data['brand_menu'] = $this->brandRepository->getBrandMenu();
        // $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return '<div class="Segment">'.
        '<div class="Segment__Title Segment__Title--flexed"><span class="Heading Text--subdued u-h7">Journal</span><a class="Heading Link Link--secondary u-h7" href="/search?q=s*&type=article">View all</a></div>'.

        '<div class="Segment__Content"><ul class="Linklist"><li class="Linklist__Item">'.
                    '<a href="/blogs/articles/ticket-to-90-s-roller-skate-kembali-mengambil-hati?_pos=1&_sid=0a113e99d&_ss=r" class="Link Link--secondary">Ticket to 90’s : Roller Skate Kembali Mengambil Hati</a>'.
                  '</li><li class="Linklist__Item">'.
                    '<a href="/blogs/articles/sole-superior-singapore-2017?_pos=2&_sid=0a113e99d&_ss=r" class="Link Link--secondary">SOLE SUPERIOR SINGAPORE 2017</a>'.
                  '</li><li class="Linklist__Item">'.
                    '<a href="/blogs/articles/artist-series-stcl-x-decky-sastra?_pos=3&_sid=0a113e99d&_ss=r" class="Link Link--secondary">ARTIST SERIES "STCL X DECKY SASTRA"</a>'.
                  '</li><li class="Linklist__Item">'.
                    '<a href="/blogs/articles/570-pairs-staycool-socks-sold-without-promo-discount-at-jakarta-sneaker-day-2019?_pos=4&_sid=0a113e99d&_ss=r" class="Link Link--secondary">2000 pairs StayCool Socks sold without promo / discount at Jakarta Sneaker Day 2019!</a>'.
                  '</li><li class="Linklist__Item">'.
                    '<a href="/blogs/articles/mind-control-skateboard-best-trick-contest-by-staycool-socks-vearst-jeans?_pos=5&_sid=0a113e99d&_ss=r" class="Link Link--secondary">SkateBoard Best Trick Contest by StayCool Socks</a>'.
                  '</li><li class="Linklist__Item">'.
                    '<a href="/blogs/articles/do-it-yourself?_pos=6&_sid=0a113e99d&_ss=r" class="Link Link--secondary">StayCool x Street Vision: Semangat #Pulsitive Melalui DIY Masker Knit</a>'.
                  '</li></ul></div>'.
      '</div>';
        // return view('collections', $data);
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
