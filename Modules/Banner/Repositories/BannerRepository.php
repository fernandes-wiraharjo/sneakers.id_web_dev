<?php

namespace Modules\Banner\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
    $data = $request->all();
    $get_banner = $this->model->findOrFail($id);

    if($get_banner->order != $data['order']){
        $existing_banner_order = $this->getBannerBySameOrderNumber($data['order']);

        if($existing_banner_order){
            foreach($existing_banner_order as $item) {
                $this->model->where('id', $item->id)->update(['is_active' => 0]);
            }
        }
    }

    return $get_banner->update($banner);
  }

  public function createBanner(Request $request) {
    $banner = $this->bannerService->insertBanner($request);
    $data = $request->all();
    if(intval($data['is_active'])){
        $same_number_banner = $this->getBannerBySameOrderNumber($data['order']);
        if($same_number_banner->count() > 5) {
            foreach($same_number_banner as $item) {
                $this->model->where('id', $item->id)->update(['is_active' => 0]);
            }
        }
    }
    return $this->model->create($banner);
  }

  public function getBannerById($id){
      return $this->model->findOrFail($id);
  }

  public function getBannerByOrderNumber($number){
      return $this->model->where('order', $number)->first();
  }

  public function getBannerBySameOrderNumber($number){
    return $this->model->where('order', $number)->get();
  }

  public function getOrderBannerByOrderByLatest(){
      return $this->model->orderBy('order', 'DESC')->pluck('order')->first();
  }

  public function deleteBanner($id){
    $banner = $this->getBannerById($id);
    $image_path = public_path("/images/banner/".$banner->banner_image);
    // Value is not URL but directory file path
    if(File::exists($image_path)) {
        File::delete($image_path);
    }
    return $this->getBannerById($id)->delete();
  }

  public function getBannerOrdered($limit = 5, $offset = 0){
      return $this->model->where('is_active', 1)
        ->offset($offset)
        ->limit($limit)
        ->orderBy('order','ASC')
        ->get();
  }
}
