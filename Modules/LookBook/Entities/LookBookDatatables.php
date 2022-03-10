<?php

namespace Modules\LookBook\Entities;

use Modules\LookBook\Entities\LookBook;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LookBookDatatables  extends DataTable
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
            ->addIndexColumn()
            ->rawColumns(['action','status', 'look_book_title'])
            ->editColumn('look_book_title', function ($item) {
                $image_url = $item->look_book_image;
                return '<div class="d-flex align-items-center">'.
                            '<a href="'.route('administrator.master-data.lookbook.edit', [$item->id, 'back' => request()->fullUrl()]).'" class="symbol symbol-50px">'.
                            '<span class="symbol-label" style="background-image:url('.getImage($image_url ?? '' , 'lookbook').');"></span>'.
                        '</a>'.
                        '<div class="ms-5">'.
                            '<a href="'.route('administrator.master-data.lookbook.edit', [$item->id, 'back' => request()->fullUrl()]).'"'.
                            ' class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="look_book_title">'.$item->look_book_title.'</a>'.
                        '</div>'.
                    '</div>';
            })
            ->addColumn('status', function ($item) {
                return $item->is_active ? "<span class='badge badge-primary'>Active</span>" : "<span class='badge badge-light-dark'>Not Active</span>";
            })
            ->addColumn('action', function ($item) {
                return view('components.action-burger', [
                    'show' => null,
                    'edit' => [
                      'gate' => 'administrator.master-data.lookbook.update',
                      'url' => route('administrator.master-data.lookbook.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => [
                      'gate' => 'administrator.master-data.lookbook.destroy',
                      'url' => route('administrator.master-data.lookbook.destroy', [$item->id, 'back' => request()->fullUrl()]),
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
            Column::make('DT_RowIndex')->title(__('#'))->width(50)
                ->sortable(false)
                ->searchable(false),
            Column::make('look_book_title')->width(150),
            Column::make('look_book_order')->title(__('Order'))->width(50)
                ->searchable(false),
            Column::computed('status')->width(75),
            Column::computed('action')
                ->sortable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LookBook $model)
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
            ->setTableId('lookbook-table')
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
        return 'Product_' . date('YmdHis');
    }
}
