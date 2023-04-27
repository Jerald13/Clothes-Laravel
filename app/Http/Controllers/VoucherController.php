<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VoucherController extends Controller
{
    public function checkVoucher(Request $request)
    {
        $voucherCode = $request->input("voucher_code");
        $response = Http::post("http://127.0.0.1:3232/api/vouchers/check", [
            "voucher_code" => $voucherCode,
        ]);
        $status = "";
        $message = "";
        $discount_percentage = "";
        $voucherExists = false;

        if ($response->successful()) {
            $data = $response->json();
            $status = $data["success"];
            $message = $data["message"];
            $discount_percentage = $data["discount_percentage"];
            $voucherExists = true;
        } else {
            $status = false;
            $message = "Error occurred while checking voucher";
        }

        return response()->json([
            "status" => $status,
            "message" => $message,
            "voucherExists" => $voucherExists,
            "voucherCode" => $voucherCode,
            "discount_percentage" => $discount_percentage,
        ]);
    }
}
