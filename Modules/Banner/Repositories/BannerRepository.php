<?php

namespace Modules\Banner\Repositories;

use Illuminate\Http\Request;
use Modules\Banner\Entities\Banner;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\BannerService;

class BannerRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(BannerService $bannerService, Banner $model) {
    parent::__construct($model);
    $this->bannerService = $bannerService;
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param [Model] $user
   * @return Void
   */
  public function updateBanner(Request $request, $id) {
    $banner = $this->bannerService->updateBanner($request);

    $get_banner = $this->model->findOrFail($id);
    $get_banner->update($banner);
  }

  public function createBanner(Request $request) {
    $banner = $this->bannerService->insertBanner($request);

    $this->model->create($banner);
  }

  public function getBannerById($id){
      return $this->model->findOrFail($id);
  }

  public function deleteBanner($id){
      return $this->getBannerById($id)->delete();
  }
}
