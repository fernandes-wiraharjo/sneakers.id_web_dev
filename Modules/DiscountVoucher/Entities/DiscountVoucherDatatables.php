<?php

namespace Modules\DiscountVoucher\Entities;

use Modules\DiscountVoucher\Entities\DiscountVoucher;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DiscountVoucherDatatables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->rawColumns(['action', 'voucher_code', 'apply_to', 'discount', 'status', 'validity', 'quota', 'minimum'])
            ->editColumn('voucher_code', function ($item) {
                return "<span class='fw-bold font-monospace'>{$item->voucher_code}</span>";
            })
            ->addColumn('apply_to', function ($item) {
                $applyTo = $item->apply_to ?? DiscountVoucher::APPLY_TO_CART;
                $badges = [
                    DiscountVoucher::APPLY_TO_SHIPPING => "<span class='badge badge-light-info'>Shipping only</span>",
                    DiscountVoucher::APPLY_TO_PRODUCT => "<span class='badge badge-light-warning'>Product only</span>",
                    DiscountVoucher::APPLY_TO_CART => "<span class='badge badge-light-primary'>Entire cart</span>",
                ];

                return $badges[$applyTo] ?? $badges[DiscountVoucher::APPLY_TO_CART];
            })
            ->addColumn('status', function ($item) {
                if (!$item->is_active) {
                    return "<span class='badge badge-light-dark'>Inactive</span>";
                }
                
                $now = now();
                if ($now->lt($item->valid_from)) {
                    return "<span class='badge badge-warning'>Not Started</span>";
                } elseif ($now->gt($item->valid_until)) {
                    return "<span class='badge badge-danger'>Expired</span>";
                } else {
                    return "<span class='badge badge-success'>Active</span>";
                }
            })
            ->addColumn('validity', function ($item) {
                return $item->valid_from->format('d M Y') . ' – ' . $item->valid_until->format('d M Y');
            })
            ->addColumn('discount', function ($item) {
                if ($item->discount_type === 'percent') {
                    $rate = rtrim(rtrim(number_format((float) $item->discount_rate, 2, '.', ''), '0'), '.');
                    $html = "<span class='badge badge-info'>{$rate}%</span>";
                    if ($item->discount_amount && $item->discount_amount > 0) {
                        $html .= "<br/><small class='text-muted'>max Rp " . number_format($item->discount_amount, 0, ',', '.') . "</small>";
                    }
                    return $html;
                }

                return "<span class='badge badge-primary'>Rp " . number_format($item->discount_amount, 0, ',', '.') . "</span>";
            })
            ->addColumn('minimum', function ($item) {
                if ((float) $item->min_purchase <= 0) {
                    return "<span class='text-muted'>No minimum</span>";
                }

                return 'Rp ' . number_format($item->min_purchase, 0, ',', '.');
            })
            ->addColumn('quota', function ($item) {
                if ($item->quota_total == 0) {
                    return "<div>{$item->usage_count} used</div><small class='text-muted'>Unlimited quota</small>";
                }
                
                $remaining = $item->quota_total - $item->usage_count;
                $percentage = ($item->usage_count / $item->quota_total) * 100;
                $badgeClass = $percentage >= 100 ? 'badge-danger' : ($percentage >= 80 ? 'badge-warning' : 'badge-success');

                return "<span class='badge {$badgeClass}'>{$item->usage_count} / {$item->quota_total}</span><br/><small class='text-muted'>{$remaining} left · {$item->quota_per_user}/user</small>";
            })
            ->editColumn('created_at', function (DiscountVoucher $model) {
                return $model->created_at->format('d-m-Y H:i');
            })
            ->editColumn('action', function ($item) {
                return view('back-office.components.action-burger', [
                    'show' => null,
                    'edit' => [
                      'gate' => 'administrator.discount-voucher.update',
                      'url' => route('administrator.discount-voucher.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => [
                      'gate' => 'administrator.discount-voucher.destroy',
                      'url' => route('administrator.discount-voucher.destroy', [$item->id])
                    ]
                ]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\DiscountVoucher\Entities\DiscountVoucher $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DiscountVoucher $model)
    {
        return $model->newQuery()
            ->select('discount_vouchers.*')
            ->orderBy('discount_vouchers.created_at', 'DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('discount-voucher-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(1)
                    ->responsive(true)
                    ->parameters([
                        'scrollX' => true,
                        'processing' => true,
                        'serverSide' => true
                        ])
                    ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->sortable(false)
                ->searchable(false)
                ->width(80)
                ->addClass('text-center'),
            Column::make('voucher_code')
                ->title(__('Code'))
                ->width(140),
            Column::make('apply_to')
                ->title(__('Applies To'))
                ->width(130)
                ->searchable(false)
                ->addClass('text-center'),
            Column::make('discount')
                ->title(__('Discount'))
                ->width(160)
                ->searchable(false)
                ->sortable(false),
            Column::make('minimum')
                ->title(__('Minimum'))
                ->width(150)
                ->searchable(false)
                ->sortable(false),
            Column::make('validity')
                ->title(__('Valid Period'))
                ->width(180)
                ->searchable(false)
                ->sortable(false),
            Column::make('quota')
                ->title(__('Usage'))
                ->width(140)
                ->searchable(false)
                ->sortable(false),
            Column::make('status')
                ->title(__('Status'))
                ->width(100)
                ->sortable(false)
                ->searchable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'DiscountVoucher_' . date('YmdHis');
    }
}
