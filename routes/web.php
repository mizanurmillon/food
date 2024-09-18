<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//User logout route
Route::get('/logout', [App\Http\Controllers\User\ProfileController::class, 'logout'])->name('logout');
Route::get('/password-change', [App\Http\Controllers\User\ProfileController::class, 'passwordChange'])->name('password');
Route::post('/password-update', [App\Http\Controllers\User\ProfileController::class, 'passwordUpdate'])->name('password.store');

Route::post('/shipping-store', [App\Http\Controllers\User\ShippingController::class, 'store'])->name('shipping.store');

Route::group(['namespace' => 'App\Http\Controllers\Front'], function(){

   Route::get('/','FrontendController@index');
    //reservation Store Route-----
   Route::post('/reservation','FrontendController@storeReservation')->name('front.store.reservation');
   Route::get('/quick-view-product/{id}','FrontendController@QuickviewProduct');
   Route::get('/food-details/{slug}','FrontendController@FoodDetails')->name('food.details');
   Route::post('comment-food','CommentController@Comment')->name('comment');

   //All food Route----
   Route::get('/all-food','FrontendController@AllFood')->name('all.food');
   //blog route--------
   Route::get('/blog-page','FrontendController@BlogPage')->name('blog.page');

   //Cart route----
   Route::get('/all-cart','CartController@AllCart')->name('all.cart');
   Route::post('/add-to-cart-QV','CartController@AddToCart')->name('add.to.cart.QV');
   Route::post('/add-cart','CartController@Cart')->name('add.cart');
   Route::get('/add-to-cart/{id}','CartController@AddCart')->name('add.to.cart');
   Route::get('/cartproduct-remove/{rowId}','CartController@RemoveCart');
   Route::get('/quantity-update/{rowId}/{qty}','CartController@updatecart');
   Route::get('/my-cart','CartController@Mycart')->name('my.cart');
   Route::get('/cart-delete','CartController@destroy')->name('delete.cart');
   // checkout route-----
   Route::get('/checkout-cart','CheckoutController@CheckoutCart')->name('checkout.cart');
   //coupon route ---------
   Route::post('/coupon-apply','CheckoutController@ApplyCoupon')->name('coupon.apply');
   Route::get('/coupon-remove','CheckoutController@RemoveCoupon')->name('remove.coupon');
});
Route::group(['namespace' => 'App\Http\Controllers\User'], function(){
    //Clientsay route here--------
    Route::group(['prefix' => 'client-review'], function() {
       Route::get('/', 'ProfileController@review')->name('clientsay');
       Route::post('/store', 'ProfileController@storeClientsay')->name('clientsay.store');
       Route::post('/update', 'ProfileController@updateClientsay')->name('clientsay.update');
   });

    //__wishlist route__//
    Route::get('add-to-wishlist/{id}','WishlistController@AddWishlist');
});