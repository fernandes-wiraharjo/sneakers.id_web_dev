<?php

namespace Modules\LookBook\Repositories;

use Illuminate\Http\Request;
use Modules\LookBook\Entities\LookBook;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\LookBookService;

class LookBookRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(LookBookService $lookbookService, LookBook $model) {
    parent::__construct($model);
    $this->lookbookService = $lookbookService;
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param [Model] $user
   * @return Void
   */
  public function updateLookBook($id, Request $request) {
    $lookbook = $this->lookbookService->updateLookBook($id, $request);

    $get_lookbook = $this->model->find($id);
    return $get_lookbook->update($lookbook);
  }

  public function createLookBook(Request $request) {
    $lookbook = $this->lookbookService->insertLookBook($request);

    return $this->model->create($lookbook);
  }

  public function getNextLookBook($page){
    return $this->model->where('look_book_order', '>', $page)->min('look_book_order');
  }

  public function getPrevLookBook($page){
    return $this->model->where('look_book_order', '<', $page)->max('look_book_order');
  }

  public function getLookBookByPageNumber($page){
    return $this->model->where('look_book_order', $page)->first();
  }

  public function getOrderLookBookByOrderByLatest(){
    return $this->model->orderBy('look_book_order', 'DESC')->pluck('look_book_order')->first();
  }

  public function getAllLookBook(){
      return $this->model->where('is_active', 1)->orderBy('look_book_order', 'ASC')->get();
  }

  public function getLookBookById($id){
      return $this->model->find($id);
  }

  public function deleteLookBook($id){
      return $this->getLookBookById($id)->delete();
  }
}
