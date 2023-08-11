<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Facades\XenditServices;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Transaction\Entities\Transaction;
use Modules\Transaction\Entities\TransactionDestination;
use Modules\Transaction\Entities\TransactionItems;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $trx = Transaction::selectRaw('*, month(str_to_date(date, "%Y-%m-%d")) as modified_date')->get();
        $trxDest = TransactionDestination::selectRaw('DISTINCT email, MONTH(created_at) as modified_month')->get();
        $trxItem = TransactionItems::selectRaw('product_detail_id ,COUNT(product_detail_id) as sales')->groupBy('product_detail_id')->orderBy('sales', 'desc')->get();

        $totalLastMonthBefore = $trx->where('modified_date', date('m')-2)->sum('grand_total');
        $totalLastMonth = $trx->where('modified_date', date('m')-1)->sum('grand_total');
        $totalThisMonth = $trx->where('modified_date', date('m'))->sum('grand_total');


        $diffTotalGrandBefore = ($totalLastMonthBefore - $totalLastMonth);
        $diffTotalGrand = ($totalLastMonth - $totalThisMonth);
        // $diffTotalBefore = round(( $diffTotalGrandBefore / $totalLastMonth) * 100);
        // $diffTotal = round(( $diffTotalGrand / $totalThisMonth) * 100);

        $diffTotalBefore = ($totalLastMonthBefore !== 0) ? round(($diffTotalGrandBefore / $totalLastMonthBefore) * 100) : 0;
        $diffTotal = ($totalThisMonth !== 0) ? round(($diffTotalGrand / $totalThisMonth) * 100) : 0;

        $totalCustThisMonth = $trxDest->where('modified_date', date('m'))->count();
        $totalCustLastMonth = $trxDest->where('modified_date', date('m')-1)->count();
        $listRows = array(
            array(
                'icon' => 'icons/duotune/maps/map004.svg',
                'title' => 'Sales',
                'description' => 'This month',
                'stats' => 'Rp. '.rupiah_format($totalThisMonth),
                'arrow' => $totalLastMonth >= $totalThisMonth ? 'down' : 'up',
            ),
            array(
                'icon' => 'icons/duotune/general/gen024.svg',
                'title' => 'Customer',
                'description' => 'Unique Customer this month',
                'stats' => $totalCustThisMonth.' User',
                'arrow' => $totalCustLastMonth >= $totalCustThisMonth ? 'down' : 'up'
            ),
            array(
                'icon' => 'icons/duotune/electronics/elc005.svg',
                'title' => 'Growth',
                'description' => $diffTotal.'% Rate',
                'stats' => 'Rp. '.rupiah_format($diffTotalGrand),
                'arrow' => $diffTotalBefore >= $diffTotal ? 'down' : 'up',
            ),
            array(
                'icon' => 'icons/duotune/general/gen005.svg',
                'title' => 'Product Sales',
                'description' => 'Total product sales',
                'stats' => count($trxItem).' Items',
            )
        );

        $brandItem = TransactionItems::selectRaw('brands.brand_title as title, brands.brand_image as image, count(distinct(product_details.product_id)) as total_product,sum(transaction_items.price) as badge')
            ->leftJoin('product_details', 'product_detail_id', '=', 'product_details.id')
            ->leftJoin('brands', 'product_details.brand_id', '=', 'brands.id')
            ->groupBy('brands.id')
            ->get();

        $totalTransaction = Transaction::get()->count();
        $trxList = Transaction::selectRaw('
            transactions.token,
            transactions.date,
            transactions.type,
            transactions.method,
            transactions.status,
            transactions.grand_total,
            transaction_destinations.first_name,
            transaction_destinations.last_name,
            transaction_destinations.email,
            regions.province,
            regions.district,
            regions.subdistrict,
            regions.post_code
            ')
                ->leftJoin('transaction_destinations', 'transactions.id', '=', 'transaction_destinations.transaction_id')
                ->leftJoin('regions', 'regions.region_id', '=', 'transaction_destinations.region_id')
                ->orderBy('transactions.updated_at', 'desc')
                ->limit(5)
                ->get();


            $monthlySum = Transaction::selectRaw('DATE_FORMAT(STR_TO_DATE(date, "%Y-%m-%d"), "%M") as month_name, SUM(grand_total) as total_grand')
                ->groupBy('month_name')
                ->get();
            // $monthlySum = Transaction::selectRaw('
            //     DATE_FORMAT(STR_TO_DATE(date, "%Y-%m-%d"), "%M") as month_name,
            //     CASE
            //         WHEN SUM(grand_total) >= 1000000000 THEN CONCAT(ROUND(SUM(grand_total) / 1000000000, 1), " m")
            //         WHEN SUM(grand_total) >= 1000000 THEN CONCAT(ROUND(SUM(grand_total) / 1000000, 1), " jt")
            //         WHEN SUM(grand_total) >= 1000 THEN CONCAT(ROUND(SUM(grand_total) / 1000, 1), " rb")
            //         ELSE SUM(grand_total)
            //     END as total_grand')
            //     ->groupBy('month_name')
            //     // ->orderBy(DB::raw('MONTH(STR_TO_DATE(date, "%Y-%m-%d"))'))
            //     ->get();

        $monthlySumArray = $monthlySum->pluck('total_grand', 'month_name')->toArray();

        $data['panel_1'] = [
            'class' => 'card-xxl-stretch',
            'xendit_balance' => XenditServices::getBalance(),
            'listRows' => $listRows
        ];

        $data['panel_2'] = [
            'color' => 'primary',
            'class' => 'card-xxl-stretch',
            'listRows' => $brandItem->toArray(),
            'items' => $brandItem->count() ?? 0,
        ];

        $data['panel_3'] = [
            'class' => 'card-xxl-stretch',
            'total_order' => $totalTransaction,
            'tableRows' => $trxList
        ];

        $data['panel_5'] = [
            'total_trx' => $totalTransaction,
            'class' => 'card-xxl-stretch',
            'chartColor' => 'danger',
            'chartHeight' => '200px',
            'month' => array_keys($monthlySumArray),
            'values' => array_values($monthlySumArray)
        ];

        return view('dashboard::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
