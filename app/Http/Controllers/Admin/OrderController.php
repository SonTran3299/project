<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $filter  = $request->filter;
        $itemPerPage = config('my-config.item_per_page');
        $query = Order::orderBy('updated_at', 'desc')->with('user');

        if (!empty($filter) && $filter !== 'all') { 
            $query->where('status', $filter);
        }

        $datas = $query->paginate($itemPerPage);
        return view('admin.pages.order.list', ['datas' => $datas]);
    }

    public function detail(Order $order)
    {
        $data = Order::where('id', $order->id)->with('orderItems', 'orderPaymentMethods', 'user')->first();
        return view('admin.pages.order.detail', ['data' => $data]);
    }

    public function updateOrderStatus(Order $order, Request $request)
    {
        if ($order->status === 'chưa xác nhận') {
            $order->status = $request->status;
        } elseif ($order->status === 'xác nhận đơn hàng') {
            $order->status = $request->status;
        } elseif ($order->status === 'đang giao') {
            $order->status = $request->status;
        }

        $check = $order->save() ? 'Thành công' : 'Thất bại';
        return redirect()->route('admin.order.list')->with('msg', $check);
    }
}
