@extends('layouts.maintenance')
@section('title') Property @stop

@section('newBtn')
<a href="{{ route('property.create') }}">
	<button class="btn btn-success pull-right" type="button">Add New</button>
</a>
@stop

@section('content')
<div class="container-fluid">
	<p>
		<b>Legends:</b> <br>&nbsp;
		<span class="text-success" style="padding: 10px 10px;"><i class="fa fa-dollar"></i> Property is Sold</span>
		<span class="text-warning" style="padding: 10px 10px;"><i class="fa fa-check"></i> Property is Negotiable</span>
		<span class="text-danger" style="padding: 10px 10px;"><i class="fa fa-remove"></i> Property is Occupied</span>
 	</p> <br>
	<table class="table table-condensed table-responsive" id="propertyTable">
	<thead>
		<tr>
			<th>Property Name</th>
			<th>Property Type</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
		<tbody>
		@foreach ($properties as $property)
		@if ($property->property_is_negotiable || ($property->property_is_negotiable && $property->property_is_occupied) )
		<tr class="warning">
		@elseif ($property->property_is_occupied)
		<tr class="danger">
		@else
		<tr class="default">
		@endif
			<td>
				<a href="{{ route('property.show',['property' => $property]) }}">
					{{ str_limit($property->property_name,100) }}
				</a>
			</td>
			<td>{{ $property->types->property_type_name }}</td>
			<td>{{ $property->statuses->property_status_name }}</td>
			<td>
			@if ($property->property_active)
				<div class="col-md-3">
						<a href="{{ route('property.edit', ['property' => $property]) }}">
							<button class="btn btn-primary" type="submit"
								data-toggle="tooltip" title="Edit"
							>
								<i class="fa fa-edit"></i>
							</button>
						</a>
					</div>
					<div class="col-md-2">
						<form action="{{ route('property.destroy', ['property' => $property]) }}" method="POST">
							{{ csrf_field() }} {{ method_field('DELETE') }}
							<button class="btn btn-danger" type="submit"
								data-toggle="tooltip" title="Remove" 
							>
								<i class="fa fa-trash"></i>
							</button>
						</form>
					</div> <!-- /.col-md-3 -->
				@elseif (!$property->property_active)
				<div class="col-md-3">
						<form action="{{ route('property.restore', ['property' => $property]) }}" method="POST">
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
</div> <!-- /.container-fluid -->
@stop

@section('bottom')
<script>
	$(document).ready(function () {
		$('#propertyTable').DataTable();
	});
</script>
@stop