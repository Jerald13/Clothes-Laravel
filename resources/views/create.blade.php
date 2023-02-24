<html>
<head>
    <meta charset="UTF-8">
    <title>Add new Produt</title>
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
</head>
<body>
    <h2>Add New Product</h2><br/>
    <form method="post" action="{{ url('products') }}">
    @csrf
    <p>
        <label for="code">Product Code:</label>
        <input type="text" name="code">
    </p>
    <p>
        <label for="name">Product Name:</label>
        <input type="text" name="name">
    </p>
    <p>
        <button type="submit">Submit</button>
    </p>
    </form>
</body>
</html>