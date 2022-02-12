<?php

  namespace App\DataTables;

  use App\Models\Role;
  use Yajra\DataTables\Html\Button;
  use Yajra\DataTables\Html\Column;
  use Yajra\DataTables\Html\Editor\Editor;
  use Yajra\DataTables\Html\Editor\Fields;
  use Yajra\DataTables\Services\DataTable;

  class PermissionDatatables extends DataTable {

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->addColumn('action', function($item) {
            return view('ladmin::table.action', [
                    'show' => [
                        'title' => 'Assign Permission',
                        'gate' => 'administrator.access.permission.show',
                        'url' => route('administrator.access.permission.show', [$item->id, 'back' => request()->fullUrl()])
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
            Column::make('DT_RowIndex')->title(__('No')),
            Column::make('name'),
            Column::computed('action')
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
    public function query(Role $model)
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
            ->setTableId('permission-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->responsive(true)
            ->parameters([
                'buttons' => ['pdf'],
            ]);
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
