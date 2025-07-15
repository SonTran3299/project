<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CartUpdateRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends ClientController
{
    public function index(){
        $cart = session()->get('cart');
        dd($cart);
    }
    public function showCart()
    {
        $cartData = Cart::orderBy('id', 'DESC')->get();
        $totalPrice = 0;
        $unitPrice = 10;
        foreach ($cartData as $data) {
            $itemPrice = $data->quantity * $unitPrice;
            $totalPrice += $itemPrice;
        }
        $shippingFee = 0;
        if ($totalPrice < 100000) {
            $shippingFee = 10;
        }
        $finalPrice = $totalPrice + $shippingFee;
        return view('client.pages.cart', [
            'datas' => $cartData,
            'totalPrice' => $totalPrice,
            'shippingFee' => $shippingFee,
            'finalPrice' => $finalPrice,
            'dataCategory' => $this->loadCategory()
        ]);
    }
    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => ($cart[$product->id]['quantity'] ?? 0) + 1,
            'main_image' => $product->main_image
        ];

        session()->put('cart', $cart);
        return response()->json(['message' => 'Thêm thành công']);
    }
}
