<?php

namespace Modules\HeaderImage\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HeaderImage\Repositories\HeaderImageRepository;
use Modules\HeaderImage\Entities\HeaderImageDatatables;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\HeaderImage\Entities\HeaderImage;
use Alert;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\SignaturePlayer\Entities\SignaturePlayer;

class HeaderImageController extends Controller
{

    protected $repository;

    public function __construct(HeaderImageRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(HeaderImageDatatables $dataTables)
    {
        ladmin()->allow('administrator.master-data.header-image.index');

        return $dataTables->render('headerimage::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.master-data.header-image.create');
        $data['header_image'] = new HeaderImage();
        $data['brands'] = Brand::all();
        $data['categories'] = Category::all();
        $data['signatures'] = SignaturePlayer::orderBy('signature_title', 'ASC')->get();

        return view('headerimage::create', $data);
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
            'menu_parent_name' => 'required|string',
            'menu_name' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        $stored = $this->repository->createHeaderImage($request);

        if ($stored) {
            Alert::success('Header Image Created Successfully!');
            return redirect(route('administrator.master-data.header-image.index'));
        } else {
            Alert::error('Failed to create header image, check your info!');
            return redirect()->back();
        }
    } catch (LadminException $e) {
        Alert::error($e->getMessage());
        return redirect()->back()->withErrors([$e->getMessage()]);
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
        ladmin()->allow('administrator.master-data.header-image.update');
        $data['header_image'] = $this->repository->getHeaderImageById($id);
        $data['brands'] = Brand::all();
        $data['categories'] = Category::all();
        $data['signatures'] = SignaturePlayer::orderBy('signature_title', 'ASC')->get();
        return view('headerimage::edit', $data);
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
            $validation = [
                 'menu_parent_name' => 'required|string',
                 'menu_name' => 'required|string',
                 'image' => 'nullable|image|max:2048',
            ];

            $validator = $request->validate($validation);

            $updated = $this->repository->updateHeaderImage($request, $id);

            if ($updated) {
                Alert::success('Header Image Updated Successfully!');
                return redirect(route('administrator.master-data.header-image.index'));
            } else {
                Alert::error('Failed to update header image, check your info!');
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
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
            $deleted = $this->repository->deleteHeaderImage($id);

            if ($deleted) {
                Alert::success('Header Image Deleted Successfully!');
                return redirect(route('administrator.master-data.header-image.index'));
            } else {
                Alert::error("Failed to delete header image");
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

}
