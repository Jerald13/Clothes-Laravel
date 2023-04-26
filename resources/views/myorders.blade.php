@extends('master')
@section('content')

    <head>
        <link rel="stylesheet" href="css/ordertable.css">
    </head>

    <body>
        <div class="container mt-5 pt-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10">
                    <div class="rounded"></div>
                    <div class="table-responsive table-borderless">
                        <h4>My Orders </h4>
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
                                        <td> Paid By ...</td>
                                        <td> {{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @if ($item->order_status == 'new')
                                                <span class="badge badge-light">{{ $item->order_status }}</span>
                                            @elseif ($item->order_status == 'processing')
                                                <span class="badge badge-dark">{{ $item->order_status }}</span>
                                            @elseif ($item->order_status == 'shipping')
                                                <span class="badge badge-info">{{ $item->order_status }}</span>
                                            @elseif ($item->order_status == 'received')
                                                <span class="badge badge-success">{{ $item->order_status }}</span>
                                            @elseif ($item->order_status == 'rated')
                                                <span class="badge badge-warning">{{ $item->order_status }}</span>
                                            @endif
                                        </td>
                                        <td><a href="{{ route('orders.showOrderDetail', ['id' => $item->id]) }}"
                                                class="btn btn-primary">View</a></td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
@endsection
