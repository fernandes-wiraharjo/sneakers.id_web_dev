<?php

namespace Modules\SignaturePlayer\Repositories;

use Illuminate\Http\Request;
use Modules\SignaturePlayer\Entities\SignaturePlayer;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\SignaturePlayerService;

class SignaturePlayerRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(SignaturePlayerService $signaturePlayerService, SignaturePlayer $model) {
    parent::__construct($model);
    $this->signaturePlayerService = $signaturePlayerService;
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param [Model] $user
   * @return Void
   */
  public function updateSignaturePlayer(Request $request, $id) {
    $signaturePlayer = $this->signaturePlayerService->updateSignaturePlayer($request);

    $get_signaturePlayer = $this->model->findOrFail($id);
    $data = $request->all();
    if($data['signature_code'] != $get_signaturePlayer->signature_code){

      $updated = $get_signaturePlayer->update([
        'is_active' => false
      ]);

      if($updated){
        $signaturePlayer['is_active'] = $data['is_active'];

        return $this->model->create($signaturePlayer);
      }
    }
    return $get_signaturePlayer->update($signaturePlayer);
  }

  public function createSignaturePlayer(Request $request) {
    $signaturePlayer = $this->signaturePlayerService->insertSignaturePlayer($request);

    return $this->model->create($signaturePlayer);
  }

  public function getAllSignatures() {
      return $this->model->get();
  }

  public function getSignaturePlayerById($id){
      return $this->model->findOrFail($id);
  }

  public function deleteSignaturePlayer($id){
      $signature = $this->getSignaturePlayerById($id);

    if($signature->products()->count() > 0){
        return false;
    } else {
        return $signature->delete();
    }
  }

  public function getSignatureTag(){
      return $this->model->select(
          'id as value',
          'signature_code as code',
          'signature_player_name as title',
          'signature_image as image'
          )->get();
  }
}
