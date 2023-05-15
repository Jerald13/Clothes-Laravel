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
    <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uppy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme">
</head>

<body class="vertical dark ">
    @extends('editor.editorMaster')
    @section('content')
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="page-title">Form Edit Product</h2>
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
                        @elseif(session('msg-error'))
                            <div class="alert alert-danger" id="msg">
                                {{ session('msg-error') }}
                            </div>
                            <script>
                                setTimeout(function() {
                                    $('#msg').fadeOut('slow');
                                }, 5000); // 5000 milliseconds = 5 seconds                      
                            </script>
                        @endif
                        {{-- End display massegae --}}
                        <div class="row" style="justify-content: center;">
                            <div class="col-md-12" style="width:958px;max-width: 110%;">
                                <form action="{{ route('editor.product.productUpdate', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <!-- Card !-->
                                    <div class="card shadow mb-4">
                                        <div class="card-header">
                                            <strong class="card-title">Add Product</strong>
                                        </div>
                                        <div class="card-body">
                                            <p>Frist uploaded image will become feature image. Dont upload any if no to
                                                update image</p>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card shadow mb-4">
                                                        <div class="card-header">
                                                            <strong>Image Upload</strong>
                                                        </div>
                                                        <div class="parent">
                                                            <div class="form-group">
                                                                <input type="file" name="images[]" style="margin:auto"
                                                                    multiple>
                                                            </div>
                                                        </div>
                                                        <script>
                                                            FilePond.registerPlugin(FilePondPluginFileValidateType);
                                                            FilePond.registerPlugin(FilePondPluginImagePreview);
                                                            FilePond.registerPlugin(FilePondPluginFileEncode);
                                                            FilePond.registerPlugin(FilePondPluginFileValidateSize);
                                                            FilePond.registerPlugin(FilePondPluginImageExifOrientation);

                                                            const pondInput = FilePond.create(
                                                                document.querySelector('#image')
                                                            );



                                                            //   let data = new FormData();
                                                            // const pondFiles = pondInput.getFiles();
                                                            //   console.log(pondFiles);
                                                            // for (let i = 0; i < pondFiles.length; i++) {
                                                            //   data.append('File', pondFiles[i].file);
                                                            //   pondInput.removeFile(i);
                                                            // }
                                                        </script>
                                                    </div> <!-- .card -->
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="simpleinput">Product Name</label>
                                                        <input type="text" id="simpleinput" name='prodName'
                                                            value="{{ $product->name }}" class="form-control">
                                                    </div>
                                                    <div class="form-group mb-3" style="width: 70%">
                                                        <label for="example-textarea">Description</label>
                                                        <textarea class="form-control" id="example-textarea" name="prodDesc" rows="4">{{ $product->description }}</textarea>
                                                    </div>
                                                    <div class="form-group mb-3" style="width:20%">
                                                        <label for="custom-select">Category</label>
                                                        <select class="custom-select" id="custom-select" name='category_id'>
                                                            <option value="{{ $product->category_id }}"selected>
                                                                @foreach ($categories as $category)
                                                                    @if ($category->id == $product->category_id)
                                                                        {{ $category->name }}
                                                                    @endif
                                                                @endforeach
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                @if ($category->id != $product->category_id)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name }}
                                                                @endif

                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <label>Price</label>
                                                    <div class="input-group mb-3" style='width:150px;'>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">$</span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            aria-label="Amount (to the nearest dollar)" name="prodPrice"
                                                            value="{{ $product->price }}">

                                                    </div>
                                                    <div id="input-container">
                                                        <label for="size">Variable</label>
                                                        <?php $count = 0; ?>
                                                        @foreach ($stocks as $stock)
                                                            <?php $count++; ?>
                                                            <div class="row" id="new_1">

                                                                <div class="col-md-2">
                                                                    <div class="form-group mb-3">
                                                                        <label for="size">Size</label>
                                                                        <select class="custom-select" name="size[]">
                                                                            <option value="{{ $stock->size_id }}"selected>
                                                                                @foreach ($sizes as $size)
                                                                                    @if ($stock->size_id == $size->id)
                                                                                        {{ $size->size }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </option>
                                                                            @foreach ($sizes as $size)
                                                                                @if ($stock->size_id != $size->id)
                                                                                    <option value="{{ $size->id }}">
                                                                                        {{ $size->size }}
                                                                                    </option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <div class="form-group mb-3 " style="width:100px;">
                                                                        <label for="quantity">Quantity</label>
                                                                        <input type="number" class="form-control"
                                                                            id="quantity" name="quantity[]"
                                                                            min="0"
                                                                            value="{{ $stock->quantity }}">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        @endforeach
                                                        @for ($i = $count; $i < 5; $i++)
                                                            <div class="row" id="new_1">
                                                                <div class="col-md-3">
                                                                    <div class="form-group mb-2">
                                                                        <label for="size">Size</label>
                                                                        <select class="custom-select" name="size[]">
                                                                            <option selected value=0>--Select Category--
                                                                            </option>
                                                                            @foreach ($sizes as $size)
                                                                                <option value="{{ $size->id }}">
                                                                                    {{ $size->size }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group mb-7 " style="width:100px;">
                                                                        <label for="quantity">Quantity</label>
                                                                        <input type="number" class="form-control"
                                                                            id="quantity" name="quantity[]"
                                                                            min="0" value="0">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div>
                                                    <input class="btn btn-primary" type='submit' value="Submit"
                                                        onclick="submitData()">
                                                </div>
                                </form>
                            </div> <!-- / .card -->
                        </div> <!-- /.col -->

        </main> <!-- main -->





        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


        </form>
        </div> <!-- / .card -->
        </div> <!-- /.col -->

        </div> <!-- .wrapper -->

        <script src=" {{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/simplebar.min.js') }}"></script>
        <script src='{{ asset('js/daterangepicker.js') }}'></script>
        <script src='{{ asset('js/jquery.stickOnScroll.js') }}'></script>
        <script src="{{ asset('js/tinycolor-min.js') }}"></script>
        <script src="{{ asset('js/config.js') }}"></script>
        <script src='{{ asset('js/jquery.mask.min.js') }}'></script>
        <script src='{{ asset('js/select2.min.js') }}'></script>
        <script src='{{ asset('js/jquery.steps.min.js') }}'></script>
        <script src='{{ asset('js/jquery.validate.min.js') }}'></script>
        <script src='{{ asset('js/jquery.timepicker.js') }}'></script>
        <script src='{{ asset('js/dropzone.min.js') }}'></script>
        <script src='{{ asset('js/uppy.min.js') }}'></script>
        <script src='{{ asset('js/quill.min.js') }}'></script>
        <script>
            $('.select2').select2({
                theme: 'bootstrap4',
            });
            $('.select2-multi').select2({
                multiple: true,
                theme: 'bootstrap4',
            });
            $('.drgpicker').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                showDropdowns: true,
                locale: {
                    format: 'MM/DD/YYYY'
                }
            });
            $('.time-input').timepicker({
                'scrollDefault': 'now',
                'zindex': '9999' /* fix modal open */
            });
            /** date range picker */
            if ($('.datetimes').length) {
                $('.datetimes').daterangepicker({
                    timePicker: true,
                    startDate: moment().startOf('hour'),
                    endDate: moment().startOf('hour').add(32, 'hour'),
                    locale: {
                        format: 'M/DD hh:mm A'
                    }
                });
            }
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                        'month')]
                }
            }, cb);
            cb(start, end);
            $('.input-placeholder').mask("00/00/0000", {
                placeholder: "__/__/____"
            });
            $('.input-zip').mask('00000-000', {
                placeholder: "____-___"
            });
            $('.input-money').mask("#.##0,00", {
                reverse: true
            });
            $('.input-phoneus').mask('(000) 000-0000');
            $('.input-mixed').mask('AAA 000-S0S');
            $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
                translation: {
                    'Z': {
                        pattern: /[0-9]/,
                        optional: true
                    }
                },
                placeholder: "___.___.___.___"
            });
            // editor
            var editor = document.getElementById('editor');
            if (editor) {
                var toolbarOptions = [
                    [{
                        'font': []
                    }],
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{
                            'header': 1
                        },
                        {
                            'header': 2
                        }
                    ],
                    [{
                            'list': 'ordered'
                        },
                        {
                            'list': 'bullet'
                        }
                    ],
                    [{
                            'script': 'sub'
                        },
                        {
                            'script': 'super'
                        }
                    ],
                    [{
                            'indent': '-1'
                        },
                        {
                            'indent': '+1'
                        }
                    ], // outdent/indent
                    [{
                        'direction': 'rtl'
                    }], // text direction
                    [{
                            'color': []
                        },
                        {
                            'background': []
                        }
                    ], // dropdown with defaults from theme
                    [{
                        'align': []
                    }],
                    ['clean'] // remove formatting button
                ];
                var quill = new Quill(editor, {
                    modules: {
                        toolbar: toolbarOptions
                    },
                    theme: 'snow'
                });
            }
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
        <script>
            var uptarg = document.getElementById('drag-drop-area');
            if (uptarg) {
                var uppy = Uppy.Core().use(Uppy.Dashboard, {
                    inline: true,
                    target: uptarg,
                    proudlyDisplayPoweredByUppy: false,
                    theme: 'dark',
                    width: 770,
                    height: 210,
                    plugins: ['Webcam']
                }).use(Uppy.Tus, {
                    endpoint: 'https://master.tus.io/files/'
                });
                uppy.on('complete', (result) => {
                    console.log('Upload complete! We’ve uploaded these files:', result.successful)
                });
            }
        </script>
        <script src="js/apps.js"></script>
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
