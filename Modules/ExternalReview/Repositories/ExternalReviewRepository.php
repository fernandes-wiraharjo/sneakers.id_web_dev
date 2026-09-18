<?php

namespace Modules\ExternalReview\Repositories;

use Illuminate\Support\Str;
use Modules\ExternalReview\Entities\ExternalReviewLink;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductDetail;
use App\Repositories\Repository;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;

class ExternalReviewRepository extends Repository implements MasterRepositoryInterface
{
    public function __construct(ExternalReviewLink $model)
    {
        parent::__construct($model);
    }

    public function getById($id)
    {
        return $this->model->with(['product', 'reviewProduct'])->findOrFail($id);
    }

    public function getByToken(string $token)
    {
        return $this->model->with(['product', 'reviewProduct'])
            ->where('token', $token)
            ->first();
    }

    public function createLink(array $data): ExternalReviewLink
    {
        return $this->model->create([
            'token' => Str::uuid()->toString(),
            'product_id' => $data['product_id'],
            'product_size' => $data['product_size'],
            'buyer_name' => $data['buyer_name'],
            'created_by' => $data['created_by'] ?? null,
        ]);
    }

    public function deleteLink($id)
    {
        $link = $this->getById($id);

        if ($link->isUsed()) {
            return false;
        }

        return $link->delete();
    }

    public function getActiveProductsForSelect()
    {
        return Product::query()
            ->where('is_active', 1)
            ->orderBy('product_name')
            ->get(['id', 'product_code', 'product_name']);
    }

    public function getProductSizes(int $productId)
    {
        return ProductDetail::query()
            ->where('product_id', $productId)
            ->orderBy('size')
            ->pluck('size')
            ->unique()
            ->values();
    }

    public function markAsUsed(ExternalReviewLink $link, int $reviewProductId): ExternalReviewLink
    {
        $link->update([
            'review_product_id' => $reviewProductId,
            'used_at' => now(),
        ]);

        return $link->fresh();
    }
}
