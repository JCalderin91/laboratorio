<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>{{ config('app.name') }}</title>
	@include('assets.styles')
</head>

<body class="@if(Route::currentRouteName()=='login') login-page @else signup-page @endif">
    @yield('content')
    @include('assets.scripts')
</body>
</html>
