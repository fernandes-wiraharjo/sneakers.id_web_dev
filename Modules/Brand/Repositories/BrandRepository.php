<?php

namespace Modules\Brand\Repositories;

use Illuminate\Http\Request;
use Modules\Brand\Entities\Brand;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\BrandService;

class BrandRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(BrandService $brandService, Brand $model) {
    parent::__construct($model);
    $this->brandService = $brandService;
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param [Model] $user
   * @return Void
   */
  public function updateBrand(Request $request, $id) {
    $brand = $this->brandService->updateBrand($request);

    $get_brand = $this->model->findOrFail($id);
    $get_brand->update($brand);
  }

  public function createBrand(Request $request) {
    $brand = $this->brandService->insertBrand($request);

    $this->model->create($brand);
  }

  public function getBrandById($id){
      return $this->model->findOrFail($id);
  }

  public function deleteBrand($id){
      return $this->getBrandById($id)->delete();
  }

  public function getBrandIdAndName(){
      return $this->model->get()->pluck('id', 'brand_title');
  }
}
