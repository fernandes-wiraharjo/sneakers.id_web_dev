<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Product\Repositories\ProductRepository;

class NewReleaseItem extends Component
{
    public function render(ProductRepository $productRepository)
    {
        $data['products'] = $productRepository->getProductNewRelease(4);
        return view('livewire.new-release-item', $data);
    }
}
