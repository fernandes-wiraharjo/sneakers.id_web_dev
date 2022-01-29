<?php

namespace Modules\Product\Repositories;

use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductImage;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;

class ProductRepository extends Repository implements MasterRepositoryInterface {

    protected $model;
    protected $modelProductImage;

    public function __construct(Product $model, ProductImage $modelProductImage) {
        parent::__construct($model, $modelProductImage);
        $this->model = $model;
        $this->productImage = $modelProductImage;
    }

    public function createProduct($data){
        return $this->model->create($data);
    }

    public function insertProductImage($data){
        return $this->modelProductImage->create($data);
    }

    public function getLatestProductCode(){
        return $this->model->orderBy('product_code', 'desc')->pluck('product_code')->first();
    }

    public function getProductById($id){
        return $this->model->findOrFail($id);
    }

}
