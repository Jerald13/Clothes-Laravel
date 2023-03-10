<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/* Controller */
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FreeGiftController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Metamask\MetamaskController;
use Illuminate\Support\Facades\Mail;
use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;

/* Model */
use App\Models\Product_images;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;

// Auth::routes();

/*   User Login Page Module    */
Route::post("/login", [LoginController::class, "login"])->name("login");
Route::view("/register", "register")->name("register");
Route::post("/register", [UserController::class, "register"]);
Route::get("/login", function () {
    return view("login");
});
Route::get("/verify-email/{id}/{hash}", [
    UserController::class,
    "sendVerificationEmail",
])->name("auth.sendVerificationEmail");

Route::get("/verify-email/{id}/{hash}/verify", [
    UserController::class,
    "verify",
])->name("auth.verify");

// Route::post("/register", function (Request $request) {
//     // ... validate and create user ...

//     // Send verification email
//     $verificationUrl = URL::temporarySignedRoute(
//         "verification.verify",
//         now()->addMinutes(60),
//         ["id" => $request->id]
//     );
//     Mail::to($request->email)->send(new VerifyEmail($verificationUrl));

//     return redirect()
//         ->route("login")
//         ->with(
//             "success",
//             "Registration successful. Please check your email to verify your account."
//         );
// })->name("register");

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

/*   Admin Route    */
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
    ])->name("editor.productEdit");
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

    /*   User    */
    Route::get("editor/User/users-xsl", [
        UserController::class,
        "displayInXSL",
    ])->name("users.display.xsl");
    Route::get("editor/User/users-xml", [
        UserController::class,
        "displayInXML",
    ])->name("users.display.xml");
    Route::get("editor/User/index", [UserController::class, "display"])->name(
        "users.display"
    );
    Route::get("editor/users/export/xml", [
        UserController::class,
        "exportUsersToXml",
    ])->name("users.export.xml");
    Route::post("editor/users/import/xml", [
        UserController::class,
        "importUsersToXml",
    ])->name("users.import.xml");
    Route::post("/users/{user}/ban", [UserController::class, "banUser"])->name(
        "users.ban"
    );
    Route::get("editor/users/userDisplayBanned", [
        UserController::class,
        "displayBannedUser",
    ])->name("users.displayBannedUser");
    Route::post("/users/{user}/unban", [
        UserController::class,
        "unbanUser",
    ])->name("users.unban");

    /*   Role    */
    Route::get("editor/role/index", [
        UserController::class,
        "displayRole",
    ])->name("role.displayRole");
});

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

Route::prefix("metamask")->group(function () {
    Route::get("/", [MetamaskController::class, "index"])->name("metamask");
    Route::post("/transaction/create", [
        MetamaskController::class,
        "create",
    ])->name("metamask.transaction.create");
});

/*   Error Page   */
Route::view("errors/page-404", "errors/page-404")->name("errors/page-404");
Route::view("errors/page-error", "errors/page-error")->name(
    "errors/page-error"
);

/*   Visitor Page   */
Route::get("/shop", function () {
    return view("shop");
});

Route::get("/", function () {
    return view("master");
});

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
