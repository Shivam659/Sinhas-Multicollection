<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductBookingController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\CartController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BaseController::class,'home']);
Route::get('/home', [Basecontroller::class,'home'])->name('home');
Route::get('/specialOffer', [Basecontroller::class,'specialOffer'])->name('specialOffer');
Route::get('/delivery', [Basecontroller::class,'delivery'])->name('delivery');
Route::get('/cart', [Basecontroller::class,'cart'])->name('cart');
Route::get('/productView/{id}', [Basecontroller::class,'productView'])->name('productView');
Route::get('/contact-us', [Basecontroller::class,'contact'])->name('contact');
Route::get('user/login', [Basecontroller::class,'user_login'])->name('user_login');
Route::post('user/login', [Basecontroller::class,'loginCheck'])->name('loginCheck');
Route::post('user/register', [Basecontroller::class,'user_store'])->name('user_store');
Route::get('user/logout', [Basecontroller::class,'logout'])->name('user_logout');



//login 


Route::get('/admin/login',[AdminController::class,'login'])->name('admin.login');
Route::post('/admin/login',[AdminController::class,'makeLogin'])->name('admin.makeLogin');

Route::group(['middleware' => 'auth'],function(){

Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout',[AdminController::class,'logout'])->name('admin.logout');
//user 

Route::get('/admin/users',[UserController::class,'index'])->name('admin.users');
Route::post('/admin/delete',[UserController::class,'delete'])->name('user.delete');

/* CategoryController routes   */

Route::get('/categories',[CategoryController::class,'index'])->name('category.list');
Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/categories/edit/{id}',[CategoryController::class,'update'])->name('category.update');
Route::post('/category/delete',[CategoryController::class,'destroy'])->name('category.delete');
Route::get('/category/add',[CategoryController::class,'create'])->name('category.create');
Route::post('/category/add',[CategoryController::class,'store'])->name('category.store');

/* ProductController routes  */

Route::get('/products',[ProductController::class,'index'])->name('product.list');
Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
Route::post('/product/create', [ProductController::class,'store'])->name('product.store');
Route::get('/product/edit/{id}', [ProductController::class,'edit'])->name('product.edit');
Route::post('/product/edit/{id}', [ProductController::class,'update'])->name('product.update');
Route::post('/product/delete', [ProductController::class,'destroy'])->name('product.delete');
Route::get('/product/details/{id}', [ProductController::class,'extraDetails'])->name('product.extraDetails');
Route::post('/product/details/{id}', [ProductController::class,'extraDetailsStore'])->name('product.extraDetailsStore');

/* booking products */

Route::get('booking/products', [ProductBookingController::class,'index'])->name('booking.products');
Route::get('booking/products/delete', [ProductBookingController::class,'destroy'])->name('booking.product.delete');
Route::get('booking/product-status', [ProductBookingController::class,'change_bookingStatus'])->name('booking.product.status');
Route::post('product/booking', [ProductBookingController::class,'store'])->name('product.booking');
Route::get('product/bookingSuccess', [ProductBookingController::class,'bookingSuccess'])->name('product.bookingSuccess');
Route::get('product/bookingFail', [ProductBookingController::class,'bookingFail'])->name('product.bookingFail');

});


// cart controller

Route::post('cart/store', [CartController::class,'store'])->name('cart.store');
Route::get('cart/delete', [CartController::class,'destroy'])->name('cart.delete');