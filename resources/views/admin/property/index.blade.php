@extends('layouts.admin')
@section('title') Property @stop

@section('newBtn')
<a href="{{ route('property.create') }}">
	<button class="btn btn-success pull-right" type="button">Add New</button>
</a>
@stop

@section('content')
<div class="container-fluid">
	@foreach ($properties as $property)
	<div class="panel {{ ($property->property_is_occupied) ? 'panel-success' : 'panel-default' }}">
		<div class="panel-heading">
			<span class="text-muted"><b>{{ $property->property_name }}</b></span>
		</div> <!-- /.panel-heading -->
		<div class="panel-body">
			
		</div> <!-- /.panel-body -->
		<div class="panel-footer">
			<a href="{{ route('property.edit', ['property' => $property]) }}">
				<button class="btn btn-success"><i class="fa fa-edit"></i></button>
			</a>
		</div> <!-- /.panel-footer -->
	</div> <!-- /.panel panel-default -->
	@endforeach
</div> <!-- /.container-fluid
@stop