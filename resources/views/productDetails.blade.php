@extends('master')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Product Detail</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>

    <body class="animsition">
        <!-- Product Detail -->
        <section class="sec-product-detail bg0 p-t-65 p-b-60">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">
                                    @foreach ($images as $image)
                                        <?php $encodedData = base64_encode($image->data); ?>
                                        <div class="item-slick3" data-thumb="data:image/jpeg;base64,{{ $encodedData }}">
                                            <div class="wrap-pic-w pos-relative">
                                                <img src="data:image/jpeg;base64,{{ $encodedData }}" alt="IMG-PRODUCT">

                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                    href="data:image/jpeg;base64,{{ $encodedData }}">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                {{ $product->name }}
                            </h4>

                            <span class="mtext-106 cl2">
                                RM {{ $product->price }}

                            </span>

                            <!--  -->
                            <div class="p-t-33">

                                <div>Quantity: <span id="quantity">0</span></div>
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Size
                                    </div>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0 " id="variableContainer">
                                            <select id="size" name="size" class="form-control"
                                                id="exampleFormControlSelect1">
                                                <!--class="js-select2"!-->
                                                    <option>Choose an option</option>

                                                    @foreach ($stockVariableSize as $stock)
                                                        @foreach ($sizes as $size)
                                                            @if ($stock->size_id == $size->id)
                                                                <option value="{{ $size->id }}">
                                                                    {{ $size->size }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Quantity
                                    </div>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">

                                    <div class="size-204 respon6-next">
                                        <div style="width: 30%">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-dark" type="button"
                                                        onclick="decrementQuantity()" style="user-select: none;">-</button>
                                                </div>
                                                <input type="number" id="inputQuantityNew" class="form-control"
                                                    value="0" style="width:100px">
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark" type="button"
                                                        onclick="incrementQuantity()" style="user-select: none;">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{ $product->id }}" id="productId">

                            <button id="add-to-cart"
                                class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>


                <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    // Get the elements we need
                    let sizeElement = document.getElementById('size');
                    let quantityElement = document.getElementById('quantity');
                    let productIdElement = document.getElementById('productId');
                    let addToCartButton = document.getElementById('add-to-cart');
                    let containerElement = document.getElementById('variableContainer');
                    let inputQuantityElement = document.getElementById('inputQuantityNew');

                    $('#add-to-cart').on('click', function() {
                        let productId = $('#productId').val();
                        let quantity = $('#inputQuantityNew').val();
                        let size = $('#size').val();

                        $.ajax({
                            url: "{{ route('cart.add') }}",
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            data: {
                                productId: productId,
                                quantity: quantity,
                                size: size
                            },

                            success: function(response) {
                                if (response.hasOwnProperty('carts')) {
                                    let carts = response.carts;
                                    sessionStorage.setItem('carts', JSON.stringify(carts));
                                    location.reload();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }

                        });
                    });

                    function decrementQuantity() {
                        var value = parseInt(document.getElementById('inputQuantityNew').value, 10);

                        if (value !== 0) {
                            value--;
                        }
                        document.getElementById('inputQuantityNew').value = value;
                    }

                    function incrementQuantity() {
                        var value = parseInt(document.getElementById('inputQuantityNew').value, 10);
                        var max = parseInt(document.getElementById('quantity').textContent, 10);

                        if (value < max) {
                            value++;
                            document.getElementById('inputQuantityNew').value = value;
                        }

                    }



                    containerElement.addEventListener('change', function() {
                        if (event.target.id === 'size') {
                            let size = sizeElement.value;
                            // Make AJAX call here and pass the selected color and size as parameters
                            // Update the quantity element with the AJAX response
                            fetch('/get-quantity?size=' + size + '&productId=' + productIdElement.value)
                                .then(response => response.text())
                                .then(quantity => {
                                    let result = JSON.parse(quantity);
                                    quantityElement.innerHTML = result.quantity;
                                    if (parseInt(result.quantity) === 0) {
                                        document.getElementById('inputQuantityNew').value = 0;
                                    }
                                })
                                .catch(error => console.error(error));
                        }
                    });
                </script>




                <!--  -->
                <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                    <div class="flex-m bor9 p-r-10 m-r-11">
                        <a href="#"
                            class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                            data-tooltip="Add to Wishlist">
                            <i class="zmdi zmdi-favorite"></i>
                        </a>
                    </div>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                        data-tooltip="Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                        data-tooltip="Twitter">
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                        data-tooltip="Google Plus">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </div>
            </div>
            </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                        </li>



        
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>



                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">

            </div>
        </section>

        <!-- Related Products -->
        <section class="sec-relate-product bg0 p-t-45 p-b-105">
            <div class="container">
                <div class="p-b-45">
                    <h3 class="ltext-106 cl5 txt-center">
                        Related Products
                    </h3>
                </div>

                <!-- Slide2 -->
                <div class="wrap-slick2">
                    <div class="slick2">
                        @foreach ($productsSameCate as $product)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        <?php
                                        $productImage = DB::table('product_images')
                                            ->where('product_id', $product->id)
                                            ->first();
                                        $encodedData = $productImage ? base64_encode($productImage->data) : '';
                                        ?>

                                        <img src="data:image/jpeg;base64,{{ $encodedData }}" alt="IMG-PRODUCT" style="height:330px">

                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="product-detail.html"
                                                class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                {{ $product->name }}
                                            </a>

                                            <span class="stext-105 cl3">
                                                RM {{ $product->price }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>
        </section>
    </body>

    </html>
@endsection
