<?php

namespace Modules\SignaturePlayer\Repositories;

use Illuminate\Http\Request;
use Modules\SignaturePlayer\Entities\SignaturePlayer;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\SignaturePlayerService;
use Illuminate\Support\Facades\File;

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
    $get_signaturePlayer = $this->model->findOrFail($id);
    $existingPath = 'images/signature/'.$get_signaturePlayer->signature_code.'/'.$get_signaturePlayer->signature_image;

    // Remove previous image if it exists
    if ($get_signaturePlayer->signature_image && File::exists(public_path($existingPath)) && $request['image'] != null) {
        File::delete(public_path($existingPath));
    }

    $signaturePlayer = $this->signaturePlayerService->updateSignaturePlayer($request, $id);

    return $get_signaturePlayer->update($signaturePlayer);
  }

  public function createSignaturePlayer(Request $request) {
    $signaturePlayer = $this->signaturePlayerService->insertSignaturePlayer($request);

    return $this->model->create($signaturePlayer);
  }

  public function getAllSignatures() {
      return $this->model->where('is_active', 1)->orderBy('signature_title', 'ASC')->get();
  }

  public function getSignaturePlayerById($id){
      return $this->model->find($id);
  }

  public function getSignatureByName($keyword){
    return $this->model
      ->where('signature_title', 'LIKE', '%'.$keyword.'%')
      ->where('signature_player_name', 'LIKE', '%'.$keyword.'%')
      ->where('signature_description', 'LIKE', '%'.$keyword.'%')
      ->get();
  }

  public function getOneSignatureByName($keyword){
    return $this->model
      ->where('signature_title', 'LIKE', '%'.$keyword.'%')
      ->where('signature_player_name', 'LIKE', '%'.$keyword.'%')
      ->where('signature_description', 'LIKE', '%'.$keyword.'%')
      ->first();
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
      return $this->model->where('is_active', 1)->select(
          'id as value',
          'signature_code as code',
          'signature_player_name as title'
          )->get();
  }
}
