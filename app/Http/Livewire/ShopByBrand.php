<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Brand\Repositories\BrandRepository;

class ShopByBrand extends Component
{
    public function render(BrandRepository $brandRepository)
    {
        $data['brand'] = $brandRepository->getActiveMenuBrand();
        return view('livewire.shop-by-brand', $data);
    }
}
