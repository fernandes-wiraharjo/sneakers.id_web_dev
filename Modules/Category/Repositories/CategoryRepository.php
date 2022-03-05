<?php

namespace Modules\Category\Repositories;

use Illuminate\Http\Request;
use Modules\Category\Entities\Category;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\CategoryService;

class CategoryRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(CategoryService $categoryService, Category $model) {
    parent::__construct($model);
    $this->categoryService = $categoryService;
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param [Model] $user
   * @return Void
   */
  public function updateCategory(Request $request, $id) {
    $category = $this->categoryService->updateCategory($request);

    $get_category = $this->model->findOrFail($id);
    $data = $request->all();
    if($data['category_code'] != $get_category->category_code){

      $updated = $get_category->update([
        'is_active' => false
      ]);

      if($updated){
        $category['is_active'] = $data['is_active'];

        return $this->model->create($category);
      }
    }
    return $get_category->update($category);
  }

  public function createCategory(Request $request) {
    $category = $this->categoryService->insertCategory($request);

    return $this->model->create($category);
  }

  public function getCategoryById($id){
      return $this->model->findOrFail($id);
  }

  public function deleteCategory($id){
      $category = $this->getCategoryById($id);

      if($category->products()->count() > 0) {
        return false;
      } else {
        return $category->delete();
      }
  }

  public function getAllCategories() {
      return $this->model->get();
  }

  public function getCategoryIdAndNameLivewire(){
      return $this->model->where('is_active', 1)->select('id', 'category_title as value')->get();
  }
}
