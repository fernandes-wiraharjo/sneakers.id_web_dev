<?php

namespace Modules\DiscountVoucher\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\DiscountVoucher\Repositories\DiscountVoucherRepository;
use Modules\DiscountVoucher\Entities\DiscountVoucherDatatables;
use Modules\DiscountVoucher\Entities\DiscountVoucher;
use Hexters\Ladmin\Exceptions\LadminException;
use Alert;

class DiscountVoucherController extends Controller
{
    protected $repository;

    public function __construct(DiscountVoucherRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(DiscountVoucherDatatables $dataTable)
    {
        if (!auth()->user()->can('administrator.discount-voucher.index')) {
            return redirect()->route('customer.dashboard');
        }

        ladmin()->allow('administrator.discount-voucher.index');
        return $dataTable->render('discountvoucher::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.discount-voucher.create');
        
        $data['voucher'] = new DiscountVoucher();
        $data['voucher_code'] = $this->repository->generateVoucherCode();
        
        return view('discountvoucher::create', $data);
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
                'voucher_code' => 'required|unique:discount_vouchers,voucher_code|max:50',
                'valid_from' => 'required|date',
                'valid_until' => 'required|date|after_or_equal:valid_from',
                'min_purchase' => 'required|numeric|min:0',
                'discount_type' => 'required|in:percent,fixed_amount',
                'discount_rate' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:100',
                'discount_amount' => 'required_if:discount_type,fixed_amount|nullable|numeric|min:0',
                'quota_total' => 'required|integer|min:0',
                'quota_per_user' => 'required|integer|min:1',
                'is_active' => 'boolean'
            ], [
                'voucher_code.required' => 'Voucher code is required',
                'voucher_code.unique' => 'Voucher code already exists',
                'valid_from.required' => 'Valid from date is required',
                'valid_until.required' => 'Valid until date is required',
                'valid_until.after_or_equal' => 'Valid until must be after or equal to valid from',
                'min_purchase.required' => 'Minimum purchase is required',
                'discount_type.required' => 'Discount type is required',
                'discount_rate.required_if' => 'Discount rate is required for percentage type',
                'discount_amount.required_if' => 'Discount amount is required for fixed amount type',
                'quota_total.required' => 'Quota total is required',
                'quota_per_user.required' => 'Quota per user is required'
            ]);

            if ($validator) {
                $data = $request->only([
                    'voucher_code',
                    'valid_from',
                    'valid_until',
                    'min_purchase',
                    'discount_type',
                    'discount_rate',
                    'discount_amount',
                    'quota_total',
                    'quota_per_user',
                    'is_active'
                ]);

                // Set is_active default
                $data['is_active'] = $request->has('is_active') ? 1 : 0;

                // Clean up discount fields based on type
                // For percent: discount_amount is max discount cap (optional)
                // For fixed_amount: discount_rate should be null
                if ($data['discount_type'] === 'fixed_amount') {
                    $data['discount_rate'] = null;
                }

                $stored = $this->repository->create($data);

                if ($stored) {
                    Alert::success('Discount Voucher Created Successfully!');
                    return redirect(route('administrator.discount-voucher.index'))
                        ->with('success', 'Discount Voucher Created Successfully!');
                } else {
                    Alert::error('Failed to create discount voucher!');
                    return redirect()->back();
                }
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withInput()->withErrors([
                $e->getMessage()
            ]);
        } catch (\Exception $e) {
            Alert::error('An error occurred: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        ladmin()->allow('administrator.discount-voucher.index');
        
        $data['voucher'] = $this->repository->getById($id);
        $data['statistics'] = $this->repository->getStatistics($id);
        
        return view('discountvoucher::show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.discount-voucher.update');
        
        $data['voucher'] = $this->repository->getById($id);
        
        return view('discountvoucher::edit', $data);
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
            $validator = $request->validate([
                'voucher_code' => 'required|max:50|unique:discount_vouchers,voucher_code,' . $id,
                'valid_from' => 'required|date',
                'valid_until' => 'required|date|after_or_equal:valid_from',
                'min_purchase' => 'required|numeric|min:0',
                'discount_type' => 'required|in:percent,fixed_amount',
                'discount_rate' => 'required_if:discount_type,percent|nullable|numeric|min:0|max:100',
                'discount_amount' => 'required_if:discount_type,fixed_amount|nullable|numeric|min:0',
                'quota_total' => 'required|integer|min:0',
                'quota_per_user' => 'required|integer|min:1',
                'is_active' => 'boolean'
            ], [
                'voucher_code.required' => 'Voucher code is required',
                'voucher_code.unique' => 'Voucher code already exists',
                'valid_from.required' => 'Valid from date is required',
                'valid_until.required' => 'Valid until date is required',
                'valid_until.after_or_equal' => 'Valid until must be after or equal to valid from',
                'min_purchase.required' => 'Minimum purchase is required',
                'discount_type.required' => 'Discount type is required',
                'discount_rate.required_if' => 'Discount rate is required for percentage type',
                'discount_amount.required_if' => 'Discount amount is required for fixed amount type',
                'quota_total.required' => 'Quota total is required',
                'quota_per_user.required' => 'Quota per user is required'
            ]);

            if ($validator) {
                $data = $request->only([
                    'voucher_code',
                    'valid_from',
                    'valid_until',
                    'min_purchase',
                    'discount_type',
                    'discount_rate',
                    'discount_amount',
                    'quota_total',
                    'quota_per_user',
                    'is_active'
                ]);

                // Set is_active
                $data['is_active'] = $request->has('is_active') ? 1 : 0;

                // Clean up discount fields based on type
                // For percent: discount_amount is max discount cap (optional)
                // For fixed_amount: discount_rate should be null
                if ($data['discount_type'] === 'fixed_amount') {
                    $data['discount_rate'] = null;
                }

                $updated = $this->repository->update($id, $data);

                if ($updated) {
                    Alert::success('Discount Voucher Updated Successfully!');
                    return redirect(route('administrator.discount-voucher.index'))
                        ->with('success', 'Discount Voucher Updated Successfully!');
                } else {
                    Alert::error('Failed to update discount voucher!');
                    return redirect()->back();
                }
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withInput()->withErrors([
                $e->getMessage()
            ]);
        } catch (\Exception $e) {
            Alert::error('An error occurred: ' . $e->getMessage());
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
        try {
            $deleted = $this->repository->delete($id);

            if ($deleted) {
                Alert::success('Discount Voucher Deleted Successfully!');
                return redirect(route('administrator.discount-voucher.index'))
                    ->with('success', 'Discount Voucher Deleted Successfully!');
            } else {
                Alert::error('Failed to delete discount voucher!');
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        } catch (\Exception $e) {
            Alert::error('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
