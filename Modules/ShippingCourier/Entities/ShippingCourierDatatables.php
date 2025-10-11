<?php

namespace Modules\ShippingCourier\Entities;

use Modules\ShippingCourier\Entities\ShippingCourier;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShippingCourierDatatables extends DataTable {

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
            ->addIndexColumn()
            ->rawColumns(['action', 'status'])
            ->addColumn('status', function ($item) {
                return $item->is_active ? "<span class='badge badge-primary'>Active</span>" : "<span class='badge badge-light-dark'>Not Active</span>";
            })
            ->addColumn('action', function ($item) {
                return view('back-office.components.action-burger', [
                    'show' => null,
                    'edit' => [
                        'gate' => 'administrator.master-data.shipping-courier.update',
                        'url' => route('administrator.master-data.shipping-courier.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => [
                        'gate' => 'administrator.master-data.shipping-courier.destroy',
                        'url' => route('administrator.master-data.shipping-courier.destroy', [$item->id, 'back' => request()->fullUrl()]),
                    ]
                ]);
            });
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title(__('No'))
                ->searchable(false)
                ->sortable(false),
            Column::make('code')->title('Code'),
            Column::make('name')->title('Name'),
            Column::make('status')
                ->width(10)
                ->sortable(false)
                ->searchable(false),
            Column::computed('action')
                ->searchable(false)
                ->sortable(false)
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ShippingCourier $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('shipping-couriers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(1)
                    ->responsive(true)
                    ->parameters(['scrollX' => true])
                    ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

     /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ShippingCouriers_' . date('YmdHis');
    }
}