<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Category\Repositories\CategoryRepository;

class Category extends Component
{
    public $current_category;
    public $edit;

    public function render(CategoryRepository $category)
    {
        $category = $category->getCategoryIdAndNameLivewire()->toJson();
        return view('livewire.category', compact('category'));
    }
}
