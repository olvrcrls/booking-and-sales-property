@extends('layouts.maintenance')
@section('title') Payment Methods @stop

@section('newBtn')
<a href="{{ route('payment_method.create') }}">
	<button class="btn btn-success pull-right" type="button">Add New</button>
</a>
@stop

@section('content')
<div class="container-fluid">
	<table class="table table-condensed table-responsive table-striped" id="payment_methodTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($payment_methods as $payment_method)
			<tr>
				<td>
					<a href="{{ route('payment_method.show',['payment_method' => $payment_method]) }}">
						{{ $payment_method->payment_method_name }}
					</a>
				</td>
				<td>
				@if ($payment_method->payment_method_description)
					{{ str_limit($payment_method->payment_method_description,50) }}
				@else
				No Description
				@endif
				</td>
				<td>
						@if ($payment_method->payment_method_active)
						<div class="col-md-3">
							<a href="{{ route('payment_method.edit', ['payment_method' => $payment_method]) }}">
								<button class="btn btn-primary" type="submit"
									 data-toggle="tooltip" title="Edit"
								>
									<i class="fa fa-edit"></i>
								</button>
							</a>
						</div>
						<div class="col-md-3">
							<form action="{{ route('payment_method.destroy', ['payment_method' => $payment_method]) }}" method="POST">
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
							<form action="{{ route('payment_method.restore', ['payment_method' => $payment_method]) }}" method="POST">
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
			$('#payment_methodTable').DataTable();
		});
	</script>
@stop