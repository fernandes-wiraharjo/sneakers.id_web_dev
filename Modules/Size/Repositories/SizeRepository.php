<?php

namespace Modules\Size\Repositories;

use Illuminate\Http\Request;
use Modules\Size\Entities\Size;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\SizeService;

class SizeRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(SizeService $sizeService, Size $model) {
    parent::__construct($model);
    $this->sizeService = $sizeService;
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param [Model] $user
   * @return Void
   */
  public function updateSize(Request $request, $id) {
    $size = $this->sizeService->updateSize($request);

    $get_size = $this->model->findOrFail($id);
    $get_size->update($size);
  }

  public function createSize(Request $request) {
    $size = $this->sizeService->insertSize($request);

    $this->model->create($size);
  }

  public function getSizeById($id){
      return $this->model->findOrFail($id);
  }

  public function deleteSize($id){
      return $this->getSizeById($id)->delete();
  }

  public function getSizeIdAndNameLivewire(){
    return $this->model->select('id', 'size_title as value')->get();
  }
}
