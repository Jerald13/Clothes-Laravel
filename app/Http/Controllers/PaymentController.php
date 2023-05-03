<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Response;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{
    public function updateOrderPayment(Request $request, $id) {

        // Use $id variable to retrieve the Order object from the database
        $order = Order::find($id);

        // Get the order total from the database
        $orderTotal = $order->order_total;

        $shippingAddress = $request->input('billing_address');
        $state = $request->input('state');
        $city= $request->input('city');
        $postcode = $request->input('zipcode');

        // Get the selected state from the form input
        $state = $request->input('state');

        //et the shipping fee based on the state
        if ($state == 'Sabah' || $state == 'Sarawak') {
            $shippingFee = 8;
        } else {
            $shippingFee = 5;
        }

        $newTotal = 0;
        // Calculate the order total
        $newTotal = $orderTotal + $shippingFee;
        $newTotal = number_format($newTotal, 2, ".", "");

        
        // Update the shipping address, state, city, postcode, and shipping fee in the database
        $order->shipping_address = $shippingAddress;
        $order->state = $state;
        $order->city = $city;
        $order->postcode = $postcode;
        $order->shipping_fee = $shippingFee;
        $order->order_total = $newTotal;
        //update the order status to pending
        $order->order_status = 'pending';
        $order->save();


        // Retrieve the bank name from the payment option
        $bankName = $request->input('payment_option');

        $discount_percentage = $request->input('discount_percentage');
        $discount = 1 - (floatval($discount_percentage) / 100);
        $paymentAmount = $newTotal * $discount;
        $paymentAmount = number_format($paymentAmount, 2, ".", "");

        
        $payment = new Payment();
        $payment->order_id = $id;
        // need to store the product id inside the order details with the same order id
        $orderDetails = OrderDetail::where('order_id', $id)->get();
        $productIds = $orderDetails->pluck('product_id')->toArray();
        $payment->product_id = implode(',', $productIds);
        $payment->user_id = auth()->user()->id;
        $payment->payment_method = $bankName;
        $payment->payment_date = now()->format('Y-m-d');
        $payment->payment_amount = $paymentAmount;
        $payment->payment_status = "new";
        $payment->save();

        $paymentId = $payment->id;
        // Redirect the user to the payment page with the bankName and paymentAmount parameters
        return redirect()->route("payment", [
        'id' => $id, 
        'bankName' => $bankName,
        'paymentAmount' => $paymentAmount, 
        'payment_id' => $paymentId
        ]);
    }

    public function payment(Request $request) {
        $id = $request->input('id');
        $bankName = $request->input('bankName');
        $paymentAmount = $request->input('paymentAmount');
        $paymentId = $request->input('payment_id');

        return view("payment", ['id' => $id, 'bankName' => $bankName, 'paymentAmount' => $paymentAmount, 'payment_id' => $paymentId]);
    }


    // public function updatePaymentStatus(Request $request)
    // {
    //     $paymentId = $request->input('id');

    //     // Search for the bank ID based on the provided bank name
    //     $payment = Payment::where('id', $paymentId)->first();
    //     if (!$payment) {
    //         return response()->json(['message' => 'Payment not found'], 404);
    //     }
    
    //     // Update payment status to successful
    //     $payment->payment_status = 'successful';
    //     $payment->save();
    
    //     return view('paymentsuccess');
    // }

    // function updatePaymentStatus($id)
    // {
    //     $payment = Payment::findOrFail($id);
    //     $orderId = $payment->order->id;
    
    //     // Update payment status to successful
    //     $payment->payment_status = 'successful';
    //     $payment->save();
    
    //     // Update order status to successful
    //     $order = Order::findOrFail($orderId);
    //     $order->order_status = 'successful';
    //     $order->save();
    
    //     return view('paymentsuccess');
    // }
    

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