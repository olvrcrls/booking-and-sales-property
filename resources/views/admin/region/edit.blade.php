@extends('layouts.admin')
@section('title') Edit {{ $region->region_name }} @stop

@section('newBtn')
<a href="{{ route('region.index') }}"><button class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Back</button></a>
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
			<form action="{{ route('region.update', ['region' => $region]) }}" class="form-horizontal"
			 	  accept-charset="utf-8" autocomplete="no" role="form" method="post" 
			> {{ csrf_field() }} {{ method_field('PUT') }}
				<div class="form-group required">
					<div class="col-md-12">
						<label for="region_name" class="control-label">Region's Name</label>
						<input type="text" class="form-control" required 
								placeholder="Region Name" name="region_name" id="region_name"
								value="{{ $region->region_name }}" 
						>
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.form-group required -->
				<div class="form-group">
					<div class="col-md-12">
						<button class="btn btn-success" type="submit">Submit</button>
					</div>
				</div>
			</form>
		</div> <!-- /.panel-body -->
	</div> <!-- /.panel panel-default -->
</div>
@stop