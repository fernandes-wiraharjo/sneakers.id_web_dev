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
    $headerImage = $this->headerImageService->updateHeaderImage($request, $id);

    $get_header_image = $this->model->findOrFail($id);
    $get_header_image->fill($headerImage);
    $get_header_image->save();

    return true;
  }

  public function createHeaderImage(Request $request) {
    $existing = $this->model
      ->where('menu_parent_name', $request->menu_parent_name)
      ->where('menu_name', $request->menu_name)
      ->first();

    // Unique (menu_parent_name, menu_name) — update existing instead of duplicate insert
    if ($existing) {
      return $this->updateHeaderImage($request, $existing->id);
    }

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

  public function getHeaderImageByParentAndName($menuParentName, $menuName){
    return $this->model
      ->where('menu_parent_name', $menuParentName)
      ->where('menu_name', $menuName)
      ->first();
  }
}
