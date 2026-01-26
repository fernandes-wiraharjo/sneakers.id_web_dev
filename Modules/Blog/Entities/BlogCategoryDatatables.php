<?php

namespace Modules\Blog\Entities;

use Modules\Blog\Entities\BlogCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogCategoryDatatables extends DataTable
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
            ->rawColumns(['action', 'is_show_home', 'is_show_single_post', 'is_show_search'])
            ->addColumn('is_show_home', function ($item) {
                return $item->is_show_home ? "<span class='badge badge-primary'>Yes</span>" : "<span class='badge badge-light-dark'>No</span>";
            })
            ->addColumn('is_show_single_post', function ($item) {
                return $item->is_show_single_post ? "<span class='badge badge-primary'>Yes</span>" : "<span class='badge badge-light-dark'>No</span>";
            })
            ->addColumn('is_show_search', function ($item) {
                return $item->is_show_search ? "<span class='badge badge-primary'>Yes</span>" : "<span class='badge badge-light-dark'>No</span>";
            })
            ->addColumn('action', function ($item) {
                if($item->blogs()->count() > 0){
                    $type = 'restrict';
                }
                return view('back-office.components.action-burger', [
                    'show' => null,
                    'edit' => [
                      'gate' => 'administrator.blog.category.update',
                      'url' => route('administrator.blog.category.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => [
                      'gate' => 'administrator.blog.category.destroy',
                      'url' => route('administrator.blog.category.destroy', [$item->id, 'back' => request()->fullUrl()]),
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
            Column::make('id'),
            Column::make('name'),
            Column::make('is_show_home')
                ->title(__('Show Home'))
                ->searchable(false)
                ->sortable(false),
            Column::make('sequence'),
            Column::make('is_show_single_post')
                ->title(__('Show Single Post'))
                ->searchable(false)
                ->sortable(false),
            Column::make('sequence_single_post')
                ->title(__('Sequence Single Post')),
            Column::make('is_show_search')
                ->title(__('Show Search'))
                ->searchable(false)
                ->sortable(false),
            Column::make('sequence_search')
                ->title(__('Sequence Search')),
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
     * @param \Modules\Blog\Entities\BlogCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BlogCategory $model)
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
                    ->setTableId('blog-category-table')
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
        return 'BlogCategory_' . date('YmdHis');
    }
}

