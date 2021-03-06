<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Product\Repositories\ProductRepository;

class BestSellers extends Component
{
    public function render(ProductRepository $productRepository)
    {
        $data['products'] = $productRepository->getProductBestSeller(4);
        return view('livewire.best-sellers', $data);
    }
}
