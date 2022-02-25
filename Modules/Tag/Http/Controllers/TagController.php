<?php

namespace Modules\Tag\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Tag\Repositories\TagRepository;
use Modules\Tag\Entities\TagDatatables;
use GuzzleHttp\Psr7\UploadedFile;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\Tag\Entities\Tag;
use Alert;

class TagController extends Controller
{
    protected $repository;

    public function __construct(TagRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(TagDatatables $dataTables)
    {
        ladmin()->allow('administrator.master-data.tag.index');

        return $dataTables->render('tag::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.master-data.tag.create');
        $data['tag'] = new Tag();

        return view('tag::create', $data);
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
                'tag_code' => 'required|unique:tags|max:255',
            ]);

            if($validator) {
                $stored = $this->repository->createTag($request);
                if($stored){
                    Alert::success('Tag Created Successfully!');
                    return redirect(route('administrator.master-data.tag.index'))
                        ->with('success', 'Tag Created Successfully!');
                } else {
                    Alert::error('Failed to created tag, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to created tag, check your info!');
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
        return view('tag::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.tag.update');
        $data['tag'] = $this->repository->getTagById($id);
        return view('tag::edit', $data);
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
            $updated = $this->repository->updateTag($request, $id);
            if($updated){
                Alert::success('Tag Updated Successfully!');
                return redirect(route('administrator.master-data.tag.index'))
                    ->with('success', 'Tag Updated Successfully!');
            } else {
                Alert::error('Failed to updated tag, check your info!');
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
            $deleted = $this->repository->deleteTag($id);

            if($deleted){
                Alert::success('Tag Deleted Successfully!');
                return redirect(route('administrator.master-data.tag.index'))
                    ->with('success', 'Tag Deleted Successfully!');
            } else {
                Alert::error("Failed to delete tag <br> can't delete parent data!");
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
