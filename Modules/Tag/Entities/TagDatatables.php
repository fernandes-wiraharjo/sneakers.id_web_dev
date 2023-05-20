<?php

namespace Modules\Tag\Entities;

use Modules\Tag\Entities\Tag;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TagDatatables  extends DataTable
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
            ->rawColumns(['action', 'status'])
            ->addColumn('status', function ($item) {
                return $item->is_active ? "<span class='badge badge-primary'>Active</span>" : "<span class='badge badge-light-dark'>Not Active</span>";
              })
            ->addColumn('action', function ($item) {
                if($item->products()->count() > 0){
                    $type = 'restrict';
                }

                if($item->tag_code == 'BEST-SELLER' || $item->tag_code == 'FEATURED' || $item->tag_code == 'NEW-ARRIVAL' || $item->tag_code == 'NEW-RELEASE') {
                    $destory_button = null;
                } else {
                    $destory_button = [
                        'gate' => 'administrator.master-data.tag.destroy',
                        'url' => route('administrator.master-data.tag.destroy', [$item->id, 'back' => request()->fullUrl()]),
                        'type' => $type ?? null
                    ];
                }

                return view('back-office.components.action-burger', [
                    'show' => null,
                    'edit' => [
                      'gate' => 'administrator.master-data.tag.update',
                      'url' => route('administrator.master-data.tag.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => $destory_button
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
                ->sortable(false)
                ->searchable(false),
            Column::make('tag_code'),
            Column::make('tag_title'),
            Column::make('status')
                ->width(10)
                ->sortable(false)
                ->searchable(false),
            Column::computed('action')
                ->sortable(false)
                ->searchable(false)
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
    public function query(Tag $model)
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
            ->dom('frtip')
            ->orderBy(1)
            ->parameters(['scrollX' => true])
            ->responsive(true)
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
