<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Category;
use App\Notifications\SendNotification;
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
use Spatie\SlackAlerts\Facades\SlackAlert;

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
        // SlackAlert::message("test");
        $data['featured_air_jordan'] = $this->productRepository->getProductOneFeaturedAirJordan();
        $data['featured_nike'] = $this->productRepository->getProductOneFeaturedNike();
        $data['brand'] = $this->brandRepository->getAllBrand();
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        activity()->log('Someone Accessing my website');
        return view('display-store.landing', $data);
    }

    public function productDetail($id){
        $data['product'] = $this->productRepository->getProductByIdWithEager($id);
        $data['size'] = $data['product']->details()->where('product_details.qty', '>' , 0)->get();
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        activity()->log('Someone look into my product');
        return view('display-store.product-detail', $data);
    }

    public function search(Request $request){

        $data = $request->all();
        $keyword = $data['search'] ?? '';
        $this->search = $keyword;

        $brand = $this->brandRepository->getBrandByName($keyword);
        $category = $this->categoryRepository->getCategoryByName($keyword);
        $tag = $this->tagRepository->getTagByName($keyword);
        $size = $this->sizeRepository->getSizeByName($keyword);
        $signature = $this->signaturePlayerRepository->getSignatureByName($keyword);

        $brand_id = $brand ? $brand->pluck('id')->toArray() : null;
        $category_id = $category ? $category->pluck('id')->toArray() : null;
        $tag_id = $tag ? $tag->pluck('id')->toArray() : null;
        $size_id = $size ? $size->pluck('id')->toArray() : null;
        $signature_id = $signature ? $signature->pluck('id')->toArray() : null;

        $result_item = $this->productRepository->getProductWhere()
                                ->when($brand_id, function ($query, $brands){
                                    return $query->whereHas('detail', function ($q) use ($brands){
                                        return $q->whereIn('brand_id', $brands)
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($size_id, function ($query, $sizes){
                                    return $query->whereHas('sizes', function ($q) use ($sizes){
                                        return $q->whereIn('size_id', $sizes)
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($tag_id, function ($query, $tags) {
                                    return $query->whereHas('tags', function ($q) use ($tags){
                                        $tags = array_unique($tags);
                                        return $q->whereIn('tag_id', $tags)
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($category_id, function ($query, $categories){
                                    return $query->whereHas('categories', function ($q) use ($categories){
                                        $categories = array_unique($categories);
                                        return $q->whereIn('category_id', $categories)
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($signature_id, function ($query, $signatures){
                                    return $query->whereHas('signatures', function ($q) use ($signatures){
                                        return $q->whereIn('signature_player_id', $signatures)
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($this->search, function ($query, $search){
                                    return $query->where('product_name', 'LIKE', '%'.$search.'%')
                                        ->where('description', 'LIKE', '%'.$search.'%');
                                });

        $result = [
            'item' => $result_item->limit(5)->get(),
            'total_result' => $result_item->count()
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
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        activity()->log('Someone find a product');
        return view('display-store.search-result', $data);
    }

    public function collections($keyword){
        $data['keyword'] = $keyword;
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('display-store.collections', $data);
    }

    public function lookbook($page){
        $data['next_page'] = $this->lookBookRepository->getNextLookBook($page);
        $data['prev_page'] = $this->lookBookRepository->getPrevLookBook($page);
        $data['lookbook'] = $this->lookBookRepository->getAllLookBookPaginate(20);
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('display-store.lookbook', $data);
    }

    public function sizeChart(){
        $data['sizes'] = $this->sizeRepository->getAllActiveSizes();
        $data['men_sizes'] = $this->sizeRepository->getAllMenSize();
        $data['women_sizes'] = $this->sizeRepository->getAllWomenSize();
        $data['kid_sizes'] = $this->sizeRepository->getAllKidSize();
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('display-store.size-chart', $data);
    }

    public function aboutUs(){
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('display-store.about-us', $data);
    }

    public function faq(){
        $data['faq'] = $this->faqRepository->getAllFaq();
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('display-store.qna', $data);
    }

    public function email(){
        return view('email.invoice');
    }
}
