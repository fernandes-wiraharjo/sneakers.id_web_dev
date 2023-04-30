<?php

namespace Modules\Product\Entities;

use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductTag;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDatatables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        //dd($query->get());
        return datatables()
            ->eloquent($query)
            // ->filter(function($q) {

            // })
            ->rawColumns(['action', 'id', 'product_name', 'tag', 'price', 'category', 'signature', 'status', 'qty'])
            ->editColumn('qty', function($item){
                return $item->details()->sum('qty');
            })
            ->addColumn('status', function ($item) {
                return $item->is_active ? "<span class='badge badge-primary'>Active</span>" : "<span class='badge badge-light-dark'>Not Active</span>";
              })
            ->addColumn('tag', function ($item) {
                if ($item->tags()->count() > 0) {
                    $result = "";
                    foreach($item->tags()->get() as $tag) {
                        $result .= view('components.chips', [
                            'a' => $tag->tag_title,
                            'b' => ''
                        ]);
                    }
                    return $result;
                } else {
                    return '-';
                }

            })
            ->addColumn('category', function ($item) {
                if ($item->categories()->count() > 0) {
                    $result = "";
                    foreach($item->categories()->get() as $category) {
                        $result .= view('components.chips', [
                            'a' => $category->category_title,
                            'b' => ''
                        ]);
                    }
                    return $result;
                } else {
                    return '-';
                }

            })
            ->addColumn('signature', function ($item) {
                if ($item->signatures()->count() > 0) {
                    $result = "";
                    foreach($item->signatures()->get() as $signature) {
                        $result .= view('components.chips', [
                            'a' => $signature->signature_title,
                            'b' => $signature->signature_player_name
                        ]);
                    }
                    return $result;
                } else {
                    return '-';
                }

            })
            ->editColumn('price', function($item) {
                $data = $item->details()->select('retail_price' ,'after_discount_price')->orderBy('retail_price')->first();
                $data->retail_price = intval($data->retail_price);
                $data->after_discount_price = intval($data->after_discount_price);

                if($data->retail_price > $data->after_discount_price && $data->after_discount_price > 0){
                    $prices = '<span><del>Rp. '.rupiah_format($data->retail_price ?? 0)."</del></span><br> "
                        ."<span>Rp.".rupiah_format($data->after_discount_price ?? 0)."</span>";
                } else {
                    $prices = 'Rp.' .rupiah_format($data->retail_price ?? 0);
                }

                return $prices;
            })
            ->editColumn('product_name', function ($item) {
                $image_url = $item->image;
                return "<span class='badge badge-primary'>".$item->brand->brand_title."</span>".
                '<div class="d-flex align-items-center">'.
                            '<a href="'.route('administrator.product.edit', [$item->id, 'back' => request()->fullUrl()]).'" class="symbol symbol-50px">'.
                                '<span class="symbol-label" style="background-image:url('.getImage($image_url ?? '' , 'products/'.$item->product_code).');"></span>'.
                            '</a>'.
                            '<div class="ms-5">'.
                                '<a href="'.route('administrator.product.edit', [$item->id, 'back' => request()->fullUrl()]).'"'.
                                ' class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="product_name">'.$item->product_name.'</a>'.
                            '</div>'.
                        '</div>';
            })
            ->editColumn('created_at', function (Product $model) {
                return $model->created_at->format('d-m-Y H:i');
            })
            ->editColumn('action', function ($item) {
                $item_tag_best_seller = ProductTag::with('tag')->where('product_id', $item->id)->whereHas('tag', function($q){
                    $q->where('tag_title', 'BEST SELLER');
                })->first();

                $item_tag_new_release = ProductTag::with('tag')->where('product_id', $item->id)->whereHas('tag', function($q){
                    $q->where('tag_title', 'NEW RELEASE');
                })->first();

                $best_seller = null;
                $new_release = null;

                if($item_tag_best_seller){
                    $best_seller = $item_tag_best_seller->tag()->first()->tag_title;
                }

                if($item_tag_new_release){
                    $new_release = $item_tag_new_release->tag()->first()->tag_title;
                }

                return view('components.action-burger', [
                    'show' => null,
                    'edit' => [
                      'gate' => 'administrator.product.update',
                      'url' => route('administrator.product.edit', [$item->id, 'back' => request()->fullUrl()])
                    ],
                    'destroy' => [
                      'gate' => 'administrator.product.destroy',
                      'url' => route('administrator.product.destroy', [$item->id]),
                      'tag' => ['best_seller' => $best_seller, 'new_release' => $new_release],
                      'type' => 'product'
                    ]
                ]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model
            ->with(['tags', 'detail'])
            ->whereHas('details')
            // ->crossJoin('product_details as pd', 'pd.product_id', '=', 'products.id')
            ->select('products.*')
            ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(1)
                    ->responsive(true)
                    ->parameters([
                        'scrollX' => true,
                        'processing' => true,
                        'serverSide' => true
                        ])
                    ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->sortable(false)
                ->searchable(false)
                ->width(150)
                ->addClass('text-center'),
            Column::make('product_code')
                ->title(__('Article Number')),
            Column::make('product_name')
                ->width(300),
            Column::make('qty')->width(50)
                ->searchable(false),
            Column::make('price')
                ->searchable(false),
            Column::make('tag')
                ->width(150)
                ->searchable(false)
                ->sortable(false),
            Column::make('category')
                ->width(150)
                ->searchable(false)
                ->sortable(false),
            Column::make('signature')
                ->width(150)
                ->searchable(false)
                ->sortable(false),
            Column::make('status')
                ->width(10)
                ->sortable(false)
                ->searchable(false),
        ];
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
