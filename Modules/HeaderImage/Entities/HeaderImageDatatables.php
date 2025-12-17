<?php

namespace Modules\HeaderImage\Entities;

use Modules\HeaderImage\Entities\HeaderImage;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

  class HeaderImageDatatables extends DataTable {
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
            ->rawColumns(['action', 'status', 'image_url'])
            ->editColumn('image_url', function ($item) {
                $imageUrl = $item->image_url ?? '';
                if (empty($imageUrl)) {
                    return '<span class="text-muted">No image</span>';
                }
                
                return '<div class="d-flex flex-column align-items-start gap-3">
                    <img src="' . e($imageUrl) . '" 
                         alt="Header Image" 
                         class="rounded" 
                         style="width: 160px; height: 60px; object-fit: cover; cursor: pointer;"
                         onclick="window.open(\'' . e($imageUrl) . '\', \'_blank\')"
                         onerror="this.src=\'/images/placeholder.png\'; this.onerror=null;">
                    <div title="' . e($imageUrl) . '">
                        <a href="' . e($imageUrl) . '" target="_blank" class="small">
                            ' . e($imageUrl) . '
                        </a>
                    </div>
                </div>';
            })
            ->addColumn('status', function ($item) {
              return $item->is_active ? "<span class='badge badge-primary'>Active</span>" : "<span class='badge badge-light-dark'>Not Active</span>";
            })
            ->addColumn('action', function ($item) {
                return view('back-office.components.action-burger', [
                    'show' => null,
                    'edit' => [
                      'gate' => 'administrator.master-data.header-image.update',
                      'url' => route('administrator.master-data.header-image.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => [
                      'gate' => 'administrator.master-data.header-image.destroy',
                      'url' => route('administrator.master-data.header-image.destroy', [$item->id, 'back' => request()->fullUrl()]),
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
            Column::make('image_url')
                ->title('Image')
                ->sortable(false)
                ->searchable(true),
            Column::make('menu_name'),
            Column::make('menu_parent_name'),
            Column::make('status')
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
    public function query(HeaderImage $model)
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
                    ->setTableId('header_image-table')
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
        return 'HeaderImage_' . date('YmdHis');
    }
  }
