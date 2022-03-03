<?php

namespace Modules\Faq\Repositories;

use Illuminate\Http\Request;
use Modules\Faq\Entities\Faq;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\FaqService;

class FaqRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(FaqService $faqService, Faq $model) {
    parent::__construct($model);
    $this->faqService = $faqService;
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param [Model] $user
   * @return Void
   */
  public function updateFaq(Request $request, $id) {
    $faq = $this->faqService->updateFaq($request);

    $get_faq = $this->model->findOrFail($id);
    return $get_faq->update($faq);
  }

  public function createFaq(Request $request) {
    $faq = $this->faqService->insertFaq($request);

    return $this->model->create($faq);
  }

  public function getFaqById($id){
      return $this->model->findOrFail($id);
  }

  public function deleteFaq($id){
      return $this->getFaqById($id)->delete();
  }
}
