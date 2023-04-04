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

    return $get_category->update($category);
  }

  public function createCategory(Request $request) {
    $category = $this->categoryService->insertCategory($request);

    return $this->model->create($category);
  }

  public function getCategoryById($id){
      return $this->model->find($id);
  }

  public function deleteCategory($id){
      $category = $this->getCategoryById($id);

      if($category->products()->count() > 0) {
        return false;
      } else {
        return $category->delete();
      }
  }

  public function getCategoryByName($keyword){
    return $this->model
      ->where('category_code', 'LIKE', '%'.$keyword.'%')
      ->orWhere('category_title', 'LIKE', '%'.$keyword.'%')
      ->orWhere('category_description', 'LIKE', '%'.$keyword.'%')
      ->first();
  }

  public function getCategoryByCode($keywordList = []){
    return $this->model
      ->whereIn('category_code', $keywordList)
      ->get();
  }

  public function getAllCategories() {
      return $this->model->where('is_active', 1)->get();
  }

  public function getAllCategoriesExceptGender() {
    return $this->model->whereNotIn('category_code', ['MENS', 'WOMENS', 'KIDS', 'GRADE_SCHOOL', 'PRESCHOOL', 'TODDLER', 'INFANT'])->where('is_active', 1)->get();
  }

  public function getCategoryIdAndNameLivewire(){
      return $this->model->where('is_active', 1)->select('id', 'category_title as value')->get();
  }
}
