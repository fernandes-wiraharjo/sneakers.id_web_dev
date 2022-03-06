<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Banner\Repositories\BannerRepository;

class BannerImage extends Component
{
    public function render(BannerRepository $bannerRepository)
    {
        $data['banner'] = $bannerRepository->getBannerOrdered(5);
        return view('livewire.banner-image', $data);
    }
}
