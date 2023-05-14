<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    {{-- {{ asset('{{ asset('css/feather.css') }}') }} --}}
    <link rel="stylesheet" href="{{ asset('css/feather.css') }}') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uppy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <!-- Uppy CSS -->
    {{-- <link href="https://transloadit.edgly.net/releases/uppy/v1.15.5/dist/uppy.min.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css"
        integrity="sha512-ePDtJugyEp5O5j5MzgC3rOq3tOYpSZlvjL7e0PTbR5O7V0jtwySnO7LYaBY0z/dgXkEBYbGk60NhJNC68Q2u1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
</head>
<style>
    .dropdown-item:hover {
        color: #16181b !important;
    }

    button.btn.btn-link {
        color: #ced4da;
        padding: unset;
    }

    button.btn.btn-link:hover {
        color: #16181b !important;

    }

    form.dropdown-item:hover {
        color: #16181b !important;
    }

    button.btn.btn-link {
        text-decoration: none;
    }

    button.dropdown-item {
        padding: unset;
    }

    button.dropdown-item.btn.btn-danger:hover {
        color: #CCCCCC !important;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-content {
        width: 52% !important;
        height: 27% !important;
    }
</style>

<body class="vertical  dark  ">

    @extends('editor.editorMaster')
    @section('content')
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="mb-2 page-title">Orders Data table</h2>

                        <div class="row">
                            <div class="col-9">
                                <p class="text-muted">Display order status with username, email, phone number, shipping
                                    address, order total. For those who order items that are new,pending,successful,cancelled,delivered
                                    then the Editor or Admin able update order status.</p>
                            </div>
                            <div class="col-3" style="text-align: right;">

                                <button class="btn btn-primary" id="uploadButton" style="margin-right: 10px;">Import XML
                                    File</button>

                                <div id="uploadModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <form id="uploadForm" action="{{ route('orders.import.xml') }}" method="post"
                                            style="justify-content: center;margin: auto;text-align: left;">
                                            @csrf

                                            <div class="form-group">
                                                <label for="xmlFile">Select or drag and drop an XML file</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="xmlFile"
                                                        name="xmlFile" accept=".xml" required>
                                                    <label class="custom-file-label" for="xmlFile">Choose file</label>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Import Orders</button>
                                        </form>
                                    </div>
                                </div>
                                <a href="{{ route('orders.export.xml') }}"><button class="btn btn-primary">Export XML
                                        File</button></a>
                            </div>
                        </div>

                        <div class="row my-4">
                            <!-- Small table -->
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <!-- table -->
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <th>ID</th>
                                                    <th>UserName</th>
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <th>Address</th>
                                                    <th>State</th>
                                                    <th>Post Code</th>
                                                    <th>Total (RM)</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input">
                                                                <label class="custom-control-label"></label>
                                                            </div>
                                                        </td>

                                                        <td>{{ $order->id }}</td>
                                                        <td>{{ $order->user->username }}</td>
                                                        <td>{{ $order->user->email }}</td>
                                                        <td>{{ $order->user->phone_number }}</td>
                                                        <td>{{ $order->shipping_address ?? '-' }}</td>
                                                        <td>{{ $order->state ?? '-' }}</td>
                                                        <td>{{ $order->postcode ?? '-' }}</td>
                                                        <td>{{ $order->order_total }}</td>
                                                        <td>{{ $order->order_status }}</td>
                                                        <td>{{ $order->created_at }}</td>
                                                        <td>{{ $order->updated_at }}</td>

                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm dropdown-toggle more-horizontal"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <span class="text-muted sr-only">Action</span>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    style="padding: 10px;">
                                                                    <form
                                                                        action="{{ route('orders.updateOrderStatus', $order) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <select name="status">
                                                                            <option
                                                                                value="pending"{{ $order->status == 'pending' ? ' selected' : '' }}>
                                                                                Pending</option>
                                                                            <option
                                                                                value="successful"{{ $order->status == 'successful' ? ' selected' : '' }}>
                                                                                Successful</option>
                                                                            <option
                                                                                value="cancelled"{{ $order->status == 'cancelled' ? ' selected' : '' }}>
                                                                                Cancelled</option>
                                                                        </select>
                                                                        <button type="submit"
                                                                            class="dropdown-item btn btn-sm btn-dark">Update
                                                                            Status</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- simple table -->
                        </div> <!-- end section -->
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->

        </main> <!-- main -->
        </div> <!-- .wrapper -->

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/simplebar.min.js') }}"></script>
        <script src="{{ asset('js/daterangepicker.js') }}"></script>
        <script src="{{ asset('js/jquery.stickOnScroll.js') }}"></script>
        <script src="{{ asset('js/tinycolor-min.js') }}"></script>
        <script src="{{ asset('js/config.js') }}"></script>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/uppy.min.js') }}"></script>
        <script src="{{ asset('js/quill.min.js') }}"></script>
        <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>

        <script>
            $('#dataTable-1').DataTable({
                autoWidth: true,
                "lengthMenu": [
                    [16, 32, 64, -1],
                    [16, 32, 64, "All"]
                ]
            });
        </script>
        <script src="{{ asset('js/apps.js') }}"></script>
        <!-- Global site user (guser.js) - Google Analytics -->
        <script async src="https://www.googleusermanager.com/guser/js?id=UA-56159088-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function guser() {
                dataLayer.push(arguments);
            }
            guser('js', new Date());
            guser('config', 'UA-56159088-1');


            // Get the modal
            var modal = document.getElementById("uploadModal");

            // Get the button that opens the modal
            var btn = document.getElementById("uploadButton");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            // Handle form submission
            var form = document.getElementById("uploadForm");
            form.addEventListener("submit", function(event) {
                event.preventDefault();
                var formData = new FormData(form);
                fetch(form.action, {
                    method: form.method,
                    body: formData
                }).then(response => {
                    if (response.ok) {

                        Swal.fire({
                            title: 'Success!',
                            text: 'XML Files added to database' + '.',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });

                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to added Order XML Files to database.',
                            icon: 'error'
                        }).then(() => {
                            location.reload();
                        });
                    }
                });
            });
        </script>

        <script>
            const fileInput = document.getElementById("xmlFile");
            const fileLabel = document.querySelector(".custom-file-label");

            fileInput.addEventListener("change", () => {
                fileLabel.textContent = fileInput.files[0].name;
            });
        </script>


    </body>

    </html>
@endsection
