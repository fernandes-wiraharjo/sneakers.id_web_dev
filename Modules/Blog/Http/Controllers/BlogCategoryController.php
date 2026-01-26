<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Repositories\BlogCategoryRepository;
use Modules\Blog\Entities\BlogCategoryDatatables;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\Blog\Entities\BlogCategory;
use Alert;

class BlogCategoryController extends Controller
{

    protected $repository;

    public function __construct(BlogCategoryRepository $repository) {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(BlogCategoryDatatables $dataTables)
    {
        ladmin()->allow('administrator.blog.category.index');

        return $dataTables->render('blog::blog-category.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.blog.category.create');
        $blogCategory = new BlogCategory();
        
        // Prefill sequence fields with latest + 1
        $blogCategory->sequence = $this->repository->getLatestSequence();
        $blogCategory->sequence_single_post = $this->repository->getLatestSequenceSinglePost();
        $blogCategory->sequence_search = $this->repository->getLatestSequenceSearch();
        
        $data['blogCategory'] = $blogCategory;

        return view('blog::blog-category.create', $data);
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
                'id' => 'required|unique:blog_categories,id|max:255',
                'name' => 'required|max:255',
                'sequence' => 'required|integer',
                'sequence_single_post' => 'required|integer',
                'sequence_search' => 'required|integer',
            ]);

            if($validator) {
                $stored = $this->repository->createBlogCategory($request);
                if($stored){
                    Alert::success('Blog Category Created Successfully!');
                    return redirect(route('administrator.blog.category.index'))
                        ->with('success', 'Blog Category Created Successfully!');
                } else {
                    Alert::error('Failed to create blog category, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to create blog category, check your info!');
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
        return view('blog::blog-category.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.blog.category.update');
        $data['blogCategory'] = $this->repository->getBlogCategoryById($id);
        return view('blog::blog-category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {
            $old_data = $this->repository->getBlogCategoryById($id);
            $data = $request->all();

            if($old_data->id == $data['id']){
                $validation = [
                    'id' => 'required|exists:blog_categories,id|max:255',
                    'name' => 'required|max:255',
                    'sequence' => 'required|integer',
                    'sequence_single_post' => 'required|integer',
                    'sequence_search' => 'required|integer',
                ];
            } else {
                $validation = [
                    'id' => 'required|unique:blog_categories,id|max:255',
                    'name' => 'required|max:255',
                    'sequence' => 'required|integer',
                    'sequence_single_post' => 'required|integer',
                    'sequence_search' => 'required|integer',
                ];
            }

            $validator = $request->validate($validation);

            if($validator) {
                $updated = $this->repository->updateBlogCategory($request, $id);
                if($updated){
                    Alert::success('Blog Category Updated Successfully!');
                    return redirect(route('administrator.blog.category.index'))
                        ->with('success', 'Blog Category Updated Successfully!');
                } else {
                    Alert::error('Failed to update blog category, check your info!');
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
     * @param string $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->repository->deleteBlogCategory($id);

            if($deleted){
                Alert::success('Blog Category Deleted Successfully!');
                return redirect(route('administrator.blog.category.index'))
                    ->with('success', 'Blog Category Deleted Successfully!');
            } else {
                Alert::error('Failed to delete blog category, check your info!');
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
    }
}

