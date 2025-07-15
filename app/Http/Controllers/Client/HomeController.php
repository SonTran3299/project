<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends ClientController
{
    public function index()
    {
        $newProduct = Product::orderBy('id',  'desc')->take(8)->get();
        $outstandingProducts = Product::orderBy('id',  'asc')->take(8)->get();
        return view('client.pages.home', [
            'newProduct' => $newProduct,
            'outstandingProducts' => $outstandingProducts,
            'dataCategory' => $this->loadCategory(),       
            'categoryDemo' => $this->loadCategoryHome()
        ]);
    }
    public function loadCategoryHome()
    {
        return ProductCategory::orderBy('id',  'desc')->take(6)->get();
    }
}
