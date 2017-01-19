@extends('layouts.admin')

@section('title') Add New City @stop

@section('newBtn')
<a href="{{ route('city.index') }}"><button class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Back</button></a>
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
			<form action="{{ route('city.store') }}" class="form-horizontal"
			 	  accept-charset="utf-8" autocomplete="no" role="form" method="post" 
			>	{{ csrf_field() }}
				<div class="form-group required">
					<div class="col-md-12">
						<label for="city_name" class="control-label">City's Name</label>
						<input type="text" class="form-control" required 
								placeholder="City Name" name="city_name" id="city_name"
						>
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.form-group required -->
				<div class="form-group required">
					<div class="col-md-12">
						<label for="city_zip_code" class="control-label">City's Zip Code</label>
						<input type="text" class="form-control" required minlength="4" maxlength="5" 
							placeholder="City Zip Code" name="city_zip_code" id="city_zip_code" 
						>
					</div>
				</div>  <!-- /.form-group required -->
				<div class="form-group required">
					<div class="col-md-12">
						<label for="city_region" class="control-label">Region</label>
						<select name="city_region" id="city_region" required class="form-control">
							<option value="" selected disabled>-- Select Region --</option>
							@foreach ($regions as $region)
							<option value="{{ $region->region_id }}">{{ $region->region_name }}</option>
							@endforeach
						</select>
					</div>
				</div> <!-- /.col-md-12 -->
				<div class="form-group">
					<div class="col-md-12">
						<button class="btn btn-success" type="submit">Create</button>
					</div>
				</div>  <!-- /.form-group -->
			</form>
		</div> <!-- /.panel-body -->
	</div> <!-- /.panel panel-default -->
</div>
@stop