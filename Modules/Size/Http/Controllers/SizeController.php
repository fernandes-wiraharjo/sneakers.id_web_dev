<?php

namespace Modules\Size\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Size\Repositories\SizeRepository;
use Modules\Size\Entities\SizeDatatables;
use GuzzleHttp\Psr7\UploadedFile;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\Size\Entities\Size;
use Alert;

class SizeController extends Controller
{

    protected $repository;

    public function __construct(SizeRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(SizeDatatables $dataTables)
    {
        ladmin()->allow('administrator.master-data.size.index');

        return $dataTables->render('size::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.master-data.size.create');
        $data['size'] = new Size();

        return view('size::create', $data);
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
                'size_code' => 'required|unique:sizes|max:255',
            ]);

            if($validator) {
                $stored = $this->repository->createSize($request);
                if($stored){
                    Alert::success('Size Created Successfully!');
                    return redirect(route('administrator.master-data.size.index'))
                        ->with('success', 'Size Created Successfully!');
                } else {
                    Alert::error('Failed to created size, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to created size, check your info!');
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
        return view('size::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.size.update');
        $data['size'] = $this->repository->getSizeById($id);
        return view('size::edit', $data);
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
            $updated = $this->repository->updateSize($request, $id);
            if($updated){
                Alert::success('Size Updated Successfully!');
                return redirect(route('administrator.master-data.size.index'))
                    ->with('success', 'Size Updated Successfully!');
            } else {
                Alert::error('Failed to updated size, check your info!');
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
            $deleted = $this->repository->deleteSize($id);

            if($deleted){
                Alert::success('Size Deleted Successfully!');
                return redirect(route('administrator.master-data.size.index'))
                    ->with('success', 'Size Deleted Successfully!');
            } else {
                Alert::error('Failed to delete size, check your info!');
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
