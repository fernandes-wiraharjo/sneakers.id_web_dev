<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Modules\Product\Entities\Product;
use Modules\Brand\Repositories\BrandRepository;
use Modules\Product\Repositories\ProductRepository;
use Modules\Size\Repositories\SizeRepository;
use Modules\Tag\Repositories\TagRepository;
use Modules\Category\Repositories\CategoryRepository;
use Modules\SignaturePlayer\Repositories\SignaturePlayerRepository;

class ProductList extends Component
{
    use WithPagination;

    public $search;
    public $brand = [];
    public $size = [];
    public $tag = [];
    public $category = [];
    public $signature = [];
    public $keyword;
    public $sort_by = 'DESC';
    public $sort_column = 'created_at';

    protected $updatesQueryString = ['search'];

    public function sort($sort_column = 'created_at', $sort_by){
        $this->sort_by = $sort_by;
        $this->sort_column = $sort_column;
    }

    public function mount(): void
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatedBrand()
    {
        if(!is_array($this->brand)) return;
        $this->brand = array_filter($this->brand,
            function ($brand) {
                return $brand != false;
            }
        );
    }

    public function updatedCategory()
    {
        if(!is_array($this->category)) return;
        $this->category = array_filter($this->category,
            function ($category) {
                return $category != false;
            }
        );
    }

    public function updatedTag()
    {
        if(!is_array($this->tag)) return;
        $this->tag = array_filter($this->tag,
            function ($tag) {
                return $tag != false;
            }
        );
    }

    public function updatedSignature()
    {
        if(!is_array($this->signature)) return;
        $this->signature = array_filter($this->signature,
            function ($signature) {
                return $signature != false;
            }
        );
    }

    public function render(
        ProductRepository $productRepository,
        BrandRepository $brandRepository,
        SizeRepository $sizeRepository,
        TagRepository $tagRepository,
        CategoryRepository $categoryRepository,
        SignaturePlayerRepository $signaturePlayerRepository
        ): View
    {
        $data['filters'] = [
            'brand' => $brandRepository->getAllBrand(),
            'size' => $sizeRepository->getAllSizes(),
            'tag' => $tagRepository->getAllTags(),
            'category' => $categoryRepository->getAllCategories(),
            'signature_player' => $signaturePlayerRepository->getAllSignatures()
        ];

        if($this->keyword != 'all') {
            $keyword = str_replace('-', ' ', $this->keyword);
            $keyword_array = explode('.', $keyword);
            if(count($keyword_array) >= 2){
                $keyword_array[1] = str_replace('-', ' ', $keyword_array[1]);
                $brand = $brandRepository->getBrandByName($keyword_array[1]);
                $category = $categoryRepository->getCategoryByName($keyword_array[1]);
                $brand_id = $brand ? $brand->id : null;
                $category_id = $category ? $category->id : null;
                if($brand_id) {
                    $this->brand[] = $brand_id;
                }

                if($category_id) {
                    $this->category[] = intval($category_id);
                }

                if($keyword_array[0] != 'all'){
                    $category = $categoryRepository->getCategoryByName($keyword_array[0]);
                    $category_id = $category ? $category->id : null;
                    if($category_id) {
                        $this->category[] = intval($category_id);
                    }

                    $tag = $tagRepository->getTagByName($keyword_array[0]);
                    $tag_id = $tag ? $tag->id : null;
                    if($tag_id) {
                        $this->tag[] = $tag_id;
                    }
                }
            } else {
                $category = $categoryRepository->getCategoryByName($keyword_array[0]);
                $category_id = $category ? $category->id : null;
                if($category_id) {
                    $this->category[] = intval($category_id);
                }

                $tag = $tagRepository->getTagByName($keyword);
                $tag_id = $tag ? $tag->id : null;
                if($tag_id) {
                    $this->tag[] = $tag_id;
                }
            }
        }

        $sale_category_id = $categoryRepository->getCategoryByName('sale')->id ?? null;
        $sale_tag_id = $tagRepository->getTagByName('sale')->id ?? null;
        $discount_id = $tagRepository->getTagByName('discount')->id ?? null;

        $products = $productRepository->getProductWhere()
                                ->when($this->search, function ($query, $search){
                                    return $query->where('product_name', 'LIKE', '%'.$search.'%')
                                        ->orWhere('description', 'LIKE', '%'.$search.'%');
                                })
                                ->when($this->brand, function ($query, $brands){
                                    return $query->whereHas('detail', function ($q) use ($brands){
                                        return $q->whereIn('brand_id', array_unique($brands))
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($this->category, function ($query, $categories){
                                    return $query->whereHas('categories', function ($q) use ($categories){
                                        return $q->whereIn('category_id', array_unique($categories))
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($this->tag, function ($query, $tags) {
                                    return $query->whereHas('tags', function ($q) use ($tags){
                                        return $q->whereIn('tag_id', array_unique($tags))
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($this->signature, function ($query, $signatures){
                                    return $query->whereHas('signatures', function ($q) use ($signatures){
                                        return $q->whereIn('signature_player_id', array_unique($signatures))
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                /**
                                 * Sizes not in filter
                                 */
                                // ->when($this->size, function ($query, $sizes){
                                //     return $query->whereHas('sizes', function ($q) use ($sizes){
                                //         return $q->orWhereIn('size_id', array_unique($sizes))
                                //             ->when($this->search, function ($query, $search){
                                //                 return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                //             });
                                //     });
                                // })
                                ->when($this->keyword === 'sale' || $this->keyword === 'discount' || in_array($sale_category_id, $this->category) || in_array($sale_tag_id, $this->tag) || in_array($discount_id, $this->tag), function ($query) {
                                    return $query->where('pd.discount_percentage', '>', 0);
                                })
                                ->orderBy($this->sort_column, $this->sort_by);
        /**
         * Query debug
         */
        // $data['sql'] = $products->toSql();
        $data['products'] = $products->paginate(40);
        return view('livewire.product-list', $data);
    }
}
