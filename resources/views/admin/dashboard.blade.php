@extends('layouts.admin')
@section('title') Dashboard @stop

@section('content')
<div class="row">
	<h3 class="text-muted text-center"><u><b>OVERVIEW <i class="fa fa-barchart"></i></b></u></h3> <br>
	<div class="col-md-4">
		<div class="well well-lg">
			<h4 class="text-center"><b>Property Bookings Graph</b></h4>
			<canvas id="propertyBookings"></canvas>	
		</div>
	</div> <!-- /.col-md-4 -->
	<div class="col-md-4">
		<div class="well well-lg">
			<h4 class="text-center"><b>Property Sales Graph</b></h4>
			<canvas id="propertySales"></canvas>	
		</div>
	</div> <!-- /.col-md-4 -->
	<div class="col-md-4">
		<div class="well well-lg">
			<h4 class="text-center"><b>Expenses Graph</b></h4>
			<canvas id="expenses"></canvas>	
		</div>
	</div> <!-- /.col-md-4 -->
</div> <!-- /.row -->
<div class="row pull-center">
	<h3 class="text-muted text-center"><u><b>PROPERTY STATISTICS</b></u></h3> <br>
	<div class="col-md-4 col-md-offset-1 well well-sm">
		<h4 class="text-center"><b>VISITS</b></h4>
		<ul class="list-group">
			<li class="list-group-item">
				<b>Example Property</b>
				<span class="pull-right">10 Visits</span>
			</li>
			<li class="list-group-item">
				<b>One Property</b>
				<span class="pull-right">1 Visit</span>
			</li>
			<li class="list-group-item">
				<b>Another Property</b>
				<span class="pull-right">20 Visits</span>
			</li>
			<li class="list-group-item">
				<b>New Property</b>
				<span class="pull-right">0 Visit</span>
			</li>
			<li class="list-group-item">
				<b>Old Property</b>
				<span class="pull-right">110 Visits</span>
			</li>
			<li class="list-group-item">
				<b>Classy Property</b>
				<span class="pull-right">50 Visits</span>
			</li>
			<li class="list-group-item">
				<b>Low Rate Property</b>
				<span class="pull-right">90 Visits</span>
			</li>
			<li class="list-group-item">
				<b>Mid Rate Property</b>
				<span class="pull-right">15 Visits</span>
			</li>
			<li class="list-group-item">
				<a href="#!">
					<button class="btn btn-primary btn-md" type="button">View More</button>
				</a>
			</li>
		</ul>
	</div>
	<div class="col-md-4 col-md-offset-2 well well-sm">
		<h4 class="text-center"><b>REVENUES</b></h4>
		<ul class="list-group">
			<li class="list-group-item">
				<b>Example Property</b>
				<span class="pull-right">$1500.00</span>
			</li>
			<li class="list-group-item">
				<b>One Property</b>
				<span class="pull-right">$10500.00</span>
			</li>
			<li class="list-group-item">
				<b>Another Property</b>
				<span class="pull-right">$12500.00</span>
			</li>
			<li class="list-group-item">
				<b>New Property</b>
				<span class="pull-right">$0.00</span>
			</li>
			<li class="list-group-item">
				<b>Old Property</b>
				<span class="pull-right">$1200000.00</span>
			</li>
			<li class="list-group-item">
				<b>Classy Property</b>
				<span class="pull-right">$50000.00</span>
			</li>
			<li class="list-group-item">
				<b>Low Rate Property</b>
				<span class="pull-right">$36000.00</span>
			</li>
			<li class="list-group-item">
				<b>Mid Rate Property</b>
				<span class="pull-right">$800.00</span>
			</li>
			<li class="list-group-item">
				<a href="#!">
					<button class="btn btn-primary btn-md" type="button">View More</button>
				</a>
			</li>
		</ul>
	</div>
</div> <!-- /.row -->
<div class="row">
	<h3 class="text-muted text-center"><u><b>RECENT REVIEWS	</b></u></h3> <br>
	<div class="well well-sm">
		<ul class="list-group">
			<li class="list-group-item">
			<blockquote>
				<p>
				"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur voluptas quidem dicta laboriosam sint reprehenderit suscipit..."
				</p>
				<footer><cite title="Anonymous Client">Anonymous Client</cite></footer>
			</blockquote>
			</li>
			<li class="list-group-item">
			<blockquote>
				<p>
				"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur voluptas quidem dicta laboriosam sint reprehenderit suscipit..."
				</p>
				<footer><cite title="Anonymous Client">Anonymous Client</cite></footer>
			</blockquote>
			</li>
			<li class="list-group-item">
			<blockquote>
				<p>
				"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur voluptas quidem dicta laboriosam sint reprehenderit suscipit..."
				</p>
				<footer><cite title="Anonymous Client">Anonymous Client</cite></footer>
			</blockquote>
			</li>
		</ul> <!-- /.list-group -->
		<a href="#!">
			<button class="btn btn-primary btn-md" type="button">View More</button>
		</a>
	</div> <!-- /.well well-sm -->
</div> <!-- /.row -->
@stop

@section('scripts')
<script src="/js/dashboard.js"></script>
@stop