@extends('layouts.maintenance')
@section('title') Amenity @stop

@section('newBtn')
<a href="{{ route('amenity.create') }}">
	<button class="btn btn-success pull-right" type="button">Add New</button>
</a>
@stop

@section('content')
<div class="container-fluid">
	<table class="table table-condensed table-responsive table-striped" id="amenityTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($amenities as $amenity)
			<tr>
				<td>
					<a href="{{ route('amenity.show',['amenity' => $amenity]) }}">
						{{ $amenity->amenity_name }}
					</a>
				</td>
				<td>
					@if ($amenity->amenity_description)
					{{ $amenity->amenity_description }}
					@else
					No Description
					@endif
				</td>
				<td>
						@if ($amenity->amenity_active)
						<div class="col-md-2">
							<a href="{{ route('amenity.edit', ['amenity' => $amenity]) }}">
								<button class="btn btn-primary" type="submit"
									 data-toggle="tooltip" title="Edit"
								>
									<i class="fa fa-edit"></i>
								</button>
							</a>
						</div>
						<div class="col-md-3">
							<form action="{{ route('amenity.destroy', ['amenity' => $amenity]) }}" method="POST">
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
							<form action="{{ route('amenity.restore', ['amenity' => $amenity]) }}" method="POST">
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
			$('#amenityTable').DataTable();
		});
	</script>
@stop