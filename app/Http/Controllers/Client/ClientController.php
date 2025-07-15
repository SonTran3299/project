<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        $dataProduct = Product::orderBy('id',  'desc')->take(8)->get();
        return view('client.pages.home', ['dataProduct' => $dataProduct,'dataCategory' => $this->loadCategory()]);
    }

    public function shop(Request $request)
    {
        $searchQuery = $request->query('query') ?? null;

        $sort  = $request->sort ?? 'latest';
        $arraySort = ['id', 'desc'];

        $minPrice = 0;
        $maxPrice = 100;
        //SELECT *  FROM `product` WHERE `price` BETWEEN 8 AND 100000000;
        if ($sort === 'oldest') {
            $arraySort = ['id', 'asc'];
        }

        [$column, $sort] = $arraySort;

        // $itemPerPage = config('my-config.item_per_page');
        $itemPerPage = 9;
        if (!$searchQuery) {
            $dataProduct = Product::orderBy($column,  $sort)->paginate($itemPerPage);
        } else {
            $dataProduct = Product::where('name', 'LIKE', "%$searchQuery%")->orderBy($column,  $sort)->paginate($itemPerPage);
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

    public function loadCategory()
    {
        return DB::table('product_category')->orderBy('name', 'asc')->get();
    }

    public function login()
    {
        return view('client.pages.user.login');
    }

    public function register()
    {
        return view('client.pages.user.register');
    }
}
