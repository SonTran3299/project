<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        return view(
            'admin.pages.dashboard.index',
            [
                'productSold' => self::soldProducts($month, $year),
                'countOrder' => self::countNewOrder(),
                'countUser' => User::count() - 1,
                'successRate' => self::caculateSuccessfulDeliveryRate(),
                'sales' => self::caculateIncome($month, $year),
            ]
        );
    }

    protected function countNewOrder()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
    }

    protected static function soldProducts(string|int $month, string|int $year)
    {
        $products = OrderItem::selectRaw('name, sum(quantity) as total')->whereMonth('updated_at', $month)
            ->whereYear('updated_at', $year)
            ->groupBy('name')->get();

        $chartData = [['Tên Sản phẩm', 'Số lượng đã bán']];
        foreach ($products as $item) {
            $chartData[] = [$item->name, (int) $item->total];
        }

        return $chartData;
    }

    protected static function caculateSuccessfulDeliveryRate(): float
    {
        $total = Order::whereIn('status', [3, 5])->count();
        $totalDelivered = Order::where('status', 3)->count();

        $rate = 0;
        if ($total > 0) {
            $rate = ($totalDelivered / $total) * 100;
        }
        return round($rate, 2);
    }

    protected static function caculateIncome(string|int $month, string|int $year): array
    {
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfDay();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth()->endOfDay();

        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();
        $products = OrderItem::whereBetween('updated_at', [$startDate, $endDate])->get();

        $gross_sale = 0;
        $discount = 0;
        $net_sale = 0;
        foreach ($products as $product) {
            $gross_sale += $product->price * $product->quantity;
            $discount += $product->price * $product->quantity * $product->discount_percentage;
        }

        $net_sale = $gross_sale - $discount;

        $expense = $discount + 0; //các khoản chi khác
        return [
            'netSale' => $net_sale,
            'grossSale' => $gross_sale,
            'expense' => $expense
        ];
    }
}
