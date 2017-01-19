@extends('layouts.admin')

@section('title') Add New Property Type @stop

@section('newBtn')
<a href="{{ route('property_type.index') }}"><button class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Back</button></a>
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
			<form action="{{ route('property_type.store') }}" class="form-horizontal"
			 	  accept-charset="utf-8" autocomplete="no" role="form" method="post" 
			>	{{ csrf_field() }}
				<div class="form-group required">
					<div class="col-md-12">
						<label for="property_type_name" class="control-label">Property Type's Name</label>
						<input type="text" class="form-control" required 
								placeholder="Property Type Name" name="property_type_name" id="property_type_name"
						>
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.form-group required -->
				<div class="form-group">
					<div class="col-md-12">
						<label for="property_type_description" class="control-label">Description</label>
						<textarea name="property_type_description" id="property_type_description" 
									cols="30" rows="10" class="form-control" required 
									placeholder="Property Type Description" 
							></textarea>
					</div>
				</div>  <!-- /.form-group required -->
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