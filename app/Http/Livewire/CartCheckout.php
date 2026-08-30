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
    public $guestEmail = ''; // Email for guest users

    /** Cart line keys (size_id) that are out of stock or missing in DB */
    public array $unavailableLines = [];

    public bool $hasUnavailableItems = false;

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
            // Pre-fill guest email if voucher was applied by guest
            if (!auth()->check() && isset($voucherData['email'])) {
                $this->guestEmail = $voucherData['email'];
            }
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
        
        // Reload voucher data to ensure inputs are populated on refresh
        $voucherData = Cart::getVoucher();
        if ($voucherData) {
            $this->voucherCode = $voucherData['code'];
            $this->voucherApplied = true;
            $this->appliedVoucher = $voucherData;
            $this->voucherMessage = $voucherData['message'] ?? 'Voucher applied successfully!';
            // Pre-fill guest email if voucher was applied by guest
            if (!auth()->check() && isset($voucherData['email'])) {
                $this->guestEmail = $voucherData['email'];
            }
        }
        
        $this->calculateDiscount();
        
        return view('bootstrap.livewire.cart-checkout', [
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
        $detail = ProductDetail::query()->where('id', $size_id)->first();
        $qty = $detail ? (int) $detail->qty : 0;

        if ($qty <= 0) {
            if ($action === 'plus') {
                $this->emit('showToast', ['type' => 'error', 'message' => 'This product is no longer available. Remove it from your cart to continue.']);
            }
            $this->updateCart();
            $this->emit('cartCounter');
            return;
        }

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

        $this->unavailableLines = [];
        foreach (Cart::content() as $lineKey => $item) {
            $sizeId = $item['size_id'];
            $detail = ProductDetail::query()->where('id', $sizeId)->first();
            $stock = $detail ? (int) $detail->qty : 0;

            if ($stock <= 0) {
                $this->unavailableLines[$lineKey] = true;
            }

            if ($stock <= 0) {
                $this->disabledPlus[$sizeId] = true;
            } elseif (intval($item['quantity']) + 1 <= $stock) {
                $this->disabledPlus[$sizeId] = false;
            } else {
                $this->disabledPlus[$sizeId] = true;
            }
        }

        $this->hasUnavailableItems = count($this->unavailableLines) > 0;
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
        if ($this->hasUnavailableItems) {
            $this->voucherMessage = 'Remove unavailable items from your cart before using a voucher.';
            return;
        }

        if (empty($this->voucherCode)) {
            $this->voucherMessage = 'Please enter a voucher code.';
            return;
        }
        
        // For guests, email is required
        if (!auth()->check() && empty($this->guestEmail)) {
            $this->voucherMessage = 'Please enter your email address to apply voucher.';
            return;
        }
        
        // Validate email format for guests
        if (!auth()->check() && !filter_var($this->guestEmail, FILTER_VALIDATE_EMAIL)) {
            $this->voucherMessage = 'Please enter a valid email address.';
            return;
        }
        
        // Get voucher repository
        $voucherRepo = app(\Modules\DiscountVoucher\Repositories\DiscountVoucherRepository::class);
        
        // Get current cart total
        $currentTotal = Cart::total();
        
        // Get email - use authenticated user's email or guest email
        $email = auth()->check() ? auth()->user()->email : $this->guestEmail;
        
        // Validate voucher
        $validation = $voucherRepo->validateVoucherForUser(
            $this->voucherCode,
            $currentTotal,
            $email
        );
        
        if ($validation['valid']) {
            $this->voucherApplied = true;
            $this->appliedVoucher = [
                'id' => $validation['voucher']->id,
                'code' => $validation['voucher']->voucher_code,
                'discount_type' => $validation['voucher']->discount_type,
                'discount_rate' => $validation['voucher']->discount_rate,
                'discount_amount' => $validation['voucher']->discount_amount,
                'apply_to' => $validation['voucher']->apply_to ?? 'cart',
                'min_purchase' => $validation['voucher']->min_purchase,
                'message' => $validation['message'],
                'email' => !auth()->check() ? $this->guestEmail : null
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
        $applyTo = $voucher['apply_to'] ?? 'cart';
        $productTotal = (float) $this->total;
        $minPurchase = (float) ($voucher['min_purchase'] ?? 0);

        // Shipping-only discount is unknown until checkout selects a courier.
        if ($applyTo === 'shipping') {
            $this->discountAmount = 0;
            $this->finalTotal = $this->total;
            return;
        }

        // Entire-cart min may depend on shipping; preview discount only if product total already qualifies.
        if ($applyTo === 'cart' && $productTotal < $minPurchase) {
            $this->discountAmount = 0;
            $this->finalTotal = $this->total;
            return;
        }

        $baseAmount = $productTotal;

        if ($voucher['discount_type'] === 'percent') {
            $discount = ($baseAmount * $voucher['discount_rate']) / 100;

            if (isset($voucher['discount_amount']) && $voucher['discount_amount'] > 0 && $discount > $voucher['discount_amount']) {
                $discount = $voucher['discount_amount'];
            }

            $this->discountAmount = min($discount, $baseAmount);
        } else {
            $this->discountAmount = min((float) $voucher['discount_amount'], $baseAmount);
        }

        $this->finalTotal = max(0, $this->total - $this->discountAmount);
    }
}
