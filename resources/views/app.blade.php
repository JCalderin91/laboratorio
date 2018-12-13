<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>
  <link rel="stylesheet" href="{{ asset('css/font-awesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body >
	<div id="app">
		<App/>
	</div>

	<script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/axios.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/app.js')}}"></script>
	<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
