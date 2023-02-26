<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function categoryCreateForm()
    {
        return view("editor.categoryCreate");
    }

    public function categoryCreate(Request $req)
    {
        if ($req->session()->has("user")) {
            $cart = new Category();
            $cart->name = $req->name;
            $cart->status = $req->has('status') ? $req->status : 'active';
            $cart->save();
            return redirect("/");
        } else {
            return redirect("/login");
        }
    }
}
