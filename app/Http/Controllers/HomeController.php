<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function createProduct()
    {
        return view("editor.productCreate");
    }

    public function editProduct()
    {
        return view("editor.productEdit");
    }

    public function userHome()
    {
        return view("product");
    }

    public function editorHome()
    {
        return view("product");
    }

    public function adminHome()
    {
        return view("product");
    }
}
