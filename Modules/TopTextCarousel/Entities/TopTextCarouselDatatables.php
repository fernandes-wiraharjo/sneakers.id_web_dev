<?php

namespace Modules\TopTextCarousel\Entities;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TopTextCarouselDatatables extends DataTable
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
                        'gate' => 'administrator.master-data.top-text-carousel.update',
                        'url' => route('administrator.master-data.top-text-carousel.edit', [$item->id, 'back' => request()->fullUrl()]),
                    ],
                    'destroy' => [
                        'gate' => 'administrator.master-data.top-text-carousel.destroy',
                        'url' => route('administrator.master-data.top-text-carousel.destroy', [$item->id, 'back' => request()->fullUrl()]),
                    ],
                ]);
            });
    }

    public function query(TopTextCarousel $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('top-text-carousel-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('frtip')
            ->orderBy(2, 'asc')
            ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title(__('No'))->sortable(false)->searchable(false),
            Column::make('text')->title('Text'),
            Column::make('link')->title('Link'),
            Column::make('sort_order')->title('Order'),
            Column::make('is_active')->title('Status')->orderable(false)->searchable(false),
            Column::computed('action')->title('')->sortable(false)->searchable(false)->exportable(false)->printable(false)->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'TopTextCarousel_' . date('YmdHis');
    }
}
