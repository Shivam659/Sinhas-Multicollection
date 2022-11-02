<?php

namespace App\Http\Controllers;
use App\Models\ProductBooking;
use App\Models\Cart;
use Illuminate\Http\Request;
use Session;
use Omnipay\Omnipay;

class ProductBookingController extends Controller
{
    public function index() {
    	$booking_products = ProductBooking::get();
    	return view('admin.bookedProducts.index',compact('booking_products'));
    }

    public function store(Request $request)
    {
    	dd('hi');
    }
}
