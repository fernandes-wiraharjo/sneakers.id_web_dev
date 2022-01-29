<?php

namespace Modules\Brand\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Brand\Repositories\BrandRepository;
use Modules\Brand\Entities\BrandDatatables;
use GuzzleHttp\Psr7\UploadedFile;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\Brand\Entities\Brand;

class BrandController extends Controller
{

    protected $repository;

    public function __construct(BrandRepository $repository) {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(BrandDatatables $dataTables)
    {
        ladmin()->allow('administrator.master-data.brand.index');

        return $dataTables->render('brand::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.master-data.brand.create');
        $data['brand'] = new Brand();

        return view('brand::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $this->repository->createBrand($request);
            session()->flash('success', [
                'Brand has been created sucessfully'
            ]);
            return redirect()->back();
        } catch (LadminException $e) {
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
        return view('brand::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.brand.update');
        $data['brand'] = $this->repository->getBrandById($id);
        return view('brand::edit', $data);
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
            $this->repository->updateBrand($request, $id);
            session()->flash('success', [
                'Brand has been updated sucessfully'
            ]);
            return redirect()->back();
        } catch (LadminException $e) {
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
            $deleted = $this->repository->deleteBrand($id);

            if($deleted) {
                session()->flash('success', [
                    'Brand has been deleted sucessfully'
                ]);
                return redirect()->back();
            }
        } catch (LadminException $e) {
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
    }
}
