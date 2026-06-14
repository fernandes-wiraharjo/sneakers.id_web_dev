<?php

namespace Modules\Product\Repositories;

use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductImage;
use Modules\Product\Entities\ProductDetail;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use DB;
use Modules\Product\Entities\ProductSizeChart;

class ProductRepository extends Repository implements MasterRepositoryInterface {

    protected $model;
    protected $modelProductImage;
    protected $modelProductDetail;
    protected $modelProductSizeChart;

    public function __construct(
        Product $model,
        ProductImage $modelProductImage,
        ProductDetail $modelProductDetail,
        ProductSizeChart $modelProductSizeChart) {
        parent::__construct($model, $modelProductImage, $modelProductDetail, $modelProductSizeChart);
        $this->model = $model;
        $this->productImage = $modelProductImage;
        $this->productDetail = $modelProductDetail;
        $this->productSizeChart = $modelProductSizeChart;
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
        ->select('products.*', 'pd.retail_price', 'pd.after_discount_price', DB::raw('IF(pd.after_discount_price = 0, pd.retail_price, pd.after_discount_price) as actual_product_prize'))
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
        // ->whereRaw('pd.min_retail_price = pd2.retail_price')
        ->where(['products.is_active'=> 1])
        ->whereHas('details', function ($q) {
            $q->where('qty', '>', 0);
        })
        ->where('pd.qty', '<>', 0)
        ->groupBy('products.id', 'products.product_code', 'products.product_name', 'products.product_link', 'products.shopee_link', 'products.tiktok_link', 'products.blibli_link', 'products.description', 'products.image', 'products.product_visit', 'products.page_view_count', 'products.is_active', 'products.created_at','products.updated_at','pd.retail_price', 'pd.after_discount_price');

        return $q;
    }

    // public function getProductWhere() {
    //     $minPrices = DB::table('product_details')
    //         ->select(
    //             'product_id',
    //             DB::raw('MIN(retail_price) as min_retail_price'),
    //             DB::raw('MIN(after_discount_price) as min_after_discount_price')
    //         )
    //         ->groupBy('product_id');

    //     $q = $this->model->query()
    //         ->with(['images:id,product_id,image_url']) // only load what you need
    //         ->joinSub($minPrices, 'pd', function($join) {
    //             $join->on('pd.product_id', '=', 'products.id');
    //         })
    //         ->select(
    //             'products.*',
    //             'pd.min_retail_price as retail_price',
    //             'pd.min_after_discount_price as after_discount_price',
    //             DB::raw('IF(pd.min_after_discount_price = 0, pd.min_retail_price, pd.min_after_discount_price) as actual_product_prize')
    //         )
    //         ->where('products.is_active', 1)
    //         ->whereExists(function($q) {
    //             $q->select(DB::raw(1))
    //             ->from('product_details')
    //             ->whereColumn('product_details.product_id', 'products.id')
    //             ->where('product_details.qty', '<>', 0);
    //         })
    //         ->groupBy(
    //             'products.id',
    //             'products.product_code',
    //             'products.product_name',
    //             'products.product_link',
    //             'products.shopee_link',
    //             'products.tiktok_link',
    //             'products.blibli_link',
    //             'products.description',
    //             'products.image',
    //             'products.product_visit',
    //             'products.is_active',
    //             'products.created_at',
    //             'products.updated_at',
    //             'pd.min_retail_price',
    //             'pd.min_after_discount_price'
    //         );

    //     return $q;
    // }

    public function getProductByCode($code){
        return $this->model->query()
            ->with('images')
            ->where(['is_active' => 1, 'product_code' => $code])->first();
    }

    public function getProductDetailByIdAndSize($id, $size){
        return $this->productDetail
            ->where(['product_id' => $id, 'size' => $size])
            ->first();
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

    public function insertProductSizeChart($data){
        return $this->productSizeChart->create($data);
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
        return $this->applyNewReleaseScope($this->getProductWhere())
            ->orderByDesc('products.created_at')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    public function applyNewReleaseScope($query)
    {
        return $query->whereHas('tags', function ($q) {
            $q->where('tag_title', 'NEW RELEASE');
        });
    }

    /**
     * Purchased quantity subquery (all sizes) for best-seller ranking.
     */
    protected function bestSellerPurchaseCountSql(): string
    {
        return '(
            SELECT COALESCE(SUM(ti.quantity), 0)
            FROM transaction_items ti
            INNER JOIN product_details pdt ON pdt.id = ti.product_detail_id
            INNER JOIN transactions t ON t.id = ti.transaction_id
            WHERE pdt.product_id = products.id
            AND t.status IN (\'SUCCESS\', \'COMPLETED\')
        )';
    }

    /**
     * Apply best-seller ranking: purchases, page views, created_at, product name.
     */
    public function applyBestSellerOrdering($query)
    {
        return $query
            ->orderByRaw($this->bestSellerPurchaseCountSql() . ' DESC')
            ->orderByDesc('products.page_view_count')
            ->orderByDesc('products.created_at')
            ->orderBy('products.product_name');
    }

    public function getProductBestSellerQuery()
    {
        return $this->applyBestSellerOrdering($this->getProductWhere());
    }

    public function getProductBestSeller($limit = 10, $offset = 0)
    {
        return $this->getProductBestSellerQuery()
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

    public function deleteProduct($id, $source){
        $product = $this->model->find($id);
        $path = 'images/products/'.$product->product_code;

        if ($source == 'cms') {
            foreach($product->images()->get() as $image){
                removeImageFromStorage($path, $image->image_url);
            }
        } else { // from artisan command (run from repositories, not public_html on cpanel)
            $actualPublicPath = base_path('../../public_html');
            foreach($product->images()->get() as $image){
                removeImageFromStorage($path, $image->image_url, $actualPublicPath);
            }
        }

        $product->images()->delete();
        $product->detail()->delete();
        $product->tags()->detach();
        $product->categories()->detach();
        $product->sizes()->detach();
        $product->signatures()->detach();

        if($product->images()->count() == 0) {
            //delete folder
            if ($source == 'cms') {
                removeFolderFromStorage($path);
            } else { // from artisan command (run from repositories, not public_html on cpanel)
                $actualPublicPath = base_path('../../public_html');
                removeFolderFromStorage($path, $actualPublicPath);
            }
        }

        return $product->delete();
    }
}
