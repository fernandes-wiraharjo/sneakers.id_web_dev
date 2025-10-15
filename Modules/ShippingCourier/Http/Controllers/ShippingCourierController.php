<?php

namespace Modules\ShippingCourier\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\ShippingCourier;
use Modules\ShippingCourier\Entities\ShippingCourierService;
use Modules\ShippingCourier\Entities\ShippingCourierDatatables;
use Hexters\Ladmin\Exceptions\LadminException;
use Alert;
use DB;

class ShippingCourierController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ShippingCourierDatatables $dataTables)
    {
        ladmin()->allow('administrator.master-data.shipping-courier.index');
        return $dataTables->render('shippingcourier::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('shippingcourier::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            ladmin()->allow('administrator.master-data.shipping-courier.create');
            
            $validator = $request->validate([
                'code' => 'required|string|unique:shipping_couriers,code',
                'name' => 'required|string',
                'is_active' => 'boolean',
                'services' => 'array',
                'services.*.code' => 'required|string',
                'services.*.name' => 'required|string',
                'services.*.is_active' => 'boolean'
            ]);

            if ($validator) {
                DB::beginTransaction();
                try {
                    // Create courier
                    $courier = ShippingCourier::create($request->all());

                    // Create services
                    foreach ($request->input('services', []) as $serviceData) {
                        $serviceData['is_active'] = isset($serviceData['is_active']);
                        $courier->services()->create([
                            'code' => $serviceData['code'],
                            'name' => $serviceData['name'],
                            'is_active' => $serviceData['is_active']
                        ]);
                    }

                    DB::commit();
                    Alert::success('Shipping Courier Created Successfully!');
                    return redirect(route('administrator.master-data.shipping-courier.index'))
                        ->with('success', 'Shipping Courier Created Successfully!');
                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }
            } else {
                Alert::error('Failed to create shipping courier, check your info!');
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        } catch (\Exception $e) {
            Alert::error('An error occurred while creating the shipping courier.');
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
        return view('shippingcourier::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.shipping-courier.update');
        $courier = ShippingCourier::findOrFail($id);
        return view('shippingcourier::edit', compact('courier'));
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
            ladmin()->allow('administrator.master-data.shipping-courier.update');
            
            $courier = ShippingCourier::findOrFail($id);
            $data = $request->all();
            // Handle checkbox - if not checked, it won't be in the request
            $data['is_active'] = $request->has('is_active');

            if ($courier->code == $data['code']) {
                $validation = [
                    'code' => 'required|exists:shipping_couriers,code',
                    'name' => 'required|string',
                    'is_active' => 'boolean',
                    'services' => 'array',
                    'services.*.code' => 'required|string',
                    'services.*.name' => 'required|string',
                    'services.*.is_active' => 'boolean'
                ];
            } else {
                $validation = [
                    'code' => 'required|string|unique:shipping_couriers,code',
                    'name' => 'required|string',
                    'is_active' => 'boolean',
                    'services' => 'array',
                    'services.*.code' => 'required|string',
                    'services.*.name' => 'required|string',
                    'services.*.is_active' => 'boolean'
                ];
            }

            $validator = $request->validate($validation);

            if ($validator) {
                DB::beginTransaction();
                try {
                    // Update courier
                    $courier->update($data);

                    // Update services
                    $existingServices = collect($request->input('services', []));
                    $existingServiceIds = $existingServices->pluck('id')->filter()->all();

                    // Delete services that are not in the request
                    $courier->services()->whereNotIn('id', $existingServiceIds)->delete();

                    // Update or create services
                    foreach ($existingServices as $serviceData) {
                        $serviceData['is_active'] = isset($serviceData['is_active']);
                        
                        if (isset($serviceData['id'])) {
                            // Update existing service
                            $courier->services()->where('id', $serviceData['id'])->update([
                                'code' => $serviceData['code'],
                                'name' => $serviceData['name'],
                                'is_active' => $serviceData['is_active']
                            ]);
                        } else {
                            // Create new service
                            $courier->services()->create([
                                'code' => $serviceData['code'],
                                'name' => $serviceData['name'],
                                'is_active' => $serviceData['is_active']
                            ]);
                        }
                    }

                    DB::commit();
                    Alert::success('Shipping Courier Updated Successfully!');
                    return redirect(route('administrator.master-data.shipping-courier.index'))
                        ->with('success', 'Shipping Courier Updated Successfully!');
                } catch (\Exception $e) {
                    DB::rollback();
                    throw $e;
                }
            } else {
                Alert::error('Failed to update shipping courier, check your info!');
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        } catch (\Exception $e) {
            Alert::error('An error occurred while updating the shipping courier.');
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
            ladmin()->allow('administrator.master-data.shipping-courier.destroy');
            
            $courier = ShippingCourier::findOrFail($id);
            $deleted = $courier->delete();

            if ($deleted) {
                Alert::success('Shipping Courier Deleted Successfully!');
                return redirect(route('administrator.master-data.shipping-courier.index'))
                    ->with('success', 'Shipping Courier Deleted Successfully!');
            } else {
                Alert::error("Failed to delete shipping courier!");
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
