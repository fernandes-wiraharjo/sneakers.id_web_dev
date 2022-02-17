<?php

namespace Modules\LookBook\Repositories;

use Illuminate\Http\Request;
use Modules\LookBook\Entities\LookBook;
use Modules\LookBook\Entities\LookBookImages;
use Modules\LookBook\Entities\LookBookCard;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;

class LookBookRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(
      //LookBookService $lookbookService,
      LookBook $model,
      LookBookImages $lookbookImage,
      LookBookCard $lookbookCard) {
    parent::__construct($model);
    //$this->lookbookService = $lookbookService;
    $this->lookbookImage = $lookbookImage;
    $this->lookbookCard = $lookbookCard;
  }

  public function createLookBook($data) {
    return $this->model->create($data);
  }

  public function insertLookBookImage($data){
    return $this->lookbookImage->create($data);
  }

  public function insertLookBookCard($data){
    return $this->lookbookCard->create($data);
  }

  public function getLookBookById($id){
      return $this->model->findOrFail($id);
  }

  public function deleteLookBookImage($id){
    return $this->model->find($id)->images()->delete();
  }

  public function deleteLookBookCard($id){
    return $this->model->find($id)->cards()->delete();
  }

  public function deleteLookBook($id){
    $lookbook = $this->model->find($id);

    $lookbook->images()->delete();
    $lookbook->cards()->delete();

    return $lookbook->delete();
}
}
