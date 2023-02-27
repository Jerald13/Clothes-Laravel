<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>SSSS</h1>
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="mb-6">
            <label class="block">
                <span class="text-gray-700">Category Name</span>
                <input type="text" name="name"
                    class="block w-full @error('name') border-red-500 @enderror mt-1 rounded-md"
                    placeholder="" value="{{old('name')}}" />
            </label>
            @error('name')
            <div class="text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-6">
            <label class="block">
                <span class="text-gray-700">Slug</span>
                <input type="text" name="slug"
                    class="block w-full @error('slug') border-red-500 @enderror mt-1 rounded-md"
                    placeholder="" value="{{old('slug')}}" />
            </label>
            @error('slug')
            <div class="text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit"
            class="text-white bg-blue-600  rounded text-sm px-5 py-2.5">Submit</button>

    </form>
</body>
</html>