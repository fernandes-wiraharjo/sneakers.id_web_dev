<?php

namespace Modules\Reporting\Services;

use Modules\Reporting\Entities\ReportPurchase;
use Modules\Reporting\Entities\ReportPurchaseHistory;
use Modules\Reporting\Repositories\ReportPurchaseRepository;
use Modules\Reporting\Repositories\TransactionTypeRepository;
use Modules\Transaction\Entities\Transaction;

class SyncTransactionToReportService
{
    public function __construct(ReportPurchaseRepository $repository, TransactionTypeRepository $transactionTypeRepository)
    {
        $this->repository = $repository;
        $this->transactionTypeRepository = $transactionTypeRepository;
    }

    /**
     * Sync a single transaction to report_purchase.
     * When $replaceIfExists is false, skips if order_id already exists. When true, deletes existing rows then inserts.
     * transaction_type is always WEB. price_total_payment = grand_total (already after discount). price_voucher = voucher_discount on first row.
     * Returns number of report rows created.
     */
    public function syncTransaction(Transaction $transaction, bool $replaceIfExists = false): int
    {
        $transaction->load(['items.detail.product', 'destination', 'shipping']);
        $shipping = $transaction->shipping;
        if (!$shipping || empty(trim((string) ($shipping->shipping_waybill ?? '')))) {
            return 0;
        }
        $orderId = $transaction->token ?: ('TXN-' . $transaction->id);
        if (!$replaceIfExists && ReportPurchase::where('order_id', $orderId)->exists()) {
            return 0;
        }
        if ($replaceIfExists) {
            $existingIds = ReportPurchase::where('order_id', $orderId)->pluck('id');
            if ($existingIds->isNotEmpty()) {
                ReportPurchaseHistory::whereIn('report_purchase_id', $existingIds)->delete();
            }
            ReportPurchase::where('order_id', $orderId)->delete();
        }
        $destination = $transaction->destination;
        $customerName = $destination ? trim(($destination->first_name ?? '') . ' ' . ($destination->last_name ?? '')) : '';
        $fullAddress = $destination ? trim((string) ($destination->address ?? '')) : '';
        $transactionDate = $transaction->paid_at ?? $transaction->date;
        $priceOngkir = (int) ($shipping->shipping_cost ?? 0);
        $grandTotal = (int) ($transaction->grand_total ?? 0);
        $priceDiscount = (int) ($transaction->voucher_discount ?? 0);
        $items = $transaction->items;
        $first = true;
        $synced = 0;
        foreach ($items as $item) {
            $detail = $item->detail;
            if (!$detail || !$detail->product) {
                continue;
            }
            $product = $detail->product;
            $qty = (int) $item->quantity;
            $priceModal = (int) ($detail->base_price ?? 0) * $qty;
            $priceJual = (int) ($item->price ?? 0) * $qty;
            $marginNet = $priceJual - $priceModal;
            $modalNet = (int) (($marginNet / 2) + $priceModal);
            $this->repository->create([
                'order_id' => strtoupper($orderId),
                'transaction_date' => $transactionDate,
                'customer_name' => strtoupper($customerName ?: '-'),
                'transaction_type' => 'WEB',
                'location' => $fullAddress !== '' ? strtoupper($fullAddress) : null,
                'article_number' => strtoupper($product->product_code ?? ''),
                'product_name' => strtoupper($product->product_name ?? ''),
                'size' => strtoupper((string) ($detail->size ?? '')),
                'quantity' => $qty,
                'price_ongkir' => $first ? $priceOngkir : 0,
                'price_modal' => $priceModal,
                'price_jual' => $priceJual,
                'price_voucher' => ($first && $priceDiscount) ? (int) $priceDiscount : null,
                'price_total_payment' => $first ? $grandTotal : 0,
                'dp_owner' => null,
                'dp_supplier' => null,
                'sisa_owner' => null,
                'sisa_supplier' => null,
                'status_owner' => 'lunas',
                'status_supplier' => 'lunas',
                'margin_net' => $marginNet,
                'modal_net' => $modalNet,
                'phone_number' => $destination ? strtoupper((string) ($destination->phone_number ?? '')) : null,
                'awb_number' => strtoupper((string) ($shipping->shipping_waybill ?? '')),
            ]);
            $synced++;
            $first = false;
        }
        return $synced;
    }
}
