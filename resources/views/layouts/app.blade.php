<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>Laboratorio @yield('title')</title>
	@include('assets.styles')
    @yield('styles')
</head>
<body class="theme-blue">
    @include('elements.loader')
    @include('elements.search')
    @include('elements.top_bar')    
    <section>
        @include('elements.left_sidebar')
    </section>
    <section class="content">
        <div class="container-fluid">
   			@yield('content')
        </div>
    </section>
    @include('assets.scripts')
    @yield('script')
</body>
</html>
