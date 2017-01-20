@extends('layouts.maintenance')
@section('title') Cities @stop

@section('newBtn')
<a href="{{ route('city.create') }}" class="btn pull-right btn-success"><b>Add New</b></a>
@stop
@section('content')
<div class="container-fluid">
	<table class="table table-condensed table-striped table-responsive" id="cityTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Region</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($cities as $city)
			<tr>
				<td><a href="{{ route('city.show', ['city' => $city]) }}">{{ $city->city_name }}</a></td>
				<td>{{ $city->regions->region_name }}</td>
				<td>
					@if ($city->city_active)
					<div class="col-md-3">
						<a href="{{ route('city.edit', ['city' => $city]) }}">
							<button class="btn btn-primary" type="submit"
								 data-toggle="tooltip" title="Edit"
							>
								<i class="fa fa-edit"></i>
							</button>
						</a>
					</div>
					<div class="col-md-3">
						<form action="{{ route('city.destroy', ['city' => $city]) }}" method="POST">
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
						<form action="{{ route('city.restore', ['city' => $city]) }}" method="POST">
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
		$("#cityTable").DataTable();
	});
</script>
@stop
