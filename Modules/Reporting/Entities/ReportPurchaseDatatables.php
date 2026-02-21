<?php

namespace Modules\Reporting\Entities;

use Modules\Reporting\Entities\ReportPurchase;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ReportPurchaseDatatables extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->rawColumns(['action', 'status_owner', 'status_supplier'])
            ->editColumn('transaction_date', function ($item) {
                return $item->transaction_date ? $item->transaction_date->format('d-M-Y') : '-';
            })
            ->editColumn('price_ongkir', function ($item) {
                return $item->price_ongkir !== null ? 'Rp ' . rupiah_format($item->price_ongkir) : '-';
            })
            ->editColumn('price_modal', function ($item) {
                return $item->price_modal !== null ? 'Rp ' . rupiah_format($item->price_modal) : '-';
            })
            ->editColumn('price_jual', function ($item) {
                return $item->price_jual !== null ? 'Rp ' . rupiah_format($item->price_jual) : '-';
            })
            ->editColumn('price_total_payment', function ($item) {
                return $item->price_total_payment !== null ? 'Rp ' . rupiah_format($item->price_total_payment) : '-';
            })
            ->editColumn('dp_owner', function ($item) {
                return $item->dp_owner !== null ? 'Rp ' . rupiah_format($item->dp_owner) : '-';
            })
            ->editColumn('dp_supplier', function ($item) {
                return $item->dp_supplier !== null ? 'Rp ' . rupiah_format($item->dp_supplier) : '-';
            })
            ->editColumn('sisa_owner', function ($item) {
                return $item->sisa_owner !== null ? 'Rp ' . rupiah_format($item->sisa_owner) : '-';
            })
            ->editColumn('sisa_supplier', function ($item) {
                return $item->sisa_supplier !== null ? 'Rp ' . rupiah_format($item->sisa_supplier) : '-';
            })
            ->editColumn('margin_net', function ($item) {
                return $item->margin_net !== null ? 'Rp ' . rupiah_format($item->margin_net) : '-';
            })
            ->editColumn('modal_net', function ($item) {
                return $item->modal_net !== null ? 'Rp ' . rupiah_format($item->modal_net) : '-';
            })
            ->editColumn('status_owner', function ($item) {
                return $this->formatStatusBadge($item->status_owner);
            })
            ->editColumn('status_supplier', function ($item) {
                return $this->formatStatusBadge($item->status_supplier);
            })
            ->addColumn('action', function ($item) {
                return view('reporting::report-purchase._partials.action-burger', [
                    'edit' => [
                        'gate' => 'administrator.report-purchase.update',
                        'url' => route('administrator.report-purchase.edit', [$item->id, 'back' => request()->fullUrl()]),
                    ],
                    'destroy' => [
                        'gate' => 'administrator.report-purchase.destroy',
                        'url' => route('administrator.report-purchase.destroy', [$item->id, 'back' => request()->fullUrl()]),
                    ],
                ]);
            });
    }

    public function query(ReportPurchase $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('report-purchase-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('frtip')
            ->orderBy(1, 'desc')
            ->responsive(false)
            ->parameters([
                'scrollX' => true,
                'responsive' => false,
            ])
            ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title(__('No'))->sortable(false)->searchable(false),
            Column::make('transaction_date')->title('Tanggal'),
            Column::make('order_id')->title('Order ID'),
            Column::make('customer_name')->title('Customer'),
            Column::make('transaction_type')->title('Tipe'),
            Column::make('location')->title('Lokasi'),
            Column::make('article_number')->title('Article'),
            Column::make('product_name')->title('Product'),
            Column::make('size')->title('Size'),
            Column::make('quantity')->title('Qty'),
            Column::make('price_ongkir')->title('Ongkir')->searchable(false)->orderable(false),
            Column::make('price_modal')->title('Modal')->searchable(false)->orderable(false),
            Column::make('price_jual')->title('Jual')->searchable(false)->orderable(false),
            Column::make('price_total_payment')->title('Total Bayar')->searchable(false)->orderable(false),
            Column::make('dp_owner')->title('DP Owner')->searchable(false)->orderable(false),
            Column::make('dp_supplier')->title('DP Supplier')->searchable(false)->orderable(false),
            Column::make('sisa_owner')->title('Sisa Owner')->searchable(false)->orderable(false),
            Column::make('sisa_supplier')->title('Sisa Supplier')->searchable(false)->orderable(false),
            Column::make('status_owner')->title('Status Owner'),
            Column::make('status_supplier')->title('Status Supplier'),
            Column::make('margin_net')->title('Margin Net')->searchable(false)->orderable(false),
            Column::make('modal_net')->title('Modal Net')->searchable(false)->orderable(false),
            Column::make('phone_number')->title('Phone'),
            Column::make('awb_number')->title('AWB'),
            Column::computed('action')->title('')->sortable(false)->searchable(false)->exportable(false)->printable(false)->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'ReportPurchase_' . date('YmdHis');
    }

    /**
     * Format status with uppercase and color badge (lunas=green, belum lunas=red, sebagian=yellow).
     */
    protected function formatStatusBadge($status)
    {
        if ($status === null || $status === '') {
            return '-';
        }
        $label = strtoupper($status);
        $class = 'badge ';
        switch (strtolower($status)) {
            case 'lunas':
                $class .= 'bg-success';
                break;
            case 'belum lunas':
                $class .= 'bg-danger';
                break;
            case 'sebagian':
                $class .= 'bg-warning text-dark';
                break;
            default:
                $class .= 'bg-secondary';
        }
        return '<span class="' . $class . '">' . e($label) . '</span>';
    }
}
