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
        <style>
            form {
                margin-top: 6%;
            }

            .card {
                width: 35%;
                margin: auto;
                background: white;
                position: center;
                align-self: center;
                top: 10%;
                border-radius: 1.5rem;
                box-shadow: 4px 3px 20px #3535358c;
                margin-top: 2%;
                margin-bottom: 5%;

            }

            .leftside {
                background: #030303;
                width: 25rem;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-top-left-radius: 1.5rem;
                border-bottom-left-radius: 1.5rem;
            }

            .product {
                object-fit: cover;
                width: 20em;
                height: 20em;
                border-radius: 100%;
            }

            .rightside {
                background-color: #ffffff;
                width: 35rem;
                border-bottom-right-radius: 1.5rem;
                border-top-right-radius: 1.5rem;
                padding: 1rem 2rem 3rem 3rem;
            }

            label {
                display: block;
                font-size: 1.1rem;
                font-weight: 400;
                margin: .8rem 0;
                margin-top: 8%;
            }

            .inputbox {
                color: #030303;
                width: 100%;
                padding: 0.5rem;
                border: none;
                border-bottom: 1.5px solid #ccc;
                margin-bottom: 1rem;
                border-radius: 0.3rem;
                font-family: 'Roboto', sans-serif;
                color: #615a5a;
                font-size: 1.1rem;
                font-weight: 500;
                outline: none;
            }

            .expcvv {
                display: flex;
                justify-content: space-between;
                padding-top: 0.6rem;
            }

            .expcvv_text {
                padding-right: 1rem;
            }

            .expcvv_text2 {
                padding: 0 1rem;
            }

            .button {
                background: linear-gradient(135deg, #753370 0%, #298096 100%);
                padding: 15px;
                border: none;
                border-radius: 50px;
                color: white;
                font-weight: 400;
                font-size: 1.2rem;
                margin-top: 10px;
                width: 100%;
                letter-spacing: .11rem;
                outline: none;
            }

            .button:hover {
                transform: scale(1.05) translateY(-3px);
                box-shadow: 3px 3px 6px #38373785;
            }

            @media only screen and (max-width: 1000px) {
                .card {
                    flex-direction: column;
                    width: auto;

                }

                .leftside {
                    width: 100%;
                    border-top-right-radius: 0;
                    border-bottom-left-radius: 0;
                    border-top-right-radius: 0;
                    border-radius: 0;
                }

                .rightside {
                    width: auto;
                    border-bottom-left-radius: 1.5rem;
                    padding: 0.5rem 3rem 3rem 2rem;
                    border-radius: 0;
                }
            }
        </style>
    </head>

    <body>
        <form id="paymentform">
            <div class="card">
                <div class="rightside">
                    <input type="hidden" name="paymentId" value="{{ $id }}">
                    <input type="hidden" name="bankName" value="{{ $bankName }}">
                    <input type="hidden" name="paymentAmount" value="{{ $paymentAmount }}">
                    <h1 style="text-align: center">{{ $bankName }}</h1>
                    <br />
                    <h2 style="text-align: center">Online Bank Processing</h2>
                    <label for="amount">Payment Amount:</label>
                    <span>{{ 'RM ' . number_format($paymentAmount, 2, '.', '') }}</span>
                    <label for="name">Username</label>
                    <input type="text" class="inputbox" name="name" id="name" required />
                    <label for="password">Password</label>
                    <div class="password-toggle">
                        <input type="password" class="inputbox" name="password" id="password" required />
                        <input type="checkbox" id="toggle-password" onclick="togglePassword()">Show password
                    </div>
                    <button type="submit" class="button">Confirm Checkout</button>
                </div>
            </div>
        </form>
        <script>
            function togglePassword() {
                var passwordInput = document.getElementById("password");
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
            }
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Intercept the form submit event
                $('#paymentform').submit(function(e) {
                    e.preventDefault(); // Prevent the default form submission

                    // Retrieve the form data
                    var paymentId = $('input[name="paymentId"]').val();
                    var bankName = $('input[name="bankName"]').val();
                    var paymentAmount = $('input[name="paymentAmount"]').val();
                    var username = $('#name').val();
                    var password = $('#password').val();

                    // Call the retrieveAccountInfo endpoint
                    $.ajax({
                        type: 'POST',
                        url: 'http://127.0.0.1:3232/api/retrieveAccountInfo',
                        data: {
                            username: username,
                            password: password
                        },
                        success: function(response) {
                            // Call the validateAccountInfo endpoint
                            $.ajax({
                                type: 'POST',
                                url: 'http://127.0.0.1:3232/api/validateAccountInfo',
                                data: {
                                    username: username,
                                    password: password,
                                    bankName: bankName
                                },
                                success: function(response) {
                                    // Call the deductBankAmount endpoint
                                    $.ajax({
                                        type: 'POST',
                                        url: 'http://127.0.0.1:3232/api/deductBankAmount',
                                        data: {
                                            username: username,
                                            password: password,
                                            bankName: bankName,
                                            paymentAmount: paymentAmount
                                        },
                                        success: function(response) {
                                            // Payment successful
                                            alert('Payment successful! Your new account balance is ' +
                                                response.balance);
                                                window.location.href = '{{ route("paymentsuccess") }}';
                                        },
                                        error: function(jqXHR, textStatus,
                                            errorThrown) {
                                            alert('Payment failed: ' + jqXHR
                                                .responseJSON.message);
                                        }
                                    });
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    alert('Account validation failed: ' + jqXHR
                                        .responseJSON.message);
                                }
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Failed to retrieve account information: ' + jqXHR.responseJSON
                                .message);
                        }
                    });
                });
            });
        </script>
    </body>

    </html>
@endsection
