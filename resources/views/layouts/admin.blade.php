<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<meta name="author" content="{{ config('app.author') }}">
	<meta name="csrf_token" content="{{ csrf_token() }}">
	<meta name="robots" content="NOINDEX,NOFOLLOW">
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
			<a href="{{ (\Auth::user()) ? route('dashboard') : route('index') }}" class="brand-logo"><img src="/fandom.png" alt="logo"></a>
		</div> <!-- /.col-md-2 -->
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-12 page-header">
					<h3 class="text-muted">
						<b>@yield('title')</b>
						@yield('newBtn')
						<div class="text-center" style="margin-top: -25px;">
							<a href="#!" style="padding-right: 10px;"
								data-toggle="tooltip" title="Client Request Notifications" 
							><i class="fa fa-bell text-center"></i> <span class="badge">1</span></a>
							<a href="#!" style="padding-right: 10px;"
								data-toggle="tooltip" title="New Scheduled Bookings" 
							>
							<i class="fa fa-calendar-o"></i> <span class="badge">3</span></a>
							<a href="#!" style="padding-right: 10px;"
								data-toggle="tooltip" title="Property Reviews" 
							><i class="fa fa-comments text-center"></i> <span class="badge">105</span></a>
						</div>
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
                <li {{ (Request::is('property') ? "class=active" : '') }}><a href="{{ route('property.index') }}"><i class="fa fa-home"></i> Properties</a></li>
                <li {{ (Request::is('properties/houses-for-rent') ? "class=active" : '') }}><a href="{{ route('admin.housesForRent') }}"><i class="fa fa-home"></i> Houses For Rent</a></li>
                <li {{ (Request::is('properties/houses-for-sale') ? "class=active" : '') }}><a href="{{ route('admin.housesForSale') }}"><i class="fa fa-home"></i> Houses For Sale</a></li>
                <li><a href="#"><i class="fa fa-calendar-o"></i> Bookings</a></li>
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
                {{-- <li><a href="#"><i class="fa fa-tags"></i> Report</a></li> --}}
                <li><a href="#"><i class="fa fa-star"></i> Reviews</a></li>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                		<i class="fa fa-cog"></i> Maintenance <span class="caret"></span>
                	</a>
                	<ul class="dropdown-menu">
                		{{-- <li {{ (Request::is('region') ? "class=active" : '') }}>
                			<a href="{{ route('region.index') }}"><i class="fa fa-map-marker"></i> Regions</a>
                		</li>
                		<li {{ (Request::is('city') ? "class=active" : '') }}>
                			<a href="{{ route('city.index') }}"><i class="fa fa-map-marker"></i> City</a>
                		</li> --}}
                		<li><a href="#"><i class="fa fa-map-marker"></i> Locations</a></li>
                		<li {{ (Request::is('feature_type') ? "class=active" : '') }}>
                			<a href="{{ route('feature_type.index') }}"><i class="fa fa-lightbulb-o"></i> Feature Types</a>
                		</li>
                		<li {{ (Request::is('property_type') ? "class=active" : '') }}>
                			<a href="{{ route('property_type.index') }}"><i class="fa fa-lightbulb-o"></i> Property Types</a>
            			</li>
                		<li {{ (Request::is('property_status') ? "class=active" : '') }}>
	                		<a href="{{ route('property_status.index') }}">
	                			<i class="fa fa-lightbulb-o"></i> Property Status
	            			</a>
            			</li>
                		<li {{ (Request::is('amenity') ? "class=active" : '') }}>
                			<a href="{{ route('amenity.index') }}">
	                			<i class="fa fa-lightbulb-o"></i> Property Amenity
                			</a>
            			</li>
                		<li {{ (Request::is('payment_method') ? "class=active" : '' ) }}>
	                		<a href="{{ route('payment_method.index') }}">
	                			<i class="fa fa-credit-card"></i> Payment Methods
                			</a>
                		</li>
                		<li><a href="#"><i class="fa fa-bar-chart"></i> Booking Rates</a></li>
                		<li><a href="#"><i class="fa fa-tag"></i> Online Service Fee</a></li>
                	</ul> <!-- /. dropdown-menu -->
	            </li> <!-- /Maintenance -->
				<li><a href="#"><i class="fa fa-list"></i> Audits</a></li>
				<li><a href="#"><i class="fa fa-trash"></i> Trash</a></li>
                {{-- <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> --}}
                @if (Auth::check())
				<li>
					<a href="{{ route('auth.logout') }}"
						onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"
					>
						<i class="fa fa-sign-out"></i> Logout
					</a>
					<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                    </form>
				</li>
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
	@yield('scripts')
	<script src="/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function () {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</html>