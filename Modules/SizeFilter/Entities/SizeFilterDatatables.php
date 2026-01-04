<?php

namespace Modules\SizeFilter\Entities;

use Modules\SizeFilter\Entities\SizeFilter;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SizeFilterDatatables extends DataTable
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
            ->rawColumns(['action', 'status', 'eu_sizes'])
            ->editColumn('eu_sizes', function ($item) {
                $euSizes = $item->eu_sizes ?? [];
                $euSizeCount = count($euSizes);
                $displaySizes = array_slice($euSizes, 0, 5);
                $euSizeList = implode(', ', $displaySizes);
                
                if ($euSizeCount > 5) {
                    $euSizeList .= ' <span class="badge badge-light-primary">+' . ($euSizeCount - 5) . ' more</span>';
                }
                
                return $euSizeList ?: '<span class="text-muted">No EU sizes</span>';
            })
            ->addColumn('status', function ($item) {
                return $item->is_active 
                    ? "<span class='badge badge-primary'>Active</span>" 
                    : "<span class='badge badge-light-dark'>Inactive</span>";
            })
            ->addColumn('action', function ($item) {
                return view('back-office.components.action-burger', [
                    'show' => null,
                    'edit' => [
                        'gate' => 'administrator.master-data.size-filter.update',
                        'url' => route('administrator.master-data.size-filter.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => [
                        'gate' => 'administrator.master-data.size-filter.destroy',
                        'url' => route('administrator.master-data.size-filter.destroy', [$item->id, 'back' => request()->fullUrl()])
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
                ->sortable(false)
                ->searchable(false)
                ->width(50),
            Column::make('filter_label')
                ->title('Filter Label')
                ->width(150),
            Column::make('eu_sizes')
                ->title('Mapped EU Sizes')
                ->sortable(false)
                ->searchable(false),
            Column::make('sort_order')
                ->title('Order')
                ->width(100),
            Column::make('status')
                ->sortable(false)
                ->searchable(false)
                ->width(100),
            Column::computed('action')
                ->sortable(false)
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width(150),
        ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\SizeFilter\Entities\SizeFilter $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SizeFilter $model)
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
            ->setTableId('sizefilter-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('frtip')
            ->orderBy(3) // Order by sort_order
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
        return 'SizeFilter_' . date('YmdHis');
    }
}

