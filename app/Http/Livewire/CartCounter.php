<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartCounter extends Component
{
    public $cartCounter;
    public $listeners =[
        'cartCounter' => 'updateCartCounter',
    ];

    public function updateCartCounter() {
        $this->cartCounter = Cart::content()->count();
    }

    public function render()
    {
        $this->cartCounter = Cart::content()->count();
        return view('livewire.cart-counter', ['cartCounter' => $this->cartCounter]);
    }
}
