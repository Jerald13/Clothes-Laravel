@extends('master')
@section('content')
    <!DOCTYPE html>
    <html>

    <head>
        <title>CheckOut Page</title>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:title" content="">
        <meta property="og:type" content="">
        <meta property="og:url" content="">
        <meta property="og:image" content="">
        <link rel="stylesheet" href="css/orderPayment.css">
        <style>
            @media (max-width:420px) {
                .product-grid-4 .col-12 {
                    width: 50% !important;
                }
            }
        </style>
    </head>

    <body>
        <div class="container mt-5 pt-4 mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="shipping-address">
                        <h4>Please fill out your Shipping Address*</h4>
                        <div class="form-group mt-3">
                            <label for="fname">Full name *</label>
                            <input type="text" required="" name="fname" placeholder="Full name *"
                                value="{{ auth()->user()->username }} " readonly
                                style="background-color: #f8f8f8; color: #555;">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone number *</label>
                            <input required="" type="text" name="phone" placeholder="Phone Number *"
                                value="{{ auth()->user()->phone_number }}" readonly
                                style="background-color: #f8f8f8; color: #555;">
                        </div>
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="billing_address">Address *</label>
                                <input type="text" name="billing_address" required="" placeholder="Address *">
                            </div>
                            <div class="form-group">
                                <div class="custom_select">
                                    <label for="state">State *</label>
                                    <select name="state" id="state" class="form-control select-active" required="">
                                        <option value="">Please choose your state</option>
                                        <option value="Johor">Johor</option>
                                        <option value="Kedah">Kedah</option>
                                        <option value="Kelantan">Kelantan</option>
                                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                                        <option value="Labuan">Labuan</option>
                                        <option value="Melaka">Melaka</option>
                                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Penang">Penang</option>
                                        <option value="Perak">Perak</option>
                                        <option value="Perlis">Perlis</option>
                                        <option value="Putrajaya">Putrajaya</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Sarawak">Sarawak</option>
                                        <option value="Selangor">Selangor</option>
                                        <option value="Terengganu">Terengganu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom_select">
                                    <label for="city">City *</label>
                                    <select name="city" id="city" class="form-control select-active" required="">
                                        <option value="">Please choose your city</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="zipcode">Zip Code *</label>
                                <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *">
                            </div>
                            <div class="form-group">
                                <label for="country">Country *</label>
                                <input required="" type="text" name="country" placeholder="Malaysia *" readonly value="Malaysia" style="background-color: #f8f8f8; color: #555;">
                            </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>Product Ordered</h4>
                        </div>
                        <div class="table-responsive order_table text-center">
                            @if (!is_null($cartItems) && count($cartItems) > 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td>
                                                    <h5>{{ $item->product->name }}</h5>
                                                </td>
                                                <td class="product-qty">{{ $item->user_quantity }}</td>
                                                <td>{{ $item->product->price * $item->user_quantity }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th>Subtotal (RM)</th>
                                            <td class="product-subtotal" colspan="3">{{ number_format($subtotal, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tax Amount (RM)</th>
                                            <td class="product-subtotal" colspan="3">{{ number_format($taxAmount, 2) }}
                                            </td>
                                        </tr>
                                        <tr id="shipping-fee-row">
                                            <th>Shipping Fee (RM)</th>
                                            <td colspan="3"><em
                                                    id="shipping-fee">{{ number_format($shippingFee, 2) }}</em></td>
                                        </tr>
                                        <tr>
                                            <th>Total (RM) </th>
                                            <td colspan="3" class="product-subtotal"><span id="total"
                                                    class="font-xl text-brand fw-900">{{ number_format($orderTotal, 2) }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <p>Your cart is empty.</p>
                            @endif
                            <div class="apply_voucher">
                                <div class="mb-25 text-left">
                                  <h4>Voucher</h4>
                                </div>
                                <div class="form-group" style="display: flex; justify-content: space-between;">
                                    <input required="" type="text" name="zipcode" placeholder="Enter Voucher Code" style="width:70%; margin-right: 10px;">
                                    <button type="submit" style="width:30%; display: flex; justify-content: center; align-items: center; color: white; background:#1a9cb7; border: none;">
                                        <span style="text-align: center;">APPLY</span>
                                    </button>
                                </div>
                              </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio"
                                            name="payment_option" id="exampleRadios3">
                                        <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                                            data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Cash On
                                            Delivery</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio"
                                            name="payment_option" id="exampleRadios4">
                                        <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                            data-target="#cardPayment" aria-controls="cardPayment">Card Payment</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio"
                                            name="payment_option" id="exampleRadios5">
                                        <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse"
                                            data-target="#paypal" aria-controls="paypal">Paypal</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('order.cancel', ['id' => $orderId]) }}"
                                    class="btn btn-fill-out btn-block">Cancel Order</a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-fill-out btn-block">Place Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Define the state and city options as arrays of objects
            var states = [{
                    name: "Johor",
                    cities: ["Johor Bahru", "Batu Pahat", "Kluang"]
                },
                {
                    name: "Kedah",
                    cities: ["Alor Setar", "Kulim", "Langkawi"]
                },
                {
                    name: "Kelantan",
                    cities: ["Kota Bharu", "Pasir Mas", "Tanah Merah"]
                },
                {
                    name: "Kuala Lumpur",
                    cities: ["Kuala Lumpur", "Kepong"]
                },
                {
                    name: "Labuan",
                    cities: ["Labuan"]
                },
                {
                    name: "Melaka",
                    cities: ["Melaka"]
                },
                {
                    name: "Negeri Sembilan",
                    cities: ["Seremban", "Nilai", "Port Dickson"]
                },
                {
                    name: "Pahang",
                    cities: ["Kuantan", "Temerloh", "Bentong"]
                },
                {
                    name: "Penang",
                    cities: ["George Town", "Butterworth", "Bukit Mertajam"]
                },
                {
                    name: "Perak",
                    cities: ["Ipoh", "Taiping", "Sitiawan"]
                },
                {
                    name: "Perlis",
                    cities: ["Kangar", "Arau"]
                },
                {
                    name: "Putrajaya",
                    cities: ["Putrajaya"]
                },
                {
                    name: "Sabah",
                    cities: ["Kota Kinabalu", "Sandakan", "Tawau"]
                },
                {
                    name: "Sarawak",
                    cities: ["Kuching", "Sibu", "Miri"]
                },
                {
                    name: "Selangor",
                    cities: ["Shah Alam", "Petaling Jaya", "Klang"]
                },
                {
                    name: "Terengganu",
                    cities: ["Kuala Terengganu", "Besut", "Dungun"]
                }
            ];

            // Get the state and city select elements
            var stateSelect = document.getElementById("state");
            var citySelect = document.getElementById("city");

            // Add an event listener to the state select element
            stateSelect.addEventListener("change", function() {
                // Get the selected state
                var selectedState = states.find(function(state) {
                    return state.name === stateSelect.value;
                });

                // Clear the city select element
                citySelect.innerHTML = '<option value="">Please choose your city</option>';

                // Add the cities for the selected state to the city select element
                selectedState.cities.forEach(function(city) {
                    var option = document.createElement("option");
                    option.text = city;
                    option.value = city;
                    citySelect.add(option);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Get the shipping fee and total elements
                var shippingFeeElem = $('#shipping-fee');
                var totalElem = $('#total');

                // Set the default shipping fee to "-"
                shippingFeeElem.text('-');

                // Handle the change event of the state dropdown
                $('#state').on('change', function() {
                    // Get the selected state
                    var state = $(this).val();

                    // Update the shipping fee based on the selected state
                    var shippingFee = (state == 'Sabah' || state == 'Sarawak') ? 8.00 : 5.00;
                    shippingFeeElem.text(shippingFee.toFixed(2));

                    // Update the total based on the shipping fee
                    var orderTotal = parseFloat('{{ $orderTotal }}');
                    if (isNaN(orderTotal)) {
                        orderTotal = 0;
                    }
                    orderTotal += shippingFee;
                    totalElem.text(orderTotal.toFixed(2));
                });
            });
        </script>
    </body>

    </html>
@endsection