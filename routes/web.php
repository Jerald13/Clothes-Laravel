<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Session;
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

Route::resource("products", "App\Http\Controllers\ProductController");
Route::get("/products/{id}/edit", "ProductController@edit");
Route::put("products/{id}", "ProductController@update");
Route::delete("products/{id}", "ProductController@destroy");
// Route::patch('products/{id}/update', 'ProductController@update')->name('products.update');
// Route::delete('products/{id}/destroy', 'ProductController@destroy');
// Route::patch('products/{id}/update', 'ProductController@update');

Route::get("/login", function () {
    return view("login");
});

Route::get("/logout", function () {
    Session::forget("user");
    return view("login");
});

Route::get("/", function () {
    return view("master");
});

// Auth::routes();

//User Route
Route::middleware(["auth", "user-role:user"])->group(function () {
    Route::get("/home", [HomeController::class, "userHome"])->name("home");
});

//Editor Route
Route::middleware(["auth", "user-role:editor"])->group(function () {
    Route::get("/editor/home", [HomeController::class, "editorHome"])->name(
        "home.editor"
    );
});

//Admin Route
Route::middleware(["auth", "user-role:admin"])->group(function () {
    Route::get("/admin/home", [HomeController::class, "adminHome"])->name(
        "home.admin"
    );
});

Route::view("/register",'register');
Route::post("/register", [UserController::class, "register"]);

Route::post("/login", [UserController::class, "login"]);
Route::get("/", [ProductController::class, "index"]);
Route::get("detail/{id}", [ProductController::class, "detail"]);
Route::get("search", [ProductController::class, "search"]);
Route::post("add_to_cart", [ProductController::class, "addToCart"]);
Route::get("cartlist", [ProductController::class, "cartList"]);
Route::get("removecart/{id}", [ProductController::class, "removeCart"]);
Route::get("ordernow", [ProductController::class, "orderNow"]);
Route::post("orderplace", [ProductController::class, "orderPlace"]);
Route::get("myorders", [ProductController::class, "myOrders"]);
