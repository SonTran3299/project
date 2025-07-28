<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function detail(Product $product)
    {
        $productImages = Product::where('id', $product->id)->with('images')->first();
        $products = Product::inRandomOrder()->limit(4)->get();
        $comments = Comment::where('product_id', $product->id)->with('user')->get();
        return view(
            'client.pages.detail',
            [
                'data' => $product,
                'productImages' => $productImages->images,
                'products' => $products,
                'comments' => $comments
            ]
        );
    }

    public function comment(Product $product, Request $request) {
        $comments = Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'product_id' => $product->id
        ]);
    }
}
