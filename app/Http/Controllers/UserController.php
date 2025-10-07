<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(){

    if(Auth::check() && Auth::user()->user_type=="admin"){

        return view('admin.dashboard');
            }
    else{
       return view('dashboard');
    }
}
    public function home(){
        $products = Product::latest()->take(4)->get();
        if(Auth::check()){
        $count_cart = ProductCart::where('user_id', Auth::id())->count();
        }
        else{
            $count_cart ='';
        }
        return view('index', compact('products', 'count_cart'));
    }

    public function ProductDetails($id){
        $product = Product::findOrFail($id);

        $in_cart = ProductCart::where('user_id', Auth::id())
        ->where('product_id', $id)->first();
       // return $in_cart->id;
        return view('product', compact('product', 'in_cart'));
    }

    public function allProducts(){
        $products = Product::paginate(10);
        return view ('allproducts', compact('products'));
    }

    public function addToCart($id){
        $product = Product::findOrFail($id);
        $product_cart = new ProductCart();
        $product_cart->user_id = Auth::id();
        $product_cart->product_id = $product->id;
        $product_cart->save();
        return redirect()->back()->with('message', 'cart added successfully');
    }

    public function cartProducts(){

        $cart = ProductCart::where('user_id', Auth::id())->get();
        return view('view_cart', compact('cart'));
    }

    public function deleteCart($id){
        $cart = ProductCart::findOrFail($id);
        if(Auth::id()==$cart->user_id){
           $cart->delete();
           return redirect()->back()->with('message', "Successfully removed");
        }
        else{
            abort(402, 'Unathorized');
        }
    }

    public function confirmOrder(Request $request){

        $cart_product_id = ProductCart::where('user_id', Auth::id())->get();

        $address = $request->reciever_address;
        $phone = $request->reciever_phone;

        foreach($cart_product_id as $cart_product){
            $order = new Order();
            $order->reciever_address = $address;
            $order->reciever_phone = $phone;
            $order->product_id = $cart_product->product_id;
            $order->user_id = Auth::id();
            $order->save();
        }

        $cart = ProductCart::where('user_id', Auth::id())->get();
        foreach($cart as $cart){
            $cart_id = ProductCart::findOrFail($cart->id);
            $cart->delete();
        }

        return redirect()->back()->with('message', 'Order Confirmed');
    }

    public function myOrders(){
        $orders = Order::where('user_id',  Auth::id())->get();

        return view('myorders', compact('orders'));

    }

    public function stripe($price){

        return view('stripe', compact('price'));

    }



    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from ."
        ]);

        return redirect()->back()->with('message', 'payment was successful');

    }


}
