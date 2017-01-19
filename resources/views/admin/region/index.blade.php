@extends('layouts.maintenance')
@section('title') Regions @stop

@section('newBtn')
<a href="{{ route('region.create') }}" class="btn pull-right btn-success"><b>Add New</b></a>
@stop
@section('content')
<div class="container-fluid">
	<table class="table table-condensed table-striped table-responsive" id="regionTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($regions as $region)
			<tr>
				<td><a href="{{ route('region.show', ['region' => $region]) }}">{{ $region->region_name }}</a></td>
				<td>
					<div class="col-md-3">
						<a href="{{ route('region.edit', ['region' => $region]) }}">
							<button class="btn btn-primary" type="submit"
								data-toggle="tooltip" title="Edit"
							>
								<i class="fa fa-edit"></i>
							</button>
						</a>
					</div>
					<div class="col-md-3">
						<form action="{{ route('region.destroy', ['region' => $region]) }}" method="POST">
							{{ csrf_field() }} {{ method_field('DELETE') }}
							<button class="btn btn-danger" type="submit"
								data-toggle="tooltip" title="Remove" 
							>
								<i class="fa fa-trash"></i>
							</button>
						</form>
					</div>
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
		$("#regionTable").DataTable();
	});
</script>
@stop
