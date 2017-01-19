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
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	@yield('styles')
</head>
<body>
<div class="container">
	&nbsp; <br>
	<div class="row">
		<div class="col-md-2">
			<a href="{{ route('index') }}" class="brand-logo"><img src="/fandom.png" alt="logo"></a>
		</div> <!-- /.col-md-2 -->
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-12 page-header">
					<h3 class="text-muted">
						<b>@yield('title')</b>
						@yield('newBtn')
					</h3>
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->
		</div>
	</div> &nbsp;
	<div class="row">
		<div class="col-md-2">
			<ul class="nav nav-pills nav-stacked">
                <li {{ (Request::is('dashboard') ? "class=active" : '') }}>
                	<a href="{{ route('dashboard') }}"><i class="fa fa-bar-chart"></i> Dashboard</a>
                </li>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		<i class="fa fa-cog"></i> Maintenance <span class="caret"></span>
                	</a>
                	<ul class="dropdown-menu">
                		<li {{ (Request::is('region') ? "class=active" : '') }}>
                			<a href="{{ route('region.index') }}"><i class="fa fa-map-marker"></i> Regions</a>
                		</li>
                		<li {{ (Request::is('city') ? "class=active" : '') }}>
                			<a href="{{ route('city.index') }}"><i class="fa fa-map-marker"></i> City</a>
                		</li>
                		<li><a href="#"><i class="fa fa-lightbulb-o"></i> Feature Types</a></li>
                		<li><a href="#"><i class="fa fa-lightbulb-o"></i> Property Types</a></li>
                		<li><a href="#"><i class="fa fa-lightbulb-o"></i> Property Status</a></li>
                		<li><a href="#"><i class="fa fa-lightbulb-o"></i> Property Amenity</a></li>
                		<li><a href="#"><i class="fa fa-credit-card"></i> Payment Methods</a></li>
                		<li><a href="#"><i class="fa fa-bar-chart"></i> Booking Rates</a></li>
                		<li><a href="#"><i class="fa fa-tag"></i> Online Service Fee</a></li>
                	</ul> <!-- /. dropdown-menu -->
	            </li>
                <li><a href="#"><i class="fa fa-home"></i> Properties</a></li>
                <li class="dropdown">
	                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                	<i class="fa fa-money"></i> Property Sales <span class="caret"></span>
	                </a>
	                <ul class="dropdown-menu">
	                	<li><a href="#"><i class="fa fa-calendar-o"></i> Visitations</a></li>
	                	<li><a href="#"><i class="fa fa-money"></i> Transactions</a></li>
	                	<li><a href="#"><i class="fa fa-bar-chart"></i> Property Rates</a></li>
	                </ul>
	            </li>
                <li><a href="#"><i class="fa fa-calendar-o"></i> Bookings</a></li>
                <li><a href="#"><i class="fa fa-tags"></i> Report</a></li>
                <li><a href="#"><i class="fa fa-star"></i> Reviews</a></li>
				<li><a href="#"><i class="fa fa-list"></i> Audits</a></li>
				<li><a href="#"><i class="fa fa-trash"></i> Trash</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                @if (Auth::check())
				<li><a href="#"><i class="fa fa-sign-out"></i> Logout</a></li>
				@else
				<li><a href="#"><i class="fa fa-user-secret"></i> Guest</a></li>
                @endif
            </ul> <!-- /.nav nav-pills -->
		</div>
		<div id="app" class="col-md-10">
			@yield('content')
		</div> <!--  #app / content -->
	</div>
</div> <!-- /.container -->
</body>
	<!-- scripts -->
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function () {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
	@yield('scripts')
</html>