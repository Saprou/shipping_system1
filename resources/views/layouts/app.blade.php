<!doctype html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="shipping and delivering">
    <meta name="author" content="alforsan-ex">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>AL FORSAN EX</title>
    
    
    <link rel="icon" href="{{ asset('photos/logo.jpeg') }}" type="image/jpg">
    <!-- Styles -->
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cuts.css') }}" rel="stylesheet">
</head>
<body onClick="closeLists()">
    <div>
        <main>
            @yield('content')
            <a href="" id="error-founder" style="display:none"></a>
            <script src="{{asset('js\app.js')}}"></script>
        </main>
    </div>
</body>
</html>
