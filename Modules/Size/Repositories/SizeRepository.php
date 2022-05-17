<?php

namespace Modules\Size\Repositories;

use Illuminate\Http\Request;
use Modules\Size\Entities\Size;
use Modules\Size\Entities\SizeMen;
use Modules\Size\Entities\SizeWomen;
use Modules\Size\Entities\SizeKid;
use Modules\Size\Entities\SizeChart;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\SizeService;

class SizeRepository extends Repository implements MasterRepositoryInterface {

    protected $sizeChartModel;
    protected $sizeMenModel;
    protected $sizeWomenModel;
    protected $sizeKidModel;


  public function __construct(
      SizeService $sizeService,
      Size $model,
      SizeMen $sizeMenModel,
      SizeWomen $sizeWomenModel,
      SizeKid $sizeKidModel,
      SizeChart $sizeChartModel) {
    parent::__construct(
        $model,
        $sizeChartModel,
        $sizeMenModel,
        $sizeWomenModel,
        $sizeKidModel,
    );
    $this->sizeService = $sizeService;
    $this->sizeChartModel = $sizeChartModel;
    $this->sizeMenModel = $sizeMenModel;
    $this->sizeWomenModel = $sizeWomenModel;
    $this->sizeKidModel = $sizeKidModel;
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param [Model] $user
   * @return Void
   */
  public function updateSize(Request $request, $id) {
    $data = $request->all();
    $get_size = $this->model->findOrFail($id);
    $sizeMen = $this->sizeService->insertSpecificSize($data['men']);
    $sizeMen['size_id'] = $get_size->id;

    if(!isset($data['men_sizes_id'])){
        $this->createMenSize($sizeMen);
    } else {
        $this->updateMenSize($data['men_sizes_id'],$sizeMen);
    }

    $sizeWomen = $this->sizeService->insertSpecificSize($data['women']);
    $sizeWomen['size_id'] = $get_size->id;

    if(!isset($data['women_sizes_id'])){
        $this->createWomenSize($sizeWomen);
    } else {
        $this->updateWomenSize($data['women_sizes_id'],$sizeWomen);
    }


    $sizeKid = $this->sizeService->insertSpecificSize($data['kid']);
    $sizeKid['size_id'] = $get_size->id;

    if(!isset($data['kid_sizes_id'])){
        $this->createKidSize($sizeKid);
    } else {
        $this->updateKidSize($data['kid_sizes_id'],$sizeKid);
    }

    if($get_size->charts->count() > 0) {
        foreach($get_size->charts as $item) {
            if($item->size_name === "US - Men's"){
                $item->update([ 'size_value' => $data['men']['US'] ?? '' ]);
            } else if ($item->size_name === "US - Women's"){
                $item->update([ 'size_value' => $data['women']['US'] ?? '' ]);
            } else if($item->size_name === "US - Kid's"){
                $item->update([ 'size_value' => $data['kid']['US'] ?? '' ]);
            } else if($item->size_name === "UK"){
                $item->update([ 'size_value' => $data['men']['UK'] ?? '' ]);
            } else if($item->size_name === "EU"){
                $item->update([ 'size_value' => $data['men']['EU'] ?? '' ]);
            } else if($item->size_name === "CM"){
                $item->update([ 'size_value' => $data['men']['CM'] ?? '' ]);
            }
        }
    } else {
        $size_chart = [
            [
                'size_id' => $id,
                'size_name' => "US - Men's",
                'size_value' => $data['men']['US'] ?? ''
            ],
            [
                'size_id' => $id,
                'size_name' => "US - Women's",
                'size_value' => $data['women']['US'] ?? ''
            ],
            [
                'size_id' => $id,
                'size_name' => "US - Kid's",
                'size_value' => $data['kid']['US'] ?? ''
            ],
            [
                'size_id' => $id,
                'size_name' => "UK",
                'size_value' => $data['men']['UK'] ?? ''
            ],
            [
                'size_id' => $id,
                'size_name' => "EU",
                'size_value' => $data['men']['EU'] ?? ''
            ],
            [
                'size_id' => $id,
                'size_name' => "CM",
                'size_value' => $data['men']['CM'] ?? ''
            ],
        ];

        $this->insertSizeChart($size_chart);
    }

    //perlu di get dulu kemudian tiap data di update satu per satu by id

    return true;
  }

  public function createSize(Request $request) {
    $data = $request->all();

    $size = $this->sizeService->insertSize($request);
    $sizeMen = $this->sizeService->insertSpecificSize($data['men']);
    $sizeWomen = $this->sizeService->insertSpecificSize($data['women']);
    $sizeKid = $this->sizeService->insertSpecificSize($data['kid']);

    $inserted = $this->model->create($size);

    $sizeMen['size_id'] = $inserted->id;
    $sizeWomen['size_id'] = $inserted->id;
    $sizeKid['size_id'] = $inserted->id;

    //dd($data['men']);
    $this->createMenSize($sizeMen);
    $this->createWomenSize($sizeWomen);
    $this->createKidSize($sizeKid);

    $size_chart = [
        [
            'size_id' => $inserted->id,
            'size_name' => "US - Men's",
            'size_value' => $data['men']['US'] ?? ''
        ],
        [
            'size_id' => $inserted->id,
            'size_name' => "US - Women's",
            'size_value' => $data['women']['US'] ?? ''
        ],
        [
            'size_id' => $inserted->id,
            'size_name' => "US - Kid's",
            'size_value' => $data['kid']['US'] ?? ''
        ],
        [
            'size_id' => $inserted->id,
            'size_name' => "UK",
            'size_value' => $data['men']['UK'] ?? ''
        ],
        [
            'size_id' => $inserted->id,
            'size_name' => "EU",
            'size_value' => $data['men']['EU'] ?? ''
        ],
        [
            'size_id' => $inserted->id,
            'size_name' => "CM",
            'size_value' => $data['men']['CM'] ?? ''
        ],
    ];

    $this->insertSizeChart($size_chart);

    return true;
  }

  public function createSizeChart($data) {
      return $this->sizeChartModel->create($data);
  }

  public function insertSizeChart($data) {
    return $this->sizeChartModel->insert($data);
  }

  public function updateSizeChart($id, $data) {
    $update = $this->sizeChartModel->find($id);
    return $update->update($data);
  }

  public function createMenSize($data) {
    return $this->sizeMenModel->create($data);
  }

  public function updateMenSize($id, $data) {
    $update = $this->sizeMenModel->find($id);
    return $update->update($data);
  }

  public function getAllMenSize()
  {
      return $this->sizeMenModel->get();
  }

  public function getMenSizeById($id) {
      return $this->sizeMenModel->find($id);
  }

  public function createWomenSize($data) {
    return $this->sizeWomenModel->create($data);
  }

  public function updateWomenSize($id, $data) {
    $update = $this->sizeWomenModel->find($id);
    return $update->update($data);
  }

  public function getAllWomenSize()
  {
      return $this->sizeWomenModel->get();
  }

  public function getWomenSizeById($id) {
    return $this->sizeWomenModel->find($id);
  }

  public function createKidSize($data) {
    return $this->sizeKidModel->create($data);
  }

  public function updateKidSize($id, $data) {
    $update = $this->sizeKidModel->find($id);
    return $update->update($data);
  }

  public function getAllKidSize()
  {
      return $this->sizeKidModel->get();
  }

  public function getKidSizeById($id) {
    return $this->sizeKidModel->find($id);
  }

  public function getSizeChartById($id){
    return $this->sizeChartModel->find($id);
  }

  public function getAllSizes(){
      return $this->model->where('is_active', 1)->get();
  }

  public function getAllActiveSizes(){
      return $this->model->where('is_active', 1)->get();
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
        $delete->mens()->delete();
        $delete->womens()->delete();
        $delete->kids()->delete();
        return $delete->delete();
      }
  }

  public function getSizeIdAndNameLivewire(){
    return $this->model->where('is_active', 1)->select('id', 'size_title as value')->get();
  }

  public function getSizeIdAndName(){
      return $this->model->where('is_active', 1)->get()->pluck('id', 'size_title');
  }
}
