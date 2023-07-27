<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;

class CartService {
    const MINIMUM_QUANTITY = 1;
    const DEFAULT_INSTANCE = 'shopping-cart';

    protected $session;
    protected $instance;

    /**
     * Constructs a new cart object.
     *
     * @param Illuminate\Session\SessionManager $session
     */
    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function add($id, $size_id, $code ,$name, $retail_price, $discount_price, $size = 'All size', $quantity, $weight, $image, $url,$options = []): void
    {
        $cartItem = $this->createCartItem($id, $size_id, $code, $name, str_replace('.','',$retail_price), str_replace('.','',$discount_price),$size , $quantity, $weight, $image , $url, $options);

        $content = $this->getContent();

        if ($content->has($size_id)) {
            $cartItem->put('quantity', $content->get($size_id)->get('quantity') + $quantity);
        }

        $content->put($size_id, $cartItem);

        $this->session->put(self::DEFAULT_INSTANCE, $content);
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

            $this->session->put(self::DEFAULT_INSTANCE, $content);
        }
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
            $this->session->put(self::DEFAULT_INSTANCE, $content->except($size_id));
        }
    }

    /**
     * Clears the cart.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->session->forget(self::DEFAULT_INSTANCE);
    }

    /**
     * Returns the id hash of the cart.
     *
     * @return Illuminate\Support\Collection
     */
    public function hashID(): string
    {
        return $this->session->getId();
    }

    /**
     * Returns the content of the cart.
     *
     * @return Illuminate\Support\Collection
     */
    public function content(): Collection
    {
        return is_null($this->session->get(self::DEFAULT_INSTANCE)) ? collect([]) : $this->session->get(self::DEFAULT_INSTANCE);
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
            return $total += $item->get('quantity') * $item->get('weight');
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
        return $this->session->has(self::DEFAULT_INSTANCE) ? $this->session->get(self::DEFAULT_INSTANCE) : collect([]);
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
}
