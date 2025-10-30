<?php
namespace App\Http\Livewire;
use App\Facades\Cart;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Modules\Product\Entities\ProductDetail;

class CartComponent extends Component
{
    protected $total;
    protected $content;
    public $disabledPlus = [];
    public $interval = 5; // Interval in seconds (adjust as needed)
    public $note = '';
    protected $listeners = [
        'productAddedToCart' => 'updateCart',
        'noteSaved' => 'saveNote',
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
    }
    /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        $this->updateCart();
        return view('livewire.cart-component', [
            'total' => intval($this->total),
            'content' => $this->content,
            'note' => Cart::getNotes(),
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
        // Cart::clearOrderId();
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
        $this->disabledPlus[$size_id] = false;

        if($action == 'plus') {
            if (intval($current_qty)+1 <= $qty) {
                Cart::update($size_id, $action);
            } else {
                $this->disabledPlus[$size_id] = true;
                $this->emit('showToast', ['type' => 'error', 'message' => 'Product stock has reached the limit']);
            }
        } elseif($action == 'minus') {
            $this->disabledPlus[$size_id] = false;
            Cart::update($size_id, $action);
        } elseif($action == 'change') {
            // Handle direct input change
            $newQty = intval($current_qty);
            $originalQty = intval($current_qty);
            
            // Ensure minimum quantity is 1
            if ($newQty < 1) {
                $newQty = 1;
            }
            
            // Check if new quantity exceeds available stock
            if ($newQty > $qty) {
                $newQty = $qty;
                $this->disabledPlus[$size_id] = true;
                $this->emit('showToast', ['type' => 'warning', 'message' => 'Product stock has reached the limit. Set to maximum: ' . $qty]);
            }
            
            Cart::setQuantity($size_id, $newQty);
            $this->disabledPlus[$size_id] = ($newQty >= $qty);
            
            // If quantity was corrected, dispatch event to update the input field
            if ($originalQty != $newQty) {
                $this->dispatchBrowserEvent('quantity-corrected', [
                    'size_id' => $size_id,
                    'quantity' => $newQty
                ]);
            }
        } else {
            $this->disabledPlus[$size_id] = false;
            Cart::update($size_id, $action);
        }

        if((intval($current_qty)+1 >= $qty) && ($action == 'plus')) {
            $this->emit('showToast', ['type' => 'error', 'message' => 'Product stock has reached the limit']);
        }

        $this->updateCart();
        $this->emit('cartCounter');
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

        foreach(Cart::content() as $item) {
            $qty = ProductDetail::where('id', $item['size_id'])->first()->qty;
            if (intval($item['quantity'])+1 <= $qty) {
                $this->disabledPlus[$item['size_id']] = false;
            } else {
                $this->disabledPlus[$item['size_id']] = true;
            }
        };
    }

    public function saveNote($newNote)
    {
        $this->note = $newNote;
        Cart::addNotes($newNote);
        $this->emit('noteUpdated', $this->note);
    }

    // public function hydrate()
    // {
    //     while (true) {
    //         $this->updateCart();
    //         sleep($this->interval);
    //     }
    // }
}
