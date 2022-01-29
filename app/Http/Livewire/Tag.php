<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Tag\Repositories\TagRepository;

class Tag extends Component
{
    public function render(TagRepository $tag)
    {
        $tag = $tag->getTagIdAndNameLivewire()->toJson();
        return view('livewire.tag', compact('tag'));
    }
}
