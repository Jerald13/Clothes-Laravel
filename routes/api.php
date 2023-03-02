<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dummyAPI;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});

Route::get("list/{id?}", [UserController::class, "list"]);
Route::post("add", [UserController::class, "add"]);
Route::put("update", [UserController::class, "update"]);
Route::delete("delete/{id}", [UserController::class, "delete"]);
Route::post("save", [UserController::class, "testData"]);

// Route::apiResource("userApi", [UserController::class]);

Route::group(["middleware" => "auth:sanctum"], function () {
    //All secure URL's

    Route::get("search/{name}", [UserController::class, "search"]);
});

Route::post("login", [UserController::class, "index"]);

Route::post("uploadApi", [ImageController::class, "uploadApi"]);
