<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful Message</title>
    <style>
        .black-button {
            background-color: black;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            text-decoration: none;
        }

        .link {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <h2>{{ $subjectState }}</h2>
    Thanks For Buying our products.</p>

    <button class="black-button">
        <a href="http://127.0.0.1:8000/index" class="link">Visit Site</a>
    </button>
    <br><br>


    Best regards, <br>
    {{ config('app.name') }}
    {{-- <a href="{{ $verificationUrl }}">Cozastore</a>  --}}
    {{-- <h2>Verify Your Email Address</h2> --}}
    {{-- <p>Thank you for registering with us. Please click the button below to verify your email address:</p>
    <a href="{{ $verificationUrl }}">Verify Email</a> --}}
</body>

</html>
