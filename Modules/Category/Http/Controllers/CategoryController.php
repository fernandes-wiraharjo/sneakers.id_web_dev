<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Category\Entities\CategoryDatatables;
use GuzzleHttp\Psr7\UploadedFile;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\Category\Entities\Category;
use Illuminate\Support\Facades\Validator;
use Alert;
class CategoryController extends Controller
{

    protected $repository;

    public function __construct(CategoryRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(CategoryDatatables $dataTables)
    {
        ladmin()->allow('administrator.master-data.category.index');

        return $dataTables->render('category::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.master-data.category.create');
        $data['category'] = new Category();

        return view('category::create', $data);
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
                'category_code' => 'required|unique:categories|max:255',
            ]);

            if($validator) {
                $stored = $this->repository->createCategory($request);

                if($stored){
                    Alert::success('Category Created Successfully!');
                    return redirect(route('administrator.master-data.category.index'))
                        ->with('success', 'Category Created Successfully!');
                } else {
                    Alert::error('Failed to created category, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to created category, check your info!');
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
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.category.update');
        $data['category'] = $this->repository->getCategoryById($id);
        return view('category::edit', $data);
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
            $validator = $request->validate([
                'category_code' => 'exists|max:255',
            ]);

            if($validator) {
                $updated = $this->repository->updateCategory($request, $id);

                if($updated){
                    Alert::success('Category Updated Successfully!');
                    return redirect(route('administrator.master-data.category.index'))
                        ->with('success', 'Category Updated Successfully!');
                } else {
                    Alert::error('Failed to updated category, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to updated category, check your info!');
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
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->repository->deleteCategory($id);

            if($deleted){
                Alert::success('Category Deleted Successfully!');
                return redirect(route('administrator.master-data.category.index'))
                    ->with('success', 'Category Deleted Successfully!');
            } else {
                Alert::error("Failed to delete category <br> can't delete parent data!");
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
