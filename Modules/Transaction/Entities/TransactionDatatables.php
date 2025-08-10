<?php

namespace Modules\Transaction\Entities;


use App\Models\Region;
use App\Models\User;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductTag;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransactionDatatables extends DataTable
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
            ->rawColumns(['action'])
            ->editColumn('shipping_status', function ($item) {
                return $item->shipping->status ?? '-' ;
            })
            ->editColumn('method',  function ($item) {
                return $item->type.'-'.$item->method;
            })
            ->editColumn('customer_email',  function ($item) {
                return $item->email ?? '-';
            })
            ->editColumn('total_weight',  function ($item) {
                return $item->total_weight / 1000 . ' Kg';
            })
            ->editColumn('grand_total',  function ($item) {
                return 'Rp '.rupiah_format(intval($item->grand_total));
            })
            ->editColumn('created_at', function ($item) {
                return $item->created_at->format('d-m-Y H:i');
            })
            ->addColumn('action', function ($item) {
                // dd($item);
                $data['shipping'] = $item->shipping;
                $data['destination'] = $item->destination;
                $data['histories'] = $item->histories;
                $data['transaction'] = $item;
                $data['items'] = $item->items;
                $data['user_info'] = $item->getUserData;
                $data['user_address'] = $item->getUserData->user_address()->first();
                $data['region'] = Region::where('region_id', $data['user_address']->region_id ?? 18090)->first();
                return view('transaction::_partial.action-burger', $data);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaction $model)
    {
        return $model->with('destination', 'destination.user')
            ->select('transactions.*', 'transaction_destinations.email', 'transaction_destinations.transaction_id')
            ->leftJoin('transaction_destinations','transactions.id','=', 'transaction_destinations.transaction_id')
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
                    ->setTableId('transaction-table')
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
                ->width(300)
                ->addClass('text-center'),
            Column::make('date')
                ->title(__('Payment date')),
            Column::make('customer_email')
                ->name('destination.user.email')
                ->title('Customer Email')
                ->width(150)
                ->sortable(true)
                ->orderable(true) // Allow sorting on this column
                ->orderColumn('destination.user.email $1'),
            Column::make('grand_total')
                ->width(150)
                ->searchable(false),
            Column::make('total_quantity')->width(50)
                ->searchable(false),
            Column::make('total_weight')->width(50)
                ->searchable(false),
            Column::make('status')
                ->title('Order status')
                ->searchable(false),
            Column::make('method')
                ->width(150)
                ->searchable(false)
                ->sortable(false),
            Column::make('shipping_status')
                ->width(150)
                ->searchable(false)
                ->sortable(false),
            Column::make('created_at')
                ->width(150)
                ->searchable(false)
                ->sortable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Transaction_' . date('YmdHis');
    }
}
