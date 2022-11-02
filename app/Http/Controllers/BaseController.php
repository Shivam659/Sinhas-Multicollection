<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use Hash;
use Illuminate\Support\Facades\Auth;


class BaseController extends Controller
{
	public function home(Request $request)
	{
	$products = Product::get();
    $new_products = Product::limit(6)->latest()->get();
   	return view('front.home',compact('products','new_products'));
	}

	public function specialOffer() {
		return view('front.specialOffer');
	}
    
    public function delivery() {
    	return view('front.delivery');
    }

    public function contact(){
    	return view('front.contact');
    }

    public function cart() {
    	$carts = [];
    	if (Auth::user()) {
    		$user_id = Auth::user()->id;
    		$carts = Cart::where('user_id',$user_id)->get();
            
    		
    	}
        else{

            return redirect()->route('home')->with('no-item','Please login to see your item in cart');
        }
    	return view('front.cart',compact('carts'));
    }

    public function productView(Request $request)
    {
        $id = $request->id;
        $product = Product::where('id',$id)->with('ProductDetail')->first();
        $category_id = $product->category_id;
        $related_products = Product::where('category_id',$category_id)->get();
        return view('front.productView',compact('product','related_products'));
    }

    public function user_login() {
        return  view('front.login');
    }

    public function loginCheck(Request $request)
    {
        $data = array(
            'email' => $request->email,
            'password' => $request->password
        );

        if (Auth::attempt($data)) {
            return redirect()->route('cart');
        }else{
            return back()->withErrors(['message' => 'invalid email or password']);

        }
    }

    public function user_store(Request $request)
    {
        $data = array(
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => '0',
        );

        $user = User::create($data);
        return redirect()->route('user_login')->with('success','You have successfully login');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('user_login');
    }
}
