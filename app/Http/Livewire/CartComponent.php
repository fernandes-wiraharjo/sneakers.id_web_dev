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
                $this->emit('modalQty', ['message' => 'product stock has reach the limit']);
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
