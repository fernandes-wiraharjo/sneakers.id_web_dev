<?php

namespace Modules\HeaderImage\Repositories;

use Illuminate\Http\Request;
use Modules\HeaderImage\Entities\HeaderImage;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\HeaderImageService;

class HeaderImageRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(HeaderImageService $headerImageService, HeaderImage $model) {
    parent::__construct($model);
    $this->headerImageService = $headerImageService;
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param [Model] $user
   * @return Void
   */
  public function updateHeaderImage(Request $request, $id) {
    $headerImage = $this->headerImageService->updateHeaderImage($request);

    $get_header_image = $this->model->findOrFail($id);

    return $get_header_image->update($headerImage);
  }

  public function createHeaderImage(Request $request) {
    $headerImage = $this->headerImageService->insertHeaderImage($request);

    return $this->model->create($headerImage);
  }

  public function getHeaderImageById($id){
      return $this->model->find($id);
  }

  public function deleteHeaderImage($id){
      $headerImage = $this->getHeaderImageById($id);
      return $headerImage->delete();
  }

  public function getHeaderImageByName($keyword){
    return $this->model
      ->where('menu_name', 'LIKE', '%'.$keyword.'%')
      ->orWhere('menu_parent_name', 'LIKE', '%'.$keyword.'%')
      ->first();
  }
}
