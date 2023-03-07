@extends('master')
@section("content")
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Title -->
    <title>Create new account | Graindashboard UI Kit</title>

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
								<h4 class="card-title">Create new account</h4>
								<form action="register" method="POST">
									@csrf
									<div class="form-group">
										<label for="username">Username</label>
										<input type="text" class="form-control" id="username" name="username" required="" autofocus="">
									</div>

									<div class="form-group">
										<label for="email">E-Mail Address</label>
										<input id="email" type="email" class="form-control" name="email" required="">
										<div id="result"> </div>
									</div>


									<div class="form-group">
										<label for="phone_number">Phone Number</label>
										<select name="phone_code">
											<option value="+60">+60</option>
										</select>
										<input class="form-control" id="phone_number" type="text" name="phone_number" required="" autofocus="">
										<span class="error-message" style="color: red;"></span>
									</div>

									{{-- <div class="form-group">
										<label for="phone_number">Phone Number</label>
										<select name="phone_code">
											<option value="+60">+60</option>
										</select>
										<input class="form-control" id="phone_number" type="text" name="phone_number" required="" autofocus="">
									</div> --}}


									 <div class="form-row">
										<div class="form-group col-md-6">
											<label for="password">Password
											</label>
											<input id="password" type="password" class="form-control" name="password" required="">
										</div>
										<div class="form-group col-md-6">
											<label for="password-confirm">Confirm Password
											</label>
											<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="">
											<span id='message'></span>
										</div>
									
									</div>


									<div class="form-group no-margin">
										<input type="submit" value="Sign Up" class="btn btn-primary btn-block" name="submitBtn" id="submitBtn" >
									</div>
									<div class="text-center mt-3 small">
										Already have an account? <a href="login.html">Sign In</a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
$('#password, #password-confirm').on('keyup', function () {
	if($('#password').val().length < 1){
    $('#message').html('').css('color', '');
  }
	else if ($('#password').val() == $('#password-confirm').val()) {
    $('#message').html('Matching').css('color', 'green');
  }else 
    $('#message').html('Not Matching').css('color', 'red');
});


$(document).ready(function() {
    $('#phone_number').on('input', function() {
        var phone_number = $(this).val().replace(/[^0-9]/g, ''); // remove any non-digit characters
        var phone_code = $('[name="phone_code"]').val();
        var phone_regex = new RegExp("^" + phone_code + "[0-9]{9}$"); // regex pattern for valid phone number

        if (phone_regex.test(phone_number)) {
            $('.error-message').text('');
        } else {
            $('.error-message').text('Invalid phone number format');
        }
    });
});


// $(document).ready(function () {

// function isValidEmail(email) {

// 	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
// 	return regex.test(email);
// }

// $("form").submit(function (event) {

// 	if (isValidEmail($("#email").val())) {
// 		$("#result").html("Valid Email"$("#email").val()).css('color', 'green');

// 	} else {
// 		   $("#result").html("InValid Email").css('color', 'red');
// 	}
	
// 	 event.preventDefault();
// });

// });

	  </script>
	  

  </body>
</html>
@endsection