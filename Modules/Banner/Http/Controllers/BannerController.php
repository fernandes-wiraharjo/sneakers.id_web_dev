<?php

namespace Modules\Banner\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Banner\Repositories\BannerRepository;
use Modules\Banner\Entities\BannerDatatables;
use GuzzleHttp\Psr7\UploadedFile;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\Banner\Entities\Banner;
use Alert;

class BannerController extends Controller
{
    protected $repository;

    public function __construct(BannerRepository $repository) {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(BannerDatatables $dataTables)
    {
        ladmin()->allow('administrator.master-data.banner.index');

        return $dataTables->render('banner::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.master-data.banner.create');
        $data['latest_order'] = $this->repository->getOrderBannerByOrderByLatest() + 1;
        $data['banner'] = new Banner();

        return view('banner::create', $data);
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
                'image' => 'mimes:jpeg,jpg,png,gif|required',
            ]);

            if($validator) {
                $stored = $this->repository->createBanner($request);

                if($stored){
                    Alert::success('Banner Created Successfully!');
                    return redirect(route('administrator.master-data.banner.index'))
                        ->with('success', 'Banner Created Successfully!');
                } else {
                    Alert::error('Failed to created banner, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to created banner, check your info!');
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
        return view('banner::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.banner.update');
        $data['banner'] = $this->repository->getBannerById($id);
        return view('banner::edit', $data);
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
            $old_data = $this->repository->getBannerById($id);
            $data = $request->all();
            if($old_data->order == $data['order']){
                $validator = $request->validate([
                    'order' => 'required|exists:banners,order',
                ]);
            } else {
                $validator = $request->validate([
                    'order' => 'required|unique:banners,order',
                ]);
            }

            if($validator) {
                $updated = $this->repository->updateBanner($request, $id);
                if($updated){
                    Alert::success('Banner Updated Successfully!');
                    return redirect(route('administrator.master-data.banner.index'))
                        ->with('success', 'Banner Updated Successfully!');
                } else {
                    Alert::error('Failed to updated banner, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to updated banner, check your info!');
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
            $deleted = $this->repository->deleteBanner($id);

            if($deleted){
                Alert::success('Banner Deleted Successfully!');
                return redirect(route('administrator.master-data.banner.index'))
                    ->with('success', 'Banner Deleted Successfully!');
            } else {
                Alert::error('Failed to delete banner, check your info!');
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
