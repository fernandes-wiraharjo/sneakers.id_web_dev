<?php

namespace Modules\Faq\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Faq\Repositories\FaqRepository;
use Modules\Faq\Entities\FaqDatatables;
use GuzzleHttp\Psr7\UploadedFile;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\Faq\Entities\Faq;
use Alert;

class FaqController extends Controller
{
    protected $repository;

    public function __construct(FaqRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(FaqDatatables $dataTables)
    {
        ladmin()->allow('administrator.master-data.faq.index');

        return $dataTables->render('faq::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.master-data.faq.create');
        $data['faq'] = new Faq();

        return view('faq::create', $data);
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
                'faq_title' => 'required',
                'faq_question' => 'required',
                'faq_answer' => 'required',
            ]);

            if($validator) {
                $stored = $this->repository->createFaq($request);

                if($stored){
                    Alert::success('FAQ Created Successfully!');
                    return redirect(route('administrator.master-data.faq.index'))
                        ->with('success', 'FAQ Created Successfully!');
                } else {
                    Alert::error('Failed to created faq, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to created faq, check your info!');
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
        return view('faq::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.faq.update');
        $data['faq'] = $this->repository->getFaqById($id);
        return view('faq::edit', $data);
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
            $updated = $this->repository->updateFaq($request, $id);
            if($updated){
                Alert::success('FAQ Updated Successfully!');
                return redirect(route('administrator.master-data.faq.index'))
                    ->with('success', 'FAQ Updated Successfully!');
            } else {
                Alert::error('Failed to updated faq, check your info!');
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
            $deleted = $this->repository->deleteFaq($id);

            if($deleted){
                Alert::success('FAQ Deleted Successfully!');
                return redirect(route('administrator.master-data.faq.index'))
                    ->with('success', 'FAQ Deleted Successfully!');
            } else {
                Alert::error('Failed to delete faq, check your info!');
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
