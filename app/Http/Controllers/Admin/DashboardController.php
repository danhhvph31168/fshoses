<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DashboardCateExport;
use App\Exports\DashboardExport;
use App\Http\Controllers\Controller;
use App\Services\DashBoard\HandleChartServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function __construct(public HandleChartServices $handleChartServices) {}

    public function orderStatistical(Request $request)
    {
        // date today
        $dataDate = [];
        $dataDate = $this->handleChartServices->handleFilterDay($request, $dataDate);

        // xử lý biểu đồ apexcharts
        $currentYear = Carbon::now()->year;

        $totalAmounts = [];
        $orderCounts = [];
        $orderCountsCancel = [];
        $productCounts = [];

        [$totalAmounts, $orderCounts, $orderCountsCancel, $productCounts] =
            $this->handleChartServices->handleChart($request, $currentYear, $totalAmounts, $orderCounts, $orderCountsCancel, $productCounts);

        // xử lý thống kê map
        $orderPercentages = [];
        $orderPercentages = $this->handleChartServices->handleMap($orderPercentages);

        // xử lý best selling product
        $topProducts = $this->handleChartServices->handleSellingProduct($request, perPage: 5);
        $topCategory = $this->handleChartServices->handleSellingProduct($request, perPage: 5);
        $topProducts = $topProducts[0];
        $topCategory = $topCategory[1];

        // dd($this->handleChartServices->handleSellingProduct($request, perPage: null)[1]->collect());

        return view(
            "admin/dashboard",
            compact(
                'totalAmounts',
                'orderCounts',
                'currentYear',
                'orderPercentages',
                'orderCountsCancel',
                'productCounts',
                'dataDate',
                'topProducts',
                'topCategory',
            )
        );
    }

    public function exportProduct(Request $request)
    {
        return Excel::download(new DashboardExport($this->handleChartServices->handleSellingProduct($request, perPage: null)[0]->collect()), 'product.xlsx');
    }

    public function exportCategory(Request $request)
    {
        return Excel::download(new DashboardCateExport($this->handleChartServices->handleSellingProduct($request, perPage: null)[1]->collect()), 'category.xlsx');
    }
}
