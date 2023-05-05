<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view("editor.order.index", compact("orders"));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            "status" => "required",
        ]);

        $allowedStatuses = ["pending", "successful", "cancelled"];
        if (!in_array($validatedData["status"], $allowedStatuses)) {
            return redirect()
                ->back()
                ->with("error", "Invalid status value.");
        }

        $order->update(["order_status" => $validatedData["status"]]);

        return redirect()->back();
    }

    function search($id)
    {
        return Order::where("id", "=", $id)->get();
    }

    public function displayInXSL()
    {
        $orders = Order::latest()->paginate(10);

        $xml = new \SimpleXMLElement("<orders/>");

        foreach ($orders as $order) {
            $orderXml = $xml->addChild("order");
            $orderXml->addChild("id", $order->id);
            $orderXml->addChild("username", $order->user->username);
            $orderXml->addChild("email", $order->user->email);
            $orderXml->addChild("phone_number", $order->user->phone_number);
            $orderXml->addChild(
                "shipping_address",
                empty($order->shipping_address) ? "-" : $order->shipping_address
            );
            $orderXml->addChild(
                "state",
                empty($order->state) ? "-" : $order->state
            );
            $orderXml->addChild(
                "city",
                empty($order->city) ? "-" : $order->city
            );
            $orderXml->addChild(
                "postcode",
                empty($order->postcode) ? "-" : $order->postcode
            );
            $orderXml->addChild("country", $order->country);
            $orderXml->addChild("order_total", $order->order_total);
            $orderXml->addChild("order_status", $order->order_status);
        }

        $xmlString = $xml->asXML();

        // Load the XSL stylesheet
        $xsl = new \DOMDocument();
        $xsl->load(base_path("resources/views/editor/Order/index.xsl"));

        // Load the XML data
        $xmlData = new \DOMDocument();
        $xmlData->loadXML($xmlString);

        // Apply the XSL transformation
        $xsltProcessor = new \XSLTProcessor();
        $xsltProcessor->importStylesheet($xsl);
        $htmlString = $xsltProcessor->transformToXML($xmlData);

        // Create and return the response
        $response = new Response($htmlString);
        $response->header("Content-Type", "text/html");

        return $response;
    }

    public function displayInXML()
    {
        $orders = Order::latest()->paginate(10);

        $xml = new \SimpleXMLElement("<orders/>");

        foreach ($orders as $order) {
            $orderXml = $xml->addChild("order");
            $orderXml->addChild("id", $order->id);
            $orderXml->addChild("username", $order->user->username);
            $orderXml->addChild("email", $order->user->email);
            $orderXml->addChild("phone_number", $order->user->phone_number);
            $orderXml->addChild("shipping_address", $order->shipping_address);
            $orderXml->addChild("state", $order->state);
            $orderXml->addChild("city", $order->city);
            $orderXml->addChild("postcode", $order->postcode);
            $orderXml->addChild("country", $order->country);
            $orderXml->addChild("order_total", $order->order_total);
            $orderXml->addChild("order_status", $order->order_status);
        }

        $xmlString = $xml->asXML();

        $response = new Response($xmlString);
        $response->header("Content-Type", "application/xml");

        return $response;
    }

    public function exportOrdersToXml()
    {
        $orders = Order::all();

        $xml = new \SimpleXMLElement("<orders/>");
        foreach ($orders as $order) {
            $orderXml = $xml->addChild("order");
            $orderXml->addChild("id", $order->id);
            $orderXml->addChild("username", $order->user->username);
            $orderXml->addChild("email", $order->user->email);
            $orderXml->addChild("phone_number", $order->user->phone_number);
            $orderXml->addChild("shipping_address", $order->shipping_address);
            $orderXml->addChild("state", $order->state);
            $orderXml->addChild("city", $order->city);
            $orderXml->addChild("postcode", $order->postcode);
            $orderXml->addChild("country", $order->country);
            $orderXml->addChild("order_total", $order->order_total);
            $orderXml->addChild("order_status", $order->order_status);
        }

        $response = response($xml->asXML(), 200);
        $response->header("Content-Type", "text/xml");
        $response->header(
            "Content-Disposition",
            'attachment; filename="orders.xml"'
        );

        return $response;
    }

    public function importOrdersFromXml(Request $request)
    {
        $xmlFile = $request->file("xmlFile");

        $xmlString = file_get_contents($xmlFile);

        $xml = new \SimpleXMLElement($xmlString);

        foreach ($xml->order as $orderData) {
            $order = new Order();
            $order->user_id = (int) $orderData->user_id;
            $order->shipping_address = (string) $orderData->shipping_address;
            $order->state = (string) $orderData->state;
            $order->city = (string) $orderData->city;
            $order->postcode = (int) $orderData->postcode;
            $order->country = (string) $orderData->country;
            $order->order_total = (float) $orderData->order_total;
            $order->order_status = (string) $orderData->order_status;

            $user = User::where("username", (string) $orderData->username)
                ->where("email", (string) $orderData->email)
                ->where("phone_number", (string) $orderData->phone_number)
                ->first();

            if ($user) {
                $order->user_id = $user->id;
            } else {
                return redirect()
                    ->back()
                    ->with("error", "User not found.");
            }

            $order->save();
        }

        return redirect()
            ->back()
            ->with("success", "Orders imported successfully.");
    }

    public function order()
    {
        return view("order");
    }

    public function showOrders()
    {
        // Retrieve the order items for the authenticated user
        $userId = auth()->user()->id;
        $orderItems = Order::with("payment")
            ->where("user_id", $userId)
            ->get();

        // Pass the order items to the view
        return view("myorders", ["orderItems" => $orderItems]);
    }

    public function showOrderDetail(Request $request)
    {
        $id = $request->input("id");

        // Retrieve the order items for the specified order ID
        $orderItems = OrderDetail::with("product")
            ->where("order_id", $id)
            ->get();

        // Calculate the total order subtotal
        $totalOrderSubtotal = OrderDetail::where("order_id", $id)->sum(
            "order_subtotal"
        );

        // Retrieve the payment amount for the specified order ID
        $order = Order::with("payment")->find($id);
        $paymentAmount = $order->payment->payment_amount;

        // Pass the order items, the total order subtotal and the payment amount to the view
        return view("orderdetail", [
            "orderItems" => $orderItems,
            "totalOrderSubtotal" => $totalOrderSubtotal,
            "paymentAmount" => $paymentAmount,
        ]);
    }

    function orderNow()
    {
        $userId = auth()->user()->id;
        $total = $products = DB::table("cart")
            ->join("products", "cart.product_id", "=", "products.id")
            ->where("cart.user_id", $userId)
            ->sum("products.price");
        return view("ordernow", ["total" => $total]);
    }

    function orderPlace(Request $req)
    {
        $userId = auth()->user()->id;
        $allCart = Cart::where("user_id", $userId)->get();
        foreach ($allCart as $cart) {
            $order = new Order();
            $order->user_id = $cart["user_id"];
            $order->order_status = "new";
            $order->save();
            Cart::where("user_id", $userId)->delete();
        }
        $req->input();
        return redirect("/");
    }

    function myOrders()
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $orders = $user
            ->myOrder()
            ->with("product")
            ->get();
        return view("myorders", compact("orders"));
    }

    public function store(Request $request)
    {
        $voucherCode = $request->input("voucher");
        $response = Http::get("http://127.0.0.1:3232/api/vouchers/check", [
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

        //dd($discount_percentage);

        // generate and check unique track number
        $trackNumber = "";
        $unique = false;
        while (!$unique) {
            $trackNumber =
                "ABC-" . str_pad(mt_rand(1, 99999), 5, "0", STR_PAD_LEFT);
            $unique = Order::where("track_number", $trackNumber)->doesntExist();
        }

        // $shippingAddress = $request->input('billing_address');
        // $state = $request->input('state');
        // $city= $request->input('city');
        // $postcode = $request->input('zipcode');

        // Get the cart items from the database
        $cartItems = Cart::where("user_id", auth()->user()->id)->get();

        // Calculate the subtotal
        $subtotal = $this->calculateSubtotal($cartItems);

        // Get the selected state from the form input
        $state = $request->input("state");

        // //et the shipping fee based on the state
        // if ($state == 'Sabah' || $state == 'Sarawak') {
        //     $shippingFee = 8;
        // } else {
        //     $shippingFee = 5;
        // }

        $shippingFee = 0.0;
        $response = Http::get("http://127.0.0.1:3232/api/deliver");
        $deliveries = $response->json();
        session()->put("deliveries", $deliveries);
        // Calculate the tax amount by mutiply 6% tax rate
        $taxRate = 0.06; // 6%
        $taxAmount = $subtotal * $taxRate;
        $taxAmount = number_format($taxAmount, 2, ".", "");

        // Calculate the order total
        $orderTotal = $subtotal + $shippingFee + $taxAmount;
        $orderTotal = number_format($orderTotal, 2, ".", "");

        // Insert the order data into the database
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->track_number = $trackNumber;
        $order->order_total = $orderTotal;
        $order->shipping_address = null;
        $order->state = null;
        $order->city = null;
        $order->postcode = null;
        $order->country = "Malaysia";
        //default shipping fee = RM0.00
        $order->shipping_fee = $shippingFee;
        $order->tax_rate = $taxRate;
        $order->tax_amount = $taxAmount;
        $order->save();

        // Insert the order details into the database
        foreach ($cartItems as $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item->product_id;
            $orderDetail->order_quantity = $item->user_quantity;
            $orderDetail->order_size = $item->user_size;
            $orderDetail->order_subtotal =
                $item->product->price * $item->user_quantity;
            $orderDetail->save();
        }

        return redirect()->route("order");
    }

    private function calculateSubtotal($cartItems)
    {
        $subtotal = 0;

        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->user_quantity;
            $subtotal = number_format($subtotal, 2, ".", "");
        }

        return $subtotal;
    }

    public function show(Request $request)
    {
        if (auth()->check()) {
            // your existing code to process the order

            // Retrieve order id
            $order = Order::where("user_id", auth()->id())
                ->where("order_status", "new")
                ->first();
            $orderId = $order->id;

            // Get the cart items from the database
            $cartItems = Cart::where("user_id", auth()->user()->id)->get();

            // Calculate the subtotal
            $subtotal = $this->calculateSubtotal($cartItems);

            //default shipping fee is RM0.00
            $shippingFee = 0.0;

            // Calculate the tax amount by mutiply 6% tax rate
            $taxRate = 0.06; // 6%
            $taxAmount = $subtotal * $taxRate;

            // Calculate the order total
            $orderTotal = $subtotal + $shippingFee + $taxAmount;

            $response = Http::get("http://127.0.0.1:3232/api/banks/names");
            $bankNames = [];
            if ($response->successful()) {
                $bankNames = $response->json();
            }

            return view(
                "order",
                compact(
                    "cartItems",
                    "subtotal",
                    "shippingFee",
                    "taxAmount",
                    "orderTotal",
                    "orderId",
                    "bankNames"
                )
            );
        } else {
            return redirect()
                ->route("login")
                ->with("message", "Please login to place an order.");
        }
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->order_status = "cancelled"; // Update the status of the order
            $order->save();

            return redirect()->route("index");
        } else {
            return redirect()
                ->back()
                ->with("error", "Order not found.");
        }
    }

    public function create()
    {
        // Return a view with a form to create a new order
    }

    public function edit(Order $order)
    {
        // Return a view with a form to edit the specified order
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());

        // Update order details
        foreach ($request->input("order_details") as $detail) {
            $order
                ->orderDetails()
                ->updateOrCreate(["id" => $detail["id"]], $detail);
        }

        return redirect()
            ->route("orders.show", $order)
            ->with("success", "Order updated successfully!");
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route("orders.index")
            ->with("success", "Order deleted successfully!");
    }
}
