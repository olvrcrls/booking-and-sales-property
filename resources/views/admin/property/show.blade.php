@extends('layouts.admin')
@section('title') {{ str_limit($property->property_name,80) }} ( {{ $property->types->property_type_name }} ) @stop

@section('newBtn')
<a href="{{ route('property.index') }}">
	<button class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Back</button>
</a>
@stop

@section('content')
<div class="container-fluid">
	<div class="panel panel-{{ ($property->property_active ? "default" : "danger") }}">
		<div class="panel-heading">
			<span class="panel-title"><b>{{ $property->property_name }} {{ ($property->property_active ? "" : "(REMOVED)") }}</b></span>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">
					<label class="control-label"><i class="fa fa-info-circle"></i> Property Description:</label>
					<div class="well well-sm">
						<p>
							<b>{{ $property->property_description }}</b>
						</p>
					</div>
				</div>
			</div> <!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<label for="address" class="control-label"><i class="fa fa-map-marker"></i> Property Address:</label>
					<div class="well well-sm">
						<b>
							{{ $property->property_address }}, {{ $property->cities->city_name }}, {{ $property->cities->regions->region_name }}
						</b>
					</div> <!-- /.well well-sm -->
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->&nbsp;
			<div class="row">
				<div class="col-md-3">
					<label class="control-label"><i class="fa fa-arrows-alt"></i> Size</label>
					<span class="well well-sm"><b>{{ number_format($property->property_size,2) }} SQ. M.</b></span>
				</div>
				<div class="col-md-3">
					<label for="bath" class="control-label"><i class="fa fa-bath"></i> Bath:</label>
					<span id="bath" class="well well-sm"><b>{{ $property->property_bath_capacity }} space(s)</b></span>
				</div> <!-- /.col-md-4 -->
				<div class="col-md-3">
					<label for="bed" class="control-label"><i class="fa fa-bed"></i> Bed:</label>
					<span id="bed" class="well well-sm"><b>{{ $property->property_bed_capacity }} space(s)</b></span>
				</div> <!-- /.col-md-4 -->
				<div class="col-md-3">
					<label for="garage" class="control-label"><i class="fa fa-car"></i> Garage:</label>
					<span id="bath" class="well well-sm"><b>{{ $property->property_garage_capacity }} space(s)</b></span>
				</div> <!-- /.col-md-4 -->
			</div> <!-- /.row --> &nbsp;
			<div class="row">
				<div class="col-md-12">
					<label class="control-label"><i class="fa fa-bookmark"></i> Amenity:</label>
				</div>
				<div class="col-md-12">
					<div class="col-md-6">
						<ul class="list-group">
							<li class="list-group-item"><i class="fa fa-wifi"></i> Wi-Fi Connection</li>
							<li class="list-group-item"><i class="fa fa-wifi"></i> Wi-Fi Connection</li>
							<li class="list-group-item"><i class="fa fa-wifi"></i> Wi-Fi Connection</li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group">
							<li class="list-group-item"><i class="fa fa-wifi"></i> Wi-Fi Connection</li>
							<li class="list-group-item"><i class="fa fa-wifi"></i> Wi-Fi Connection</li>
							<li class="list-group-item"><i class="fa fa-wifi"></i> Wi-Fi Connection</li>
						</ul>
					</div>
				</div>
			</div> <!-- /.row -->
		</div> <!-- /.panel-body -->
	</div> <!-- /.panel panel-default -->
</div> <!-- /.container-fluid -->
@stop