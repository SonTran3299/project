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
    public function index()
    {
        return view(
            'admin.dashboard.index',
            [
                'productSold' => $this->soldProducts(),
                'countOrder' => $this->countNewOrder(),
                'countUser' => $this->countUser(),
                'successRate' => self::successfulDeliveryRate()
            ]
        );
    }

    protected function countNewOrder()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
    }

    protected function countUser()
    {
        return User::count() - 1;
    }

    protected function soldProducts()
    {
        $products = OrderItem::selectRaw('name, sum(quantity) as total')
            ->groupBy('name')->get();

        $chartData = [['Tên Sản phẩm', 'Số lượng đã bán']];
        foreach ($products as $item) {
            $chartData[] = [$item->name, (int) $item->total];
        }

        return $chartData;
    }

    protected static function successfulDeliveryRate()
    {
        $total = Order::whereIn('status', [3, 5])->count();
        $totalDelivered = Order::where('status', 3)->count();

        $rate = 0; 
        if ($total > 0) {
            $rate = ($totalDelivered / $total) * 100; 
        }
        return round($rate, 2);
    }
}
