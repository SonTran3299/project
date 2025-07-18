<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends ClientController
{
    public function index()
    {
        $newProduct = Product::orderBy('id',  'desc')->take(8)->get();
        $outstandingProducts = Product::orderBy('id',  'asc')->take(8)->get();
        //dd($this->loadProductInCategory());
        return view('client.pages.home', [
            'newProduct' => $newProduct,
            'outstandingProducts' => $outstandingProducts,     
            'categoryDemo' => $this->loadCategoryHome(),
            'productCounts' => $this->loadProductInCategory()
        ]);
    }
    public function loadCategoryHome()
    {
        return ProductCategory::orderBy('id',  'desc')->take(6)->get();
    }

    public function loadProductInCategory(){
        //return DB::select('select product_category_id, COUNT(*) as soluong from product GROUP By product_category_id');
        $counts = DB::table('product') 
                      ->select('product_category_id', DB::raw('COUNT(*) as soluong'))
                      ->groupBy('product_category_id')
                      ->get();

        $productCounts = [];
        foreach ($counts as $count) {
            $productCounts[$count->product_category_id] = $count->soluong;
        }
        return $productCounts;
    }
}