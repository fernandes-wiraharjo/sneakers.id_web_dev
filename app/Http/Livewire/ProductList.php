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
    public $brand;
    public $size;
    public $tag;
    public $category;
    public $signature;
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
        $this->search = request()->query('search', $this->search);
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

        // dump([$this->search]);
        $where_column = ['product_code', 'product_name', 'description'];

        if ($this->brand) {
            if (($key = array_search(false, $this->brand)) !== false) {
                unset($this->brand[$key]);
            }

            if(empty($this->brand)) $this->brand = null;
        }

        if ($this->size) {
            if (($key = array_search(false, $this->size)) !== false) {
                unset($this->size[$key]);
            }

            if(empty($this->size)) $this->size = null;
        }

        if ($this->tag) {
            if (($key = array_search(false, $this->tag)) !== false) {
                unset($this->tag[$key]);
            }

            if(empty($this->tag)) $this->tag = null;
        }

        if ($this->category) {
            if (($key = array_search(false, $this->category)) !== false) {
                unset($this->category[$key]);
            }

            if(empty($this->category)) $this->category = null;
        }

        if ($this->signature) {
            if (($key = array_search(false, $this->signature)) !== false) {
                unset($this->signature[$key]);
            }

            if(empty($this->signature)) $this->signature = null;
        }

        if($this->keyword != 'all') {
            $keyword = str_replace('-', ' ', $this->keyword);
            $keyword_array = explode('.', $keyword);
            if(count($keyword_array) >= 2){
                $keyword_array[1] = str_replace('-', ' ', $keyword_array[1]);
                $brand = $brandRepository->getBrandByName($keyword_array[1]);
                $brand_id = $brand ? $brand->id : null;
                $this->brand[] = $brand_id;
                if($keyword_array[0] != 'all'){
                    $tag = $tagRepository->getTagByName($keyword_array[0]);
                    $tag_id = $tag ? $tag->id : null;
                    $this->tag[] = $tag_id;
                }
            } else {
                $tag = $tagRepository->getTagByName($keyword);
                $tag_id = $tag ? $tag->id : null;
                $this->tag[] = $tag_id;
            }
        }

        $products = $productRepository->getProductWhere()
                                ->when($this->brand, function ($query, $brands){
                                    return $query->whereHas('detail', function ($q) use ($brands){
                                        $q->whereIn('brand_id', $brands)
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($this->size, function ($query, $sizes){
                                    return $query->whereHas('sizes', function ($q) use ($sizes){
                                        $q->whereIn('size_id', $sizes)
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($this->tag, function ($query, $tags) {
                                    return $query->whereHas('tags', function ($q) use ($tags){
                                        $q->whereIn('tag_id', $tags)
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($this->category, function ($query, $categories){
                                    return $query->whereHas('categories', function ($q) use ($categories){
                                        $q->whereIn('category_id', $categories)
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($this->signature, function ($query, $signatures){
                                    return $query->whereHas('signatures', function ($q) use ($signatures){
                                        $q->whereIn('signature_player_id', $signatures)
                                            ->when($this->search, function ($query, $search){
                                                return $query->where('product_name', 'LIKE', '%'.$search.'%');
                                            });
                                    });
                                })
                                ->when($this->search, function ($query, $search){
                                    return $query->where('product_name', 'LIKE', '%'.$search.'%')
                                        ->where('description', 'LIKE', '%'.$search.'%');
                                })
                                ->orderBy($this->sort_column, $this->sort_by)->paginate(40);

        $data['products'] = $products;
        return view('livewire.product-list', $data);
    }
}
