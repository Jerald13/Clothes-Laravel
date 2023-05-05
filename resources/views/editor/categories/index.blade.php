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
</style>

<body class="vertical  dark  ">

    @extends('editor.editorMaster')
    @section('content')
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="mb-2 page-title">Categories Data table</h2>
                        <div class="row">
                            <div class="col-9">
                                <p class="text-muted">Add Tags such as Fashion, Lifestyle, Denim, Streetstyle, Crafts.</p>
                            </div>
                            <div class="col-3" style="text-align: right;">
                                <a href="{{ route('categories.create') }}"><button class="btn btn-primary">Add New
                                        category</button></a>
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
                                                    <th>Name</th>
                                                    <th>Active</th>
                                                    <th>No Product</th>
                                                    <th>Craeted At</th>
                                                    <th>Updated At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input">
                                                                <label class="custom-control-label"></label>
                                                            </div>
                                                        </td>

                                                        <td>{{ $category->id }}</td>
                                                        <td>{{ $category->name }}</td>
                                                        {{-- <td>{{$category->status}}</td> --}}

                                                        <td>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="{{ $category->id }}"
                                                                    onchange="updateCategoryStatus({{ $category->id }}, this.checked)"
                                                                    {{ $category->status == 'active' ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="{{ $category->id }}"></label>
                                                            </div>
                                                        </td>

                                                        <td>{{ $category->product_count }}</td>
                                                        <td>{{ $category->created_at }}</td>
                                                        <td>{{ $category->updated_at }}</td>

                                                        <td><button class="btn btn-outline-primary" 
                                                                type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <span class="text-muted sr-only" >Action</span>
                                                                Action
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('categories.edit', $category->id) }}">Edit
                                                                    Name</a>

                                                                @if ($category->product_count == 0)
                                                                    <form class="dropdown-item delete-category-form"
                                                                        id="delete-category-form-{{ $category->id }}"
                                                                        action="{{ route('categories.destroy', $category->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="dropdown-item delete-category-btn"
                                                                            type="button"
                                                                            data-id="{{ $category->id }}">Delete</button>
                                                                    </form>
                                                                @endif



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


        <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
        <script>
            $(document).on('click', '.delete-category-btn', function(e) {
                e.preventDefault();
                var categoryId = $(this).data('id');
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this category!",
                        icon: "warning",
                        buttons: ["Cancel", "Yes, delete it!"],
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $('#delete-category-form-' + categoryId).submit();
                        }
                    });
            });

            function updateCategoryStatus(categoryId, isChecked) {
                $.ajax({
                        method: 'POST',
                        url: '/categories/' + categoryId + '/status',
                        data: {
                            status: isChecked ? 'active' : 'inactive'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    .done(function(response) {
                        // Show a success message to the user
                        Swal.fire({
                            title: 'Success!',
                            text: 'Category status updated to ' + response.status + '.',
                            icon: 'success'
                        });
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        // Show an error message to the user
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update category status.',
                            icon: 'error'
                        });
                    });
            }


            //         function updateCategoryStatus(categoryId, isChecked) {
            //   $.ajax({
            //     method: 'POST',
            //     url: '/categories/' + categoryId + '/status',
            //     data: { status: isChecked ? 'active' : 'inactive' },
            //     headers: {
            //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            //   })
            //   .done(function() {
            //     // Optional: Show a success message to the user
            //   })
            //   .fail(function(jqXHR, textStatus, errorThrown) {
            //     // Optional: Show an error message to the user
            //   });
            // }
        </script>
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
