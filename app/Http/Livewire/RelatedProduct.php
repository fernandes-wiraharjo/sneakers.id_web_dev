<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;

class RelatedProduct extends Component
{
    public $product;
    public $relatedProducts;

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount($product): void
    {
        $this->product = $product;
        $this->loadRelatedProducts();
    }

    /**
     * Load related products based on the formula:
     * 1. Find all related price (+- 10%)
     * 2. Order by similar category and tags
     * 3. Order by created_at descending
     *
     * @return void
     */
    protected function loadRelatedProducts(): void
    {
        // Get current product's price (use after_discount_price if available, otherwise retail_price)
        $currentProductPrice = $this->product->detail->after_discount_price > 0 
            ? $this->product->detail->after_discount_price 
            : $this->product->detail->retail_price;

        // Calculate price range (±10%)
        $minPrice = $currentProductPrice * 0.9;
        $maxPrice = $currentProductPrice * 1.1;

        // Get current product's category IDs and tag IDs
        $currentCategoryIds = $this->product->categories->pluck('id')->toArray();
        $currentTagIds = $this->product->tags->pluck('id')->toArray();

        // Build query to find related products
        $query = Product::query()
            ->with(['detail', 'images', 'categories', 'tags'])
            ->select(
                'products.*',
                'pd.retail_price',
                'pd.after_discount_price',
                'pd.discount_percentage',
                DB::raw('IF(pd.after_discount_price = 0, pd.retail_price, pd.after_discount_price) as actual_product_price')
            )
            ->leftJoin('product_details as pd', function($join) {
                $join->on('pd.product_id', '=', 'products.id')
                    ->where('pd.retail_price', '=', DB::raw('(
                        Select min(retail_price)
                        from product_details
                        where product_id = products.id
                        and qty > 0
                    )'))
                    ->where('pd.after_discount_price', '=', DB::raw('(
                        Select min(after_discount_price)
                        from product_details
                        where product_id = products.id
                        and qty > 0
                    )'));
            })
            ->where('products.is_active', 1)
            ->where('pd.qty', '<>', 0)
            ->where('products.id', '<>', $this->product->id) // Exclude current product
            ->where(function($q) use ($minPrice, $maxPrice) {
                // Price within ±10%
                $q->where(function($subQ) use ($minPrice, $maxPrice) {
                    $subQ->whereRaw('IF(pd.after_discount_price = 0, pd.retail_price, pd.after_discount_price) >= ?', [$minPrice])
                         ->whereRaw('IF(pd.after_discount_price = 0, pd.retail_price, pd.after_discount_price) <= ?', [$maxPrice]);
                });
            })
            ->groupBy(
                'products.id',
                'products.product_code',
                'products.product_name',
                'products.product_link',
                'products.shopee_link',
                'products.tiktok_link',
                'products.blibli_link',
                'products.description',
                'products.image',
                'products.product_visit',
                'products.page_view_count',
                'products.is_active',
                'products.created_at',
                'products.updated_at',
                'pd.retail_price',
                'pd.after_discount_price',
                'pd.discount_percentage'
            );

        // Get all products matching price range
        $products = $query->get();

        // Score products based on category and tag matches
        $scoredProducts = $products->map(function($product) use ($currentCategoryIds, $currentTagIds) {
            $categoryMatches = $product->categories->whereIn('id', $currentCategoryIds)->count();
            $tagMatches = $product->tags->whereIn('id', $currentTagIds)->count();
            
            // Calculate score: category matches weighted more, then tag matches
            $score = ($categoryMatches * 10) + ($tagMatches * 5);
            
            return [
                'product' => $product,
                'score' => $score,
                'category_matches' => $categoryMatches,
                'tag_matches' => $tagMatches
            ];
        });

        // Sort by score (descending), then by created_at (descending)
        $sortedProducts = $scoredProducts->sortByDesc(function($item) {
            return [$item['score'], $item['product']->created_at];
        });

        // Take top 6 products
        $this->relatedProducts = $sortedProducts->take(6)->pluck('product')->values();
    }

    /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('bootstrap.livewire.related-product');
    }
}

