<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @vite(['resources/js/app.js'])
</head>
<body>
<form action='{{URL('/task/'.$task->id)}}' method="POST" >
        @csrf
        <label for="exampleDropdownFormEmail2" class="form-label">ID:</label>
        <input type="text" name="id" class="form-control" value="{{$task->id}}">

        <label for="exampleDropdownFormEmail2" class="form-label">Name:</label>
        <input type="text" name="name" class="form-control" value="{{$task->name}}">

        <label for="exampleDropdownFormEmail2" class="form-label">Description:</label>
        <input type="text" name="description" class="form-control" value="{{$task->description}}">

        <input type="submit" class="btn btn-success btn-kuldes" value="Mentés">
</form>
</body>
</html>
