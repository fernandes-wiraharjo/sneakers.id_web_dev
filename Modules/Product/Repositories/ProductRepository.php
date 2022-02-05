<?php

namespace Modules\Product\Repositories;

use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductImage;
use Modules\Product\Entities\ProductDetail;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;

class ProductRepository extends Repository implements MasterRepositoryInterface {

    protected $model;
    protected $modelProductImage;
    protected $modelProductDetail;

    public function __construct(
        Product $model,
        ProductImage $modelProductImage,
        ProductDetail $modelProductDetail) {
        parent::__construct($model, $modelProductImage, $modelProductDetail);
        $this->model = $model;
        $this->productImage = $modelProductImage;
        $this->productDetail = $modelProductDetail;
    }

    public function createProduct($data){
        return $this->model->create($data);
    }

    public function insertProductImage($data){
        return $this->productImage->create($data);
    }

    public function insertProductDetails($data){
        return $this->productDetail->create($data);
    }

    public function getLatestProductCode(){
        return $this->model->orderBy('product_code', 'desc')->pluck('product_code')->first();
    }

    public function getProductById($id){
        return $this->model->findOrFail($id);
    }

    public function getProductImageByIdProduct($id){
        return $this->model->findOrFail($id)->images()->get();
    }

    public function attachProductTags($id, $tags = []){
        $product = $this->model->find($id);
        return $product->tags()->attach($tags);
    }

    public function attachProductCategories($id, $categories = []){
        $product = $this->model->find($id);
        return $product->categories()->attach($categories);
    }

    public function attachProductSizes($id, $size = []){
        $product = $this->model->find($id);
        return $product->sizes()->attach($size);
    }

    public function attachProductSignatures($id, $signatures = []){
        $product = $this->model->find($id);
        return $product->signatures()->attach($signatures);
    }

    public function syncProductTags($id, $tags = []){
        $product = $this->model->find($id);
        return $product->tags()->sync($tags);
    }

    public function syncProductCategories($id, $categories = []){
        $product = $this->model->find($id);
        return $product->categories()->sync($categories);
    }

    public function syncProductSizes($id, $size = []){
        $product = $this->model->find($id);
        return $product->sizes()->sync($size);
    }

    public function syncProductSignatures($id, $signatures = []){
        $product = $this->model->find($id);
        return $product->signatures()->sync($signatures);
    }

    public function deleteProductImage($id){
        return $this->model->find($id)->images()->delete();
    }

    public function deleteProduct($id){
        $product = $this->model->find($id);

        $product->images()->delete();
        $product->detail()->delete();
        $product->tags()->detach();
        $product->categories()->detach();
        $product->sizes()->detach();
        $product->signatures()->detach();

        return $product->delete();
    }
}
