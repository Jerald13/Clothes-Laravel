@extends('master')
@section('content')

    <head>

        <style>
            .container-fluid {
                width: 80%;
            }

            p {
                font-size: 14px;
                margin-bottom: 7px;

            }

            .small {
                letter-spacing: 0.5px !important;
            }

            .card-1 {
                box-shadow: 2px 2px 10px 0px rgb(190, 108, 170);
            }

            hr {
                background-color: rgba(248, 248, 248, 0.667);
            }


            .bold {
                font-weight: 500;
            }

            .change-color {
                color: #AB47BC !important;
            }

            .card-2 {
                box-shadow: 1px 1px 3px 0px rgb(112, 115, 139);

            }

            .fa-circle.active {
                font-size: 8px;
                color: #AB47BC;
            }

            .fa-circle {
                font-size: 8px;
                color: #aaa;
            }

            .rounded {
                border-radius: 2.25rem !important;
            }

            .progress {
                height: 5px !important;
                margin-bottom: 0;
            }

            .progress-bar {
                height: 5px !important;
            }

            .progress-bar-new {
                background-color: #AB47BC !important;
                width: 25% !important;
            }

            .progress-bar-pending {
                background-color: #AB47BC !important;
                width: 50% !important;
            }

            .progress-bar-successful {
                background-color: #AB47BC !important;
                width: 75% !important;
            }

            .progress-bar-cancelled {
                background-color: #AB47BC !important;
                width: 100% !important;
            }

            .invoice {
                position: relative;
                top: -70px;
            }

            .Glasses {
                position: relative;
                top: -12px !important;
            }

            .card-footer {
                background-color: #AB47BC;
                color: #fff;
            }

            h2 {
                color: rgb(78, 0, 92);
                letter-spacing: 2px !important;
            }

            .display-3 {
                font-weight: 500 !important;
            }

            @media (max-width: 479px) {
                .invoice {
                    position: relative;
                    top: 7px;
                }

                .border-line {
                    border-right: 0px solid rgb(226, 206, 226) !important;
                }

            }

            @media (max-width: 700px) {

                h2 {
                    color: rgb(78, 0, 92);
                    font-size: 17px;
                }

                .display-3 {
                    font-size: 28px;
                    font-weight: 500 !important;
                }
            }

            .card-footer small {
                letter-spacing: 7px !important;
                font-size: 12px;
            }

            .border-line {
                border-right: 1px solid rgb(226, 206, 226)
            }
        </style>
    </head>

    <body>
        <div class="container-fluid my-5 d-flex  justify-content-center">
            <div class="card card-1 mt-5 mr-2">
                <div class="card-header bg-white">
                    <div class="media flex-sm-row flex-column-reverse justify-content-between  ">
                        <div class="col my-auto">
                            <h4 class="mt-3 mb-3">Your Order Details, <span
                                    class="change-color">{{ auth()->user()->username }}</span></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($orderItems as $item)
                        <div class="row">
                            <div class="col">
                                <div class="card card-2">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="sq align-self-center "> <img
                                                    class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0"
                                                    width="135" height="135" /> </div>
                                            <div class="media-body my-auto text-right">
                                                <div class="row  my-auto flex-column flex-md-row">
                                                    <div class="col my-auto">
                                                        <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                    </div>
                                                    {{-- wait product done, then only can show the color and size --}}
                                                    <div class="col-auto my-auto"> <small>Color: White</small></div>
                                                    <div class="col my-auto"> <small>Size : M</small></div>
                                                    <div class="col my-auto"> <small>{{ $item->order_quantity }}</small>
                                                    </div>
                                                    <div class="col my-auto">
                                                        <h6 class="mb-0">{{ $item->product->price }}</h6>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <hr class="my-3 ">
                                        <div class="row">
                                            <div class="col-md-3 mb-3"> <small>Order Track Status<span></span></small>
                                            </div>
                                            <div class="col mt-auto">
                                                <div class="progress my-auto">
                                                    <?php
                                                    $status = $item->order->order_status;
                                                    $progress = 0;
                                                    switch ($status) {
                                                        case 'new':
                                                            $progress = 25;
                                                            break;
                                                        case 'pending':
                                                            $progress = 50;
                                                            break;
                                                        case 'successful':
                                                            $progress = 75;
                                                            break;
                                                        case 'cancelled':
                                                            $progress = 100;
                                                            break;
                                                    }
                                                    ?>
                                                    <div class="progress-bar progress-bar-<?php echo $status; ?> rounded"
                                                        style="width: <?php echo $progress; ?>%" role="progressbar"
                                                        aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="media row justify-content-between">
                                                    <div class="col-auto text-right"><span> <small
                                                                class="text-right mr-sm-2">New</small> <i
                                                                class="fa fa-circle <?php echo $status == 'new' ? 'active' : ''; ?>"></i> </span></div>
                                                    <div class="flex-col"> <span> <small
                                                                class="text-right mr-sm-2">Pending</small><i
                                                                class="fa fa-circle <?php echo $status == 'pending' ? 'active' : ''; ?>"></i></span></div>
                                                    <div class="col-auto flex-col-auto"><small
                                                            class="text-right mr-sm-2">Successful</small><span> <i
                                                                class="fa fa-circle <?php echo $status == 'successful' ? 'active' : ''; ?>"></i></span></div>
                                                    <div class="col-auto flex-col-auto"><small
                                                            class="text-right mr-sm-2">Cancelled</small><span> <i
                                                                class="fa fa-circle <?php echo $status == 'cancelled' ? 'active' : ''; ?>"></i></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row mt-4">
                        <div class="col">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <p class="mb-1 text-dark"><b>Order Details</b></p>
                                </div>
                                <div class="flex-sm-col text-right col">
                                    <p class="mb-1"><b>Sub-Total</b></p>
                                </div>
                                <div class="flex-sm-col col-auto">
                                    <p class="mb-1">RM {{ number_format($totalOrderSubtotal, 2) }}</p>
                                </div>
                            </div>
                            {{-- After done payment, add this --}}
                            {{-- <div class="row justify-content-between">
                                <div class="flex-sm-col text-right col"><p class="mb-1"> <b>Discount</b></p> </div>
                                <div class="flex-sm-col col-auto"><p class="mb-1">&#8377;0</p></div>
                            </div> --}}
                            <div class="row justify-content-between">
                                <div class="flex-sm-col text-right col">
                                    <p class="mb-1"><b>Tax 6%</b></p>
                                </div>
                                <div class="flex-sm-col col-auto">
                                    <p class="mb-1">RM {{ number_format($item->order->tax_amount, 2) }}</p>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="flex-sm-col text-right col">
                                    <p class="mb-1"><b>Shipping Fee</b></p>
                                </div>
                                <div class="flex-sm-col col-auto">
                                    <p class="mb-1">RM {{ number_format($item->order->shipping_fee, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row invoice ">
                        <div class="col">
                            <p class="mb-1 mt-4"> Order Track Number : {{ $item->order->track_number }}</p>
                            <p class="mb-1">Order Date : {{ $item->order->created_at->format('d-m-Y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="jumbotron-fluid">
                        <div class="row justify-content-between ">
                            <div class="col-auto my-auto ">
                                <h2 class="mb-0 font-weight-bold">TOTAL PAYMENT AFTER DISCOUNT (RM)</h2>
                            </div>
                            <div class="col-auto my-auto ml-auto">
                                <h1 class="display-3 ">{{ number_format($item->order->payment->payment_amount, 2) }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
