<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;
use Modules\Brand\Repositories\BrandRepository;

class CustomerAuthLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository) {
        $this->brandRepository = $brandRepository;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        $data['comment'] = 'Sign-in';
        $data['wrapperClass'] = 'w-lg-500px';
        return view('display-store.auth.layout', $data);
    }
}
