<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;

class CartController extends Controller
{
    public function store(Request $request)
    {
    	$data = array(
    		'product_id' => $request->product_id,
    		'qty' => $request->qty,
    		'user_id' => Auth::user()->id,
    	);

    	Cart::create($data);
    	return redirect()->route('cart');
    }

    public function destroy(Cart $cart, Request $request)
    {
    	$id = $request->id;
    	$cart = Cart::where('id',$id)->first();
    	$cart->delete();
    }
}
