<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
	<meta content="author" name="{{ config('app.author') }}">
	<meta content="robots" name="NOINDEX,NOFOLLOW">
	<title>@yield('title')</title>
	<!-- styles -->
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>
	<div id="app">
		@yield('content')
	</div>
</body>
	<!-- scripts -->
	<script src="/js/app.js"></script>
</html>