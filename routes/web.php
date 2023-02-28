<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Models\Product_images;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

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

// Route::view("/login", "login")->name("login");

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
Route::middleware(["auth", "user-role:admin"])->group(function () {
    Route::view("admin/setUserRole", "admin/setUserRole")->name(
        "admin.setUserRole"
    );
});

//Editor Route
Route::middleware(["auth", "user-role:editor"])->group(function () {
    //Product
    Route::post("editor/productCreate", [
        ImageController::class,
        "upload",
    ])->name("editor.productCreate");

    Route::get("editor/productCreate", [
        HomeController::class,
        "createProduct",
    ])->name("editor.productCreate");
    Route::view("editor/index", "editor/index")->name("editor.index");

    //Category
    // Route::post("editor/categoryCreate", [
    //     CategoryController::class,
    //     "categoryCreate",
    // ])->name("editor.categoryCreate");
    // Route::get("editor/categoryCreate", [
    //     CategoryController::class,
    //     "categoryCreateForm",
    // ])->name("editor.categoryCreate");
    // Route::get("editor.categoryDisplay", [
    //     CategoryController::class,
    //     "categoryDisplay",
    // ])->name("editor.categoryDisplay");
    Route::resource("editor/categories", CategoryController::class);
    Route::post("/categories/{category}/status", function (
        Request $request,
        Category $category
    ) {
        $category->status = $request->input("status");
        $category->save();
        return response()->json(["status" => $category->status]);
    });
});
Route::view("/page-404", "/page-404")->name("/page-404");

// //User Route
// Route::middleware(["auth", "user-role:user"])->group(function () {
//     // Route::get("/home", [HomeController::class, "userHome"])->name("home");
// });

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
