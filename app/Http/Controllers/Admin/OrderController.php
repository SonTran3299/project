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

        if ($filter !== null && $filter !== '') {
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
        if ($order->status === 0) {
            $order->status = $request->status;
        } elseif ($order->status === 1) {
            $order->status = $request->status;
        } elseif ($order->status === 2) {
            $order->status = $request->status;
        } elseif ($order->status === 3) {
            $order->status = $request->status;
        } elseif ($order->status === 4) {
            $order->status = $request->status;
        } elseif ($order->status === 5) {
            $order->status = $request->status;
        }

        $check = $order->save() ? 'Cập nhật đơn hàng thành công' : 'Cập nhật đơn hàng thất bại';
        return redirect()->route('admin.order.list')->with('msg', $check);
    }
}
