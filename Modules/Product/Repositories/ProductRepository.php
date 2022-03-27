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

    public function getAllPagination($pagination = 10){
        return $this->model->paginate($pagination);
    }

    public function getSearchByWithPaginate($where_column = [], $where_value = '', $pagination = 10) {
        /**
         * Global search product using multi column & search value
         * return collection
         */

        return $this->model->query()->whereLike($where_column, $where_value)->paginate($pagination);
    }

    public function getProductWhereLike($where_column = [], $where_value = ''){
        $where_like = [];
        foreach($where_column as $value){
            $where_like[$value] = $where_value;
        }

        //dd($where_like);
        return $this->model->query()
            ->with(['detail', 'images', 'signatures'])
            ->join('product_details as pd', 'pd.product_id', '=', 'products.id')
            ->select('products.*', 'pd.base_price', 'pd.retail_price', 'pd.after_discount_price')
            ->where($where_like)
            ->where('is_active', 1);
    }

    public function getProductWhere(){
        return $this->model->query()
            ->with(['detail', 'images', 'signatures'])
            ->join('product_details as pd', 'pd.product_id', '=', 'products.id')
            ->select('products.*', 'pd.base_price', 'pd.retail_price', 'pd.after_discount_price')
            ->where('is_active', 1);
    }

    public function getProductOneFeaturedAirJordan(){
        return $this->model->whereHas('tags', function($q) {
            $q->where('tag_title', 'FEATURED');
        })
        ->where('product_name', 'LIKE', '%AIR JORDAN%')
        ->where('is_active', 1)
        ->first();
    }

    public function getProductOneFeaturedNike(){
        return $this->model->whereHas('tags', function($q) {
            $q->where('tag_title', 'FEATURED');
        })
        ->where('product_name', 'LIKE', '%NIKE%')
        ->where('is_active', 1)
        ->first();
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

    public function getProductNewRelease($limit = 10, $offset = 0) {
        return $this->model->whereHas('tags', function($q) {
            $q->where('tag_title', 'NEW RELEASE');
        })
        ->where('is_active', 1)
        ->offset($offset)
        ->limit($limit)
        ->get();
    }

    public function getProductBestSeller($limit = 10, $offset = 0) {
        return $this->model->whereHas('tags', function($q) {
            $q->where('tag_title', 'BEST SELLER');
        })
        ->where('is_active', 1)
        ->offset($offset)
        ->limit($limit)
        ->get();
    }

    public function getProductByBrandId($brand_id, $limit = 10, $offset = 0) {
        return $this->model->with('detail')->whereHas('detail', function($q)  use ($brand_id){
            $q->where('brand_id', $brand_id);
        })
        ->where('is_active', 1)
        ->offset($offset)
        ->limit($limit)
        ->get();
    }

    public function getProductCustomTagLimit($tag ,$limit = 10, $offset = 0) {

    }

    public function getProductByIdWithEager($id){
        return $this->model->with(['detail', 'tags', 'sizes', 'categories', 'signatures', 'images'])->find($id);
    }

    public function getProductById($id){
        return $this->model->find($id);
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

    public function deleteProductImageByImageId($image_url, $product_id){
       return $this->productImage->where(['image_url' => $image_url, 'product_id' => $product_id])->delete();
    }

    public function deleteProduct($id){
        $product = $this->model->find($id);
        $path = 'images/products/'.$product->product_code;

        foreach($product->images()->get() as $image){
            removeImageFromStorage($path, $image->image_url);
        }

        $product->images()->delete();
        $product->detail()->delete();
        $product->tags()->detach();
        $product->categories()->detach();
        $product->sizes()->detach();
        $product->signatures()->detach();

        return $product->delete();
    }
}
