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
    
    // Voucher properties
    public $voucherCode = '';
    public $voucherApplied = false;
    public $voucherMessage = '';
    public $discountAmount = 0;
    public $finalTotal = 0;
    public $appliedVoucher = null;
    
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
        
        // Load voucher from cart if exists
        $voucherData = Cart::getVoucher();
        if ($voucherData) {
            $this->voucherCode = $voucherData['code'];
            $this->voucherApplied = true;
            $this->appliedVoucher = $voucherData;
            $this->voucherMessage = $voucherData['message'] ?? 'Voucher applied successfully!';
            $this->calculateDiscount();
        }


        // foreach(Cart::content() as $item) {
        //     $qty = ProductDetail::where('id', $item['size_id'])->first()->qty;
        //     if (intval($item['quantity'])+1 <= $qty) {
        //         $this->disabledPlus[$item['size_id']] = false;
        //     } else {
        //         $this->disabledPlus[$item['size_id']] = true;
        //     }
        // };
    }
    /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        $this->updateCart();
        $this->calculateDiscount();
        
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
                // dd('qty Not valid');
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
    
    /**
     * Apply voucher code
     */
    public function applyVoucher()
    {
        if (empty($this->voucherCode)) {
            $this->voucherMessage = 'Please enter a voucher code.';
            return;
        }
        
        // Get voucher repository
        $voucherRepo = app(\Modules\DiscountVoucher\Repositories\DiscountVoucherRepository::class);
        
        // Get current cart total
        $currentTotal = Cart::total();
        
        // Validate voucher
        $validation = $voucherRepo->validateVoucherForUser(
            $this->voucherCode,
            auth()->check() ? auth()->id() : null,
            $currentTotal
        );
        
        if ($validation['valid']) {
            $this->voucherApplied = true;
            $this->appliedVoucher = [
                'id' => $validation['voucher']->id,
                'code' => $validation['voucher']->voucher_code,
                'discount_type' => $validation['voucher']->discount_type,
                'discount_rate' => $validation['voucher']->discount_rate,
                'discount_amount' => $validation['voucher']->discount_amount,
                'message' => $validation['message']
            ];
            $this->voucherMessage = $validation['message'];
            
            // Store voucher in cart
            Cart::addVoucher($this->appliedVoucher);
            
            $this->calculateDiscount();
        } else {
            $this->voucherMessage = $validation['message'];
            $this->voucherApplied = false;
        }
    }
    
    /**
     * Remove applied voucher
     */
    public function removeVoucher()
    {
        $this->voucherCode = '';
        $this->voucherApplied = false;
        $this->voucherMessage = '';
        $this->discountAmount = 0;
        $this->appliedVoucher = null;
        $this->finalTotal = $this->total;
        
        // Remove voucher from cart
        Cart::removeVoucher();
    }
    
    /**
     * Calculate discount amount
     */
    protected function calculateDiscount()
    {
        if (!$this->voucherApplied || !$this->appliedVoucher) {
            $this->discountAmount = 0;
            $this->finalTotal = $this->total;
            return;
        }
        
        $voucher = $this->appliedVoucher;
        
        if ($voucher['discount_type'] === 'percent') {
            $discount = ($this->total * $voucher['discount_rate']) / 100;
            
            // Apply max discount cap if set
            if (isset($voucher['discount_amount']) && $voucher['discount_amount'] > 0 && $discount > $voucher['discount_amount']) {
                $discount = $voucher['discount_amount'];
            }
            
            $this->discountAmount = $discount;
        } else {
            $this->discountAmount = $voucher['discount_amount'];
        }
        
        $this->finalTotal = $this->total - $this->discountAmount;
        
        // Ensure final total is not negative
        if ($this->finalTotal < 0) {
            $this->finalTotal = 0;
        }
    }
}
