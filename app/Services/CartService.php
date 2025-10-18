<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Cache;

class CartService {
    const MINIMUM_QUANTITY = 1;
    const DEFAULT_INSTANCE = 'shopping-cart';
    const CART_TTL = 3600; // 1 hour in seconds

    protected $instance;
    protected $cartId;

    public function __construct($userId = null)
    {
        if (!$userId && auth()->user()) {
            $this->cartId = md5(self::DEFAULT_INSTANCE . ':' . auth()->user()->id);
        } else {
            $this->cartId = md5(self::DEFAULT_INSTANCE . ':' . $userId);
        }
    }

    public function add($id, $size_id, $code ,$name, $retail_price, $discount_price, $size = 'All size', $quantity, $weight, $image, $url,$options = []): void
    {
        $cartItem = $this->createCartItem($id, $size_id, $code, $name, str_replace('.','',$retail_price), str_replace('.','',$discount_price),$size , $quantity, $weight, $image , $url, $options);

        $content = $this->getContent();

        if ($content->has($size_id)) {
            $cartItem->put('quantity', $content->get($size_id)->get('quantity') + $quantity);
        }

        $content->put($size_id, $cartItem);

        Cache::put($this->cartId, $content, self::CART_TTL);
    }

    public function update(string $size_id, string $action): void
    {
        $content = $this->getContent();

        if ($content->has($size_id)) {
            $cartItem = $content->get($size_id);

            switch ($action) {
                case 'plus':
                    $cartItem->put('quantity', $content->get($size_id)->get('quantity') + 1);
                    break;
                case 'minus':
                    $updatedQuantity = $content->get($size_id)->get('quantity') - 1;

                    if ($updatedQuantity < self::MINIMUM_QUANTITY) {
                        $updatedQuantity = self::MINIMUM_QUANTITY;
                    }

                    $cartItem->put('quantity', $updatedQuantity);
                    break;
            }

            $content->put($size_id, $cartItem);

            Cache::put($this->cartId, $content, self::CART_TTL);
        }
    }

    public function addNotes($text): void
    {
        // dd($text);
        $content = $this->getContent();

        $content->reduce(function ($total, $item) use ($text){
            $item->put('note', $text);
        });
        // // Add notes to existing content or create new array with only note text as value for key "
        // // $content->put('note', $text);
        Cache::put($this->cartId, $content, self::CART_TTL);
    }

    public function getNotes()
    {
        $content = $this->getContent();

        if ($content->count() > 0) {
            $get_note = $content->first()->get('note');

            return $get_note;
        }
        return '';
    }

    /**
     * Removes an item from the cart.
     *
     * @param string $id
     * @return void
     */
    public function remove(string $size_id): void
    {
        $content = $this->getContent();

        if ($content->has($size_id)) {
            Cache::put($this->cartId, $content->except($size_id), self::CART_TTL);
        }
    }

    /**
     * Clears the cart.
     *
     * @return void
     */
    public function clear(): void
    {
        Cache::forget($this->cartId);
    }

    public static function clearByUserId(int $userId): void
    {
        Cache::forget(md5(self::DEFAULT_INSTANCE . ':' . $userId));
    }

    /**
     * Returns the id hash of the cart.
     *
     * @return Illuminate\Support\Collection
     */
    public function hashID(): string
    {
        return $this->cartId;
    }

    /**
     * Returns the content of the cart.
     *
     * @return Illuminate\Support\Collection
     */
    public function content(): Collection
    {
        return Cache::get($this->cartId, collect([]));
    }

     /**
     * Returns items detail of the items in the cart.
     *
     * @return collect item content
     */
    public function item(string $size_id): Collection
    {
        $content = $this->getContent();

        if ($content->has($size_id)) {
            return $cartItem = $content->get($size_id);
        }

        return collect();
    }

    /**
     * Returns total price of the items in the cart.
     *
     * @return int
     */
    public function total(): int
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, $item) {
            $price = $item->get('discount_price') != 0 ? $item->get('discount_price') : $item->get('retail_price');
            return $total += $price * $item->get('quantity');
        });

        return $total ?? 0;
    }

    /**
     * Returns total price of the items in the cart.
     *
     * @return int
     */
    public function totalQuantity(): int
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, $item) {
            return $total += $item->get('quantity');
        });

        return $total ?? 0;
    }

    public function totalWeight(): int
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, $item) {
            $item->get('weight');
            $item->get('quantity');
            return $total += intval($item->get('quantity')) * intval($item->get('weight'));
        });

        return $total ?? 0;
    }

    /**
     * Returns the content of the cart.
     *
     * @return Illuminate\Support\Collection
     */
    protected function getContent(): Collection
    {
        return Cache::get($this->cartId, collect([]));
    }

    /**
     * Creates a new cart item from given inputs.
     *
     * @param string $name
     * @param string $price
     * @param string $quantity
     * @param array $options
     * @return Illuminate\Support\Collection
     */
    protected function createCartItem(int $id, int $size_id,string $code, string $name, string $retail_price, string $discount_price, string $size,string $quantity,string $weight, string $image , string $url, array $options): Collection
    {
        $retail_price = intval($retail_price);
        $discount_price = intval($discount_price);
        $quantity = intval($quantity);
        $weight = intval($weight);

        if ($quantity < self::MINIMUM_QUANTITY) {
            $quantity = self::MINIMUM_QUANTITY;
        }

        return collect([
            'id' => $id,
            'size_id' => $size_id,
            'product_code' => $code,
            'name' => $name,
            'retail_price' => $retail_price,
            'discount_price' => $discount_price,
            'size' => $size,
            'quantity' => $quantity,
            'weight' => $weight,
            'image' => $image,
            'url' => $url,
            'options' => $options,
        ]);
    }

    public function setOrderId($orderId)
    {
        $this->session->put('cart_order_id', $orderId);
    }

    public function getOrderId()
    {
        return $this->session->get('cart_order_id');
    }

    public function clearOrderId()
    {
        $this->session->forget('cart_order_id');
    }
}
