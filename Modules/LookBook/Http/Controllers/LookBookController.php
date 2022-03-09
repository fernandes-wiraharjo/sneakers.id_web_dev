<?php

namespace Modules\LookBook\Http\Controllers;

use App\Services\LookBookService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\LookBook\Repositories\LookBookRepository;
use Modules\LookBook\Entities\LookBookDatatables;
use GuzzleHttp\Psr7\UploadedFile;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\LookBook\Entities\LookBook;
use Alert;

class LookBookController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(LookBookRepository $repository, LookBookService $service) {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(LookBookDatatables $dataTables)
    {
        ladmin()->allow('administrator.master-data.lookbook.index');

        return $dataTables->render('lookbook::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.master-data.lookbook.create');
        $data['latest_order'] = $this->repository->getOrderLookBookByOrderByLatest() + 1;
        $data['lookbook'] = new LookBook();

        return view('lookbook::create', $data);
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
                'look_book_title' => 'required',
                'image' => 'required|max:10000',
                'look_book_order' => 'required|unique:look_books,look_book_order'
            ]);

            if($validator) {
                $stored = $this->repository->createLookBook($request);
                if($stored){
                    Alert::success('LookBook Created Successfully!');
                    return redirect(route('administrator.master-data.lookbook.index'))
                        ->with('success', 'LookBook Created Successfully!');
                } else {
                    Alert::error('Failed to created lookbook, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to created look book, check your info!');
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
        return view('lookbook::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.lookbook.update');
        $data['lookbook'] = $this->repository->getLookBookById($id);
        return view('lookbook::edit', $data);
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
            $updated = $this->repository->updateLookBook($id ,$request);
            if($updated){
                Alert::success('LookBook Updated Successfully!');
                return redirect(route('administrator.master-data.lookbook.index'))
                    ->with('success', 'LookBook Updated Successfully!');
            } else {
                Alert::error('Failed to updated lookbook, check your info!');
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
            $deleted = $this->repository->deleteLookBook($id);

            if($deleted){
                Alert::success('LookBook Deleted Successfully!');
                return redirect(route('administrator.master-data.lookbook.index'))
                    ->with('success', 'LookBook Deleted Successfully!');
            } else {
                Alert::error('Failed to delete lookbook, check your info!');
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
