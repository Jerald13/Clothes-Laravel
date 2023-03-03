<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>



     <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <a href="{{ route('tags.create') }}" class="btn btn-success">Create Tag</a>

            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}   {{ $tag->status }}</td>
                    <td>
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>