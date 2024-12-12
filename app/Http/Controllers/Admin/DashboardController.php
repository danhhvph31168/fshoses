<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashBoard\HandleChartServices;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $topProducts = $this->handleChartServices->handleSellingProduct($request);
        $topCategory = $this->handleChartServices->handleSellingProduct($request);
        $topProducts = $topProducts[0];
        $topCategory = $topCategory[1];

        // dd($dataDate);

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
}