<?php

  namespace Modules\Size\Entities;

  use Modules\Size\Entities\Size;
  use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

  class SizeDatatables  extends DataTable {

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
            ->rawColumns(['action', 'size-chart', 'status'])
            ->addColumn('status', function ($item) {
                return $item->is_active ? "<span class='badge badge-primary'>Active</span>" : "<span class='badge badge-light-dark'>Not Active</span>";
            })
            ->addColumn('size-chart', function ($item) {
                if ($item->charts()->count() > 0) {
                    $result = "";
                    foreach($item->charts()->get() as $chart) {
                        $result .= view('back-office.components.chips', [
                            'a' => $chart->size_name,
                            'b' => $chart->size_value
                        ]);
                    }
                    return $result;
                } else {
                    return '-';
                }

            })
            ->addColumn('action', function ($item) {
                if ($item->charts()->count() > 0){
                    $destroy_button = null;
                } else {
                    $destroy_button =  [
                        'gate' => 'administrator.master-data.size.destroy',
                        'url' => route('administrator.master-data.size.destroy', [$item->id, 'back' => request()->fullUrl()]),
                    ];
                }
                return view('back-office.components.action-burger', [
                    'show' => [
                        'gate' => 'administrator.master-data.size.show',
                        'url' => route('administrator.master-data.size.show', [$item->id, 'back' => request()->fullUrl()])
                      ],
                    'edit' => [
                      'gate' => 'administrator.master-data.size.update',
                      'url' => route('administrator.master-data.size.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => $destroy_button
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
                ->width(50)
                ->sortable(false)
                ->searchable(false),
            Column::make('size_code')->width(150),
            Column::make('size_title')->width(150),
            Column::make('size-chart')->title(__('Size Chart'))
                ->sortable(false)
                ->searchable(false),
            Column::make('status')
                ->width(10)
                ->sortable(false)
                ->searchable(false),
            Column::computed('action')
                ->width(150)
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
    public function query(Size $model)
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
                    ->setTableId('size-table')
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
