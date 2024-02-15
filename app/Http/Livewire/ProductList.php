<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
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
    public $size_filter = [];
    public $tag = [];
    public $category = [];
    public $signature = [];
    public $keyword;
    public $sort_by = 'DESC';
    public $sort_column = 'products.created_at';
    public $sort_column_2 = 'pd.after_discount_price';
    public $gender = [];
    public $age_range = [];
    public $total_product = 0;
    public $gender_list = ['MENS', 'WOMENS', 'KIDS'];

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingBrand()
    {
        $this->resetPage();
    }

    public function updatingTag()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingSignature()
    {
        $this->resetPage();
    }

    public function updatingGender()
    {
        $this->resetPage();
    }

    public function updatingAgeRange()
    {
        $this->resetPage();
    }

    public function updatingSize()
    {
        $this->resetPage();
    }

    public function sort($sort_column = 'products.created_at', $sort_by){
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

    public function updatedGender()
    {
        if(!is_array($this->gender)) return;
        $this->gender = array_filter($this->gender,
            function ($gender) {
                return $gender != false;
            }
        );
    }

    public function updatedAgeRange()
    {
        if(!is_array($this->age_range)) return;
        $this->age_range = array_filter($this->age_range,
            function ($age_range) {
                return $age_range != false;
            }
        );
    }

    public function updatedSize()
    {
        if(!is_array($this->size_filter)) return;
        $this->size_filter = array_filter($this->size_filter,
            function ($size_filter) {
                return $size_filter != false;
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
            'category' => $categoryRepository->getAllCategoriesExceptGender(),
            'signature_player' => $signaturePlayerRepository->getAllSignatures()
        ];
        $keyword_array = [];
        $sale_keyword = '';
        $all_signature = false;
        $size = [];

        if($this->keyword != 'all') {
            $keyword = str_replace('-', ' ', $this->keyword);
            $keyword_array = explode('.', $keyword);
            if(count($keyword_array) >= 2){
                $keyword_array[1] = str_replace('-', ' ', $keyword_array[1]);

                if($keyword_array[1] != 'all') {
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

                    if($keyword_array[0] == 'sale'){
                        $this->keyword = 'sale';
                        $sale_keyword = $keyword_array[1];

                        if ($keyword_array[1] === 'featured') {
                            $keyword_array[1] = 'feature';
                        }

                        $tag = $tagRepository->getTagByName(strtoupper($keyword_array[1]));
                        $tag_id = $tag ? $tag->id : null;
                        if($tag_id) {
                            $this->tag[] = $tag_id;
                        }
                    }

                    if($keyword_array[0] == 'signatures'){
                        if($keyword_array[1] == 'all'){
                            $all_signature = true;
                        } else {
                            $this->signature[] = $keyword_array[1];
                        }
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
        $gender_id = $categoryRepository->getCategoryByCode(array_unique($this->gender_list))->pluck('id');

        // dump($gender_id);
        // dump(array_intersect($this->category, $gender_id->toArray()));

        if(array_intersect($this->category, $gender_id->toArray())){
            foreach(array_intersect($this->category, $gender_id->toArray()) as $gender_from_menu){
                $this->gender[] = $categoryRepository->getCategoryById($gender_from_menu)->first()->category_code;
            };
        }

        $products = $productRepository->getProductWhere()
                        ->when($this->search, function ($query, $search){
                            return $query->where('product_name', 'LIKE', '%'.$search.'%');
                        })
                        ->when($this->brand, function ($query, $brands){
                            return $query->whereHas('detail', function ($q) use ($brands){
                                rsort($brands);

                                return $q->whereIn('brand_id', array_unique($brands))
                                    ->when($this->search, function ($query, $search){
                                        return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                    });
                                });
                        })
                        ->when($this->category, function ($query, $categories) use ($gender_id, $keyword_array){
                            return $query->whereHas('categories', function ($q) use ($categories, $gender_id, $keyword_array){
                                rsort($categories);

                                if(array_intersect($categories, $gender_id->toArray()) && (count($keyword_array) == 2) ){
                                    return $q
                                        ->where('category_id', $categories)
                                        ->when($this->search, function ($query, $search){
                                            return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                        });
                                } else {
                                    return $q->whereIn('category_id', array_unique($categories))
                                    ->when($this->search, function ($query, $search){
                                        return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                        });
                                    }
                                });
                        })
                        ->when($this->tag, function ($query, $tags) {
                            return $query->whereHas('tags', function ($q) use ($tags){
                                rsort($tags);

                                return $q->whereIn('tag_id', array_unique($tags))
                                    ->when($this->search, function ($query, $search){
                                        return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                    });
                                });
                            })
                        ->when($this->signature, function ($query, $signatures){
                            return $query->whereHas('signatures', function ($q) use ($signatures){
                                rsort($signatures);

                                return $q->whereIn('signature_player_id', array_unique($signatures))
                                    ->when($this->search, function ($query, $search){
                                        return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                    });
                                });
                            })
                        ->when($all_signature, function ($query){
                                return $query->whereHas('signatures');
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
                        ->when($this->gender, function ($query, $gender){
                            return $query->whereHas('categories', function ($q) use ($gender){
                                rsort($gender);

                                return $q->where('categories.category_code', array_unique($gender))
                                    ->when($this->search, function ($query, $search){
                                        return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                    });
                            });
                        })
                        ->when($this->age_range, function ($query, $age_range){
                            return $query->whereHas('categories', function ($q) use ($age_range){
                                rsort($age_range);

                                return $q->whereIn('categories.category_code', array_unique($age_range))
                                    ->when($this->search, function ($query, $search){
                                        return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                    });
                            });
                        })
                        ->when($this->keyword === 'new-release' || $sale_keyword === 'new release', function($query) {
                            $date = date('Y-m-d H:i:s');

                            return $query->whereHas('tags', function($q) use ($date) {
                                $q->where('tag_title', 'NEW RELEASE');
                                $q->whereRaw('datediff(product_tags.created_at, ?) > -30', $date);
                            });
                        })
                        ->when($this->size_filter, function ($q, $sizes) {
                            foreach($sizes as $index => $size){
                                if($index == 0) {
                                    $q->where('pd.size', 'LIKE', DB::raw('"%'.$size.'%"'));
                                } else {
                                    $q->orWhere('pd.size', 'LIKE', DB::raw('"%'.$size.'%"'));
                                }
                            }
                            return $q;
                        })
                        ;

        // if($this->sort_column == 'pd.retail_price') {
        //     $products->orderBy('pd.after_discount_price', $this->sort_by);
        // }
        /**
         * Query debug
         */
        // $data['sql'] = $products->toSql();
        // dump($products->limit(5)->get());
        // dump($products->toSql());
        // dump($products->orderBy($this->sort_column, $this->sort_by)->count());
        // dump($products->count());
        $this->total_product = $products->orderBy($this->sort_column, $this->sort_by)->get()->count();
        // dump($products->toSql());
        $data['products'] = $products->orderBy($this->sort_column, $this->sort_by)->paginate(40);
        // dd($products->toSql());
        return view('livewire.product-list', $data);
    }
}
