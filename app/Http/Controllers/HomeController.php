<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\View;
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

    public function index()
    {
        $data = Product::all();
        $user = session()->get("user");
        $carts = null;
        if ($user) {
            $carts = $user
                ->carts()
                ->with("product")
                ->get();
            session()->put("carts", $carts);
        } else {
            session()->forget("carts");
        }

        return view("product", compact("data"));
    }

    
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
