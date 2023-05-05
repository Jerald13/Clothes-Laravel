@extends('master')
@section('content')

    <head>
        <link rel="stylesheet" href="css/ordertable.css">
        <style>
            .no-orders {
                text-align: center;
                font-size: 24px;
                color: #999;
                margin-top: 50px;
            }
        </style>
    </head>

    <body>
        <div class="container mt-5 pt-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    <div class="rounded"></div>
                    <div class="table-responsive table-borderless">
                        <h4>My Orders </h4>
                        @if (count($orderItems) > 0)
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Order Track No: </th>
                                        <th>Username: </th>
                                        <th>Phone Number:</th>
                                        <th>Payment Method: </th>
                                        <th>Ordered Date: </th>
                                        <th>Order Status: </th>
                                        <th>Action: </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach ($orderItems as $item)
                                    <tbody class="table-body">
                                        <tr class="cell-1">
                                            <td class="text-center"></td>
                                            <td> {{ $item->track_number }}</td>
                                            <td> {{ auth()->user()->username }}</td>
                                            <td> {{ auth()->user()->phone_number }}</td>
                                            {{-- wait payment done --}}
                                            <td>@if ($item->payment)
                                                Paid By  {{ $item->payment->payment_method }}
                                                @else
                                                Haven't Paid
                                                @endif
                                            </td>
                                            <td> {{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                @if ($item->order_status == 'new')
                                                    <span class="badge badge-light">{{ $item->order_status }}</span>
                                                @elseif ($item->order_status == 'pending')
                                                    <span class="badge badge-warning">{{ $item->order_status }}</span>
                                                @elseif ($item->order_status == 'successful')
                                                    <span class="badge badge-success">{{ $item->order_status }}</span>
                                                @elseif ($item->order_status == 'cancelled')
                                                    <span class="badge badge-danger">{{ $item->order_status }}</span>
                                                @endif
                                            </td>
                                            <td><a href="{{ route('orders.showOrderDetail', ['id' => $item->id]) }}"
                                                    class="btn btn-primary">View</a></td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        @else
                            <tr>
                                <td colspan="9">
                                    <div class="no-orders">
                                        There are no any order(s) to display.
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
@endsection
