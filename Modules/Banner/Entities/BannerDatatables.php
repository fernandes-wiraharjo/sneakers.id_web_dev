<?php

namespace Modules\Banner\Entities;

use Modules\Banner\Entities\Banner;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BannerDatatables  extends DataTable
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
            ->rawColumns(['action','banner_image', 'status'])
            ->editColumn('banner_image', function ($item) {
                return '<div class="text-center px-4">
                    <img class="mw-75 card-rounded" alt="" src="'.getImage($item->banner_image, 'banner') .'"/>
                </div>';
            })
            ->addColumn('status', function ($item) {
                return $item->is_active ? "<span class='badge badge-light-dark'>Active</span>" : "<span class='badge badge-light-dark'>Not Active</span>";
            })
            ->addColumn('action', function ($item) {
                return view('components.action-burger', [
                    'show' => null,
                    'edit' => [
                      'gate' => 'administrator.master-data.banner.update',
                      'url' => route('administrator.master-data.banner.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => [
                      'gate' => 'administrator.master-data.banner.destroy',
                      'url' => route('administrator.master-data.banner.destroy', [$item->id, 'back' => request()->fullUrl()]),
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
            Column::make('banner_image')->width(150),
            Column::make('order')->title(__('Order'))->width(50),
            Column::make('banner_url'),
            Column::computed('status')->width(150),
            Column::computed('action')
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
    public function query(Banner $model)
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
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->autoWidth(false)
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
