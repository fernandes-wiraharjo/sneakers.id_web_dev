<?php

  namespace App\DataTables;
  use Yajra\DataTables\Html\Button;
  use Yajra\DataTables\Html\Column;
  use Yajra\DataTables\Html\Editor\Editor;
  use Yajra\DataTables\Html\Editor\Fields;
  use Yajra\DataTables\Services\DataTable;

  class UserDatatables extends DataTable {

    public function dataTable()
    {
        return datatables()->eloquent(
                app(config('ladmin.user', App\Models\User::class))->with(['roles'])
            )
            ->addColumn('avatar', function($item) {
                return view('components.table-image-avatar', compact('item'));
            })
            ->editColumn('roles.name', function($item) {
                return $item->roles->pluck('name');
            })
            ->addColumn('action', function($item) {
                return view('ladmin::table.action', [
                    'show' => null,
                    'edit' => [
                    'gate' => 'administrator.account.admin.update',
                    'url' => route('administrator.account.admin.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => null
                    // [
                    // 'gate' => 'administrator.account.admin.destroy',
                    // 'url' => route('administrator.account.admin.destroy', [$item->id, 'back' => request()->fullUrl()]),
                    // ]
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
            Column::make('avatar')->title(__('Avatar')),
            Column::make('name'),
            Column::make('email'),
            Column::make('roles.name')->title(__('Role')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->responsive(true)
            ->parameters([
                'buttons' => [],
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
