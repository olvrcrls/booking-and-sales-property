@extends('layouts.admin')
@section('title') Property Statuses @stop

@section('newBtn')
<a href="{{ route('property_status.create') }}" class="btn pull-right btn-success"><b>Add New</b></a>
@stop
@section('content')
<div class="container-fluid">
	<table class="table table-condensed table-striped table-responsive" id="propertystatusTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($property_statuses as $property_status)
			<tr>
				<td><a href="{{ route('property_status.show', ['property_status' => $property_status]) }}">{{ $property_status->property_status_name }}</a></td>
				<td>
					@if ($property_status->property_status_description)
					<span data-toggle="tooltip" title="{{ $property_status->property_status_description }}">
						{{ str_limit($property_status->property_status_description, 50) }}
					</span>
					@else
					No Description
					@endif
				</td>
				<td>
				@if ($property_status->property_status_active)
					<div class="col-md-3">
						<a href="{{ route('property_status.edit', ['property_status' => $property_status]) }}">
							<button class="btn btn-primary" status="submit"
								 data-toggle="tooltip" title="Edit"
							>
								<i class="fa fa-edit"></i>
							</button>
						</a>
					</div> <!-- /.col-md-3 -->
					<div class="col-md-3">
						<form action="{{ route('property_status.destroy', ['property_status' => $property_status]) }}" method="POST">
							{{ csrf_field() }} {{ method_field('DELETE') }}
							<button class="btn btn-danger" status="submit"
								data-toggle="tooltip" title="Remove"
							>
								<i class="fa fa-trash"></i>
							</button>
						</form>
					</div> <!-- /.col-md-3 -->
					@else
					<div class="col-md-3">
						<form action="{{ route('property_status.restore', ['property_status' => $property_status]) }}" method="POST">
							{{ csrf_field() }} {{ method_field('PUT') }}
							<button class="btn btn-danger" status="submit"
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
		$("#propertystatusTable").DataTable();
	});
</script>
@stop