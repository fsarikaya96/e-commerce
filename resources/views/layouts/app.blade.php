<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="meta_title" content="@yield('meta_title')">
    <meta name="meta_keyword" content="@yield('meta_keyword')">
    <meta name="meta_description" content="@yield('meta_description')">

    <title>@yield('title',config('app.name'))</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/owl.carousel.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/owl.theme.default.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/exzoom/jquery.exzoom.css") }}">
    @vite('resources/css/app.css')
    @livewireStyles

</head>
<body>
<div id="app">
    @include('layouts.inc.frontend.navbar')
    <main class="container py-4">
        @yield('content')
    </main>
    @include('layouts.inc.frontend.footer')
</div>

<script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/js/jquery-3.6.1.min.js") }}"></script>
<script src="{{ asset("assets/js/owl.carousel.min.js") }}"></script>
<script src="{{ asset("assets/exzoom/jquery.exzoom.js") }}"></script>
@vite('resources/js/app.js')
@yield('script')

@livewireScripts
@stack('scripts')
</body>
</html>
