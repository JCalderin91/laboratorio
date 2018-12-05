<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <title>Laboratorio @yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/materialize.css') }}">
	@include('assets.styles')
    @yield('styles')
</head>
<body class="theme-blue">
   @include('elements.navbar')
   @include('elements.sidebar')
    
    <div style="padding: 20px;">
   	  @yield('content')
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/materialize.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    @include('assets.scripts')
    <script>
      $('.sidenav').sidenav();
    </script>
    @yield('script')
</body>
</html>
