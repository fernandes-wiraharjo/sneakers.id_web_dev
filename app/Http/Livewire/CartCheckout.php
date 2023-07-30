<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Modules\Product\Entities\ProductDetail;

class CartCheckout extends Component
{
    protected $total;
    protected $content;
    public $note;
    public $disabledPlus = [];
    public $interval = 5; // Interval in seconds (adjust as needed)
    protected $listeners = [
        'productAddedToCart' => 'updateCart',
        'noteUpdated' => 'updateNote',
        'updateNote' => 'fetchLatestNote',
    ];

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->note = Cart::getNotes();
        $this->updateCart();


        foreach(Cart::content() as $item) {
            $qty = ProductDetail::where('id', $item['size_id'])->first()->qty;
            if (intval($item['quantity'])+1 <= $qty) {
                $this->disabledPlus[$item['size_id']] = false;
            } else {
                $this->disabledPlus[$item['size_id']] = true;
            }
        };
    }
    /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        $this->updateCart();
        return view('livewire.cart-checkout', [
            'session_id' => Cart::hashID(),
            'total' => intval($this->total),
            'content' => $this->content,
        ]);

    }
    /**
     * Removes a cart item by id.
     *
     * @param string $id
     * @return void
     */
    public function removeFromCart(string $size_id): void
    {
        Cart::remove($size_id);
        $this->updateCart();
        $this->emit('cartCounter');
    }
    /**
     * Clears the cart content.
     *
     * @return void
     */
    public function clearCart(): void
    {
        Cart::clear();
        $this->updateCart();
        $this->emit('cartCounter');
    }
    /**
     * Updates a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function updateCartItem(string $size_id, string $action, string $current_qty): void
    {
        $qty = ProductDetail::where('id', $size_id)->first()->qty;

        if($action == 'plus') {
            if (intval($current_qty)+1 <= $qty) {
                Cart::update($size_id, $action);
            } else {
                $this->disabledPlus[$size_id] = true;
                $this->emit('modalQty', ['message' => 'product stock has reach the limit']);
                // dd('qty Not valid');
            }
        } else {
            $this->disabledPlus[$size_id] = false;
            Cart::update($size_id, $action);
        }

        if((intval($current_qty)+1 >= $qty) && ($action == 'plus')) {
            $this->emit('modalQty', ['message' => 'product stock has reach the limit']);
        }

        $this->updateCart();
    }
    /**
     * Rerenders the cart items and total price on the browser.
     *
     * @return void
     */
    public function updateCart()
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
        Cart::addNotes($this->note);

        foreach(Cart::content() as $item) {
            $qty = ProductDetail::where('id', $item['size_id'])->first()->qty;
            if (intval($item['quantity'])+1 <= $qty) {
                $this->disabledPlus[$item['size_id']] = false;
            } else {
                $this->disabledPlus[$item['size_id']] = true;
            }
        };
    }

    public function updateNote($newNote)
    {
        $this->note = $newNote;
        $this->updateCart();
        // Cart::addNotes($newNote);
    }

    public function fetchLatestNote()
    {
        $this->note = Cart::getNotes(); // Fetch the latest note from the backend (assuming 'Cart::getNotes()' fetches the current note)
    }
}
