<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Repositories\BlogArticleRepository;
use Modules\Blog\Repositories\BlogCategoryRepository;
use Modules\Blog\Entities\BlogArticleDatatables;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\Blog\Entities\Blog;
use Alert;

class BlogArticleController extends Controller
{

    protected $repository;
    protected $categoryRepository;

    public function __construct(BlogArticleRepository $repository, BlogCategoryRepository $categoryRepository) {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(BlogArticleDatatables $dataTables)
    {
        ladmin()->allow('administrator.blog.article.index');

        return $dataTables->render('blog::blog-article.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.blog.article.create');
        $blogArticle = new Blog();
        $blogArticle->author = auth()->user()->name;
        $data['blogArticle'] = $blogArticle;
        $data['categories'] = $this->categoryRepository->getModel()->orderBy('name')->get();

        return view('blog::blog-article.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $validator = $request->validate([
                'title' => 'required|max:255',
                'slug' => 'nullable|unique:blog,slug|max:255',
                'category_id' => 'nullable|exists:blog_categories,id',
                'content' => 'required',
                'featured_image' => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:10000',
                'author' => 'nullable|max:255',
            ]);

            if($validator) {
                $stored = $this->repository->createBlogArticle($request);
                if($stored){
                    Alert::success('Blog Article Created Successfully!');
                    return redirect(route('administrator.blog.article.index'))
                        ->with('success', 'Blog Article Created Successfully!');
                } else {
                    Alert::error('Failed to create blog article, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to create blog article, check your info!');
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('blog::blog-article.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.blog.article.update');
        $data['blogArticle'] = $this->repository->getBlogArticleById($id);
        $data['categories'] = $this->categoryRepository->getModel()->orderBy('name')->get();
        return view('blog::blog-article.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {
            $old_data = $this->repository->getBlogArticleById($id);
            $data = $request->all();

            if($old_data->slug == $data['slug']){
                $validation = [
                    'title' => 'required|max:255',
                    'slug' => 'required|exists:blog,slug|max:255',
                    'category_id' => 'nullable|exists:blog_categories,id',
                    'content' => 'required',
                    'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10000',
                    'author' => 'nullable|max:255',
                ];
            } else {
                $validation = [
                    'title' => 'required|max:255',
                    'slug' => 'required|unique:blog,slug|max:255',
                    'category_id' => 'nullable|exists:blog_categories,id',
                    'content' => 'required',
                    'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10000',
                    'author' => 'nullable|max:255',
                ];
            }

            $validator = $request->validate($validation);

            if($validator) {
                $updated = $this->repository->updateBlogArticle($request, $id);
                if($updated){
                    Alert::success('Blog Article Updated Successfully!');
                    return redirect(route('administrator.blog.article.index'))
                        ->with('success', 'Blog Article Updated Successfully!');
                } else {
                    Alert::error('Failed to update blog article, check your info!');
                    return redirect()->back();
                }
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->repository->deleteBlogArticle($id);

            if($deleted){
                Alert::success('Blog Article Deleted Successfully!');
                return redirect(route('administrator.blog.article.index'))
                    ->with('success', 'Blog Article Deleted Successfully!');
            } else {
                Alert::error('Failed to delete blog article, check your info!');
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
    }

    /**
     * Upload image from Summernote editor
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:10000',
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = 'images/blog/content';
                $saveAsFilename = 'content_' . time() . '_' . uniqid();
                $imageUrl = uploadAsWebp($file, $path, 'public', 1200, null, $saveAsFilename, 'resize');

                return response()->json([
                    'url' => $imageUrl
                ]);
            }

            return response()->json([
                'error' => 'No image file provided'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

