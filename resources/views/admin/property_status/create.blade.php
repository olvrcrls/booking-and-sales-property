@extends('layouts.admin')

@section('title') Add New Property Status @stop

@section('newBtn')
<a href="{{ route('property_status.index') }}"><button class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Back</button></a>
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
			<form action="{{ route('property_status.store') }}" class="form-horizontal"
			 	  accept-charset="utf-8" autocomplete="no" role="form" method="post" 
			>	{{ csrf_field() }}
				<div class="form-group required">
					<div class="col-md-12">
						<label for="property_status_name" class="control-label">Property Status's Name</label>
						<input status="text" class="form-control" required 
								placeholder="Property Status Name" name="property_status_name" id="property_status_name"
						>
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.form-group required -->
				<div class="form-group">
					<div class="col-md-12">
						<label for="property_status_description" class="control-label">Description</label>
						<textarea name="property_status_description" id="property_status_description" 
									cols="30" rows="10" class="form-control" 
									placeholder="Property Status Description" 
							></textarea>
					</div>
				</div>  <!-- /.form-group required -->
				<div class="form-group">
					<div class="col-md-12">
						<button class="btn btn-success" status="submit">Create</button>
					</div>
				</div>  <!-- /.form-group -->
			</form>
		</div> <!-- /.panel-body -->
	</div> <!-- /.panel panel-default -->
</div>
@stop