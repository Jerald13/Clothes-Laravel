<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FreeGiftController;
use App\Http\Controllers\HomeController;

/* Controller */
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\User;

/* Model */
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// Auth::routes();

/*   User Login Page Module    */

Route::post("/login", [LoginController::class, "login"])->name("login");
Route::view("/register", "register")->name("register");
Route::post("/register", [UserController::class, "register"]);
Route::get("/login", function () {
    return view("login");
});

/*   Forgot Password    */
Route::get("password/email", [
    ForgotPasswordController::class,
    "showLinkRequestForm",
])->name("password.request");

Route::post("password/email", [
    ForgotPasswordController::class,
    "sendResetLinkEmail",
])->name("password.email");

Route::get("password/reset/{token}", [
    ResetPasswordController::class,
    "showResetForm",
])->name("password.reset");

Route::post("password/update", [ResetPasswordController::class, "reset"])->name(
    "password.update"
);

// /*   Admin Route    */
Route::middleware(["auth", "user-role:admin"])->group(function () {
    Route::view("admin/setUserRole", "admin/setUserRole")->name(
        "admin.setUserRole"
    );
});

/*   Editor Route    */
Route::middleware(["auth", "user-role:editor"])->group(function () {
    /*   Product    */
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

    /*   Tags    */
    Route::resource("editor/tags", TagController::class);
    Route::post("/tags/{tag}/status", [TagController::class, "status"]);
});
Route::view("errors/page-404", "errors/page-404")->name("errors/page-404");

/*   User Route    */
Route::middleware(["auth", "user-role:user", "web"])->group(function () {
    /*   Log Out    */
    Route::get("/logout", function () {
        Auth::logout();
        Session::forget("user");
        return view("login");
    });
    /*   User Profile    */
    Route::put("/users/{user}", [UserController::class, "update"])->name(
        "users.update"
    );
    Route::get("/profile", [UserController::class, "profile"])->name("profile");
});

Route::get("/shop", function () {
    return view("shop");
});

Route::get("/", function () {
    return view("master");
});

//Product
Route::get("/index", [ProductController::class, "index"])->name("index");
Route::get("/shop", [ProductController::class, "shop"])->name("shop");
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
