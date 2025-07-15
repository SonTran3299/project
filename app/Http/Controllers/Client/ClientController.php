<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function loadCategory()
    {
        return DB::table('product_category')->orderBy('name', 'asc')->get();
    }

    public function shop(Request $request)
    {
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

        if (!$searchQuery) {
            $dataProduct = Product::orderBy($column,  $sort)->whereBetween('price', [$minPrice, $maxPrice])->paginate($itemPerPage);
        } else {
            $dataProduct = Product::where('name', 'LIKE', "%$searchQuery%")->orderBy($column,  $sort)->whereBetween('price', [$minPrice, $maxPrice])->paginate($itemPerPage);
        }

        return view('client.pages.shop', ['dataProduct' => $dataProduct, 'dataCategory' => $this->loadCategory()]);
    }

    public function detail(Product $product)
    {
        return view('client.pages.detail', ['data' => $product, 'dataCategory' => $this->loadCategory()]);
    }

    public function contact()
    {
        return view('client.pages.contact', ['dataCategory' => $this->loadCategory()]);
    }

    // public function login()
    // {
    //     return view('client.pages.user.login');
    // }

    // public function register()
    // {
    //     return view('client.pages.user.register');
    // }
}
