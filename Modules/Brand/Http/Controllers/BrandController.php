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
use Alert;

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
            $validator = $request->validate([
                'brand_code' => 'required|unique:brands|max:255',
                'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000|dimensions:min_width=500,max_width=1500,ratio=1/1',
                'is_menu' => 'brandmenu'
            ], [
                //'is_menu.brandmenu' => 'Brand menu cannot more than 3 actived!',
                'image.dimensions' => 'Brand image must be more than 500p, below 1500p and aspect ratio 1:1!'
            ]);

            if($validator) {
                $stored = $this->repository->createBrand($request);
                if($stored){
                    Alert::success('Brand Created Successfully!');
                    return redirect(route('administrator.master-data.brand.index'))
                        ->with('success', 'Brand Created Successfully!');
                } else {
                    Alert::error('Failed to created brand, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to created brand, check your info!');
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
            $old_data = $this->repository->getBrandById($id);
            $data = $request->all();

            if($old_data->brand_code == $data['brand_code']){
                $validation = [
                    'brand_code' => 'required|exists:brands,brand_code|max:255',
                    'image' => 'mimes:jpeg,jpg,png,gif|max:10000|dimensions:min_width=500,max_width=1500,ratio=1/1',
                ];
            } else {
                $validation = [
                    'brand_code' => 'required|unique:brands,brand_code|max:255',
                    'image' => 'mimes:jpeg,jpg,png,gif|max:10000|dimensions:min_width=500,max_width=1500,ratio=1/1',
                    'is_menu' => 'brandmenu'
                ];
            }

            $message = [
                //'is_menu.brandmenu' => 'Brand menu cannot more than 3 actived!',
                'image.dimensions' => 'Brand image must be more than 500p, below 1500p and aspect ratio 1:1!'
            ];

            $validator = $request->validate($validation, $message);

            if($validator) {
                $updated = $this->repository->updateBrand($request, $id);
                if($updated){
                    Alert::success('Brand Updated Successfully!');
                    return redirect(route('administrator.master-data.brand.index'))
                        ->with('success', 'Brand Updated Successfully!');
                } else {
                    Alert::error('Failed to updated brand, check your info!');
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
            $deleted = $this->repository->deleteBrand($id);

            if($deleted){
                Alert::success('Brand Deleted Successfully!');
                return redirect(route('administrator.master-data.brand.index'))
                    ->with('success', 'Brand Deleted Successfully!');
            } else {
                Alert::error('Failed to delete brand, check your info!');
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
