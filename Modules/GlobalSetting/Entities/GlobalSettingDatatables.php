<?php

  namespace Modules\GlobalSetting\Entities;

  use App\Models\Model;
  use Hexters\Ladmin\Datatables\Datatables;
  use Hexters\Ladmin\Contracts\DataTablesInterface;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

  class GlobalSettingDatatables extends DataTable {

    /**
     * Datatables function
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->rawColumns(['setting_type', 'setting_code', 'setting_value', 'is_active'])
            ->addColumn('action', function ($item) {
                // if($item->product_details()->count() > 0){
                //     $type = 'restrict';
                // }
                return view('back-office.components.action-burger', [
                    'show' => null,
                    'edit' => [
                      'gate' => 'administrator.master-data.global-setting.update',
                      'url' => route('administrator.master-data.global-setting.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => [
                      'gate' => 'administrator.master-data.global-setting.destroy',
                      'url' => route('administrator.master-data.global-setting.destroy', [$item->id, 'back' => request()->fullUrl()]),
                      'type' => $type ?? null
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
                    ->searchable(false),
            Column::make('setting_type')->width(150)
                ->sortable(false)
                ->searchable(false),
            Column::make('setting_code'),
            Column::make('setting_value'),
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
     * @param \App\Models\GlobalSetting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return GlobalSetting::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('global-setting-table')
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
        return 'GlobalSetting_' . date('YmdHis');
    }
  }
