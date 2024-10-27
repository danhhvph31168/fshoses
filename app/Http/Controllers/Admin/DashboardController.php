<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Refund;
use App\Services\DashBoard\HandleChartServices;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(public HandleChartServices $handleChartServices) {}

    public function orderStatistical(Request $request)
    {
        // xử lý biểu đồ apexcharts
        $currentYear = Carbon::now()->year;

        $totalAmounts = [];
        $orderCounts = [];
        $refundCounts = [];
        $orderCountsCancel = [];

        [$totalAmounts, $orderCounts, $refundCounts, $orderCountsCancel] = $this->handleChartServices->handleChart($request, $currentYear, $totalAmounts, $orderCounts, $refundCounts, $orderCountsCancel);

        // xử lý thống kê map
        $orderPercentages = [];
        [$orderPercentages] = $this->handleChartServices->handleMap($orderPercentages);

        return view("admin/dashboard", compact('totalAmounts', 'orderCounts', 'refundCounts', 'currentYear', 'orderPercentages', 'orderCountsCancel'));
    }
}
