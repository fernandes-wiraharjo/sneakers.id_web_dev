<?php

namespace Modules\Reporting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Reporting\Entities\ReportPurchase;
use Modules\Reporting\Entities\ReportPurchaseDatatables;
use Modules\Reporting\Repositories\ReportPurchaseRepository;
use Modules\Reporting\Repositories\TransactionTypeRepository;
use Modules\Reporting\Services\SyncTransactionToReportService;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductDetail;
use Modules\Transaction\Entities\Transaction;
use Hexters\Ladmin\Exceptions\LadminException;
use Alert;

class ReportPurchaseController extends Controller
{
    /** When true, sync will replace existing report rows for the same order_id; when false, skip when order_id already exists. */
    protected $allow_overwrite = true;

    protected $repository;
    protected $syncService;
    protected $transactionTypeRepository;

    public function __construct(ReportPurchaseRepository $repository, SyncTransactionToReportService $syncService, TransactionTypeRepository $transactionTypeRepository)
    {
        $this->repository = $repository;
        $this->syncService = $syncService;
        $this->transactionTypeRepository = $transactionTypeRepository;
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
        $data['transactionTypes'] = $this->transactionTypeRepository->getForDropdown();
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
        $data['transactionTypes'] = $this->transactionTypeRepository->getForDropdown();
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
     * Sync report_purchase from transactions that have AWB (shipping waybill).
     * Uses transaction token as order_id. Skips transactions whose order_id already exists in report table.
     * Location = full destination address. One row per transaction item; dp_*, sisa_*, status_supplier = null; status_owner = lunas.
     */
    public function syncFromTransactions(Request $request)
    {
        ladmin()->allow('administrator.report-purchase.index');
        $synced = 0;
        $skipped = 0;
        $transactions = Transaction::query()
            ->whereHas('shipping', function ($q) {
                $q->whereNotNull('shipping_waybill')->where('shipping_waybill', '!=', '');
            })
            ->with(['items.detail.product', 'destination', 'shipping'])
            ->get();
        foreach ($transactions as $transaction) {
            $n = $this->syncService->syncTransaction($transaction, $this->allow_overwrite);
            if ($n === 0 && $transaction->shipping && !empty(trim((string) $transaction->shipping->shipping_waybill ?? ''))) {
                $skipped++;
            } else {
                $synced += $n;
            }
        }
        $message = $synced > 0
            ? "Synced {$synced} report row(s) from transactions." . ($skipped > 0 ? " Skipped {$skipped} transaction(s) (already in report)." : '')
            : ($skipped > 0 ? "No new data. Skipped {$skipped} transaction(s) (already in report)." : 'No transactions with AWB found.');
        Alert::info($message);
        return redirect()->route('administrator.report-purchase.index')->with('success', $message);
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
        // price_voucher: default null when empty so UI can show "-"
        if (array_key_exists('price_voucher', $data)) {
            $raw = $data['price_voucher'];
            $cleaned = is_string($raw) ? preg_replace('/\D/', '', $raw) : $raw;
            if ($cleaned === '' || $cleaned === null) {
                $data['price_voucher'] = null;
            } else {
                $data['price_voucher'] = (int) $cleaned;
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
            'transaction_type' => 'nullable|string|max:64|exists:transaction_types,code',
            'quantity' => 'required|integer|min:0',
        ];
        foreach (['price_ongkir', 'price_modal', 'price_jual', 'price_voucher', 'price_total_payment', 'dp_owner', 'dp_supplier', 'sisa_owner', 'sisa_supplier', 'modal_net'] as $f) {
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
        $priceFields = ['price_ongkir', 'price_modal', 'price_jual', 'price_voucher', 'price_total_payment', 'dp_owner', 'dp_supplier', 'sisa_owner', 'sisa_supplier', 'modal_net'];
        foreach ($priceFields as $f) {
            $v = $data[$f] ?? 0;
            if ($v > 0 && $v < 1000) {
                throw new LadminException("Price field " . str_replace('_', ' ', $f) . " must be 0 or at least 1000.");
            }
        }
        // margin_net can be negative, no min 1000 check
    }
}
