@extends('layouts.admin')
@section('title') Feature Types @stop

@section('newBtn')
<a href="{{ route('feature_type.create') }}" class="btn pull-right btn-success"><b>Add New</b></a>
@stop
@section('content')
<div class="container-fluid">
	<table class="table table-condensed table-striped table-responsive" id="featureTypeTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($feature_types as $feature_type)
			<tr>
				<td><a href="{{ route('feature_type.show', ['feature_type' => $feature_type]) }}">{{ $feature_type->feature_type_name }}</a></td>
				<td>
					<span data-toggle="tooltip" title="{{ $feature_type->feature_type_description }}">
						{{ str_limit($feature_type->feature_type_description, 50) }}
					</span>
				</td>
				<td>
				@if ($feature_type->feature_type_active)
					<div class="col-md-3">
						<a href="{{ route('feature_type.edit', ['feature_type' => $feature_type]) }}">
							<button class="btn btn-primary" type="submit"
								 data-toggle="tooltip" title="Edit"
							>
								<i class="fa fa-edit"></i>
							</button>
						</a>
					</div>
					<div class="col-md-3">
						<form action="{{ route('feature_type.destroy', ['feature_type' => $feature_type]) }}" method="POST">
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
						<form action="{{ route('feature_type.restore', ['feature_type' => $feature_type]) }}" method="POST">
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
		$("#featureTypeTable").DataTable();
	});
</script>
@stop