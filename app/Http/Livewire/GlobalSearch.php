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

class GlobalSearch extends Component
{
    use WithPagination;

    public $search;
    public $brand = [];
    public $size = [];
    public $tag = [];
    public $category = [];
    public $signature = [];
    public $keyword;
    public $sort_by = 'ASC';
    public $sort_column = 'product_name';

    protected $updatesQueryString = ['search'];

    public function sort($sort_column = 'product_name', $sort_by = 'ASC'){
        $this->sort_by = $sort_by;
        $this->sort_column = $sort_column;
    }

    public function mount(): void
    {
        $this->search = request()->query('search', $this->search) ?? $this->keyword;
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
        $where_column = ['product_code', 'product_name', 'description'];

        if ($this->brand) {
            if (($key = array_search(false, $this->brand)) !== false) {
                unset($this->brand[$key]);
            }

            if(empty($this->brand)) $this->brand = [];
        }

        if ($this->size) {
            if (($key = array_search(false, $this->size)) !== false) {
                unset($this->size[$key]);
            }

            if(empty($this->size)) $this->size = [];
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
                    $this->signaure[] = $signature_id;
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
                $keyword === 'sale' ||
                $keyword === 'discount' ||
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
                $keyword === 'new-release',
                function ($query) {
                    $date = date('Y-m-d H:i:s');
                    return $query->whereHas('tags', function ($q) use ($date) {
                        $q->where('tag_title', 'NEW RELEASE')
                            ->whereRaw('DATEDIFF(product_tags.created_at, ?) > -30', [$date]);
                    });
                }
            )
            ->orderBy($this->sort_column, $this->sort_by)
            ->paginate(40);

        $data['products'] = $products;
        return view('livewire.global-search', $data);
    }
}
