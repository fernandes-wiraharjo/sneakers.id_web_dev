<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Tag\Repositories\TagRepository;

class Tag extends Component
{
    public $current_tag;
    public $edit;

    public function render(TagRepository $tagRepository)
    {
        $tag = $tagRepository->getTagIdAndNameLivewire()->toJson();

        if ($this->edit && $this->current_tag) {
            $this->current_tag = $this->current_tag->filter(function ($item) {
                $value = is_array($item) ? ($item['value'] ?? '') : ($item->value ?? '');
                return strtoupper($value) !== 'BEST SELLER';
            })->values();
        }

        return view('livewire.tag', compact('tag'));
    }
}
