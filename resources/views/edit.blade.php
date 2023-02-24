<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    <title>Edit Product Detail</title>
</head>
<body>
    <h2>Edit Product Details</h2><br/>
    <form method="post" action="{{ action('ProductController@update',$product->id) }}">
    @csrf
        <input name="_method" type="hidden" value="PATCH">
        <p>
            <label for="code">Product Code:</label>
            <input type="text" name="code" value="{{ $product->code }}"> 
        </p>
        <p>
            <label for="code">Product Name:</label>
            <input type="text" name="name" value="{{ $product->name }}"> 
        </p>
        <p>
           <button type="submit" style="margin-left:38px">Update</button> 
        </p>

    </form>
    
</body>
</html>