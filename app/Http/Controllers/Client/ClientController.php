<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    // public function loadCategory()
    // {
    //     return DB::table('product_category')->orderBy('name', 'asc')->get();
    // }

    public function shop(Request $request)
    {
        $categoryId = $request->query('category-filter') ?? null;
        $searchQuery = $request->query('query') ?? null;

        $sort  = $request->sort ?? 'latest';
        $arraySort = ['id', 'desc'];

        $maxPrice = $request->query('max_price') ?? Product::max('price');
        $minPrice = $request->query('min_price') ?? 0;

        if ($sort === 'oldest') {
            $arraySort = ['id', 'asc'];
        }

        [$column, $sort] = $arraySort;

        $itemPerPage = config('my-config.client_product_per_page');

        $query = Product::orderBy($column, $sort)->whereBetween('price', [$minPrice, $maxPrice]);
        if ($categoryId) {
            $query->where('product_category_id', $categoryId);
        }
        if ($searchQuery) {
            $query->where('name', 'LIKE', "%$searchQuery%");
        }
        $dataProduct = $query->paginate($itemPerPage);

        return view('client.pages.shop', ['dataProduct' => $dataProduct]);
    }

    public function detail(Product $product)
    {
        return view('client.pages.detail', ['data' => $product]);
    }

    public function contact()
    {
        return view('client.pages.contact');
    }

    public function orderHistory()
    {
        $userId = Auth::user()->id;
        $dataOrder = Order::where('user_id', $userId)->with('orderItems', 'orderPaymentMethods')->get();
        return view('client.pages.order_history', ['dataOrder' => $dataOrder]);
    }
}
