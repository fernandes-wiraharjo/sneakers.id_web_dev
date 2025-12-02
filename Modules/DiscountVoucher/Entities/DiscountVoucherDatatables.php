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
            ->rawColumns(['action', 'voucher_code', 'discount', 'status', 'validity', 'quota'])
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
                return $item->valid_from->format('d M Y') . '<br/><small>to</small><br/>' . $item->valid_until->format('d M Y');
            })
            ->addColumn('discount', function ($item) {
                if ($item->discount_type === 'percent') {
                    $discount = "<span class='badge badge-info'>{$item->discount_rate}%</span>";
                    if ($item->discount_amount && $item->discount_amount > 0) {
                        $discount .= "<br/><small class='text-muted'>max Rp " . number_format($item->discount_amount, 0, ',', '.') . "</small>";
                    }
                    return $discount;
                } else {
                    return "<span class='badge badge-primary'>Rp " . number_format($item->discount_amount, 0, ',', '.') . "</span>";
                }
            })
            ->addColumn('quota', function ($item) {
                if ($item->quota_total == 0) {
                    return "<span class='badge badge-light-success'>Unlimited</span>";
                }
                
                $remaining = $item->quota_total - $item->usage_count;
                $percentage = ($item->usage_count / $item->quota_total) * 100;
                
                if ($percentage >= 100) {
                    return "<span class='badge badge-danger'>{$item->usage_count}/{$item->quota_total}</span>";
                } elseif ($percentage >= 80) {
                    return "<span class='badge badge-warning'>{$item->usage_count}/{$item->quota_total}</span>";
                } else {
                    return "<span class='badge badge-success'>{$item->usage_count}/{$item->quota_total}</span>";
                }
            })
            ->editColumn('min_purchase', function ($item) {
                return 'Rp ' . number_format($item->min_purchase, 0, ',', '.');
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
                ->width(100)
                ->addClass('text-center'),
            Column::make('voucher_code')
                ->title(__('Voucher Code'))
                ->width(150),
            Column::make('discount')
                ->title(__('Discount'))
                ->width(120)
                ->searchable(false)
                ->sortable(false),
            Column::make('min_purchase')
                ->title(__('Min Purchase'))
                ->width(130),
            Column::make('validity')
                ->title(__('Validity Period'))
                ->width(150)
                ->searchable(false)
                ->sortable(false),
            Column::make('quota')
                ->title(__('Usage/Quota'))
                ->width(120)
                ->searchable(false)
                ->sortable(false),
            Column::make('quota_per_user')
                ->title(__('Per User'))
                ->width(80)
                ->addClass('text-center'),
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

