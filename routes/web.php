<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Product_images;
use App\Models\User;
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

// Route::resource("products", "App\Http\Controllers\ProductController");
// Route::get("/products/{id}/edit", "ProductController@edit");
// Route::put("products/{id}", "ProductController@update");
// Route::delete("products/{id}", "ProductController@destroy");
// Route::patch('products/{id}/update', 'ProductController@update')->name('products.update');
// Route::delete('products/{id}/destroy', 'ProductController@destroy');
// Route::patch('products/{id}/update', 'ProductController@update');

//Login & Logout
Route::get("/login", function () {
    return view("login");
});

Route::get("/logout", function () {
    Session::forget("user");
    return view("login");
});

Route::post("/login", [LoginController::class, "login"])->name("login");
Route::post("/logout", [LoginController::class, "logout"])->name("logout");

Route::get("/", function () {
    return view("master");
});

// Auth::routes();

//Admin Route
Route::middleware(["auth", "user-role:admin"])->group(function () {});

//Editor Route
Route::middleware(["auth", "user-role:editor"])->group(function () {
    //User Route
    // Route::get("editor/editProduct", [
    //     HomeController::class,
    //     "editProduct",
    // ])->name("editProduct");
    Route::post("editor/createProduct", [
        ImageController::class,
        "upload",
    ])->name("editor.createProduct");

    Route::get("editor/createProduct", [
        HomeController::class,
        "createProduct",
    ])->name("editor.createProduct");
    // Route::get("editor/createProduct", [
    //     HomeController::class,
    //     "createProduct",
    // ])->name("admin.createProduct");
});

//User Route
Route::middleware(["auth", "user-role:user"])->group(function () {
    // Route::get("/home", [HomeController::class, "userHome"])->name("home");
});

//Product
Route::view("/register", "register")->name("register");
Route::get("/product", [ProductController::class, "index"])->name("product");
Route::post("/register", [UserController::class, "register"]);
Route::get("/", [ProductController::class, "index"]);
Route::get("detail/{id}", [ProductController::class, "detail"]);
Route::get("search", [ProductController::class, "search"]);
Route::post("add_to_cart", [ProductController::class, "addToCart"]);
Route::get("cartlist", [ProductController::class, "cartList"]);
Route::get("removecart/{id}", [ProductController::class, "removeCart"]);
Route::get("ordernow", [ProductController::class, "orderNow"]);
Route::post("orderplace", [ProductController::class, "orderPlace"]);
Route::get("myorders", [ProductController::class, "myOrders"]);

Route::view("/error", "error")->name("error");