<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetail;

class ProductController extends Controller
{
    public function index(){
    	$products = Product::get();
    	return view('admin.product.index',compact('products'));

    }

    public function create(){
    	$categories = Category::whereNotNull('category_id')->get();
    	return view('admin.product.add',compact('categories'));
    }

    public function store(Request $request)
    {
    	$data = array(
    		'name' => $request->name,
    		'category_id' => $request->category_id,
    		'price' => $request->price,
    	);

    	if ($request->hasFile('image')) {
    		$image = $request->file('image');
    		$fileName = date('dmY').time().'.'.$image->getClientOriginalExtension();
    		$image->move(public_path("/uploads"),$fileName);
    		$data['image'] = $fileName;
    	}

    	$create = Product::create($data);
    	return redirect()->route('product.list');
    }

    public function edit(Product $product, Request $request){
    	$id = $request->id;
    	$product = Product::findOrFail($id);
    	$categories = Category::whereNotNull('category_id')->get();
    	return view('admin.product.edit',compact('product','categories'));
    }

    public function update(Request $request, Product $product){
    	dd($request->all());
    	$id = $request->id;
    	$data = array(
    			'name' => $request->name,
    			'category_id' => $request->category_id,
    			'price' => $request->price

    	);

    	if ($request->hasFile('image')) {
    		$image = $request->file('image');
    		$fileName = date('dmY').time().'.'.$image->getClientOriginalExtension();
    		$image->move(public_path('/uploads'),$fileName);
    		$data['image'] = $fileName;
    	}

    	$create = Product::where('id',$id)->update($data);
    	return redirect()->route('product.list');
    }

    public function extraDetails(Request $request)
    {
    	$id = $request->id;
    	$product = Product::where('id',$id)->with('ProductDetail')->first();
    	return view('admin.product.extraDetails',compact('id','product'));
    }

    public 	function extraDetailsStore(Request $request)
    {
    	$id = $request->id;
    	$data = array(
    		'title' => $request->title,
    		'product_id' => $id,
    		'total_items' => $request->total_items,
    		'description' => $request->description
    	);

    	$details = ProductDetail::updateOrCreate(

    		['product_id' => $id],

    		$data
    	);

    	return redirect()->route('product.list');
    }
}
