<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <H1>nice</H1>

    <form method="POST" action="createProduct" enctype="multipart/form-data">
        @csrf
    
        <div id="image-container">
            <div class="form-group">
                <label for="images">Upload Images:</label>
                <input type="file" name="images[]" class="form-control-file">
                @error('images.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    
        <button type="button" id="add-image" class="btn btn-primary">Add Image</button>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    
    <script>
        // Add a new file input when the "Add Image" button is clicked
        document.getElementById('add-image').addEventListener('click', function () {
            var container = document.getElementById('image-container');
            var div = document.createElement('div');
            div.classList.add('form-group');
            var label = document.createElement('label');
            label.textContent = 'Upload Images:';
            var input = document.createElement('input');
            input.type = 'file';
            input.name = 'images[]';
            input.classList.add('form-control-file');
            div.appendChild(label);
            div.appendChild(input);
            container.appendChild(div);
        });
    </script>
{{--     
    <form action="createProduct" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="images[]" multiple>
        <button type="submit">Upload</button>
    </form> --}}
    
</body>
</html>