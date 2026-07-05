<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Modules\Product\Entities\Product;
use Modules\Brand\Repositories\BrandRepository;
use Modules\Product\Repositories\ProductRepository;
use Modules\Size\Repositories\SizeRepository;
use Modules\Tag\Repositories\TagRepository;
use Modules\Tag\Entities\Tag;
use Modules\Category\Repositories\CategoryRepository;
use Modules\SignaturePlayer\Repositories\SignaturePlayerRepository;
use Modules\SizeFilter\Entities\SizeFilter;

class ProductList extends Component
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
    public $gender_list = ['MENS', 'WOMENS', 'KIDS'];
    public $page_title = '';

    // Use *_string to prevent escaped array in URL
    protected $queryString = [
        'search'             => ['except' => ''],
        'brand_string'       => ['as' => 'brand', 'except' => ''],
        'gender_string'      => ['as' => 'gender', 'except' => ''],
        'age_range_string'   => ['as' => 'age_range', 'except' => ''],
        'category_string'    => ['as' => 'category', 'except' => ''],
        'signature_string'   => ['as' => 'signature', 'except' => ''],
        'size_filter_string' => ['as' => 'size_filter', 'except' => ''],
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

    public function updatingSize()
    {
        $this->resetPage();
    }

    public function sort($sort_column = 'products.created_at', $sort_by = 'desc'){
        $this->sort_by = $sort_by;
        $this->sort_column = $sort_column;
    }

    public function handleSortChange($value)
    {
        if ($value) {
            list($sort_column, $sort_by) = explode(':', $value);
            $this->sort($sort_column, strtoupper($sort_by));
        }
    }

    public function mount(): void
    {
        $this->search = request()->query('search', $this->search);

        $this->brand = $this->brand_string ? explode(',', $this->brand_string) : [];
        $this->gender = $this->gender_string ? explode(',', $this->gender_string) : [];
        $this->category = $this->category_string ? explode(',', $this->category_string) : [];
        $this->age_range = $this->age_range_string ? explode(',', $this->age_range_string) : [];
        $this->signature = $this->signature_string ? explode(',', $this->signature_string) : [];
        $this->size_filter = $this->size_filter_string ? explode(',', $this->size_filter_string) : [];
        $this->tag = [];
        $this->tag_string = '';
        $this->page_title = $this->keyword;

        if (request()->has('tag')) {
            $tagIds = array_filter(explode(',', (string) request()->query('tag')));
            $collectionRoute = $this->collectionRouteForTagIds($tagIds);

            if ($collectionRoute !== null) {
                $this->redirect(route('collections', $collectionRoute));

                return;
            }

            $this->redirect(route('collections', $this->keyword));

            return;
        }
    }

    private function collectionRouteForTagIds(array $tagIds): ?string
    {
        if (empty($tagIds)) {
            return null;
        }

        $tagCodes = Tag::whereIn('id', $tagIds)->pluck('tag_code')->filter()->all();
        $routes = [
            'NEW-RELEASE' => 'new-release',
            'BEST-SELLER' => 'best-seller',
            'FEATURED' => 'featured',
            'DISCOUNT' => 'sale',
        ];

        foreach ($routes as $code => $route) {
            if (in_array($code, $tagCodes, true)) {
                return $route;
            }
        }

        return null;
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

    public function removeFilter(string $type, ?string $value = null): void
    {
        $this->resetPage();

        switch ($type) {
            case 'search':
                $this->search = '';
                break;
            case 'brand':
                $this->brand = array_values(array_filter(
                    (array) $this->brand,
                    static fn ($id) => (string) $id !== (string) $value
                ));
                $this->brand_string = implode(',', $this->brand);
                break;
            case 'gender':
                $this->gender = array_values(array_filter(
                    (array) $this->gender,
                    static fn ($code) => (string) $code !== (string) $value
                ));
                $this->gender_string = implode(',', $this->gender);
                break;
            case 'age_range':
                $this->age_range = array_values(array_filter(
                    (array) $this->age_range,
                    static fn ($code) => (string) $code !== (string) $value
                ));
                $this->age_range_string = implode(',', $this->age_range);
                break;
            case 'category':
                $this->category = array_values(array_filter(
                    (array) $this->category,
                    static fn ($id) => (string) $id !== (string) $value
                ));
                $this->category_string = implode(',', $this->category);
                break;
            case 'signature':
                $this->signature = array_values(array_filter(
                    (array) $this->signature,
                    static fn ($id) => (string) $id !== (string) $value
                ));
                $this->signature_string = implode(',', $this->signature);
                break;
            case 'size_filter':
                $this->size_filter = array_values(array_filter(
                    (array) $this->size_filter,
                    static fn ($label) => (string) $label !== (string) $value
                ));
                $this->size_filter_string = implode(',', $this->size_filter);
                break;
        }
    }

    public function clearAllFilters(): void
    {
        $this->resetPage();

        $this->search = '';
        $this->brand = [];
        $this->brand_string = '';
        $this->gender = [];
        $this->gender_string = '';
        $this->age_range = [];
        $this->age_range_string = '';
        $this->category = [];
        $this->category_string = '';
        $this->tag = [];
        $this->tag_string = '';
        $this->signature = [];
        $this->signature_string = '';
        $this->size_filter = [];
        $this->size_filter_string = '';
    }

    private function genderLabels(): array
    {
        return [
            'MENS' => "Men's",
            'WOMENS' => "Women's",
            'KIDS' => "Kid's",
        ];
    }

    private function ageRangeLabels(): array
    {
        return [
            'GRADE_SCHOOL' => 'Grade School',
            'PRESCHOOL' => 'Preschool',
            'TODDLER' => 'Toddler',
            'INFANT' => 'Infant',
        ];
    }

    private function buildActiveFilterBadges(array $filters): array
    {
        $badges = [];

        if ($this->search) {
            $badges[] = [
                'type' => 'search',
                'value' => $this->search,
                'label' => $this->search,
            ];
        }

        $brandMap = collect($filters['brand'] ?? [])->keyBy('id');
        foreach ((array) $this->brand as $id) {
            if ($brand = $brandMap->get($id)) {
                $badges[] = [
                    'type' => 'brand',
                    'value' => (string) $id,
                    'label' => $brand->brand_title,
                ];
            }
        }

        foreach ((array) $this->gender as $code) {
            $badges[] = [
                'type' => 'gender',
                'value' => (string) $code,
                'label' => $this->genderLabels()[$code] ?? $code,
            ];
        }

        foreach ((array) $this->age_range as $code) {
            $badges[] = [
                'type' => 'age_range',
                'value' => (string) $code,
                'label' => $this->ageRangeLabels()[$code] ?? $code,
            ];
        }

        $categoryMap = collect($filters['category'] ?? [])->keyBy('id');
        foreach ((array) $this->category as $id) {
            if ($category = $categoryMap->get($id)) {
                $badges[] = [
                    'type' => 'category',
                    'value' => (string) $id,
                    'label' => $category->category_title,
                ];
            }
        }

        $signatureMap = collect($filters['signature_player'] ?? [])->keyBy('id');
        foreach ((array) $this->signature as $id) {
            if ($signature = $signatureMap->get($id)) {
                $badges[] = [
                    'type' => 'signature',
                    'value' => (string) $id,
                    'label' => $signature->signature_title,
                ];
            }
        }

        foreach ((array) $this->size_filter as $label) {
            $badges[] = [
                'type' => 'size_filter',
                'value' => (string) $label,
                'label' => (string) $label,
            ];
        }

        return $badges;
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
        // $data['filters'] = [
        //     'brand' => $brandRepository->getAllBrand(),
        //     'size' => $sizeRepository->getAllSizes(),
        //     'tag' => $tagRepository->getAllTags(),
        //     'category' => $categoryRepository->getAllCategoriesExceptGender(),
        //     'signature_player' => $signaturePlayerRepository->getAllSignatures()
        // ];
        // Cache for 1 hour (3600 seconds)
        $data['filters'] = Cache::remember('product_filters', 3600, function () use (
            $brandRepository,
            $sizeRepository,
            $categoryRepository,
            $signaturePlayerRepository,
        ) {
            return [
                'brand' => $brandRepository->getAllBrand(),
                'size' => $sizeRepository->getAllSizes(),
                'category' => $categoryRepository->getAllCategoriesExceptGender(),
                'signature_player' => $signaturePlayerRepository->getAllSignatures(),
            ];
        });
        
        // Add size filters if using database mode
        if (config('app.size_filter_mode') === 'database') {
            $data['sizeFilters'] = Cache::remember('size_filters', 3600, function () {
                return SizeFilter::where('is_active', true)
                    ->orderBy('sort_order')
                    ->get();
            });
        }
        $keyword_array = [];
        $sale_keyword = '';
        $all_signature = false;
        $size = [];
        $this->page_title = 'ALL PRODUCT';
        if($this->keyword != 'all') {
            $keyword = str_replace('-', ' ', $this->keyword);
            $keyword_array = explode('.', $keyword);
            if(count($keyword_array) >= 2){
                $keyword_array[1] = str_replace('-', ' ', $keyword_array[1]);
                $this->page_title = $keyword_array[1];
                if($keyword_array[1] != 'all') {
                    $signature = $signaturePlayerRepository->getSignaturePlayerByCode($keyword_array[1]);
                    $brand = $brandRepository->getBrandByName($keyword_array[1]);
                    $category = $categoryRepository->getCategoryByName($keyword_array[1]);

                    $signature_id = $signature ? $signature->id : null;
                    if($signature_id) {
                        $this->signature[] = $signature_id;
                        $this->page_title = $signature->signature_title;
                    }

                    $brand_id = $brand ? $brand->id : null;
                    if($brand_id) {
                        $this->brand[] = $brand_id;
                        $this->page_title = $brand->brand_title;
                    }
                    
                    $category_id = $category ? $category->id : null;
                    if($category_id) {
                        $this->category[] = intval($category_id);
                        $this->page_title = $category->category_title;
                    }
                }

                if($keyword_array[0] != 'all'){
                    $category = $categoryRepository->getCategoryByName($keyword_array[0]);
                    $category_id = $category ? $category->id : null;
                    if($category_id) {
                        $this->category[] = intval($category_id);
                        $this->page_title = $category->category_title;
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
                if ($category) {
                    $this->page_title = $category->category_title;
                }
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

        $isBestSellerPage = $this->keyword === 'best-seller';
        if ($isBestSellerPage) {
            $this->page_title = 'Best Sellers';
            $this->category = [];

            if (empty($this->tag)) {
                $bestSellerTag = $tagRepository->getTagByName('BEST SELLER');
                if ($bestSellerTag) {
                    $this->tag = [intval($bestSellerTag->id)];
                }
            }
        }

        $isNewReleasePage = $this->keyword === 'new-release';
        if ($isNewReleasePage) {
            $this->page_title = 'New Release';
            $this->category = [];

            if (empty($this->tag)) {
                $newReleaseTag = $tagRepository->getTagByName('NEW RELEASE');
                if ($newReleaseTag) {
                    $this->tag = [intval($newReleaseTag->id)];
                }
            }
        }

        $sale_category_id = $categoryRepository->getCategoryByName('sale')->id ?? null;
        $sale_tag_id = $tagRepository->getTagByName('sale')->id ?? null;
        $discount_id = $tagRepository->getTagByName('discount')->id ?? null;
        $gender_id = $categoryRepository->getCategoryByCode(array_unique($this->gender_list))->pluck('id', 'category_code');
        $gender_choosen = $categoryRepository->getCategoryByCode(array_unique($this->gender))->pluck('id', 'category_code');

        // dump($gender_id); // [1,2,3]
        // dump($gender_choosen); // [1,2,3]
        // dump(array_intersect($this->category, $gender_id->toArray()));

        // if(array_intersect($this->category, $gender_id->toArray())){
        //     foreach(array_intersect($this->category, $gender_id->toArray()) as $gender_from_menu){
        //         $this->gender[] = $categoryRepository->getCategoryById($gender_from_menu)->category_code;
        //     };
        // }
        // $this->gender = array_unique($this->gender);
        $gender_codes = $this->gender;
        if ($ids = array_intersect($this->category, $gender_id->toArray())) {
            foreach ($ids as $gender_from_menu) {
                $gender_codes[] = $categoryRepository->getCategoryById($gender_from_menu)->category_code;
            }
        }
        $gender_codes = array_unique($gender_codes);

        $products = $productRepository->getProductWhere()
                        ->when($this->search, function ($query, $search){
                            return $query->where('product_name', 'LIKE', '%'.$search.'%');
                        })
                        ->when($this->brand, function ($query, $brands){
                            return $query->whereHas('detail', function ($q) use ($brands){
                                // rsort($brands);

                                return $q->whereIn('brand_id', array_unique($brands));
                                    // ->when($this->search, function ($query, $search){
                                    //     return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                    // });
                            });
                        })
                        ->when($this->category, function ($query, $categories) use ($gender_id, $keyword_array){
                            return $query->whereHas('categories', function ($q) use ($categories, $gender_id, $keyword_array){
                                // rsort($categories);

                                if(array_intersect($categories, $gender_id->toArray()) && (count($keyword_array) == 2) ){
                                    return $q
                                        ->where('category_id', $categories);
                                        // ->when($this->search, function ($query, $search){
                                        //     return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                        // });
                                } else {
                                    return $q->whereIn('category_id', array_unique($categories));
                                    // ->when($this->search, function ($query, $search){
                                    //     return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                    //     });
                                    }
                                });
                        })
                        ->when(is_array($this->tag) && count($this->tag) > 0 && ! $isBestSellerPage && ! $isNewReleasePage, function ($query, $tags) {
                            return $query->whereHas('tags', function ($q) use ($tags){
                                // rsort($tags);

                                return $q->whereIn('tag_id', array_unique((array) $tags));
                                    // ->when($this->search, function ($query, $search){
                                    //     return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                    // });
                                });
                            })
                        ->when($this->signature, function ($query, $signatures){
                            return $query->whereHas('signatures', function ($q) use ($signatures){
                                // rsort($signatures);

                                return $q->whereIn('signature_player_id', array_unique($signatures));
                                    // ->when($this->search, function ($query, $search){
                                    //     return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                    // });
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
                        // ->when(
                        //     $this->keyword === 'sale' || $this->keyword === 'discount' ||
                        //     in_array($sale_category_id, $this->category) ||
                        //     in_array($sale_tag_id, $this->tag) ||
                        //     in_array($discount_id, $this->tag),
                        //     function ($query) {
                        //         return $query->whereHas('detail', function ($q) {
                        //             $q->where('discount_percentage', '>', 0);
                        //         });
                        //     }
                        // )
                        // ->when($this->gender, function ($query, $gender){
                        //     return $query->whereHas('categories', function ($q) use ($gender){
                        //         rsort($gender);

                        //         return $q->where('categories.category_code', array_unique($gender))
                        //             ->when($this->search, function ($query, $search){
                        //                 return $query->where('product_name', 'LIKE', '%'.$search.'%');
                        //             });
                        //     });
                        // })
                        ->when($gender_codes, function ($query, $gender_codes) {
                            return $query->whereHas('categories', function ($q) use ($gender_codes) {
                                return $q->whereIn('categories.category_code', $gender_codes);
                                        // ->when($this->search, function ($query, $search) {
                                        //     return $query->where('product_name', 'LIKE', "%$search%");
                                        // });
                            });
                        })
                        ->when($this->age_range, function ($query, $age_range){
                            return $query->whereHas('categories', function ($q) use ($age_range){
                                // rsort($age_range);

                                return $q->whereIn('categories.category_code', array_unique($age_range));
                                    // ->when($this->search, function ($query, $search){
                                    //     return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                    // });
                            });
                        })
                        ->when($isNewReleasePage || $sale_keyword === 'new release', function ($query) use ($productRepository) {
                            return $productRepository->applyNewReleaseScope($query);
                        })
                        // ->when($this->size_filter, function ($query, $sizes) {
                        //     return $query->whereHas('detail', function($q) use ($sizes) {
                        //         foreach ($sizes as $size) {
                        //             $q->orWhere('size', 'LIKE', "%$size%");
                        //         }
                        //         $q->where('qty', '>', 0);
                        //     });
                        // });
                        ->when($this->size_filter, function ($q, $filterLabels) {
                            if (config('app.size_filter_mode') === 'database') {
                                // Database mode: Get all EU size values from SizeFilter records
                                // Use whereHas to check all product_details, not just the one in pd
                                return $q->whereHas('details', function ($detailQuery) use ($filterLabels) {
                                    $allEuSizes = [];
                                    
                                    foreach ($filterLabels as $filterLabel) {
                                        // Find SizeFilter records by filter_label
                                        $filters = SizeFilter::where('filter_label', $filterLabel)->get();
                                        
                                        // Collect all EU size values from JSON column
                                        foreach ($filters as $filter) {
                                            $euSizes = $filter->eu_sizes ?? [];
                                            $allEuSizes = array_merge($allEuSizes, $euSizes);
                                        }
                                    }
                                    
                                    // Remove duplicates and filter products
                                    $allEuSizes = array_unique($allEuSizes);
                                    
                                    if (!empty($allEuSizes)) {
                                        $detailQuery->where(function ($sizeQuery) use ($allEuSizes) {
                                            foreach ($allEuSizes as $index => $euSize) {
                                                // Use %size (ends with) instead of %size%
                                                if ($index == 0) {
                                                    $sizeQuery->where('size', 'LIKE', '%' . $euSize);
                                                } else {
                                                    $sizeQuery->orWhere('size', 'LIKE', '%' . $euSize);
                                                }
                                            }
                                        });
                                    }

                                    $detailQuery->where('qty', '>', 0);
                                });
                            } else {
                                // Hardcoded mode: Use sizes directly as before (ends with)
                                foreach ($filterLabels as $index => $size) {
                                    if ($index == 0) {
                                        $q->where('pd.size', 'LIKE', '%' . $size);
                                    } else {
                                        $q->orWhere('pd.size', 'LIKE', '%' . $size);
                                    }
                                }
                                
                                return $q->where('pd.qty', '>', 0);
                            }
                        });

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
        // $this->total_product = $products->orderBy($this->sort_column, $this->sort_by)->get()->count();
        // dump($products->toSql());
        if ($isBestSellerPage) {
            $products = $productRepository->applyBestSellerOrdering($products);
            $data['products'] = $products->paginate(40);
        } elseif ($isNewReleasePage) {
            $data['products'] = $products->orderByDesc('products.created_at')->paginate(40);
        } else {
            $data['products'] = $products->orderBy($this->sort_column, $this->sort_by)->paginate(40);
        }
        $this->total_product = $data['products']->total();
        $data['activeFilterBadges'] = $this->buildActiveFilterBadges($data['filters']);
        // dd($products->toSql());
        return view('bootstrap.livewire.product-list', $data);
    }
}
