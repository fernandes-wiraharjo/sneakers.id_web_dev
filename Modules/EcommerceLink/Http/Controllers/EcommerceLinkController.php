<?php

namespace Modules\EcommerceLink\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\EcommerceLink\Repositories\EcommerceLinkRepository;
use Modules\EcommerceLink\Entities\EcommerceLinkDatatables;
use GuzzleHttp\Psr7\UploadedFile;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\EcommerceLink\Entities\EcommerceLink;

class EcommerceLinkController extends Controller
{
    protected $repository;

    public function __construct(EcommerceLinkRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        ladmin()->allow('administrator.master-data.ecommerce-link.index');

        return EcommerceLinkDataTables::view('ecommercelink::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.master-data.ecommerce-link.create');
        $data['ecommerce'] = new EcommerceLink();

        return view('ecommercelink::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $this->repository->createEcommerceLink($request);
            session()->flash('success', [
                'EcommerceLink has been created sucessfully'
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
        return view('ecommercelink::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.ecommerce-link.update');
        $data['ecommerce'] = $this->repository->getEcommerceLinkById($id);
        return view('ecommercelink::edit', $data);
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
            $this->repository->updateEcommerceLink($request, $id);
            session()->flash('success', [
                'EcommerceLink has been updated sucessfully'
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
            $deleted = $this->repository->deleteEcommerceLink($id);

            if($deleted) {
                session()->flash('success', [
                    'EcommerceLink has been deleted sucessfully'
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
