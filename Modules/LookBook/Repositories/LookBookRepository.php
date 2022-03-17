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
    $data = $request->all();

    $get_lookbook = $this->model->find($id);
    if($get_lookbook->look_book_order != $data['look_book_order']){
        $existing_lookbook_order = $this->getLookBookByPageNumber($data['look_book_order']);

        if($existing_lookbook_order){
            $existing_lookbook_order->update(['is_active' => 0]);
        }
    }

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

  public function getAllLookBookPaginate($count = 20){
    return $this->model->where('is_active', 1)->orderBy('look_book_order', 'ASC')->paginate($count);
}

  public function getLookBookById($id){
      return $this->model->find($id);
  }

  public function deleteLookBook($id){
    $lookbook = $this->getLookBookById($id);

    $image_path = public_path("/images/lookbook/".$lookbook->look_book_image);
    // Value is not URL but directory file path
    if(File::exists($image_path)) {
        File::delete($image_path);
    }

    return $lookbook->delete();
  }
}
