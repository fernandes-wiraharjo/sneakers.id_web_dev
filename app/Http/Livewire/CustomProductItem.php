<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Product\Repositories\ProductRepository;

class CustomProductItem extends Component
{
    public $brand_id;

    public function render(ProductRepository $productRepository)
    {
        $data['products'] = $productRepository->getProductByBrandId($this->brand_id);
        return view('livewire.custom-product-item', $data);
    }
}
