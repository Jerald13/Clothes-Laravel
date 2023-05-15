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
        <link rel="stylesheet" href="{{ asset('css/feather.css') }}') }}">
        <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
        <link rel="stylesheet" href="{{ asset('css/uppy.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme" disabled>
        <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Date Range Picker CSS -->
        <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme" disabled>
        <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme">

        <!-- SweetAlert CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
        <!-- Uppy CSS -->
        {{-- <link href="https://transloadit.edgly.net/releases/uppy/v1.15.5/dist/uppy.min.css" rel="stylesheet"> --}}

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css"
            integrity="sha512-ePDtJugyEp5O5j5MzgC3rOq3tOYpSZlvjL7e0PTbR5O7V0jtwySnO7LYaBY0z/dgXkEBYbGk60NhJNC68Q2u1w=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- SweetAlert JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
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
    </head>


    <body class="vertical  dark  ">

        @extends('editor.editorMaster')
        @section('content')
            <main role="main" class="main-content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <h2 class="mb-2 page-title">Products Table</h2>

                            <div class="row">
                                <div class="col-12" style="text-align: right;">

                                    <button class="btn btn-primary" id="uploadButton" style="margin-right: 10px;">Import XML
                                        File</button>

                                    <div id="uploadModal" class="modal">
                                        <div class="modal-content">
                                            <span class="close">&times;</span>
                                            <form id="uploadForm" action="{{ route('product.import.xml') }}"
                                                method="post"
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
                                                <button class="btn btn-primary" type="submit">Import Product</button>
                                            </form>
                                        </div>
                                    </div>
                                    <a href="{{ route('product.export.xml') }}"><button class="btn btn-primary">Export XML
                                            File</button></a>
                                </div>
                            </div>
                            {{-- display massegae --}}
                            @if (session('msg'))
                                <div class="alert alert-success" id="msg">
                                    {{ session('msg') }}
                                </div>
                                <script>
                                    setTimeout(function() {
                                        $('#msg').fadeOut('slow');
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
                                                <div class="my-0 text-muted small">Just create new layout Index, form,
                                                    table
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
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config', 'UA-56159088-1');

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
                                text: 'Failed to added Product XML Files to database.',
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
