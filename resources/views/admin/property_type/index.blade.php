@extends('layouts.admin')
@section('title') Property Types @stop

@section('newBtn')
<a href="{{ route('property_type.create') }}" class="btn pull-right btn-success"><b>Add New</b></a>
@stop
@section('content')
<div class="container-fluid">
	<table class="table table-condensed table-striped table-responsive" id="propertyTypeTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($property_types as $property_type)
			<tr>
				<td><a href="{{ route('property_type.show', ['property_type' => $property_type]) }}">{{ $property_type->property_type_name }}</a></td>
				<td>
					@if ($property_type->property_type_description)
					<span data-toggle="tooltip" title="{{ $property_type->property_type_description }}">
						{{ str_limit($property_type->property_type_description, 50) }}
					</span>
					@else
					No Description
					@endif
				</td>
				<td>
				@if ($property_type->property_type_active)
					<div class="col-md-2">
						<a href="{{ route('property_type.edit', ['property_type' => $property_type]) }}">
							<button class="btn btn-primary" type="submit"
								 data-toggle="tooltip" title="Edit"
							>
								<i class="fa fa-edit"></i>
							</button>
						</a>
					</div> <!-- /.col-md-3 -->
					<div class="col-md-3">
						<form action="{{ route('property_type.destroy', ['property_type' => $property_type]) }}" method="POST">
							{{ csrf_field() }} {{ method_field('DELETE') }}
							<button class="btn btn-danger" type="submit"
								data-toggle="tooltip" title="Remove"
							>
								<i class="fa fa-trash"></i>
							</button>
						</form>
					</div> <!-- /.col-md-3 -->
					@else
					<div class="col-md-3">
						<form action="{{ route('property_type.restore', ['property_type' => $property_type]) }}" method="POST">
							{{ csrf_field() }} {{ method_field('PUT') }}
							<button class="btn btn-danger" type="submit"
								data-toggle="tooltip" title="Restore"
							>
								<i class="fa fa-undo"></i>
							</button>
						</form>
					</div> <!-- /.col-md-3 -->
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop
@section('bottom')
<script>
	$(document).ready(function () {
		$("#propertyTypeTable").DataTable();
	});
</script>
@stop