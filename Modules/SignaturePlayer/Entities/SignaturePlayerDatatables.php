<?php

  namespace Modules\SignaturePlayer\Entities;

  use Modules\SignaturePlayer\Entities\SignaturePlayer;
  use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

  class SignaturePlayerDatatables  extends DataTable {

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
            ->rawColumns(['action', 'status', 'home_display', 'signature_image', 'emblem_url'])
            ->editColumn('signature_image', function ($item) {
              if($item->signature_image){
                return '<div class="text-center px-4">
                    <img class="mw-75 card-rounded" alt="" src="'.$item->signature_image.'"/>
                </div>';
              }
            })
            ->editColumn('emblem_url', function ($item) {
              if($item->emblem_url){
                return '<img class="bg-dark p-2 card-rounded" alt="Emblem" src="'.$item->emblem_url.'" style="width: 30px; height: 30px;">';
              }
            })
            ->addColumn('status', function ($item) {
              return $item->is_active ? "<span class='badge badge-primary'>Active</span>" : "<span class='badge badge-light-dark'>Not Active</span>";
            })
            ->addColumn('home_display', function ($item) {
              return $item->is_home_display ? "<span class='badge badge-primary'>Display Active</span>" : "<span class='badge badge-light-dark'>Display Not Active</span>";
            })
            ->addColumn('action', function ($item) {
                if($item->products()->count() > 0){
                    $type = 'restrict';
                }
                return view('back-office.components.action-burger', [
                    'show' => null,
                    'edit' => [
                      'gate' => 'administrator.master-data.signature-player.update',
                      'url' => route('administrator.master-data.signature-player.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => [
                      'gate' => 'administrator.master-data.signature-player.destroy',
                      'url' => route('administrator.master-data.signature-player.destroy', [$item->id, 'back' => request()->fullUrl()]),
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
                ->searchable(false)
                ->sortable(false),
            Column::make('signature_image')
                ->title('Signature Image')
                ->sortable(false)
                ->searchable(false),
            Column::make('emblem_url')
                ->title('Emblem')
                ->sortable(false)
                ->searchable(false),
            Column::make('signature_code'),
            Column::make('signature_title'),
            Column::make('signature_player_name'),
            Column::make('home_display')
                ->sortable(false)
                ->searchable(false),
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
    public function query(SignaturePlayer $model)
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
                    ->setTableId('signature-table')
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
        return 'Signature_' . date('YmdHis');
    }
  }
