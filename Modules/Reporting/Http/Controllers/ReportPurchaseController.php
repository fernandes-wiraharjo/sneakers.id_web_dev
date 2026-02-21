<?php

namespace Modules\Reporting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Reporting\Entities\ReportPurchase;
use Modules\Reporting\Entities\ReportPurchaseDatatables;
use Modules\Reporting\Repositories\ReportPurchaseRepository;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductDetail;
use Hexters\Ladmin\Exceptions\LadminException;
use Alert;

class ReportPurchaseController extends Controller
{
    protected $repository;

    public function __construct(ReportPurchaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(ReportPurchaseDatatables $dataTable)
    {
        ladmin()->allow('administrator.report-purchase.index');
        return $dataTable->render('reporting::report-purchase.index');
    }

    public function create()
    {
        ladmin()->allow('administrator.report-purchase.create');
        $data['reportPurchase'] = new ReportPurchase();
        return view('reporting::report-purchase.create', $data);
    }

    public function store(Request $request)
    {
        try {
            ladmin()->allow('administrator.report-purchase.create');
            $data = $this->normalizeRequest($request->all());
            $this->validateReportPurchase($data);
            $this->repository->create($data);
            Alert::success('Report Purchase created successfully!');
            return redirect()->route('administrator.report-purchase.index')
                ->with('success', 'Report Purchase created successfully!');
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        ladmin()->allow('administrator.report-purchase.update');
        $data['reportPurchase'] = $this->repository->getById($id);
        return view('reporting::report-purchase.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            ladmin()->allow('administrator.report-purchase.update');
            $data = $this->normalizeRequest($request->all());
            $this->validateReportPurchase($data);
            $this->repository->update($id, $data);
            Alert::success('Report Purchase updated successfully!');
            return redirect()->route('administrator.report-purchase.index')
                ->with('success', 'Report Purchase updated successfully!');
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
            ladmin()->allow('administrator.report-purchase.destroy');
            $this->repository->delete($id);
            Alert::success('Report Purchase deleted successfully!');
            return redirect()->route('administrator.report-purchase.index')
                ->with('success', 'Report Purchase deleted successfully!');
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Typeahead: search products by article number (min 3 chars).
     * Returns [{ product_code, product_name, size, base_price }, ...] flattened per size.
     */
    public function typeaheadArticle(Request $request)
    {
        $q = $request->get('q', '');
        $q = trim($q);
        if (strlen($q) < 3) {
            return response()->json([]);
        }
        $products = Product::query()
            ->where('is_active', 1)
            ->where('product_code', 'LIKE', $q . '%')
            ->with('details')
            ->limit(20)
            ->get();
        $result = [];
        foreach ($products as $product) {
            foreach ($product->details as $detail) {
                $result[] = [
                    'product_code' => $product->product_code,
                    'product_name' => $product->product_name,
                    'size' => $detail->size,
                    'base_price' => (int) $detail->base_price,
                ];
            }
        }
        return response()->json($result);
    }

    protected function normalizeRequest(array $data)
    {
        $stringFields = [
            'order_id', 'customer_name', 'transaction_type', 'location',
            'article_number', 'product_name', 'size', 'phone_number', 'awb_number',
        ];
        foreach ($stringFields as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                $data[$field] = strtoupper($data[$field]);
            }
        }
        $intFields = [
            'quantity', 'price_ongkir', 'price_modal', 'price_jual', 'price_total_payment',
            'dp_owner', 'dp_supplier', 'sisa_owner', 'sisa_supplier', 'margin_net', 'modal_net',
        ];
        foreach ($intFields as $field) {
            if (isset($data[$field])) {
                if (is_string($data[$field])) {
                    $data[$field] = (int) preg_replace('/\D/', '', $data[$field]);
                } else {
                    $data[$field] = (int) $data[$field];
                }
            }
        }
        if (isset($data['transaction_date'])) {
            $data['transaction_date'] = $data['transaction_date'];
        }
        return $data;
    }

    protected function validateReportPurchase(array $data)
    {
        $rules = [
            'order_id' => 'required|string|max:255',
            'transaction_date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'transaction_type' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
        ];
        foreach (['price_ongkir', 'price_modal', 'price_jual', 'price_total_payment', 'dp_owner', 'dp_supplier', 'sisa_owner', 'sisa_supplier', 'modal_net'] as $f) {
            $rules[$f] = 'nullable|integer|min:0';
        }
        $rules['margin_net'] = 'nullable|integer'; // can be negative
        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules, [
            'order_id.required' => 'Order ID is required.',
            'transaction_date.required' => 'Transaction date is required.',
            'customer_name.required' => 'Customer name is required.',
            'quantity.required' => 'Quantity is required.',
        ]);
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
        $priceFields = ['price_ongkir', 'price_modal', 'price_jual', 'price_total_payment', 'dp_owner', 'dp_supplier', 'sisa_owner', 'sisa_supplier', 'modal_net'];
        foreach ($priceFields as $f) {
            $v = $data[$f] ?? 0;
            if ($v > 0 && $v < 1000) {
                throw new LadminException("Price field " . str_replace('_', ' ', $f) . " must be 0 or at least 1000.");
            }
        }
        // margin_net can be negative, no min 1000 check
    }
}
