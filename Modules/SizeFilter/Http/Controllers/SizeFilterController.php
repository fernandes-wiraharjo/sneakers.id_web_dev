<?php

namespace Modules\SizeFilter\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SizeFilter\Entities\SizeFilter;
use Modules\SizeFilter\Entities\SizeFilterDatatables;
use Modules\Size\Entities\Size;
use Alert;

class SizeFilterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(SizeFilterDatatables $dataTables)
    {
        ladmin()->allow('administrator.master-data.size-filter.index');

        return $dataTables->render('sizefilter::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.master-data.size-filter.create');
        
        $data['sizeFilter'] = new SizeFilter();
        $data['sizes'] = Size::with(['mens', 'womens', 'kids'])
            ->orderBy('id')
            ->get();

        return view('sizefilter::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        ladmin()->allow('administrator.master-data.size-filter.create');

        $request->validate([
            'filter_label' => 'required|string|max:255|unique:size_filters,filter_label',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'exists:sizes,id',
        ]);

        try {
            $sizeFilter = SizeFilter::create([
                'filter_label' => $request->filter_label,
                'sort_order' => $request->sort_order,
                'is_active' => $request->is_active,
            ]);

            // Attach selected sizes
            $sizeFilter->sizes()->attach($request->sizes);

            Alert::success('Size Filter Created Successfully!');
            return redirect()->route('administrator.master-data.size-filter.index')
                ->with('success', 'Size Filter Created Successfully!');
        } catch (\Exception $e) {
            Alert::error('Failed to create size filter: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.size-filter.update');

        $data['sizeFilter'] = SizeFilter::with('sizes')->findOrFail($id);
        $data['sizes'] = Size::with(['mens', 'womens', 'kids'])
            ->orderBy('id')
            ->get();
        $data['selectedSizes'] = $data['sizeFilter']->sizes->pluck('id')->toArray();

        return view('sizefilter::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        ladmin()->allow('administrator.master-data.size-filter.update');

        $request->validate([
            'filter_label' => 'required|string|max:255|unique:size_filters,filter_label,' . $id,
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'exists:sizes,id',
        ]);

        try {
            $sizeFilter = SizeFilter::findOrFail($id);
            
            $sizeFilter->update([
                'filter_label' => $request->filter_label,
                'sort_order' => $request->sort_order,
                'is_active' => $request->is_active,
            ]);

            // Sync selected sizes
            $sizeFilter->sizes()->sync($request->sizes);

            Alert::success('Size Filter Updated Successfully!');
            return redirect()->route('administrator.master-data.size-filter.index')
                ->with('success', 'Size Filter Updated Successfully!');
        } catch (\Exception $e) {
            Alert::error('Failed to update size filter: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        ladmin()->allow('administrator.master-data.size-filter.destroy');

        try {
            $sizeFilter = SizeFilter::findOrFail($id);
            $sizeFilter->sizes()->detach(); // Remove relationships
            $sizeFilter->delete();

            Alert::success('Size Filter Deleted Successfully!');
            return redirect()->route('administrator.master-data.size-filter.index')
                ->with('success', 'Size Filter Deleted Successfully!');
        } catch (\Exception $e) {
            Alert::error('Failed to delete size filter: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
