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
            $this->repository->createBanner($request);
            session()->flash('success', [
                'Banner has been created sucessfully'
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
            $this->repository->updateBanner($request, $id);
            session()->flash('success', [
                'Banner has been updated sucessfully'
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
            $deleted = $this->repository->deleteBanner($id);

            if($deleted) {
                session()->flash('success', [
                    'Banner has been deleted sucessfully'
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
