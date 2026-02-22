<?php

namespace Modules\Reporting\Entities;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TransactionTypeDatatables extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->rawColumns(['action', 'is_active'])
            ->editColumn('is_active', function ($item) {
                return $item->is_active
                    ? '<span class="badge badge-success">Active</span>'
                    : '<span class="badge badge-secondary">Inactive</span>';
            })
            ->addColumn('action', function ($item) {
                return view('back-office.components.action-burger', [
                    'edit' => [
                        'gate' => 'administrator.master-data.transaction-type.update',
                        'url' => route('administrator.master-data.transaction-type.edit', [$item->id, 'back' => request()->fullUrl()]),
                    ],
                    'destroy' => [
                        'gate' => 'administrator.master-data.transaction-type.destroy',
                        'url' => route('administrator.master-data.transaction-type.destroy', [$item->id, 'back' => request()->fullUrl()]),
                    ],
                ]);
            });
    }

    public function query(TransactionType $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('transaction-type-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('frtip')
            ->orderBy(1, 'asc')
            ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title(__('No'))->sortable(false)->searchable(false),
            Column::make('code')->title('Code'),
            Column::make('name')->title('Name'),
            Column::make('is_active')->title('Status')->orderable(false)->searchable(false),
            Column::computed('action')->title('')->sortable(false)->searchable(false)->exportable(false)->printable(false)->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'TransactionType_' . date('YmdHis');
    }
}
