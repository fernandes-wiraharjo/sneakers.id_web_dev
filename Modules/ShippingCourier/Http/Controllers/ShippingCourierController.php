<?php

namespace Modules\ShippingCourier\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\ShippingCourier;
use App\Models\ShippingCourierService;
use App\Facades\CekOngkir;
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
                    $this->syncCourierServices($courier, $request->input('services', []));

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
        $courier = ShippingCourier::with('services')->findOrFail($id);
        $apiServices = CekOngkir::fetchCourierServices($courier->code);
        $services = $this->mergeCourierServices($courier, $apiServices);
        $apiError = empty($apiServices)
            ? 'Unable to fetch services from RajaOngkir. Please check your API key, RAJAONGKIR_ORIGIN_REGION_ID, and RAJAONGKIR_SAMPLE_DESTINATION_REGION_ID configuration.'
            : null;

        return view('shippingcourier::edit', compact('courier', 'services', 'apiError'));
    }

    protected function mergeCourierServices(ShippingCourier $courier, array $apiServices): array
    {
        if (empty($apiServices)) {
            return $courier->services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'code' => $service->code,
                    'name' => $service->name,
                    'is_active' => $service->is_active,
                ];
            })->values()->all();
        }

        $existingByCode = $courier->services->keyBy(function ($service) {
            return strtoupper($service->code);
        });

        return collect($apiServices)->map(function ($apiService) use ($existingByCode) {
            $existing = $existingByCode->get(strtoupper($apiService['code']));

            return [
                'id' => $existing ? $existing->id : null,
                'code' => $apiService['code'],
                'name' => $apiService['name'],
                'is_active' => $existing ? $existing->is_active : false,
            ];
        })->values()->all();
    }

    protected function syncCourierServices(ShippingCourier $courier, array $services): void
    {
        $savedIds = [];

        foreach ($services as $serviceData) {
            $payload = [
                'code' => $serviceData['code'],
                'name' => $serviceData['name'],
                'is_active' => isset($serviceData['is_active']),
            ];

            if (!empty($serviceData['id'])) {
                $courier->services()->where('id', $serviceData['id'])->update($payload);
                $savedIds[] = (int) $serviceData['id'];
                continue;
            }

            $service = $courier->services()->updateOrCreate(
                ['code' => $serviceData['code']],
                $payload
            );
            $savedIds[] = $service->id;
        }

        if (!empty($savedIds)) {
            $courier->services()->whereNotIn('id', $savedIds)->delete();
        }
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
                    $this->syncCourierServices($courier, $request->input('services', []));

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
