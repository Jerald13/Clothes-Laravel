<?php
namespace App\Http\Controllers;

use App\Observers\Subject;
use App\Observers\EmailObserver;
use App\Observers\UpdateStatusObserver;

use App\Models\Payment;
use App\Models\User;
use App\Models\Stock;
use App\Models\Size;
use App\Models\Product;
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
    // public function __construct()
    // {
    //     $subject = new Subject();
    //     $emailObserver = new EmailObserver($subject);
    //     $updateStatusObserver = new UpdateStatusObserver($subject);
    //     $subject->setState("Your payment has been processed successfully!!!");
    //     $subject->setState("Your payment status has been updated to completed!!!");
    // }

    public function index()
    {
        $payments = Payment::all();
        return view("editor.payment.index", compact("payments"));
    }

    public function updatePaymentStatus(Request $request, Payment $payment)
    {
        $validatedData = $request->validate([
            "status" => "required",
        ]);

        $allowedStatuses = ["pending", "completed", "cancelled"];
        if (!in_array($validatedData["status"], $allowedStatuses)) {
            return redirect()
                ->back()
                ->with("error", "Invalid status value.");
        }

        $payment->update(["payment_status" => $validatedData["status"]]);

        return redirect()->back();
    }

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
        'paymentId' => $id
        ]);
    }

    public function payment(Request $request) {
        $id = $request->input('id');
        $bankName = $request->input('bankName');
        $paymentAmount = $request->input('paymentAmount');
        $paymentId = $request->input('paymentId');

        return view("payment", ['id' => $id, 'bankName' => $bankName, 'paymentAmount' => $paymentAmount, 'paymentId' => $paymentId]);
    }

    public function updateStatus($id)
    {
        // $subject = new Subject();
        // $emailObserver = new EmailObserver($subject);
        // $updateStatusObserver = new UpdateStatusObserver($subject);
        // $subject->setState("Your payment has been processed successfully!!!");

        // Update the payment status in the database
        $payment = Payment::find($id);
        $payment->payment_status = "completed";
        $payment->save();

        $payment->order->order_status = "successful";
        $payment->order->save();

        // Mail::to(auth()->user()->email)->send($emailObserver);
    
        // Return a response
        return view('paymentsuccess');
    }


    public function updatePending($id)
    {
        // Update the payment status in the database
        $payment = Payment::find($id);
        $payment->payment_status = "pending";
        $payment->save();
    
        // window.location.href = '{{ route('paymentsuccess') }}';
        // Return a JSON response
        return response()->json(['message' => 'Payment status updated to pending']);
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