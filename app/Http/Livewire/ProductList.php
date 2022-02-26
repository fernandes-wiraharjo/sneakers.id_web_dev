<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Product\Repositories\ProductRepository;
use Illuminate\View\View;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search;

    protected $updatesQueryString = ['search'];

    public function mount(): void
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render(ProductRepository $productRepository): View
    {
        $where_column = ['product_code', 'product_name', 'description'];
        if($this->search === null){
            $product = $productRepository->getAllPagination(12);
        } else {
            $product = $productRepository->getSearchByWithPaginate($where_column, $this->search, 12);
        }
        $data['products'] = $product;
        return view('livewire.product-list', $data);
    }
}
