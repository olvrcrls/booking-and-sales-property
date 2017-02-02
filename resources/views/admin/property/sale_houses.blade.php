@extends('layouts.maintenance')
@section('title') Houses For Sale @stop

@section('content')
<table id="housesForSaleTable" class="table table-condensed table-responsive">
	<thead>
		<tr>
			<th>Property</th>
			<th>Location</th>
			<th>Price</th>
			<th>Property Status</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><a href="#!">Example Property</a></td>
			<td>Las Vegas, Nevada</td>
			<td>$10,000,000.00</td>
			<td>Available</td>
		</tr>
		<tr>
			<td><a href="#!">One Property</a></td>
			<td>Harford, Connecticut</td>
			<td>$300,000.00</td>
			<td>Available</td>
		</tr>
		<tr>
			<td><a href="#!"><del>Two Property</del></a></td>
			<td>Harford, Connecticut</td>
			<td>$50,000.00</td> 
			<td class="text-danger">Sold</td>
		</tr>
		<tr>
			<td><a href="#!">Other Property</a></td>
			<td>Harford, Connecticut</td>
			<td>$450,000.00</td> 
			<td class="text-warning">On Negotiation</td>
		</tr>
	</tbody>
</table>
@stop

@section('bottom')
	<script>
		$(document).ready(function () {
			$("#housesForSaleTable").DataTable();
		});
	</script>
@stop