<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductImage extends Component
{
    public $image;
    public $edit;
    public $module;
    public $main_image;

    public function render()
    {
        return view('livewire.product-image');
    }
}
