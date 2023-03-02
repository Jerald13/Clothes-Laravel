<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Free Gifts</h1>

    <ul>
        @foreach ($freeGifts as $gift)
            <li>{{ $gift['name'] }} - {{ $gift['mime'] }}</li>
            <li><img src="{{ $gift['data'] }} " alt="{{ $gift['name'] }}"></li>
        @endforeach
    </ul>
</ul>
</body>
</html>