<?php

namespace Modules\Size\Repositories;

use Illuminate\Http\Request;
use Modules\Size\Entities\Size;
use Modules\Size\Entities\SizeChart;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\SizeService;

class SizeRepository extends Repository implements MasterRepositoryInterface {

    protected $sizeChartModel;

  public function __construct(SizeService $sizeService, Size $model, SizeChart $sizeChartModel) {
    parent::__construct($model, $sizeChartModel);
    $this->sizeService = $sizeService;
    $this->sizeChartModel = $sizeChartModel;
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

    $data = $request->all();

    if($data['size_code'] != $get_size->size_code){

      $updated = $get_size->update([
        'is_active' => false
      ]);

      if($updated){
        $size['is_active'] = $data['is_active'];

        $this->model->create($size);

        return true;
      }
    } else {
      $updated = $get_size->update($size);

      if($updated){
          foreach($data['size'] as $item) {
              $exists = $this->getSizeChartById($item['size_chart_id']);

              if ($exists && ( $item['size_name'] != $exists->size_name || $item['size_value'] != $exists->size_value )) {
                  $this->updateSizeChart($item['size_chart_id'], [
                      'size_name' => $item['size_name'],
                      'size_value' => $item['size_value']]);
              } elseif (empty($item['size_chart_id'])) {
                  $this->createSizeChart([
                      'size_id' => $id,
                      'size_name' => $item['size_name'],
                      'size_value' => $item['size_value']
                  ]);
              }
          }
      }
    }
    return true;
  }

  public function createSize(Request $request) {
    $size = $this->sizeService->insertSize($request);

    $data = $request->all();

    $inserted = $this->model->create($size);

    foreach($data['size'] as $item) {
        if($item['size_value']){
          $this->createSizeChart([
            'size_id' => $inserted->id,
            'size_name' => $item['size_name'],
            'size_value' => $item['size_value']
          ]);
        }
    }

    return true;
  }

  public function createSizeChart($data) {
      return $this->sizeChartModel->create($data);
  }

  public function updateSizeChart($id, $data) {
    $update = $this->sizeChartModel->find($id);
    return $update->update($data);
  }

  public function getSizeChartById($id){
    return $this->sizeChartModel->find($id);
  }

  public function getAllSizes(){
      return $this->model->get();
  }

  public function getSizeById($id){
      return $this->model->findOrFail($id);
  }

  public function deleteSize($id){
      $delete = $this->getSizeById($id);

      if ($delete->products()->count() > 0 || $delete->charts()->count() > 0) {
        return false;
      } else {
        $delete->charts()->delete();
        return $delete->delete();
      }
  }

  public function getSizeIdAndNameLivewire(){
    return $this->model->where('is_active', 1)->select('id', 'size_title as value')->get();
  }

  public function getSizeIdAndName(){
      return $this->model->get()->pluck('id', 'size_title');
  }
}
