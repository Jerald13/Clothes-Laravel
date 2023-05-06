@extends('master')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Title -->
        <title>Login | Graindashboard UI Kit</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- Favicon -->
        <link rel="shortcut icon" href="public/img/favicon.ico">

        <!-- Template -->
        <link rel="stylesheet" href="public/graindashboard/css/graindashboard.css">
    </head>

    <body class="">

        <main class="main">

            <div class="content">

                <div class="container-fluid pb-5">

                    <div class="row justify-content-md-center">
                        <div class="card-wrapper col-12 col-md-4 mt-5" style="margin-top: 6.5rem!important;">
                            <div class="brand text-center mb-3">
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Login</h4>
                                    <form action="login" method="POST">
                                        <div class="form-group">
                                            @csrf

                                            <label for="email">Name / E-Mail</label>
                                            <input id="email" type="text" class="form-control" name="email"
                                                required="" autofocus="">
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password
                                            </label>
                                            <input id="password" type="password" class="form-control" name="password"
                                                required="">

                                            @if (session('loginError'))
                                                <div class="alert alert-danger">
                                                    {{ session('loginError') }}
                                                </div>
                                            @endif


                                            <div class="text-right">
                                                <a href="password/email" class="small">
                                                    Forgot Your Password?
                                                </a>
                                            </div>
                                        </div>


                                        {{-- <div class="form-group">
										<div class="form-check position-relative mb-2">
										  <input type="checkbox" class="form-check-input " id="remember" name="remember">
										  <label class="checkbox checkbox-xxs form-check-label ml-1" for="remember"
												 data-icon="&#xe936">Remember Me</label>
												 <label class="form-check-label" for="remember">
													{{ __('Remember Me') }}
												</label>
										</div>
									</div> --}}


                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group no-margin">
                                            <input type="submit" value="Sign In" class="btn btn-primary btn-block"
                                                name="submitBtn" id="submitBtn">
                                        </div>
                                        <div class="text-center mt-3 small">
                                            Don't have an account? <a href="register.html">Sign Up</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <footer class="footer mt-3">
                                <div class="container-fluid">
                                    <div class="footer-content text-center small">
                                        <span class="text-muted">&copy; 2019 Graindashboard. All Rights Reserved.</span>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </div>



                </div>

            </div>
        </main>

        <script src="public/graindashboard/js/graindashboard.js"></script>
        <script src="public/graindashboard/js/graindashboard.vendor.js"></script>
    </body>

    </html>
@endsection
