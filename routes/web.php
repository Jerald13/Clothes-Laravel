<?php
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/* Controller */
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FreeGiftController;
use App\Http\Controllers\TagController;

/* Model */ 
use App\Models\Product_images;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;



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

/*   Login & Logout    */
Route::get("/login", function () {
    return view("login");
});

Route::get("/logout", function () {
    Session::forget("user");
    return view("login");
});

Route::post("/login", [LoginController::class, "login"])->name("login");
Route::post("/logout", [LoginController::class, "logout"])->name("logout");


Route::get("/shop", function () {
    return view("shop");
});

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

    /*   Category    */
    Route::resource("editor/categories", CategoryController::class);
    Route::post("/categories/{category}/status", [
        CategoryController::class,
        "status",
    ]);

    /*   TAgs    */
    Route::resource("editor/tags", TagController::class);
    Route::post("/tags/{tag}/status", [TagController::class, "status"]);
});
Route::view("/page-404", "/page-404")->name("/page-404");

// //User Route
// Route::middleware(["auth", "user-role:user"])->group(function () {
// });

//Product
Route::view("/register", "register")->name("register");
Route::get("/index", [ProductController::class, "index"])->name("index");
Route::get("/shop", [ProductController::class, "shop"])->name("shop");
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

//Web service
Route::get("/free-gifts", [FreeGiftController::class, "index"]);
