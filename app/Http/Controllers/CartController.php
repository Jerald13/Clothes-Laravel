<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Size;

class CartController extends Controller
{
    // Display a listing of the carts for a user
    public function index()
    {
        $carts = Cart::where("user_id", Auth::id())->get();
        return view("carts.index", compact("carts"));
    }

    // Show the form for creating a new cart
    public function create()
    {
        return view("carts.create");
    }

    public function add(Request $request)
    {
        $user = session()->get("user");
        $product = Product::findOrFail($request->productId);
        $sizeId = $request->size;
        $size = Size::findOrFail($sizeId);

        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->product_id = $product->id;
        $cart->user_quantity = $request->quantity;
        $cart->user_size = $size->size;
        $cart->save();

        $carts = $user
            ->carts()
            ->with("product")
            ->get();
        session()->put("carts", $carts);

        return response()->json(["carts" => $carts]);
    }

    // Store a newly created cart in storage
    public function store(Request $request)
    {
        $request->validate([
            "product_id" => "required",
            "user_quantity" => "required",
        ]);

        Cart::create([
            "product_id" => $request->product_id,
            "user_id" => Auth::id(),
            "user_quantity" => $request->user_quantity,
        ]);

        return redirect()
            ->route("carts.index")
            ->with("success", "Cart item added successfully.");
    }

    // Display the specified cart
    public function show(Cart $cart)
    {
        return view("carts.show", compact("cart"));
    }

    // Show the form for editing the specified cart
    public function edit(Cart $cart)
    {
        return view("carts.edit", compact("cart"));
    }

    // Update the specified cart in storage
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            "user_quantity" => "required",
        ]);

        $cart->update([
            "user_quantity" => $request->user_quantity,
            "user_color" => $request->user_color,
        ]);

        return redirect()
            ->route("carts.index")
            ->with("success", "Cart item updated successfully.");
    }

    // Remove the specified cart from storage
    public function destroy(Cart $cart)
    {
        $cart->delete();
        $user = session()->get("user");
        $carts = $user
            ->carts()
            ->with("product")
            ->get();
        session()->put("carts", $carts);

        return back()->with("success", "Cart item deleted successfully.");
    }
}
