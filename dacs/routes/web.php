<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\Font\HomeController::class, 'index']);


Route::prefix('shop')->group(function (){
    Route::get('product/{id}', [\App\Http\Controllers\Font\ShopController::class, 'show']);
    Route::post('product/{id}', [\App\Http\Controllers\Font\ShopController::class, 'postComment']);

    Route::get('', [\App\Http\Controllers\Font\ShopController::class, 'index']);
    Route::get('man', [\App\Http\Controllers\Font\ShopController::class, 'man']);
    Route::get('woman', [\App\Http\Controllers\Font\ShopController::class, 'woman']);
    Route::get('category/{categoryName}', [\App\Http\Controllers\Font\ShopController::class, 'category']);
});

Route::prefix('cart')->group(function (){
    Route::get('add', [\App\Http\Controllers\Font\CartController::class, 'add']);
    Route::get('/', [\App\Http\Controllers\Font\CartController::class, 'index']);
    Route::get('delete', [\App\Http\Controllers\Font\CartController::class, 'delete']);
    Route::get('destroy', [\App\Http\Controllers\Font\CartController::class, 'destroy']);
    Route::get('update', [\App\Http\Controllers\Font\CartController::class, 'update']);

});
//check coupon
Route::post('/check-coupon', [\App\Http\Controllers\Font\CartController::class, 'check_coupon']);

Route::prefix('checkout')->group(function (){
    Route::get('', [\App\Http\Controllers\Font\CheckoutController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Font\CheckoutController::class, 'addOrder']);
    Route::get('/result', [\App\Http\Controllers\Font\CheckoutController::class, 'result']);
    Route::get('/vnPayCheck', [\App\Http\Controllers\Font\CheckoutController::class, 'vnPayCheck']);
});

Route::prefix('account')->middleware('CheckLoginAdd')->group(function (){
    Route::get('login', [\App\Http\Controllers\Font\AccountController::class, 'login'])->withoutMiddleware('CheckLoginAdd');
    Route::post('login', [\App\Http\Controllers\Font\AccountController::class, 'checkLogin'])->withoutMiddleware('CheckLoginAdd');

    Route::get('logout', [\App\Http\Controllers\Font\AccountController::class, 'logout'])->withoutMiddleware('CheckLoginAdd');
    Route::get('register', [\App\Http\Controllers\Font\AccountController::class, 'register'])->withoutMiddleware('CheckLoginAdd');
    Route::post('register', [\App\Http\Controllers\Font\AccountController::class, 'postRegister'])->withoutMiddleware('CheckLoginAdd');
});

Route::prefix('my-order')->middleware('CheckRemenberLogin')->group(function (){
    Route::get('/', [\App\Http\Controllers\Font\AccountController::class, 'myOrderIndex']);
    Route::get('{id}', [\App\Http\Controllers\Font\AccountController::class, 'myOrderDetails']);
});

//admin
Route::prefix('admin')->middleware('CheckAdminLogin')->group(function (){
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('category', \App\Http\Controllers\Admin\ProductCategoryController::class);
    Route::resource('brand', \App\Http\Controllers\Admin\BrandController::class);
    Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('order', \App\Http\Controllers\Admin\OrderController::class);
    Route::resource('product/{product_id}/image', \App\Http\Controllers\Admin\ProductImageController::class);
    Route::resource('product/{product_id}/details', \App\Http\Controllers\Admin\ProductDetailsController::class);
//    Route::redirect('','admin/user');
    //co the se sai


    Route::prefix('login')->group(function (){
        Route::get('', [\App\Http\Controllers\Admin\HomeController::class, 'getLogin'])->withoutMiddleware('CheckAdminLogin');
        Route::post('', [\App\Http\Controllers\Admin\HomeController::class, 'postLogin'])->withoutMiddleware('CheckAdminLogin');
    });
    Route::get('logout', [\App\Http\Controllers\Admin\HomeController::class, 'logout']);
});


//
Route::prefix('blogs')->group(function (){
    Route::get('', [\App\Http\Controllers\Font\HomeController::class, 'blogs']);
    Route::get('details/{id}', [\App\Http\Controllers\Font\HomeController::class, 'blog_details']);
});

//Route::get('auth/facebook', [\App\Http\Controllers\Admin\HomeController::class, 'redirectToFacebook']);
//
//Route::get('auth/facebook/callback', [\App\Http\Controllers\Admin\HomeController::class, 'facebookSignin']);

////////////////
Route::post('/save-cart', [\App\Http\Controllers\Font\CartController::class, 'save_cart']);


Route::get('/auth/redirect/{provider}', [\App\Http\Controllers\SocialController::class,'redirect']);
Route::get('/{provider}/callback',  [\App\Http\Controllers\SocialController::class,'callback']);
