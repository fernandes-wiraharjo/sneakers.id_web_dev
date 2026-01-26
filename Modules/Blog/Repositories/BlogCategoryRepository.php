<?php

namespace Modules\Blog\Repositories;

use Illuminate\Http\Request;
use Modules\Blog\Entities\BlogCategory;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\BlogCategoryService;

class BlogCategoryRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(BlogCategoryService $blogCategoryService, BlogCategory $model) {
    parent::__construct($model);
    $this->blogCategoryService = $blogCategoryService;
  }

  /**
   * Update blog category
   *
   * @param Request $request
   * @param string $id
   * @return Void
   */
  public function updateBlogCategory(Request $request, $id) {
    $get_blogCategory = $this->model->findOrFail($id);
    $oldData = $get_blogCategory->toArray();
    $newData = $request->all();
    
    // Resequence if sequence changed
    if(isset($newData['sequence']) && $oldData['sequence'] != $newData['sequence']) {
      $this->resequence('sequence', $oldData['sequence'], $newData['sequence'], $id);
    }
    
    // Resequence if sequence_single_post changed
    if(isset($newData['sequence_single_post']) && $oldData['sequence_single_post'] != $newData['sequence_single_post']) {
      $this->resequence('sequence_single_post', $oldData['sequence_single_post'], $newData['sequence_single_post'], $id);
    }
    
    // Resequence if sequence_search changed
    if(isset($newData['sequence_search']) && $oldData['sequence_search'] != $newData['sequence_search']) {
      $this->resequence('sequence_search', $oldData['sequence_search'], $newData['sequence_search'], $id);
    }
    
    $blogCategory = $this->blogCategoryService->updateBlogCategory($request);

    return $get_blogCategory->update($blogCategory);
  }

  /**
   * Resequence categories when sequence changes
   *
   * @param string $field The sequence field name
   * @param int $oldSequence The old sequence value
   * @param int $newSequence The new sequence value
   * @param string $excludeId The ID to exclude from resequencing
   * @return void
   */
  private function resequence($field, $oldSequence, $newSequence, $excludeId) {
    if($oldSequence < $newSequence) {
      // Moving to higher sequence: decrement items between old and new
      $this->model->where($field, '>', $oldSequence)
        ->where($field, '<=', $newSequence)
        ->where('id', '!=', $excludeId)
        ->decrement($field);
    } else {
      // Moving to lower sequence: increment items between new and old
      $this->model->where($field, '>=', $newSequence)
        ->where($field, '<', $oldSequence)
        ->where('id', '!=', $excludeId)
        ->increment($field);
    }
  }

  public function createBlogCategory(Request $request) {
    $data = $request->all();
    
    // Resequence if sequence already exists
    if(isset($data['sequence'])) {
      $this->model->where('sequence', '>=', $data['sequence'])->increment('sequence');
    }
    
    // Resequence if sequence_single_post already exists
    if(isset($data['sequence_single_post'])) {
      $this->model->where('sequence_single_post', '>=', $data['sequence_single_post'])->increment('sequence_single_post');
    }
    
    // Resequence if sequence_search already exists
    if(isset($data['sequence_search'])) {
      $this->model->where('sequence_search', '>=', $data['sequence_search'])->increment('sequence_search');
    }
    
    $blogCategory = $this->blogCategoryService->insertBlogCategory($request);

    return $this->model->create($blogCategory);
  }

  public function getBlogCategoryById($id){
      return $this->model->find($id);
  }

  public function deleteBlogCategory($id){
      return $this->getBlogCategoryById($id)->delete();
  }

  public function getLatestSequence(){
      $latest = $this->model->orderBy('sequence', 'DESC')->pluck('sequence')->first();
      return $latest ? $latest + 1 : 1;
  }

  public function getLatestSequenceSinglePost(){
      $latest = $this->model->orderBy('sequence_single_post', 'DESC')->pluck('sequence_single_post')->first();
      return $latest ? $latest + 1 : 1;
  }

  public function getLatestSequenceSearch(){
      $latest = $this->model->orderBy('sequence_search', 'DESC')->pluck('sequence_search')->first();
      return $latest ? $latest + 1 : 1;
  }
}

