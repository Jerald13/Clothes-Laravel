<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    
    public function payment()
    {
        return view("payment");
    }


    public function create()
    {
        return view("payment.create");
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "order_id" => "required",
            "product_id" => "required",
            "user_id" => "required",
            "payment_method" => "required",
            "payment_date" => "required|date",
            "payment_amount" => "required|numeric",
            "payment_status" => "required"
        ]);
    
        Payment::create($validatedData);
    
        return redirect("/payment")->with("success", "Payment created successfully!");
    }
    
    public function edit(Payment $payment)
    {
        return view("payment.edit", compact("payment"));
    }
    
    public function update(Request $request, Payment $payment)
    {
        $validatedData = $request->validate([
            "order_id" => "required",
            "product_id" => "required",
            "user_id" => "required",
            "payment_method" => "required",
            "payment_date" => "required|date",
            "payment_amount" => "required|numeric",
            "payment_status" => "required"
        ]);
    
        $payment->update($validatedData);
    
        return redirect("/payment")->with("success", "Payment updated successfully!");
    }
    
    public function destroy(Payment $payment)
    {
        $payment->delete();
    
        return redirect("/payment")->with("success", "Payment deleted successfully!");
    }
}