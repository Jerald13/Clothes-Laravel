<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-comm Project</title>
    <!-- Latest compiled and minified CSS -->

</head>
<body>
    {{View::make('editor.sidebar')}}
    @yield('content')
    {{-- {{View::make('editor.editorFooter')}} --}}
{{-- </div> <!-- .wrapper --> --}}
</body>

</html>