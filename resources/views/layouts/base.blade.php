<!DOCTYPE html >
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<head>
	<meta charset="UTF-8">
	<link rel="canonical" href="{{ config('app.url') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="fb:app_id" content="{{ config('app.fb_app_id') }}" />
	<meta content="description" name="{{ config('app.name') }}. Home Property Sales, Check-in and Check-out rooms and property of vacations.">
	<meta content="keywords" name="Property,Vacation,Check in,Check out,Property Sales.">
	<meta content="author" name="{{ config('app.author') }}">

	<title>@yield('title')</title>
	<!-- styles -->
	<link rel="stylesheet" href="/css/app.css">
	@yield('styles')
</head>
<body>
	<div id="app">
		@yield('content')
	</div>
	<!-- scripts -->
	<script src="/js/app.js" type="text/javascript"></script>
	@yield('scripts')
</body>
</html>