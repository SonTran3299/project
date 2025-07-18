<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CartUpdateRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPaymentMethod;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends ClientController
{
    public function index()
    {
        $userId = Auth::id();

        $cart = Cart::with('product')->where('user_id', $userId)->get();
        return view('client.pages.cart', ['cart' => $cart]);
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

        $userId = Auth::id();
        $sessionCart = session()->get('cart', []);

        foreach ($sessionCart as $productId => $item) {
            $quantity = $item['quantity'];

            $cartItem = Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
        }
        session()->put('cart', []);

        return response()->json(['message' => 'Thêm thành công']);
    }

    public function checkout()
    {
        $user = Auth::user();
        $cart = session()->get('cart');

        return view('client.pages.checkout', [
            
            'user' => $user,
            'cart' => $cart
        ]);
    }

    public function placeOrder(Request $request)
    {
        try {
            DB::beginTransaction();
            $total = 0;
            $cart = session()->get('cart', []);

            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->address = $request->address;
            $order->note = $request->note;
            $order->status = 'pending';
            $order->subtotal = $total;
            $order->total = $total;
            $order->save(); //insert

            foreach ($cart as $productId => $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $productId;
                $orderItem->price = $item['price'];
                $orderItem->name = $item['name'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->save();
            }

            $orderPaymentMethod = OrderPaymentMethod::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'total' => $total,
                'status' => 'pending',
            ]);

            //Update phone of user
            $user = User::find(Auth::user()->id);
            $user->phone = $request->phone;
            $user->save();

            DB::commit();

            session()->put('cart', []);
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('client.home');
    }

    public function deleteProductFromCart(Cart $product)
    {
        $msg = $product->delete() ? 'Thành công' : 'Thất bại';
        return redirect()->route('client.cart');
    }

    public function cartCount()
    {
        $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');

        return response()->json(['count' => $cartCount]);
    }
}
