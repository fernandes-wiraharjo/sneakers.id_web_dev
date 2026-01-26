<?php

namespace Modules\Blog\Repositories;

use Illuminate\Http\Request;
use Modules\Blog\Entities\Blog;
use Hexters\Ladmin\Contracts\MasterRepositoryInterface;
use App\Repositories\Repository;
use App\Services\BlogArticleService;

class BlogArticleRepository extends Repository implements MasterRepositoryInterface {

  public function __construct(BlogArticleService $blogArticleService, Blog $model) {
    parent::__construct($model);
    $this->blogArticleService = $blogArticleService;
  }

  /**
   * Update blog article
   *
   * @param Request $request
   * @param int $id
   * @return Void
   */
  public function updateBlogArticle(Request $request, $id) {
    $blogArticle = $this->blogArticleService->updateBlogArticle($request);

    $get_blogArticle = $this->model->findOrFail($id);

    return $get_blogArticle->update($blogArticle);
  }

  public function createBlogArticle(Request $request) {
    $blogArticle = $this->blogArticleService->insertBlogArticle($request);

    return $this->model->create($blogArticle);
  }

  public function getBlogArticleById($id){
      return $this->model->with('category')->find($id);
  }

  public function deleteBlogArticle($id){
      return $this->getBlogArticleById($id)->delete();
  }
}

