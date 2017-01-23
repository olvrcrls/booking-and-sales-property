@extends('layouts.admin')

@section('title') Edit {{ $property->property_name }} Property @stop

@section('newBtn')
<a href="{{ route('property.index') }}"><button class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Back</button></a>
@stop

@section('content')
<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">
		@if ($errors->count())
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>	
			</div>
		@elseif (session('status'))
			<div class="alert alert-success">
				<strong>{{ session('status') }}</strong>
			</div>
		@endif
			<form action="{{ route('property.update', ['property' => $property]) }}" class="form-horizontal"
			 	  accept-charset="utf-8" autocomplete="no" role="form" method="post" 
			>	{{ csrf_field() }} {{ method_field('PUT') }}
				<div class="form-group required">
					<div class="col-md-12">
						<label for="property_name" class="control-label">Property's Name</label>
						<input status="text" class="form-control" required 
								placeholder="Property Name" name="property_name" id="property_name"
								value="{{ $property->property_name }}" 
						>
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.form-group required -->
				<div class="form-group required">
					<div class="col-md-12">
						<label for="property_address" class="control-label">Address</label>
						<input type="text" class="form-control" required
							placeholder="Property Address" name="property_address" id="property_address"
							value="{{ $property->property_address }}" 
						>
					</div>
				</div>
				<div class="form-group required">
					<div class="col-md-12">
						<label for="property_city" class="control-label">City</label>
						<select name="property_city" id="property_city" class="form-control"
								required
						>
							<option value="" disabled>-- Select City --</option>
							@foreach ($cities as $city)
							@if ($property->property_city_id === $city->city_id)
							<option selected value="{{ $city->city_id }}">{{ $city->city_name }} [{{ $city->regions->region_name }}]</option>
							@else
							<option value="{{ $city->city_id }}">{{ $city->city_name }} [{{ $city->regions->region_name }}]</option>
							@endif
							@endforeach
						</select>
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.form-group required -->
				<div class="form-group required">
					<div class="col-md-12">
						<label for="property_type" class="control-label">Property Type</label>
						<select name="property_type" id="property_type" class="form-control"
								required
						>
							<option value="" selected disabled>-- Select Property Type --</option>
							@foreach ($types as $type)
							@if ($property->property_type_id === $type->property_type_id)
							<option selected value="{{ $type->property_type_id }}">{{ $type->property_type_name }}</option>
							@else
							<option value="{{ $type->property_type_id }}">{{ $type->property_type_name }}</option>
							@endif
							@endforeach
						</select>
					</div>
				</div> <!-- /.form-group required -->
				<div class="form-group required">
					<div class="col-md-6">
						<label for="property_price" class="control-label"><i class="fa fa-dollar"></i> Price (For Property Sales)</label>
						<input type="number" step="0.01" name="property_price" id="property_price" required 
								value="{{ $property->property_price }}" min="0.00" class="form-control"
						>
					</div> <!-- /.col-md-6 -->
					<div class="col-md-6">
						<label for="property_size" class="control-label"><i class="fa fa-crop"></i> Size (in SQ. M.)</label>
						<input type="number" step="0.01" name="property_size" id="property_size" required 
								value="{{ $property->property_size }}" min="0.00" class="form-control"
						>
					</div> <!-- /.col-md-6 -->
				</div> <!-- /.form-group required -->
				<div class="form-group required">
					<div class="col-md-4">
						<label for="property_bedroom" class="control-label">Bedroom(s) <i class="fa fa-bed"></i></label>
						<input type="number" name="property_bedroom" id="property_bedroom" required 
							min="0" value="{{ $property->property_bed_capacity }}" class="form-control" 
						>
					</div> <!-- BEDROOMS /.col-md-4 -->
					<div class="col-md-4">
						<label for="property_bathroom" class="control-label">Bathroom(s) <i class="fa fa-bath"></i></label>
						<input type="number" name="property_bathroom" id="property_bathroom" required 
							min="0" value="{{ $property->property_bath_capacity }}" class="form-control" 
						>
					</div> <!-- BATHROOMS /.col-md-4 -->
					<div class="col-md-4">
						<label for="property_garage" class="control-label">Garage(s) <i class="fa fa-car"></i></label>
						<input type="number" name="property_garage" id="property_garage" required 
								min="0" value="{{ $property->property_garage_capacity }}" class="form-control" 
						>
					</div>
				</div> <!-- /.form-group required -->
				<div class="form-group required">
					<div class="col-md-12">
						<label for="property_status" class="control-label">Status</label>
						<select name="property_status" id="property_status" class="form-control"
								required
						>
							<option value="" disabled>-- Select Property Status --</option>
							@foreach ($statuses as $status)
							@if ($status->property_status_id === $property->property_status_id)
							<option selected value="{{ $status->property_status_id }}">{{ $status->property_status_name }}</option>
							@else
							<option value="{{ $status->property_status_id }}">{{ $status->property_status_name }}</option>
							@endif
							@endforeach
						</select>
					</div>
				</div> <!-- /.form-group required -->
				<div class="form-group">
					<div class="col-md-12">
						<span class="text-muted"><b>Other Options:</b></span>
					</div>
					<div class="col-md-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="is_negotiable" {{ ($property->property_is_negotiable ? 'checked' : '') }}> Property is <b>negotiable</b>
							</label>
						</div>
					</div> <!-- /.col-md-4 -->
					<div class="col-md-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="is_occupied" {{ ($property->property_is_occupied ? 'checked' : '') }}> Property is <b>occupied</b>
							</label>
						</div>
					</div> <!-- /.col-md-4 -->
					<div class="col-md-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="is_sold" {{ ($property->property_is_sold ? 'checked' : '') }}> Property is <b>sold</b>
							</label>
						</div>
					</div> <!-- /.col-md-4 -->
				</div> <!-- /.form-group -->
				<div class="form-group required">
					<div class="col-md-12">
						<label for="property_description" class="control-label">Description</label>
						<textarea name="property_description" id="property_description" 
									cols="30" rows="10" class="form-control" 
									placeholder="Property's Description" required
						>{{ $property->property_description }}</textarea>
					</div>
				</div>  <!-- /.form-group required -->
				<div class="form-group">
					<div class="col-md-12">
						<button class="btn btn-success" status="submit">Submit</button>
					</div>
				</div>  <!-- /.form-group -->
			</form>
		</div> <!-- /.panel-body -->
	</div> <!-- /.panel panel-default -->
</div>
@stop