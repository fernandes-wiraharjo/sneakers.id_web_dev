<?php

  namespace App\Datatables;

  use Hexters\Ladmin\Models\LadminLogable;
  use Yajra\DataTables\Html\Button;
  use Yajra\DataTables\Html\Column;
  use Yajra\DataTables\Html\Editor\Editor;
  use Yajra\DataTables\Html\Editor\Fields;
  use Yajra\DataTables\Services\DataTable;

  class LadminLogableDatatables extends Datatable {

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->rawColumns(['action', 'type', 'user.name'])
            ->editColumn('logable_type', function($item) {
                return $item->logable_type;
              })
              ->editColumn('type', function($item) {
                return '<span class="badge badge-' . ($item->colors[$item->type] ?? 'warning') . '">' . ucwords($item->type) . '</span>';
              })
            ->editColumn('created_at', function($item) {
              return $item->created_at->format('d/m/y H:i') . ' - ' . $item->created_at->diffForHumans();
            })
            ->editColumn('user.name', function($item) {
                return "<strong class=\"m-0 p-0\">{$item->user->name}</strong><br><small class=\"text-muted\">{$item->user->email}</small>";
              })
            ->addColumn('action', function($item){
                return view('ladmin::logable._table_buttons', ['item' => $item]);
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
            Column::make('created_at')->title(__('Date')),
            Column::make('type'),
            Column::make('logable_type')->title(__('Model')),
            Column::make('user.name')->title(__('User')),
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
    public function query(LadminLogable $model)
    {
        return $model->with('user')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('logable-table')
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
        return 'log_' . date('YmdHis');
    }

    // public function render() {
    //   return $this->eloquent(LadminLogable::with('user'))
    //   ->editColumn('logable_type', function($item) {
    //       return $item->logable_type;
    //     })
    //     ->editColumn('type', function($item) {
    //       return '<span class="badge badge-' . ($item->colors[$item->type] ?? 'warning') . '">' . ucwords($item->type) . '</span>';
    //     })
    //   ->editColumn('created_at', function($item) {
    //     return $item->created_at->format('d/m/y H:i') . ' - ' . $item->created_at->diffForHumans();
    //   })
    //   ->editColumn('user.name', function($item) {
    //       return "<strong class=\"m-0 p-0\">{$item->user->name}</strong><br><small class=\"text-muted\">{$item->user->email}</small>";
    //     })
    //     ->addColumn('action', function($item){
    //       return view('ladmin::logable._table_buttons', ['item' => $item]);
    //     })
    //     ->escapeColumns([])
    //     ->make(true);
    // }

    // public function options() {

    //   return [
    //     'title' => 'List Of Activity',

    //     'foos' => [ // Custom data array. You can call in your blade with variable $foos
    //       'bar' => 'baz',
    //       'baz' => 'bar',
    //     ],
    //     'buttons' => view('ladmin::logable._button_delete'),
    //     'options' => [
    //       'processing' => true,
    //       'serverSide' => true,
    //       "order" => [[0, "desc"]],
    //       'ajax' => request()->fullurl(),
    //       'columns' => [
    //         ['data' => 'created_at'],
    //         ['data' => 'type', 'class' => 'text-center'],
    //         ['data' => 'logable_type'],
    //         ['data' => 'user.name'],
    //         ['data' => 'action', 'class' => 'text-right'],
    //       ]
    //     ]
    //   ];

    // }

  }
