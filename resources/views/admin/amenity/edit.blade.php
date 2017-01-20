@extends('layouts.admin')
@section('title') Edit {{ $amenity->amenity_name }} @stop

@section('newBtn')
<a href="{{ route('amenity.index') }}">
	<button class="btn btn-default pull-right" type="button"><i class="fa fa-arrow-left"></i> Back</button>
</a>
@stop

@section('content')
<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">
			@if (session('status'))
			<div class="alert alert-success">
				<span class="text-muted">{{ session('status') }}</span>
			</div>
			@elseif ($errors->count())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<form action="{{ route('amenity.update',['amenity' => $amenity]) }}" method="POST"
				accept-charset="utf-8" class="form-horizontal" 
			> {{ csrf_field() }} {{ method_field('PUT') }}
				<div class="form-group required">
					<div class="col-md-12">
						<label for="amenity_name" class="control-label">Name</label>
						<input type="text" class="form-control" required autofocus
								name="amenity_name" id="amenity_id" placeholder="Amenity Name" 
								value="{{ $amenity->amenity_name }}" 
						>
					</div>
				</div> <!-- /.form-group required -->
				<div class="form-group">
					<div class="col-md-12">
						<label for="amenity_description" class="control-label">Description</label>
						<textarea name="amenity_description" id="amenity_description" cols="30" rows="10" class="form-control" placeholder="Description">{{ $amenity->amenity_description }}</textarea>
					</div>
				</div> <!-- /.form-group -->
				<div class="form-group">
					<div class="col-md-12">
						<button class="btn btn-success" type="submit">Create</button>
					</div>
				</div>
			</form> <!-- /form -->
		</div> <!-- /.panel-body -->
	</div>
</div>
@stop