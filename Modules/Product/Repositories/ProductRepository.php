<?php

namespace Modules\Product\Repositories;

use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductImage;
use Modules\Product\Entities\ProductDetail;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use Carbon\Carbon;
use DB;

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
        $q = $this->model->query()
        ->with(['detail', 'images', 'signatures', 'categories', 'tags'])
        ->select('products.*', 'pd.retail_price', 'pd.after_discount_price')
        ->leftJoin('product_details as pd', function($join) {
            $join->on('pd.product_id', '=', 'products.id')
                ->where('pd.retail_price', '=', DB::raw('(
                    Select min(retail_price)
                    from product_details
                    where product_id = products.id
                )'))
                ->where('pd.after_discount_price', '=', DB::raw('(
                    Select min(after_discount_price)
                    from product_details
                    where product_id = products.id
                )'));
        })
        // ->whereRaw('pd.min_retail_price = pd2.retail_price')
        ->where(['is_active'=> 1])
        ->whereRaw('pd.retail_price IS NOT NULL')
        ->groupBy('products.id', 'products.product_code', 'products.product_name', 'products.product_link', 'products.shopee_link', 'products.blibli_link', 'products.description', 'products.image', 'products.product_visit', 'products.is_active', 'created_at','updated_at','pd.retail_price', 'pd.after_discount_price');

        return $q;
    }

    public function getProductByCode($code){
        return $this->model->query()
            ->with('images')
            ->where(['is_active' => 1, 'product_code' => $code])->first();
    }

    public function getProductDetailByIdAndSize($id, $size){
        return $this->productDetail
            ->where(['product_id' => $id, 'size' => $size]);
    }

    public function getProductDetailById($id){
        return $this->productDetail->findOrFail($id);
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

    public function updateProductDetails($id, $data){
        return $this->productDetail->find($id)->update($data);
    }

    public function getLatestProductCode(){
        return $this->model->orderBy('product_code', 'desc')->pluck('product_code')->first();
    }

    public function getProductNewRelease($limit = 10, $offset = 0) {
        $date = date('Y-m-d H:i:s');
        $today = Carbon::createFromFormat('Y-m-d H:i:s', $date)->toString();

        $query = $this->model->with(['tags','detail'])->whereHas('tags', function($q) use ($date) {
            $q->where('tag_title', 'NEW RELEASE');
            $q->whereRaw('datediff(product_tags.created_at, ?) > -30', $date);
        })
        ->join(DB::raw('(SELECT product_id, MIN(retail_price) as min_retail_price FROM product_details GROUP BY product_id) as pd2'), function($join) {
            $join->on('pd2.product_id', '=', 'products.id')->limit(1);
        })
        ->join('product_details as pd', function($join) {
            $join->on('pd.product_id', '=', 'pd2.product_id')
                ->on('pd.retail_price', '=', 'pd2.min_retail_price')->limit(1);
        })
        ->select(DB::raw('DISTINCT products.id') ,'products.*', 'pd.base_price', 'pd.retail_price', 'pd.after_discount_price')
        ->where('is_active', 1)
        ->offset($offset)
        ->limit($limit)
        ->orderBy('products.created_at', 'DESC')
        ->get();

        return $query;
    }

    public function getProductBestSeller($limit = 10, $offset = 0) {
        return $this->model->whereHas('tags', function($q) {
            $q->where('tag_title', 'BEST SELLER');
        })
        ->join(DB::raw('(SELECT product_id, MIN(retail_price) as min_retail_price FROM product_details GROUP BY product_id) as pd2'), function($join) {
            $join->on('pd2.product_id', '=', 'products.id')->limit(1);
        })
        ->join('product_details as pd', function($join) {
            $join->on('pd.product_id', '=', 'pd2.product_id')
                ->on('pd.retail_price', '=', 'pd2.min_retail_price')->limit(1);
        })
        ->select(DB::raw('DISTINCT products.id') ,'products.*', 'pd.base_price', 'pd.retail_price', 'pd.after_discount_price')
        ->where('is_active', 1)
        ->offset($offset)
        ->limit($limit)
        ->orderBy('created_at', 'DESC')
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
        return $this->model->with(['detail', 'tags', 'sizes', 'categories', 'signatures', 'images', 'details'])->find($id);
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

    public function deleteProductDetail($id){
        return $this->productDetail->find($id)->delete();
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

        if($product->images()->count() == 0) {
            //delete folder
            removeFolderFromStorage($path);
        }

        return $product->delete();
    }
}
