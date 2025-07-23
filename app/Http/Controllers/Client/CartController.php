<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CartUpdateRequest;
use App\Mail\AdminEmailTemplate;
use App\Mail\CustomerEmailTemplate;
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
use Illuminate\Support\Facades\Mail;

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
        $userId = $user->id;
        $cart = Cart::where('user_id', $userId)->with('product')->get();


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
            $userId = Auth::user()->id;
            $cart = Cart::where('user_id', $userId)->with('product')->get();

            foreach ($cart as $item) {
                $total += $item->product->price * $item->quantity;
            }

            $order = new Order();
            $order->user_id = $userId;
            $order->address = $request->address;
            $order->note = $request->note;
            $order->status = 'pending';
            $order->subtotal = $total;
            $order->total = $total;
            $order->save(); //insert

            foreach ($cart as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item->product_id;
                $orderItem->price = $item->product->price;
                $orderItem->name = $item->product->name;
                $orderItem->quantity = $item->quantity;
                $orderItem->save();
            }

            $orderPaymentMethod = OrderPaymentMethod::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'total' => $total,
                'status' => 'pending',
            ]);

            //Update phone of user
            $user = User::find($userId);
            $user->phone = $request->phone;
            $user->save();

            DB::commit();

            if ($request->payment_mothod === 'vnpay') {
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $startTime = date("YmdHis");
                $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

                $vnp_TxnRef = $order->id;
                $vnp_Amount = $order->total;
                $vnp_Locale = 'vn';
                $vnp_BankCode = 'VNBANK';
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                $vnp_HashSecret = env('VNPAY_HASHSECRET');

                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => env('VNPAY_TMNCODE'),
                    "vnp_Amount" => $vnp_Amount * 100 * 23500,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
                    "vnp_OrderType" => "other",
                    "vnp_ReturnUrl" => env('VNPAY_RETURNURL'),
                    "vnp_TxnRef" => $vnp_TxnRef,
                    "vnp_ExpireDate" => $expire,
                    "vnp_BankCode" => $vnp_BankCode,
                );

                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = env('VNPAY_URL') . "?" . $query;

                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }

                return redirect()->to($vnp_Url);
            }
            Mail::to('tvs32.ys@gmail.com')->send(new CustomerEmailTemplate($order, $user));

            //Gửi cho admin
            //Mail::to('tvs32.ys@gmail.com')->send(new AdminEmailTemplate($order));

            foreach ($order->orderItems as $orderItem) {
                $product = Product::find($orderItem->product_id);
                $product->stock -= $orderItem->quantity;
                $product->save();
            }
            $check = Cart::where('user_id', $userId)->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
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
