<?php

namespace App\Services\DashBoard;

use App\Models\{Order, OrderItem, Product};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @package App\Services\DashBoard
 */
class HandleChartServices
{
    public function handleFilterDay(Request $request, $dataDate)
    {
        if ($request->dateStart || $request->dateEnd) {
            if ($request->dateStart > $request->dateEnd && $request->dateEnd) {
                toastr()->error('Start date must be less than end date');
            }

            if ($request->dateStart > Carbon::today()) {
                toastr()->error('Do not select a future start date');
            }

            if ($request->dateEnd > Carbon::today()) {
                toastr()->error('Do not select an end date in the future');
            }
        }

        // code old logs/backuphandleChartServices.txt
        $filterDate = function ($query, $dateStart, $dateEnd) {
            if ($dateStart && $dateEnd) {
                return $query->whereBetween(DB::raw('DATE(created_at)'), [$dateStart, $dateEnd]);
            } elseif ($dateStart || $dateEnd) {
                return $query->whereDate('created_at', $dateStart ?: $dateEnd);
            } else {
                return $query->whereDate('created_at', today());
            }
        };

        $dataDate = [
            'filterDayOrder' => $filterDate(Order::where('status_order', Order::STATUS_ORDER_DELIVERED), $request->dateStart, $request->dateEnd)->count(),
            'filterDayOrderCancel' => $filterDate(Order::where('status_order', Order::STATUS_ORDER_CANCELED), $request->dateStart, $request->dateEnd)->count(),
            'filterDayEarning' => $filterDate(Order::where('status_order', Order::STATUS_ORDER_DELIVERED), $request->dateStart, $request->dateEnd)->sum('total_amount'),
            'filterDayProduct' => $filterDate(OrderItem::whereHas('order', function ($query) {
                $query->where('status_order', Order::STATUS_ORDER_DELIVERED);
            }), $request->dateStart, $request->dateEnd)->count(),
        ];

        return $dataDate;
    }

    public function handleChart(Request $request, $currentYear, $totalAmounts, $orderCounts, $orderCountsCancel, $productCounts)
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

                $productCounts[] = OrderItem::query()->whereHas('order', function ($query) {
                    $query->where('status_order', Order::STATUS_ORDER_DELIVERED);
                })->whereYear('created_at', $request->filteryear)
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

                $productCounts[] = OrderItem::query()->whereHas('order', function ($query) {
                    $query->where('status_order', Order::STATUS_ORDER_DELIVERED);
                })->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $month)
                    ->count();
            }
        }

        return [$totalAmounts, $orderCounts, $orderCountsCancel, $productCounts];
    }

    public function handleMap($orderPercentages)
    {
        $orderCount3 = Order::query()
            ->select('user_province', DB::raw('count(*) as total'))
            ->where('status_order', Order::STATUS_ORDER_DELIVERED)
            ->groupBy('user_province')
            ->limit(3)
            ->orderByDesc('total')
            ->get();

        $totalOrders = Order::query()
            ->where('status_order', Order::STATUS_ORDER_DELIVERED)->count();

        foreach ($orderCount3 as $item) {
            $orderPercentages[$item->user_province] = $totalOrders > 0 ? ($item->total / $totalOrders) * 100 : 0;
        }

        return $orderPercentages;
    }

    public function handleSellingProduct(Request $request)
    {
        if ($request->has('fillterProduct')) {
            session(['fillterProduct' => $request->fillterProduct]);
        }

        if (!isset($request->page) && !isset($request->fillterProduct)) {
            session()->forget('fillterProduct');
        }

        $filterProduct = function ($query, $filProduct) {
            if ($filProduct == 'today') {
                return $query->whereDate('orders.created_at', Carbon::now())->paginate(5);
            } else if ($filProduct == 'yesterday') {
                return $query->whereDate('orders.created_at', Carbon::yesterday())->paginate(5);
            } else if ($filProduct == 'last_7_days') {
                return $query->whereBetween(DB::raw('DATE(orders.created_at)'), [Carbon::now()->subDays(7), Carbon::now()])->paginate(5);
            } else if ($filProduct == 'last_30_days') {
                return $query->whereBetween(DB::raw('DATE(orders.created_at)'), [Carbon::now()->subDays(30), Carbon::now()])->paginate(5);
            } else if ($filProduct == 'this_month') {
                return $query->whereBetween(DB::raw('DATE(orders.created_at)'), [Carbon::now()->startOfMonth(), Carbon::now()])->paginate(5);
            } else if ($filProduct == 'last_month') {
                return $query->whereBetween(DB::raw('DATE(orders.created_at)'), [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->paginate(5);
            } else if ($filProduct == 'last_year') {
                return $query->whereBetween(DB::raw('DATE(orders.created_at)'), [Carbon::now()->subDays(365), Carbon::now()])->paginate(5);
            } else {
                return $query->paginate(5);
            }
        };

        // data top product
        if (!$request->page) {
            $topProducts = $filterProduct(
                Product::query()
                    ->select(
                        'products.id',
                        'products.name',
                        'products.price_regular',
                        'products.price_sale',
                        'products.img_thumbnail',
                        'products.description',
                        DB::raw('SUM(order_items.quantity) as total_sold'),
                        DB::raw('count(orders.id) as count_orders'),
                        DB::raw('SUM(product_variants.quantity) as stock'),
                    )
                    ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
                    ->join('order_items', 'product_variants.id', '=', 'order_items.product_variant_id')
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->where('orders.status_order', Order::STATUS_ORDER_DELIVERED)
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('total_sold')
                    ->take(10),
                $request->fillterProduct
            );
        } else {
            $topProducts = $filterProduct(
                Product::query()
                    ->select(
                        'products.id',
                        'products.name',
                        'products.price_regular',
                        'products.price_sale',
                        'products.img_thumbnail',
                        'products.description',
                        DB::raw('SUM(order_items.quantity) as total_sold'),
                        DB::raw('SUM(orders.total_amount) as total_amount'),
                        DB::raw('count(orders.id) as count_orders'),
                        DB::raw('SUM(product_variants.quantity) as stock'),
                    )
                    ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
                    ->join('order_items', 'product_variants.id', '=', 'order_items.product_variant_id')
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->where('orders.status_order', Order::STATUS_ORDER_DELIVERED)
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('total_sold')
                    ->take(10),
                session('fillterProduct')
            );
        }


        // top Categories
        $topCategory = Product::query()
            ->select(
                'categories.name as category_name',
                'categories.id as category_id',
                'categories.image as category_image',
                'categories.description as category_description',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(orders.total_amount) as total_amount'),
                DB::raw('SUM(product_variants.quantity) as stock')
            )
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->join('order_items', 'product_variants.id', '=', 'order_items.product_variant_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status_order', Order::STATUS_ORDER_DELIVERED)
            ->groupBy('categories.id', 'categories.name', 'categories.image')
            ->orderByDesc('total_sold')
            ->take(6)
            ->get();

        return [$topProducts, $topCategory];
    }
}