<?php

namespace App\Services\DashBoard;

use App\Models\{Order, Refund,};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @package App\Services\DashBoard
 */
class HandleChartServices
{
    public function handleChart(Request $request, $currentYear, $totalAmounts, $orderCounts, $refundCounts, $orderCountsCancel)
    {

        if (isset($request->filteryear)) {
            for ($month = 1; $month <= 12; $month++) {
                $totalAmounts[] = Order::query()
                    ->where('status_order', Order::STATUS_ORDER_DELIVERED)
                    ->whereYear('created_at', $request->filteryear)
                    ->whereMonth('created_at', $month)
                    ->sum('total_amount');

                $orderCounts[] = Order::query()
                    ->where('status_order', Order::STATUS_ORDER_DELIVERED)
                    ->whereYear('created_at', $request->filteryear)
                    ->whereMonth('created_at', $month)
                    ->count();

                $orderCountsCancel[] = Order::query()
                    ->where('status_order', Order::STATUS_ORDER_CANCELED)
                    ->whereYear('created_at', $request->filteryear)
                    ->whereMonth('created_at', $month)
                    ->count();

                $refundCounts[] = Refund::query()
                    ->whereYear('created_at', $request->filteryear)
                    ->whereMonth('created_at', $month)
                    ->count();
            }
        } else {
            for ($month = 1; $month <= 12; $month++) {
                $totalAmounts[] = Order::query()
                    ->where('status_order', Order::STATUS_ORDER_DELIVERED)
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $month)
                    ->sum('total_amount');

                $orderCounts[] = Order::query()
                    ->where('status_order', Order::STATUS_ORDER_DELIVERED)
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $month)
                    ->count();

                $orderCountsCancel[] = Order::query()
                    ->where('status_order', Order::STATUS_ORDER_CANCELED)
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $month)
                    ->count();

                $refundCounts[] = Refund::query()
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $month)
                    ->count();
            }
        }

        return [$totalAmounts, $orderCounts, $refundCounts, $orderCountsCancel];
    }

    public function handleMap($orderPercentages)
    {
        $orderCount3 = Order::query()
            ->select('user_address', DB::raw('count(*) as total'))
            ->where('status_order', Order::STATUS_ORDER_DELIVERED)
            ->groupBy('user_address')
            ->limit(3)
            ->orderByDesc('total')
            ->get();

        $totalOrders = Order::query()
            ->where('status_order', Order::STATUS_ORDER_DELIVERED)->count();

        foreach ($orderCount3 as $item) {
            $orderPercentages[$item->user_address] = $totalOrders > 0 ? ($item->total / $totalOrders) * 100 : 0;
        }

        return [$orderPercentages];
    }
}
