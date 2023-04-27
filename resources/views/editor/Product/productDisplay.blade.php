    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="favicon.ico">
        <title>Product List</title>
        <!-- Simple bar CSS -->
        <link rel="stylesheet" href="{{ asset('css/simplebar.css') }}">
        <!-- Fonts CSS -->
        <link
            href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <!-- Icons CSS -->
        <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">
        <!-- Date Range Picker CSS -->
        <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme" disabled>
        <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme">
    </head>

    <body class="vertical  dark  ">

        @extends('editor.editorMaster')
        @section('content')
            <main role="main" class="main-content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            {{-- display massegae --}}
                            @if (session('msg_deleted'))
                                <div class="alert alert-success" id="msg_deleted">
                                    {{ session('msg_deleted') }}
                                </div>
                                <script>
                                    setTimeout(function() {
                                        $('#msg_deleted').fadeOut('slow');
                                    }, 5000); // 5000 milliseconds = 5 seconds                      
                                </script>
                            @endif
                            {{-- End display massegae --}}
                            <div class="row my-4">
                                <!-- Small table -->
                                <div class="col-md-12">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <!-- table -->
                                            <table class="table datatables" id="dataTable-1">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Price (RM)</th>
                                                        <th>Description</th>
                                                        <th>Create At</th>
                                                        <th>Update At</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($products as $product)
                                                        <tr>
                                                            <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input">
                                                                    <label class="custom-control-label"></label>
                                                                </div>
                                                            </td>
                                                            <td>{{ $product->id }}</td>
                                                            <td>{{ $product->name }}</td>
                                                            <td style="text-align: right">{{ $product->price }}</td>
                                                            <td
                                                                style="max-width: 300px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                                                {{ $product->description }}</td>
                                                            <td>{{ $product->created_at }}</td>
                                                            <td>
                                                                @if ($product->updated_at != $product->created_at)
                                                                    {{ $product->updated_at }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <span class="text-muted sr-only">Action</span>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('editor.product.productEdit', $product->id) }}">Edit</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('editor.product.productDestory', $product->id) }}"
                                                                        onclick="return confirm('Are you sure you want to delete Product (Name: {{ $product->name . ', ID:' . $product->id . '' }})?')">Remove</a>
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
                <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog"
                    aria-labelledby="defaultModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="list-group list-group-flush my-n3">
                                    <div class="list-group-item bg-transparent">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="fe fe-box fe-24"></span>
                                            </div>
                                            <div class="col">
                                                <small><strong>Package has uploaded successfull</strong></small>
                                                <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                                                <small class="badge badge-pill badge-light text-muted">1m ago</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item bg-transparent">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="fe fe-download fe-24"></span>
                                            </div>
                                            <div class="col">
                                                <small><strong>Widgets are updated successfull</strong></small>
                                                <div class="my-0 text-muted small">Just create new layout Index, form, table
                                                </div>
                                                <small class="badge badge-pill badge-light text-muted">2m ago</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item bg-transparent">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="fe fe-inbox fe-24"></span>
                                            </div>
                                            <div class="col">
                                                <small><strong>Notifications have been sent</strong></small>
                                                <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo
                                                </div>
                                                <small class="badge badge-pill badge-light text-muted">30m ago</small>
                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                    <div class="list-group-item bg-transparent">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="fe fe-link fe-24"></span>
                                            </div>
                                            <div class="col">
                                                <small><strong>Link was attached to menu</strong></small>
                                                <div class="my-0 text-muted small">New layout has been attached to the menu
                                                </div>
                                                <small class="badge badge-pill badge-light text-muted">1h ago</small>
                                            </div>
                                        </div>
                                    </div> <!-- / .row -->
                                </div> <!-- / .list-group -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear
                                    All</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog"
                    aria-labelledby="defaultModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body px-5">
                                <div class="row align-items-center">
                                    <div class="col-6 text-center">
                                        <div class="squircle bg-success justify-content-center">
                                            <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                                        </div>
                                        <p>Control area</p>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="squircle bg-primary justify-content-center">
                                            <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                                        </div>
                                        <p>Activity</p>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-6 text-center">
                                        <div class="squircle bg-primary justify-content-center">
                                            <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                                        </div>
                                        <p>Droplet</p>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="squircle bg-primary justify-content-center">
                                            <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                                        </div>
                                        <p>Upload</p>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-6 text-center">
                                        <div class="squircle bg-primary justify-content-center">
                                            <i class="fe fe-users fe-32 align-self-center text-white"></i>
                                        </div>
                                        <p>Users</p>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="squircle bg-primary justify-content-center">
                                            <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                                        </div>
                                        <p>Settings</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config', 'UA-56159088-1');
            </script>

        </body>

        </html>
    @endsection
