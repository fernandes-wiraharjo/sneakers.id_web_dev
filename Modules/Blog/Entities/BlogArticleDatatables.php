<?php

namespace Modules\Blog\Entities;

use Modules\Blog\Entities\Blog;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BlogArticleDatatables extends DataTable
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
            ->rawColumns(['action', 'is_carousel', 'is_active', 'featured_image', 'category'])
            ->editColumn('featured_image', function ($item) {
                return '<div class="text-center px-4">
                    <img class="mw-75 card-rounded" alt="" src="'.($item->featured_image_url ?? '') .'" style="max-width: 100px; max-height: 100px; object-fit: cover;"/>
                </div>';
            })
            ->addColumn('category', function ($item) {
                return $item->category ? $item->category->name : '-';
            })
            ->addColumn('is_carousel', function ($item) {
                return $item->is_carousel ? "<span class='badge badge-primary'>Yes</span>" : "<span class='badge badge-light-dark'>No</span>";
            })
            ->addColumn('is_active', function ($item) {
                return $item->is_active ? "<span class='badge badge-primary'>Active</span>" : "<span class='badge badge-light-dark'>Not Active</span>";
            })
            ->addColumn('action', function ($item) {
                return view('back-office.components.action-burger', [
                    'show' => null,
                    'edit' => [
                      'gate' => 'administrator.blog.article.update',
                      'url' => route('administrator.blog.article.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => [
                      'gate' => 'administrator.blog.article.destroy',
                      'url' => route('administrator.blog.article.destroy', [$item->id, 'back' => request()->fullUrl()])
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
            Column::make('featured_image')
                ->title(__('Image'))
                ->width(120)
                ->sortable(false)
                ->searchable(false),
            Column::make('title'),
            Column::make('slug'),
            Column::make('category')
                ->title(__('Category'))
                ->searchable(false)
                ->sortable(false),
            Column::make('author'),
            Column::make('is_carousel')
                ->title(__('Carousel'))
                ->searchable(false)
                ->sortable(false),
            Column::make('is_active')
                ->title(__('Status'))
                ->searchable(false)
                ->sortable(false),
            Column::make('visitor_count')
                ->title(__('Visitors')),
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
     * @param \Modules\Blog\Entities\Blog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Blog $model)
    {
        return $model->newQuery()->with('category');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('blog-article-table')
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
        return 'BlogArticle_' . date('YmdHis');
    }
}

