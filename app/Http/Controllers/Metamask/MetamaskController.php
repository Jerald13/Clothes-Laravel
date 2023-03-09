<?php

namespace App\Http\Controllers\Metamask;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MetamaskController extends Controller
{
    /**
     * Metamask Payment Page
     *
     * @return void
     */
    public function index()
    {
        $response["transactions"] = Transaction::all();

        return view("Metamask.metamask")->with($response);
    }
    /**
     * create New Transaction
     *
     * @param  mixed $request
     * @return void
     */
    public function create(Request $request)
    {
        // dd($request);
        // return Transaction::create([
        //     "txHash" => $request->txHash,
        //     "amount" => $request->amount,
        // ]);

        // $data = $request->validate([
        //     "name" => "required|string|max:255",
        //     "status" => "required|string|max:255",
        // ]);

        // $this->categoryRepository->storeCategory($data);

        // return redirect()
        //     ->route("categories.index")
        //     ->with("message", "Category Created Successfully");

        $cart = new Transaction();
        $cart->txHash = $request->txHash;
        $cart->amount = $request->amount;
        $cart->save();
        return redirect("/metamask");
    }
}
