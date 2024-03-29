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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FreeGiftController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\VoucherController;


use Illuminate\Support\Facades\Mail;
use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Metamask\MetamaskController;

/* Model */
use App\Models\Product_images;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;

use App\Mail\SendSuccessfulMessage;

// Auth::routes();

/*   User Login Page Module    */

Route::post("/login", [LoginController::class, "login"])->name("login");
Route::view("/register", "register")->name("register");
Route::post("/register", [UserController::class, "register"]);

Route::get("editor/productEdit", function () {
    return view("editor/productEdit");
});

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

    Route::view("admin/AddEditor", "admin/createUserWithRole")->name(
        "role.AddEditor"
    );
    Route::post("admin/User/createUserWithRole", [
        UserController::class,
        "registerEditorOrAdmin",
    ])->name("role.AddEditorForm");
});

/*   Editor Route    */
Route::middleware(["auth", "user-role:editor"])->group(function () {
    /*   Product    */
    // product create

    Route::post("editor/Product/productCreate", [
        ProductController::class,
        "createProduct",
    ])->name("editor.product.productCreate");

    Route::get("editor/Product/productCreate", [
        ProductController::class,
        "displayCreateForm",
    ])->name("editor.product.productCreateDisplay");

    //product editing
    Route::get("editor/Product/productEdit/{product}", [
        ProductController::class,
        "getSingleProdAdmin",
    ])->name("editor.product.productEdit");

    Route::post("editor/Product/productEdit/{product}", [
        ProductController::class,
        "update",
    ])->name("editor.product.productUpdate");

    //product display (admin)
    Route::get("editor/Product/productDisplay", [
        ProductController::class,
        "getAllProds",
    ])->name("editor.product.productDisplay");

    //product deleting
    Route::get("editor/Product/productDisplay/{product}", [
        ProductController::class,
        "destroy",
    ])->name("editor.product.productDestory");

    Route::view("editor/index", "editor/index")->name("editor.index");

    Route::get("editor/Product/product-xsl", [
        ProductController::class,
        "displayInXSL",
    ])->name("product.display.xsl");

    Route::get("editor/Product/product-xml", [
        ProductController::class,
        "displayInXML",
    ])->name("product.display.xml");

    Route::post("editor/Product/import/xml", [
        ProductController::class,
        "importProductToXml",
    ])->name("product.import.xml");

    Route::get("editor/Product/export/xml", [
        ProductController::class,
        "exportProductToXml",
    ])->name("product.export.xml");
    /*============================================*/

    /*   Category    */
    Route::resource("editor/categories", CategoryController::class);
    Route::post("/categories/{category}/status", [
        CategoryController::class,
        "status",
    ]);
    // Route::get("editor/categories/categories-xml", [
    //     CategoryController::class,
    //     "displayInXSL2",
    // ])->name("categories.display.xml");
    Route::get("editor/categories/categories-xsl", [
        CategoryController::class,
        "displayInXSL2",
    ])->name("categories.display.xsl");

    Route::get("editor/categories/categories-xml", [
        CategoryController::class,
        "show2",
    ])->name("categories.display.xml");

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

    /*-----------------------*/
    /* Orders */
    Route::get("editor/Order/orders-xsl", [
        OrderController::class,
        "displayInXSL",
    ])->name("orders.display.xsl");
    Route::get("editor/Order/orders-xml", [
        OrderController::class,
        "displayInXML",
    ])->name("orders.display.xml");

    Route::get("editor/Order/index", [OrderController::class, "index"])->name(
        "orders.index"
    );

    Route::patch("/orders/{order}/update-status", [
        OrderController::class,
        "updateOrderStatus",
    ])->name("orders.updateOrderStatus");

    Route::get("editor/orders/export/xml", [
        OrderController::class,
        "exportOrdersToXml",
    ])->name("orders.export.xml");

    Route::post("editor/orders/import/xml", [
        OrderController::class,
        "importOrdersToXml",
    ])->name("orders.import.xml");

    /*-----------------------*/
    /* Payment */
    Route::get("editor/Payment/index", [
        PaymentController::class,
        "index",
    ])->name("payments.index");

    Route::patch("/payment/{payment}/update-status", [
        PaymentController::class,
        "updatePaymentStatus",
    ])->name("payments.updatePaymentStatus");
});

/*   User Route    */
Route::middleware(["auth", "user-role:user", "web"])->group(function () {
    /*   Log Out    */
    Route::get("/logout", function () {
        Auth::logout();
        Session::forget("user");
        Session::forget("carts");
        return redirect()->route("login");
    });

    /*   User Profile    */
    Route::put("/users/{user}", [UserController::class, "update"])->name(
        "users.update"
    );
    Route::get("/profile", [UserController::class, "profile"])->name("profile");

    /*   Cart    */
    Route::post("/cart/add", [CartController::class, "add"])->name("cart.add");

    Route::delete("/carts/{cart}", [CartController::class, "destroy"])->name(
        "cart.destroy"
    );

    /* Orders */
    Route::get("/order", [OrderController::class, "order"])->name("order");
    Route::post("/order", [OrderController::class, "store"])->name(
        "orders.store"
    );

    Route::get("/order/cancel/{id}", [OrderController::class, "cancel"])->name(
        "order.cancel"
    );
    Route::get("/order", [OrderController::class, "show"])->name("order");
    Route::get("ordernow", [OrderController::class, "orderNow"]);
    Route::post("orderplace", [OrderController::class, "orderPlace"]);
    Route::get("myorders", [OrderController::class, "myOrders"]);
    Route::get("/myorders", [OrderController::class, "showOrders"])->name(
        "orders.showOrders"
    );
    Route::get("orderdetail", [
        OrderController::class,
        "showOrderDetail",
    ])->name("orders.showOrderDetail");
    Route::post("vouchers/check", [
        VoucherController::class,
        "checkVoucher",
    ])->name("vouchers.check");

    /* Payments */
    Route::post("/payment/{id}", [
        PaymentController::class,
        "updateOrderPayment",
    ])->name("payments.insertNewPayment");

    Route::get("/payment", [PaymentController::class, "payment"])->name(
        "payment"
    );

    Route::get("/paymentsuccess", function () {
        return view("paymentsuccess");
    })->name("paymentsuccess");

    //payment status
    Route::get('/payment/updateStatus/{id}', [PaymentController::class, 'updateStatus'])->name(
        "payments.update"
    );

    Route::get('/payment/updatePending/{id}', [PaymentController::class, 'updatePending'])->name(
        "payments.updatePending"
    );
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

//testing site
Route::get("/testing", function () {
    return view("testing");
});

Route::get("/index", [ProductController::class, "getAllProdIndex"])->name("index");
// Route::get("/index", [HomeController::class, "index"])->name("index");

Route::get("/shop", [ProductController::class, "shop"])->name("shop");
Route::get("/get-quantity", [ProductController::class, "getQuantity"])->name(
    "shop.quantity"
);

// Product Client
// Product Display
Route::get("/productDetails/{id}", [
    ProductController::class,
    "getSingleProdClient",
])->name("productDetails");

Route::get("/product", [
    ProductController::class,
    "getAllProdIndex",
])->name("getAllProductIndex");

Route::get("/", [ProductController::class, "index"]);
Route::get("detail/{id}", [ProductController::class, "detail"]);
Route::get("search", [ProductController::class, "search"]);
Route::post("add_to_cart", [ProductController::class, "addToCart"]);
Route::get("cartlist", [ProductController::class, "cartList"]);
Route::get("removecart/{id}", [ProductController::class, "removeCart"]);
Route::view("/error", "error")->name("error");

//Web service
// Route::get("/free-gifts", [FreeGiftController::class, "index"]);
