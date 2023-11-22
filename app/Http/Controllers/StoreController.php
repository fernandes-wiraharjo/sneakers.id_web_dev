<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Brand\Repositories\BrandRepository;
use Modules\Product\Repositories\ProductRepository;
use Modules\LookBook\Repositories\LookBookRepository;
use Modules\Size\Repositories\SizeRepository;
use Modules\Faq\Repositories\FaqRepository;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Tag\Repositories\TagRepository;
use Modules\SignaturePlayer\Repositories\SignaturePlayerRepository;

class StoreController extends Controller
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

    public function index() {
        $data['featured_air_jordan'] = $this->productRepository->getProductOneFeaturedAirJordan();
        $data['featured_nike'] = $this->productRepository->getProductOneFeaturedNike();
        $data['brand'] = $this->brandRepository->getAllBrand();
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['signature'] = $this->signaturePlayerRepository->getAllSignatures();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('welcome', $data);
    }

    public function productDetail($id){
        $data['product'] = $this->productRepository->getProductByIdWithEager($id);
        $data['size'] = $data['product']->details()->where('product_details.qty', '>' , 0)->get();
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['signature'] = $this->signaturePlayerRepository->getAllSignatures();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('product-detail', $data);
    }

    public function search(Request $request){
        $data = $request->all();
        $keywords = strtoupper($data['search'] ?? '');
        $keywords = str_replace('-', ' ', $keywords);
        $keyword_array = explode('.', $keywords);

        $this->brand = [];
        $this->category = [];
        $this->tag = [];
        $this->signature = [];

        if(count($keyword_array) >= 2){

            foreach ($keyword_array as $keyword) {
                $brand = $this->brandRepository->getBrandByName($keyword);
                $category = $this->categoryRepository->getCategoryByName($keyword);
                $tag = $this->tagRepository->getTagByName($keyword);
                $signature = $this->signaturePlayerRepository->getOneSignatureByName($keyword);

                $brand_id = $brand ? $brand->id : null;
                $category_id = $category ? $category->id : null;
                $tag_id = $tag ? $tag->id : null;
                $signature_id = $signature ? $signature->id : null;

                if ($brand_id) {
                    $this->brand[] = $brand_id;
                }

                if ($category_id) {
                    $this->category[] = intval($category_id);
                }

                if ($tag_id) {
                    $this->tag[] = $tag_id;
                }

                if ($signature_id) {
                    $this->signature[] = $signature_id;
                }
            }
        } else {
            $category = $this->categoryRepository->getCategoryByName($keyword_array[0]);
            $category_id = $category ? $category->id : null;
            if($category_id) {
                $this->category[] = intval($category_id);
            }

            $brand = $this->brandRepository->getBrandByName($keyword_array[0]);
            $brand_id = $brand ? $brand->id : null;
            if($brand_id) {
                $this->brand[] = intval($brand_id);
            }

            $tag = $this->tagRepository->getTagByName($keyword_array[0]);
            $tag_id = $tag ? $tag->id : null;
            if($tag_id) {
                $this->tag[] = $tag_id;
            }

            $signature = $this->signaturePlayerRepository->getOneSignatureByName($keyword_array[0]);
            $signature_id = $signature ? $signature->id : null;
            if($signature_id) {
                $this->signature[] = $signature_id;
            }
        }

        $sale_category_id = $this->categoryRepository->getCategoryByName('sale')->id ?? [];
        $sale_tag_id = $this->tagRepository->getTagByName('sale')->id ?? [];
        $discount_id = $this->tagRepository->getTagByName('discount')->id ?? [];

        $result_item = $this->productRepository->getProductWhere()
            ->when($keywords, function ($query, $search) use ($keyword_array) {
                $query->where(function ($query) use ($keyword_array) {
                    foreach ($keyword_array as $keyword) {
                        $query->orWhere('product_name', 'LIKE', '%' . $keyword . '%');
                            // ->orWhere('description', 'LIKE', '%' . $keyword . '%');
                    }
                });
            })
            ->when($this->brand, function ($query, $brands) {
                return $query->whereHas('detail', function ($q) use ($brands) {
                    return $q->whereIn('brand_id', $brands);
                });
            })
            ->when($this->tag, function ($query, $tags) {
                return $query->whereHas('tags', function ($q) use ($tags) {
                    return $q->whereIn('tag_id', $tags);
                });
            })
            ->when($this->category, function ($query, $categories) {
                return $query->whereHas('categories', function ($q) use ($categories) {
                    return $q->whereIn('category_id', $categories);
                });
            })
            ->when($this->signature, function ($query, $signatures) {
                return $query->whereHas('signatures', function ($q) use ($signatures) {
                    return $q->whereIn('signature_player_id', $signatures);
                });
            })
            ->when(
                $keywords === 'sale' ||
                $keywords === 'discount' ||
                in_array('sale', $keyword_array) ||
                in_array('discount', $keyword_array) ||
                in_array($sale_category_id, $this->category) ||
                in_array($sale_tag_id, $this->tag) ||
                in_array($discount_id, $this->tag),
                function ($query) {
                    return $query->where('pd.discount_percentage', '>', 0);
                }
            )
            ->when(
                $keywords === 'new-release',
                function ($query) {
                    $date = date('Y-m-d H:i:s');
                    return $query->whereHas('tags', function ($q) use ($date) {
                        $q->where('tag_title', 'NEW RELEASE')
                            ->whereRaw('DATEDIFF(product_tags.created_at, ?) > -30', [$date]);
                    });
                }
            );

        $all_item = $result_item->get()->count();

        $result = [
            'item' => $result_item->limit(5)->get(),
            'total_result' => $all_item
        ];

        return json_encode($result);
    }

    public function searchResult($keyword){
        $data['keyword'] = $keyword;
        $data['sizes'] = $this->sizeRepository->getAllActiveSizes();
        $data['men_sizes'] = $this->sizeRepository->getAllMenSize();
        $data['women_sizes'] = $this->sizeRepository->getAllWomenSize();
        $data['kid_sizes'] = $this->sizeRepository->getAllKidSize();
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['signature'] = $this->signaturePlayerRepository->getAllSignatures();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('search-result', $data);
    }

    public function collections($keyword){
        $data['keyword'] = $keyword;
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['signature'] = $this->signaturePlayerRepository->getAllSignatures();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('collections', $data);
    }

    public function lookbook($page){
        $data['next_page'] = $this->lookBookRepository->getNextLookBook($page);
        $data['prev_page'] = $this->lookBookRepository->getPrevLookBook($page);
        $data['lookbook'] = $this->lookBookRepository->getAllLookBookPaginate(20);
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['signature'] = $this->signaturePlayerRepository->getAllSignatures();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('lookbook', $data);
    }

    public function sizeChart(){
        $data['sizes'] = $this->sizeRepository->getAllActiveSizes();
        $data['men_sizes'] = $this->sizeRepository->getAllMenSize();
        $data['women_sizes'] = $this->sizeRepository->getAllWomenSize();
        $data['kid_sizes'] = $this->sizeRepository->getAllKidSize();
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['signature'] = $this->signaturePlayerRepository->getAllSignatures();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('size-chart', $data);
    }

    public function aboutUs(){
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['signature'] = $this->signaturePlayerRepository->getAllSignatures();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('about-us', $data);
    }

    public function faq(){
        $data['faq'] = $this->faqRepository->getAllFaq();
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['signature'] = $this->signaturePlayerRepository->getAllSignatures();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('qna', $data);
    }
}
