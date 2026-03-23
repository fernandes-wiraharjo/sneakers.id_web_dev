<?php

namespace Modules\GlobalSetting\Repositories;

use Illuminate\Http\Request;
use Modules\GlobalSetting\Entities\GlobalSetting;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\GlobalSettingService;

class GlobalSettingRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(GlobalSettingService $globalSettingService, GlobalSetting $model) {
    parent::__construct($model);
    $this->globalSettingService = $globalSettingService;
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param [Model] $user
   * @return Void
   */
  public function updateGlobalSetting(Request $request, $id) {
    $globalSetting = $this->globalSettingService->updateGlobalSetting($request);

    $get_global_setting = $this->model->findOrFail($id);

    return $get_global_setting->update($globalSetting);
  }

  public function createGlobalSetting(Request $request) {
    $globalSetting = $this->globalSettingService->insertGlobalSetting($request);

    return $this->model->create($globalSetting);
  }

  public function getAllGlobalSetting(){
      return $this->model->where('is_active', 1)->get();
  }


  public function getGlobalSettingById($id){
      return $this->model->find($id);
  }

  public function deleteGlobalSetting($id){
      return $this->getGlobalSettingById($id)->delete();
  }

  public function getGlobalSettingIdAndCode(){
      return $this->model->where('is_active', 1)->get()->pluck('id', 'setting_code');
  }
}
