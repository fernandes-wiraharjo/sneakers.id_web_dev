<?php
namespace App\Http\Livewire;
use App\Facades\Cart;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Modules\Product\Entities\ProductDetail;

class Product extends Component
{
    public $product;
    public $quantity;
    public $size;
    public $sizeList;
    public $showRetailPrice;
    public $showDiscountPrice;
    public $showDiscountPercentage;
    public $showSelectedSize;
    public $inCartPrice;

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->quantity = 1;
        // $this->size = $this->product->detail->id;
        $this->showSelectedSize = $this->product->detail->size ?? 'All size';
        $this->showRetailPrice = $this->product->detail->retail_price;
        $this->showDiscountPrice = $this->product->detail->after_discount_price;
        $this->showDiscountPercentage = $this->product->detail->discount_percentage;
    }

    public function updatePrice($id) {
        $productDetails = ProductDetail::find($id);
        $this->size = $id;
        $this->showRetailPrice = $productDetails->retail_price;
        $this->showDiscountPrice = $productDetails->after_discount_price;
        $this->showDiscountPercentage = $productDetails->discount_percentage;
        $this->showSelectedSize = $productDetails->size ?? 'All size';
    }
        /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.product');
    }
    /**
     * Adds an item to cart.     *
     * @return void
     */
    public function addToCart(): void
    {
        if (is_null($this->size)) {
            $this->emit('modal', ['message' => 'Please select a size']);
        } else {
            $item = Cart::item(intval($this->size));
            $current_item = ProductDetail::find($this->size);

            if($item->isNotEmpty()) {
                if($item['quantity'] + $this->quantity >= $current_item->qty) {
                    $this->emit('modal', ['message' => 'Product stock is limited!']);
                } else {
                    $url = url('/product-detail/'.$this->product->id.'/'.$this->product->product_name);
                    Cart::add($this->product->id, intval($this->size), $this->product->product_code ,$this->product->product_name, $this->showRetailPrice, $this->showDiscountPrice, $this->showSelectedSize, $this->quantity, $this->product->detail->weight ,getImage($this->product->image, 'products/' . $this->product->product_code), $url);
                    $this->emit('productAddedToCart');
                    $this->emit('cartCounter');
                }
            } else {
                $url = url('/product-detail/'.$this->product->id.'/'.$this->product->product_name);
                Cart::add($this->product->id, intval($this->size), $this->product->product_code ,$this->product->product_name, $this->showRetailPrice, $this->showDiscountPrice, $this->showSelectedSize, $this->quantity, $this->product->detail->weight ,getImage($this->product->image, 'products/' . $this->product->product_code), $url);
                $this->emit('productAddedToCart');
                $this->emit('cartCounter');
            }

        }
    }
}
