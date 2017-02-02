@extends('layouts.maintenance')
@section('title') Houses For Rent @stop

@section('content')
<table id="housesForRentTable" class="table table-condensed table-responsive">
	<thead>
		<tr>
			<th>Property</th>
			<th>Location</th>
			<th>Latest Reservation Date</th>
			<th>Property Status</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><a href="#!">Example Property</a></td>
			<td>Las Vegas, Nevada</td>
			<td>February 14, 2017</td>
			<td>Available</td>
		</tr>
		<tr>
			<td><a href="#!">One Property</a></td>
			<td>Harford, Connecticut</td>
			<td>February 25, 2017</td>
			<td>Available</td>
		</tr>
		<tr>
			<td><a href="#!"><del>Two Property</del></a></td>
			<td>Harford, Connecticut</td>
			<td>No Reservations</td> 
			<td class="text-danger">Unavailable</td>
		</tr>
		<tr>
			<td><a href="#!">Other Property</a></td>
			<td>Harford, Connecticut</td>
			<td>March 10, 2017</td> 
			<td class="text-warning">Under Renovation</td>
		</tr>
	</tbody>
</table>
@stop

@section('bottom')
	<script>
		$(document).ready(function () {
			$("#housesForRentTable").DataTable();
		});
	</script>
@stop