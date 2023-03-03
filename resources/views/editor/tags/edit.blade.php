<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')
        <div class="container">
            <h1>Edit Tag</h1>
    
            <form method="POST" action="{{ route('tags.update', $tag->id) }}">
                @csrf
                @method('PUT')
    
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $tag->name }}" required>
                </div>
    
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Tag</button>
                </div>
            </form>
        </div>
    @endsection
    
</body>
</html>