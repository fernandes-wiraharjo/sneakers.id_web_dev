<?php

namespace Modules\TopTextCarousel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\TopTextCarousel\Entities\TopTextCarousel;
use Modules\TopTextCarousel\Repositories\TopTextCarouselRepository;
use Modules\TopTextCarousel\Entities\TopTextCarouselDatatables;
use Hexters\Ladmin\Exceptions\LadminException;
use Alert;

class TopTextCarouselController extends Controller
{
    protected $repository;

    public function __construct(TopTextCarouselRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(TopTextCarouselDatatables $dataTable)
    {
        ladmin()->allow('administrator.master-data.top-text-carousel.index');
        return $dataTable->render('toptextcarousel::index');
    }

    public function create()
    {
        ladmin()->allow('administrator.master-data.top-text-carousel.create');
        $data['topTextCarousel'] = new TopTextCarousel();
        return view('toptextcarousel::create', $data);
    }

    public function store(Request $request)
    {
        try {
            ladmin()->allow('administrator.master-data.top-text-carousel.create');
            $request->validate([
                'text' => 'required|string|max:500',
                'link' => 'nullable|string|max:500',
                'sort_order' => 'nullable|integer|min:0',
                'is_active' => 'nullable|boolean',
            ]);
            $data = $request->only(['text', 'link', 'sort_order', 'is_active']);
            $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
            $data['is_active'] = $request->boolean('is_active');
            $this->repository->create($data);
            Alert::success('Top Text Carousel created successfully!');
            return redirect()->route('administrator.master-data.top-text-carousel.index')
                ->with('success', 'Top Text Carousel created successfully!');
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.top-text-carousel.update');
        $data['topTextCarousel'] = $this->repository->getById($id);
        return view('toptextcarousel::edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            ladmin()->allow('administrator.master-data.top-text-carousel.update');
            $request->validate([
                'text' => 'required|string|max:500',
                'link' => 'nullable|string|max:500',
                'sort_order' => 'nullable|integer|min:0',
                'is_active' => 'nullable|boolean',
            ]);
            $data = $request->only(['text', 'link', 'sort_order', 'is_active']);
            $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
            $data['is_active'] = $request->boolean('is_active');
            $this->repository->update($id, $data);
            Alert::success('Top Text Carousel updated successfully!');
            return redirect()->route('administrator.master-data.top-text-carousel.index')
                ->with('success', 'Top Text Carousel updated successfully!');
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            ladmin()->allow('administrator.master-data.top-text-carousel.destroy');
            $this->repository->delete($id);
            Alert::success('Top Text Carousel deleted successfully!');
            return redirect()->route('administrator.master-data.top-text-carousel.index')
                ->with('success', 'Top Text Carousel deleted successfully!');
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }
}
