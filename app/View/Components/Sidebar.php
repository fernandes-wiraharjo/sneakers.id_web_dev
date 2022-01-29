<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Hexters\Ladmin\Helpers\Menu;

class Sidebar extends Component
{
    public $menu;
    public $permissions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Menu $menu) {
        $this->menu = $menu;
        $this->permissions = auth()->user()->permission ?? [];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
