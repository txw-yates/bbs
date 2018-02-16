<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Comatible" content="IEedge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--CSRF TOKEN--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'LaraBBS') - Laraval进阶教程</title>

    {{--Style--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div id="app" class="{{ route_class() }}-page">
        @include('layouts._header')

        <div class="container">

            @yield('content')

        </div>

        @include('layouts._footer')
    </div>

    {{--Script--}}
    <script script="{{ asset('js/app.js') }}"></script>
</body>
</html>