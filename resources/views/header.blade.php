<?php
use App\Http\Controllers\ProductController;
$total = 0;
if (Session::has("user")) {
    $total = ProductController::cartItem();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/linearicons-v1.0.0/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/MagnificPopup/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">

    <!--===============================================================================================-->
    {{-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> --}}
</head>

<body class="animsition">

    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">
                        Free shipping for standard order over $100
                    </div>
                    <div class="right-top-bar flex-w h-full">
                        @if (Session::has('user'))

                            <a href="{{ asset('/logout') }}" class="flex-c-m p-lr-10 trans-04">
                                Logout
                            </a>

                            <a href="{{ asset('/profile') }}" class="flex-c-m p-lr-10 trans-04">
                                {{ Session::get('user')['username'] }}
                                @if (Session::get('user')['name'] == 'User')
                                    Account
                                @elseif(Session::get('user')['name'] == 'Editor')
                                    Editor
                                    <a href="{{ asset('editor/index') }}" class="flex-c-m p-lr-10 trans-04">
                                        Editor Site
                                    </a>
                                @else
                                    Admin
                                    <a href="{{ asset('editor/index') }}" class="flex-c-m p-lr-10 trans-04">
                                        Editor Site
                                    </a>
                                @endif
                            </a>
                        @else
                            <a href="{{ asset('/login') }}" class="flex-c-m p-lr-10 trans-04">
                                Login
                            </a>

                            <a href="{{ asset('/register') }}" class="flex-c-m p-lr-10 trans-04">
                                Register
                            </a>
                        @endif
                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            EN
                        </a>

                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            USD
                        </a>
                    </div>
                </div>
            </div>

            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="{{ route('index') }}" class="logo">
                        <img src="{{ asset('images/icons/logo-01.png') }}" alt="IMG-LOGO">

                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="active-menu">
                                <a href="index">Home</a>
                                <ul class="sub-menu">
                                    <li><a href="index">Homepage 1</a></li>
                                    <li><a href="index-02">Homepage 2</a></li>
                                    <li><a href="home-03">Homepage 3</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="shop">Shop</a>
                            </li>

                            <li class="label1" data-label1="hot">
                                <a href="shoping-cart.html">Features</a>
                            </li>

                            <li>
                                <a href="blog.html">Blog</a>
                            </li>

                            <li>
                                <a href="about.html">About</a>
                            </li>

                            <li>
                                <a href="contact.html">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>

                        <div id="cart-icon"
                            class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                            data-notify="{{ count(session('carts', [])) }}">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>


                        <a href="#"
                            class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                            data-notify="0">
                            <i class="zmdi zmdi-favorite-outline"></i>
                        </a>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                    data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="#"
                    class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
                    data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li>
                    <div class="left-top-bar">
                        Free shipping for standard order over $100
                    </div>
                </li>

                <li>

                    <div class="right-top-bar flex-w h-full">

                        @if (Session::has('user'))
                            <a href="/logout" class="flex-c-m p-lr-10 trans-04">
                                Logout
                            </a>

                            <a href="#" class="flex-c-m p-lr-10 trans-04">
                                {{ Session::get('user')['username'] }}
                            </a>
                        @else
                            <a href="/login" class="flex-c-m p-lr-10 trans-04">
                                Login
                            </a>

                            <a href="/register" class="flex-c-m p-lr-10 trans-04">
                                Register
                            </a>
                        @endif
                    </div>
                </li>
            </ul>

            <ul class="main-menu-m">
                <li>
                    <a href="index.html">Home</a>
                    <ul class="sub-menu-m">
                        <li><a href="index.html">Homepage 1</a></li>
                        <li><a href="home-02.html">Homepage 2</a></li>
                        <li><a href="home-03.html">Homepage 3</a></li>
                    </ul>
                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>

                <li>
                    <a href="product.html">Shop</a>
                </li>

                <li>
                    <a href="shoping-cart.html" class="label1 rs1" data-label1="hot">Features</a>
                </li>

                <li>
                    <a href="blog.html">Blog</a>
                </li>

                <li>
                    <a href="about.html">About</a>
                </li>

                <li>
                    <a href="contact.html">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>

    <!-- Cart -->
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>

        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Your Cart
                </span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            @php
                $totalPrice = 0;
            @endphp

            @if (session()->has('carts') &&
                    session()->get('carts')->count() > 0)
                <ul id="cart-items-list">
                    @foreach (session()->get('carts') as $cart)
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img delete-cart-item-btn"
                                data-cart-id="{{ $cart->id }}">
                                <img src="{{ asset('images/item-cart-03.jpg') }}" alt="item-cart-03.jpg">
                            </div>
                            <div class="header-cart-item-txt p-t-8">
                                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    {{ $cart->product->name }}
                                </a>
                                <span class="header-cart-item-info">
                                    {{ $cart->user_quantity }} x ${{ $cart->product->price }}
                                </span>
                                @php
                                    $totalPrice += $cart->user_quantity * $cart->product->price;
                                @endphp
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="header-cart-total w-full p-tb-40">
                    Total: ${{ number_format($totalPrice, 2) }}
                </div>
            @else
                <p>No items in cart.</p>
            @endif

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('.delete-cart-item-btn').on('click', function() {
                        let cartId = $(this).data('cart-id');
                        let listItem = $(this).closest('li');

                        $.ajax({
                            url: "{{ route('cart.destroy', ':cart_id') }}".replace(':cart_id', cartId),
                            type: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                listItem.remove();

                                // Update the cart count
                                let cartCount = $('#cart-icon').attr('data-notify');
                                $('#cart-icon').attr('data-notify', cartCount - 1);

                                // Recalculate the total price
                                updateTotalPrice();

                                function updateTotalPrice() {
                                    let total = 0;
                                    $('#cart-items-list li').each(function(index, element) {
                                        let quantity = $(this).find('.header-cart-item-info')
                                            .text()
                                            .match(/\d+/)[0];
                                        let price = $(this).find('.header-cart-item-info')
                                            .text()
                                            .match(/\$(\d+\.\d+)/)[1];
                                        total += quantity * price;
                                    });
                                    $('.header-cart-total').text('Total: $' + total.toFixed(2));
                                }

                                // Check if the cart is empty
                                if ($('#cart-items-list li').length == 0) {
                                    $('#cart-items-list').append('<p>No items in cart.</p>');
                                }
                            },

                            error: function(error) {
                                console.log(error)
                                listItem.remove();

                                // Update the cart count
                                let cartCount = $('#cart-icon').attr('data-notify');
                                $('#cart-icon').attr('data-notify', cartCount - 1);

                                // Recalculate the total price
                                updateTotalPrice();

                                function updateTotalPrice() {
                                    let total = 0;
                                    $('#cart-items-list li').each(function(index, element) {
                                        let quantity = $(this).find('.header-cart-item-info')
                                            .text()
                                            .match(/\d+/)[0];
                                        let price = $(this).find('.header-cart-item-info')
                                            .text()
                                            .match(/\$(\d+\.\d+)/)[1];
                                        total += quantity * price;
                                    });
                                    $('.header-cart-total').text('Total: $' + total.toFixed(2));
                                }

                                // Check if the cart is empty
                                if ($('#cart-items-list li').length == 0) {
                                    $('#cart-items-list').append('<p>No items in cart.</p>');
                                }
                            }
                        });
                    });
                });
            </script>


            {{-- <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: $75.00
                </div> --}}

            {{-- <div class="header-cart-buttons flex-w w-full">
                <a href="shoping-cart.html"
                    class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                    View Cart
                </a> --}}

                <a href="shoping-cart.html"
                    class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                    Check Out
                </a>
            </div>
        </div>
    </div>
    </div>
    </div>
