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
use Modules\SizeFilter\Entities\SizeFilter;

class GlobalSearch extends Component
{
    use WithPagination;

    public $search;
    public $brand = [];
    public $brand_string = '';
    public $size_filter = [];
    public $size_filter_string = '';
    public $tag = [];
    public $tag_string = '';
    public $category = [];
    public $category_string = '';
    public $signature = [];
    public $signature_string = '';
    public $keyword;
    public $sort_by = 'DESC';
    public $sort_column = 'products.created_at';
    public $sort_column_2 = 'pd.after_discount_price';
    public $gender = [];
    public $gender_string = '';
    public $age_range = [];
    public $age_range_string = '';
    public $total_product = 0;

    // protected $updatesQueryString = ['search'];
    protected $queryString = [
        'search'             => ['except' => ''],
        'brand_string'       => ['as' => 'brand', 'except' => ''],
        'gender_string'      => ['as' => 'gender', 'except' => ''],
        'age_range_string'   => ['as' => 'age_range', 'except' => ''],
        'category_string'    => ['as' => 'category', 'except' => ''],
        'signature_string'   => ['as' => 'signature', 'except' => ''],
        'size_filter_string' => ['as' => 'size_filter', 'except' => ''],
        'tag_string'         => ['as' => 'tag', 'except' => ''],
    ];

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

    public function sort($sort_column = 'products.product_name', $sort_by = 'ASC'){
        $this->sort_by = $sort_by;
        $this->sort_column = $sort_column;
    }

    public function mount(): void
    {
        $this->keyword = str_replace("+", " ", $this->keyword);
        $this->search = request()->query('search', $this->search) ?? $this->keyword;

        $this->brand = $this->brand_string ? explode(',', $this->brand_string) : [];
        $this->gender = $this->gender_string ? explode(',', $this->gender_string) : [];
        $this->category = $this->category_string ? explode(',', $this->category_string) : [];
        $this->tag = $this->tag_string ? explode(',', $this->tag_string) : [];
        $this->age_range = $this->age_range_string ? explode(',', $this->age_range_string) : [];
        $this->signature = $this->signature_string ? explode(',', $this->signature_string) : [];
        $this->size_filter = $this->size_filter_string ? explode(',', $this->size_filter_string) : [];
    }

    public function updatedBrand()
    {
        if(!is_array($this->brand)) return;
        $this->brand = array_filter($this->brand,
            function ($brand) {
                return $brand != false;
            }
        );

        $this->brand_string = implode(',', $this->brand);
    }

    public function updatedBrandString()
    {
        $this->brand = array_filter(explode(',', $this->brand_string));
    }

    public function updatedCategory()
    {
        if(!is_array($this->category)) return;
        $this->category = array_filter($this->category,
            function ($category) {
                return $category != false;
            }
        );
        
        $this->category_string = implode(',', $this->category);
    }

    public function updatedCategoryString()
    {
        $this->category = array_filter(explode(',', $this->category_string));
    }

    public function updatedTag()
    {
        if(!is_array($this->tag)) return;
        $this->tag = array_filter($this->tag,
            function ($tag) {
                return $tag != false;
            }
        );

        $this->tag_string = implode(',', $this->tag);
    }

    public function updatedTagString()
    {
        $this->tag = array_filter(explode(',', $this->tag_string));
    }

    public function updatedSignature()
    {
        if(!is_array($this->signature)) return;
        $this->signature = array_filter($this->signature,
            function ($signature) {
                return $signature != false;
            }
        );

        $this->signature_string = implode(',', $this->signature);
    }

    public function updatedSignatureString()
    {
        $this->signature = array_filter(explode(',', $this->signature_string));
    }

    public function updatedGender()
    {
        if(!is_array($this->gender)) return;
        $this->gender = array_filter($this->gender,
            function ($gender) {
                return $gender != false;
            }
        );

        $this->gender_string = implode(',', $this->gender);
    }

    public function updatedGenderString()
    {
        $this->gender = array_filter(explode(',', $this->gender_string));
    }

    public function updatedAgeRange()
    {
        if(!is_array($this->age_range)) return;
        $this->age_range = array_filter($this->age_range,
            function ($age_range) {
                return $age_range != false;
            }
        );

        $this->age_range_string = implode(',', $this->age_range);
    }

    public function updatedAgeRangeString()
    {
        $this->age_range = array_filter(explode(',', $this->age_range_string));
    }

    public function updatedSizeFilter()
    {
        if(!is_array($this->size_filter)) return;
        $this->size_filter = array_filter($this->size_filter,
            function ($size_filter) {
                return $size_filter != false;
            }
        );

        $this->size_filter_string = implode(',', $this->size_filter);
    }

    public function updatedSizeFilterString()
    {
        $this->size_filter = array_filter(explode(',', $this->size_filter_string));
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
        $this->keyword = str_replace("+", " ", $this->keyword);
        $data['filters'] = [
            'brand' => $brandRepository->getAllBrand(),
            'size' => $sizeRepository->getAllSizes(),
            'tag' => $tagRepository->getAllTags(),
            'category' => $categoryRepository->getAllCategoriesExceptGender(),
            'signature_player' => $signaturePlayerRepository->getAllSignatures()
        ];
        
        // Add size filters if using database mode
        if (config('app.size_filter_mode') === 'database') {
            $data['sizeFilters'] = SizeFilter::with('sizes')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();
        }
        $where_column = ['product_code', 'product_name', 'description'];
        $keyword_array = [];
        $sale_keyword = '';
        $all_signature = false;

        if ($this->brand) {
            if (($key = array_search(false, $this->brand)) !== false) {
                unset($this->brand[$key]);
            }

            if(empty($this->brand)) $this->brand = [];
        }

        if ($this->size_filter) {
            if (($key = array_search(false, $this->size_filter)) !== false) {
                unset($this->size_filter[$key]);
            }

            if(empty($this->size_filter)) $this->size_filter = [];
        }

        if ($this->tag) {
            if (($key = array_search(false, $this->tag)) !== false) {
                unset($this->tag[$key]);
            }

            if(empty($this->tag)) $this->tag = [];
        }

        if ($this->category) {
            if (($key = array_search(false, $this->category)) !== false) {
                unset($this->category[$key]);
            }

            if(empty($this->category)) $this->category = [];
        }

        if ($this->signature) {
            if (($key = array_search(false, $this->signature)) !== false) {
                unset($this->signature[$key]);
            }

            if(empty($this->signature)) $this->signature = [];
        }

        if($this->keyword != 'all') {
            $keyword = strtoupper($this->keyword ?? '');
            $keyword = str_replace('-', ' ', $keyword);
            $keyword_array = explode('.', $keyword);
            if(count($keyword_array) >= 2){
                foreach ($keyword_array as $keyword) {
                    $brand = $brandRepository->getBrandByName($keyword);
                    $category = $categoryRepository->getCategoryByName($keyword);
                    $tag = $tagRepository->getTagByName($keyword);
                    $signature = $signaturePlayerRepository->getOneSignatureByName($keyword);

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
                $category = $categoryRepository->getCategoryByName($keyword_array[0]);
                $category_id = $category ? $category->id : null;
                if($category_id) {
                    $this->category[] = intval($category_id);
                }

                $brand = $brandRepository->getBrandByName($keyword_array[0]);
                $brand_id = $brand ? $brand->id : null;
                if($brand_id) {
                    $this->brand[] = intval($brand_id);
                }

                $tag = $tagRepository->getTagByName($keyword_array[0]);
                $tag_id = $tag ? $tag->id : null;
                if($tag_id) {
                    $this->tag[] = $tag_id;
                }

                $signature = $signaturePlayerRepository->getOneSignatureByName($keyword_array[0]);
                $signature_id = $signature ? $signature->id : null;
                if($signature_id) {
                    $this->signature[] = $signature_id;
                }
            }
        }

        $sale_category_id = $categoryRepository->getCategoryByName('sale')->id ?? [];
        $sale_tag_id = $tagRepository->getTagByName('sale')->id ?? [];
        $discount_id = $tagRepository->getTagByName('discount')->id ?? [];

        $products = $productRepository->getProductWhere()
            ->when($keyword, function ($query, $search) use ($keyword_array) {
                $query->where(function ($query) use ($keyword_array) {
                    foreach ($keyword_array as $keyword) {
                        $query->orWhere('product_name', 'LIKE', '%' . $keyword . '%');
                            // ->orWhere('description', 'LIKE', '%' . $keyword . '%');
                    }
                });
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
            ->when($this->tag, function ($query, $tags) {
                return $query->whereHas('tags', function ($q) use ($tags){
                    rsort($tags);

                    return $q->whereIn('tag_id', array_unique($tags))
                        ->when($this->search, function ($query, $search){
                            return $query->where('product_name', 'LIKE', '%'.$search.'%');
                        });
                    });
                })
            ->when($this->category, function ($query, $categories){
                return $query->whereHas('categories', function ($q) use ($categories){
                    rsort($categories);

                    return $q->whereIn('category_id', array_unique($categories))
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
                ->when($this->keyword === 'sale' || $this->keyword === 'discount' || in_array($sale_category_id, $this->category) || in_array($sale_tag_id, $this->tag) || in_array($discount_id, $this->tag), function ($query) {
                    return $query->where('pd.discount_percentage', '>', 0);
                })
                ->when($this->gender, function ($query, $gender){
                    return $query->whereHas('categories', function ($q) use ($gender){
                        rsort($gender);

                        return $q->whereIn('categories.category_code', array_unique($gender))
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
                    if (config('app.size_filter_mode') === 'database') {
                        // Database mode: Get all EU size values from SizeFilter records
                        $allEuSizes = [];
                        
                        foreach ($sizes as $euSize) {
                            // Find SizeFilter records that have sizes matching this EU value
                            $filters = SizeFilter::whereHas('sizes', function ($query) use ($euSize) {
                                $query->where(function ($q) use ($euSize) {
                                    $q->whereHas('charts', function ($subQ) use ($euSize) {
                                        $subQ->where('size_name', 'EU')
                                             ->where('size_value', $euSize);
                                    })->orWhereHas('mens', function ($subQ) use ($euSize) {
                                        $subQ->where('EU', $euSize);
                                    })->orWhereHas('womens', function ($subQ) use ($euSize) {
                                        $subQ->where('EU', $euSize);
                                    })->orWhereHas('kids', function ($subQ) use ($euSize) {
                                        $subQ->where('EU', $euSize);
                                    });
                                });
                            })->with(['sizes.charts', 'sizes.mens', 'sizes.womens', 'sizes.kids'])->get();
                            
                            // Collect all EU size values from mapped sizes in these filters
                            foreach ($filters as $filter) {
                                foreach ($filter->sizes as $size) {
                                    // Get EU from size_charts
                                    $euChart = $size->charts->where('size_name', 'EU')->first();
                                    if ($euChart && $euChart->size_value) {
                                        $allEuSizes[] = $euChart->size_value;
                                    }
                                    
                                    // Get EU from men_sizes, women_sizes, or kid_sizes
                                    if ($size->mens && $size->mens->EU) {
                                        $allEuSizes[] = $size->mens->EU;
                                    }
                                    if ($size->womens && $size->womens->EU) {
                                        $allEuSizes[] = $size->womens->EU;
                                    }
                                    if ($size->kids && $size->kids->EU) {
                                        $allEuSizes[] = $size->kids->EU;
                                    }
                                }
                            }
                        }
                        
                        // Remove duplicates and filter products
                        $allEuSizes = array_unique($allEuSizes);
                        
                        if (!empty($allEuSizes)) {
                            foreach ($allEuSizes as $index => $euSize) {
                                if ($index == 0) {
                                    $q->where('pd.size', 'LIKE', DB::raw('"%'.$euSize.'%"'));
                                } else {
                                    $q->orWhere('pd.size', 'LIKE', DB::raw('"%'.$euSize.'%"'));
                                }
                            }
                        }
                    } else {
                        // Hardcoded mode: Use sizes directly as before
                        foreach ($sizes as $index => $size) {
                            if ($index == 0) {
                                $q->where('pd.size', 'LIKE', DB::raw('"%'.$size.'%"'));
                            } else {
                                $q->orWhere('pd.size', 'LIKE', DB::raw('"%'.$size.'%"'));
                            }
                        }
                    }
                    
                    return $q->where('pd.qty', '>', 0);
                })
                ->when(count($keyword_array) >= 2, function($query) {
                    return $query->where('product_name', 'LIKE', '%'.$this->keyword.'%');
                });


        $this->total_product = $products->orderBy($this->sort_column, $this->sort_by)->get()->count();
        $data['products'] = $products->orderBy($this->sort_column, $this->sort_by)->paginate(40);
        return view('livewire.global-search', $data);
    }
}
