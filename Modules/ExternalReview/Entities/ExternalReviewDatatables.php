<?php

namespace Modules\ExternalReview\Entities;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ExternalReviewDatatables extends DataTable
{
  public function dataTable($query)
  {
    return datatables()
      ->eloquent($query)
      ->addIndexColumn()
      ->rawColumns(['action', 'status', 'review_link', 'product'])
      ->addColumn('product', function ($item) {
        $product = $item->product;
        if (! $product) {
          return '-';
        }

        return e($product->product_name) . '<br><small class="text-muted">' . e($product->product_code) . '</small>';
      })
      ->addColumn('review_link', function ($item) {
        $url = $item->review_url;

        return '<div class="d-flex align-items-center gap-2">
            <input type="text" class="form-control form-control-sm" value="' . e($url) . '" readonly id="link-' . $item->id . '">
            <button type="button" class="btn btn-sm btn-light-primary" onclick="copyLink(' . $item->id . ')">Copy</button>
        </div>';
      })
      ->addColumn('status', function ($item) {
        if ($item->isUsed()) {
          return '<span class="badge badge-success">Used</span>';
        }

        return '<span class="badge badge-warning">Pending</span>';
      })
      ->addColumn('action', function ($item) {
        return view('back-office.components.action-burger', [
          'show' => null,
          'edit' => null,
          'destroy' => $item->isUsed() ? null : [
            'gate' => 'administrator.external-review.destroy',
            'url' => route('administrator.external-review.destroy', [$item->id, 'back' => request()->fullUrl()]),
          ],
        ]);
      });
  }

  protected function getColumns()
  {
    return [
      Column::make('buyer_name')->title('Buyer Name'),
      Column::computed('product')->title('Product'),
      Column::make('product_size')->title('Size'),
      Column::computed('review_link')->title('Review Link')->width(300),
      Column::computed('status')->title('Status')->width(100),
      Column::make('created_at')->title('Created'),
      Column::computed('action')
        ->sortable(false)
        ->searchable(false)
        ->exportable(false)
        ->printable(false)
        ->width(80)
        ->addClass('text-center'),
    ];
  }

  public function query(ExternalReviewLink $model)
  {
    return $model->newQuery()->with('product')->latest();
  }

  public function html()
  {
    return $this->builder()
      ->setTableId('external-review-table')
      ->columns($this->getColumns())
      ->minifiedAjax()
      ->dom('frtip')
      ->orderBy(5, 'desc')
      ->responsive(true)
      ->parameters(['scrollX' => true])
      ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
  }

  protected function filename()
  {
    return 'ExternalReview_' . date('YmdHis');
  }
}
