@extends('master')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <body class="animsition">

        <head>
            <!-- Title -->
            <title>Shop</title>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta http-equiv="x-ua-compatible" content="ie=edge">

            <!-- Favicon -->
            <link rel="shortcut icon" href="public/img/favicon.ico">

            <!-- Template -->
            <link rel="stylesheet" href="public/graindashboard/css/graindashboard.css">
        </head>

        <!-- Product -->
        <div class="bg0 m-t-23 p-b-140" style="margin-top: 100px">
            <div class="container">
                <div class="flex-w flex-sb-m p-b-52">
                    <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                            All Products
                        </button>

                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".women">
                            Women
                        </button>

                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".men">
                            Men
                        </button>

                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".bag">
                            Bag
                        </button>

                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".shoes">
                            Shoes
                        </button>

                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".watches">
                            Watches
                        </button>
                    </div>

                   

                    <!-- Search product -->
                    <div class="dis-none panel-search w-full p-t-10 p-b-15">
                        <div class="bor8 dis-flex p-l-15">
                            <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                                <i class="zmdi zmdi-search"></i>
                            </button>

                            <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
                                placeholder="Search">
                        </div>
                    </div>
                </div>

                <div class="row isotope-grid">
                    @foreach ($products as $product)
                        <div
                            class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item 
				@foreach ($categories as $category)	
									
				@if ($product->category_id == $category->id)
					{{ $category->name }}
				@endif @endforeach	
				">
                            <!-- Block2 -->
                            <div class="block2">
                                <a href="{{ route('productDetails', ['id' => $product['id']]) }}"
                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    <div class="block2-pic hov-img0">
                                        <?php
                                        $productImage = $images->where('product_id', $product->id)->first();
                                        $encodedData = $productImage ? base64_encode($productImage->data) : '';
                                        ?>

                                        <img src="data:image/jpeg;base64,{{ $encodedData }}" alt="IMG-PRODUCT">
                                    </div>
                                </a>


                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="{{ route('productDetails', ['id' => $product['id']]) }}"
                                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{ $product['name'] }}

                                        </a>

                                        <span class="stext-105 cl3">
                                            {{ $product['price'] }}

                                        </span>
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- Load more -->
                <div class="flex-c-m flex-w w-full p-t-45">
                    <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                        Load More
                    </a>
                </div>
            </div>
        </div>

    </body>

    </html>
@endsection
