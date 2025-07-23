<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $productStatusCounts = Product::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $hideStatusCount = $productStatusCounts->get(0, 0); 
        $showStatusCount = $productStatusCounts->get(1, 0); 

        $productStatus = [
            ['Tình trạng', 'Trạng thái'],
            ['Ẩn', $hideStatusCount],
            ['Hiện', $showStatusCount]
        ];
        return view('admin.dashboard.index', ['productStatus' => $productStatus]);
    }
}
