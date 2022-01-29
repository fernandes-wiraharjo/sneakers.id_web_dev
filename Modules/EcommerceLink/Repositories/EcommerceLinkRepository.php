<?php

namespace Modules\EcommerceLink\Repositories;

use Illuminate\Http\Request;
use Modules\EcommerceLink\Entities\EcommerceLink;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\EcommerceLinkService;

class EcommerceLinkRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(EcommerceLinkService $ecommerceLinkService, EcommerceLink $model) {
    parent::__construct($model);
    $this->ecommerceLinkService = $ecommerceLinkService;
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param [Model] $user
   * @return Void
   */
  public function updateEcommerceLink(Request $request, $id) {
    $ecommerceLink = $this->ecommerceLinkService->updateEcommerceLink($request);

    $get_ecommerceLink = $this->model->findOrFail($id);
    $get_ecommerceLink->update($ecommerceLink);
  }

  public function createEcommerceLink(Request $request) {
    $ecommerceLink = $this->ecommerceLinkService->insertEcommerceLink($request);

    $this->model->create($ecommerceLink);
  }

  public function getEcommerceLinkById($id){
      return $this->model->findOrFail($id);
  }

  public function deleteEcommerceLink($id){
      return $this->getEcommerceLinkById($id)->delete();
  }
}
