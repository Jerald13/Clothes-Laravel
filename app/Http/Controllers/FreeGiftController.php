<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class FreeGiftController extends Controller
{
    public function index()
    {
        $response = Http::get("http://127.0.0.1:3232/api/free-gifts");
        $freeGifts = $response->json();

        return view("free-gifts", compact("freeGifts"));
    }
}
