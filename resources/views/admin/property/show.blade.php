@extends('layouts.admin')
@section('title') {{ str_limit($property->property_name,80) }} @stop

@section('newBtn')
<a href="{{ route('property.index') }}">
	<button class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Back</button>
</a>
@stop

@section('content')
<div class="container-fluid">
	<div class="panel panel-{{ ($property->property_active ? "default" : "danger") }}">
		<div class="panel-heading">
			<span class="panel-title"><b>{{ $property->property_name }} {{ ($property->property_active ? "" : "(REMOVED)") }}</b></span>
			<span>[ <i>{{ $property->types->property_type_name }}</i> ]</span>
			<a href="{{ route('property.edit', ['property' => $property]) }}">
				<button class="btn btn-default btn-sm pull-right"
						data-toggle="tooltip" title="Edit property" 
				>
					<i class="fa fa-edit"></i>
				</button>
			</a>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">
					<label class="control-label"><i class="fa fa-info-circle"></i> Property Description:</label>
					<div class="well well-sm">
						<p>
							<b>{{ $property->property_description }}</b>
						</p>
					</div>
				</div>
			</div> <!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<label for="address" class="control-label"><i class="fa fa-map-marker"></i> Property Address:</label>
					<div class="well well-sm" id="address">
						<b>
							{{ $property->property_address }}, {{ $property->cities->city_name }}, {{ $property->cities->regions->region_name }}
						</b>
					</div> <!-- /.well well-sm -->
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row --> &nbsp;
			<div class="row">
				<div class="col-md-4">
					<label for="bath" class="control-label"><i class="fa fa-bath"></i> Bath Room(s):</label>
					<span id="bath" class="well well-sm"><b>{{ $property->property_bath_capacity }} space(s)</b></span>
				</div> <!-- /.col-md-4 -->
				<div class="col-md-4">
					<label for="bed" class="control-label"><i class="fa fa-bed"></i> Bed Room(s):</label>
					<span id="bed" class="well well-sm"><b>{{ $property->property_bed_capacity }} space(s)</b></span>
				</div> <!-- /.col-md-4 -->
				<div class="col-md-4">
					<label for="garage" class="control-label"><i class="fa fa-car"></i> Garage:</label>
					<span id="bath" class="well well-sm"><b>{{ $property->property_garage_capacity }} space(s)</b></span>
				</div> <!-- /.col-md-4 -->
			</div> <!-- /.row --> &nbsp;
			<div class="row">
				<div class="col-md-6">
					<label for="price" class="control-label"><i class="fa fa-dollar"></i> Property Pricing</label>
					<div class="well well-sm" id="price">
						<span>$ <b class="text-success"> {{ number_format($property->property_price, 2) }}</b></span>
					</div>
				</div>
				<div class="col-md-6">
					<label class="control-label"><i class="fa fa-arrows-alt"></i> Size</label>
					<div class="well well-sm" id="price">
						<span><b>{{ number_format($property->property_size,2) }} SQ. M.</b></span>
					</div>
				</div>
			</div> <!-- /.row -->&nbsp;
			<div class="row"> <!-- AMENITIES -->
				<div class="col-md-12">
					<label class="control-label"><i class="fa fa-bookmark"></i> Amenity:</label>
					<button class="btn btn-sm btn-default pull-right" data-toggle="tooltip"
							title="Add a new amenity" type="button" @click="toggleAmenityModal()"
							data-toggle="modal" data-target="amenityModal"
						>
							<i class="fa fa-plus"></i>
					</button>
					<div class="modal fade" id="amenityModal" tabindex="-1" role="dialog"
						 labelledby="amenityModalLabel"
					>
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button class="close" type="button" data-dismiss="modal" arial-label="Close"
									> <span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="amenityModalLabel">
										<b>List Of Amenities <i class="fa fa-cutlery"></i></b>
									</h4>
								</div> <!-- /.modal-header- -->
								<div class="modal-body">
									<form accept-charset="utf-8" action="" method="POST"> {{ csrf_field() }}
										@foreach ($amenities as $amenity)
										<div class="form-group">
											<div class="checkbox">
												<label>
													<input type="checkbox" value="{{ $amenity->amenity_id }}"
														@click.self="toggleAmenity($event)"
														@foreach ($property_amenities as $property_amenity)
														{{ ($property_amenity->property_amenity_amenity_id === $amenity->amenity_id) ? "checked" : "" }}
														@endforeach
													>
													{{ $amenity->amenity_name }}
												</label>
											</div>
										</div> <!-- /.form-group -->
										@endforeach
									</form>
								</div> <!-- /.modal-body -->
								<div class="modal-footer">
									<button type="button" class="btn btn-success pull-left"
										data-toggle="tooltip" title="Click here to save assigment." 
										@click="saveAmenity({{ $property->property_id }})"
									>
										<b>Save</b>
									</button>
								</div> <!-- /.modal-footer -->
							</div> <!-- /.modal-content -->
						</div> <!-- /.modal-dialog -->
					</div> <!-- /.modal fade -->
				</div>&nbsp;
				@if ($property->property_amenities->count())
				<div class="col-md-12">
					<ul class="list-group">
						@foreach($property->property_amenities->all() as $property_amenity)
						<li class="list-group-item"><i class="fa fa-hashtag"></i> {{ $property_amenity->amenities->amenity_name }}</li>
						@endforeach
					</ul>
				</div>
				@else
				<div class="col-md-12">
					<div class="well well-sm">
						<h5 class="text-muted"><b>No amenities assigned for this property, yet.</b></h5>
					</div>
				</div>
				@endif
			</div> <!-- /.row --> &nbsp;
			<div class="row">
				<div class="col-md-12">
					<label class="control-label"><i class="fa fa-image"></i> Photos</label>
					<button class="btn btn-sm btn-default pull-right"
								data-toggle="tooltip" title="Upload images for this property."
								@click="toggleUploadModal()"
						>
							<i class="fa fa-upload"></i>
					</button>
					<div class="modal fade" id="uploadModal"
						 tabindex="-1" labelledby="uploadModalLabel" 
					>
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button class="close" type="button" data-dismiss="modal" arial-label="Close"
									> <span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="uploadModalLabel">
										<b>Upload a Property Photo <i class="fa fa-upload"></i></b>
									</h4>
								</div> <!-- /.modal-header- -->
								<div class="modal-body">
									<form accept-charset="utf-8" action="" method="POST"
										enctype="" class="form-horizontal" 
									> {{ csrf_field() }}
										<div class="form-group">
											<div class="col-md-12">
												<label for="upload" class="control-label">Image File Upload <i class="fa fa-image"></i></label>
												<input type="file" name="upload" id="upload" accept="image/*" class="form-control" />
											</div> &nbsp;
											<div class="col-md-12">
												<label for="image_preview" class="control-label">Preview:</label><br><br>
												<img src="" alt="Property Image" class="img-responsive" id="image_preview" />
											</div>
										</div>
									</form>
								</div> <!-- /.modal-body -->
								<div class="modal-footer">
									<button type="button" class="btn btn-success pull-left"
										data-toggle="tooltip" title="Upload photo." 
									>
										<b>Upload</b>
									</button>
								</div> <!-- /.modal-footer -->
							</div> <!-- /.modal-content -->
						</div> <!-- /.modal-dialog -->
					</div> <!-- #uploadModal -->
				</div> &nbsp;
				@if ($property->photos->count())
				<div class="col-md-12">
					Photos
					{{-- Photo carousel with thumbnails here --}}
				</div>
				@else
				<div class="col-md-12">
					<div class="well well-sm">
						<h5 class="text-muted"><b>No photo images for this property, yet.</b></h5>
					</div>
				</div>
				@endif
			</div> <!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<label for="information" class="control-label"><i class="fa fa-cog"></i> Other Information</label>
					<div class="row">
						<div class="col-md-12">
							<div class="well well-sm">
								<ul>
									<li>
										<b>
										{{ ($property->property_is_negotiable ? "This property has negotiable price." : "This property is not negotiable.")}}
										</b>
									</li>
									<li>
										<b>
										{{ ($property->property_is_occupied ? "This property is currently occupied." : "This property is not being occupied.")}}
										</b>
									</li>
									<li>
										<b>
										{{ ($property->property_is_sold ? "This property is sold." : "This property is not yet sold.") }}
										</b>
									</li>
								</ul>
							</div> <!-- /.well well-sm -->
						</div> <!-- /.col-md-12 -->
					</div> <!-- /.row -->
				</div>
			</div> <!--/.row -->
		</div> <!-- /.panel-body -->
	</div> <!-- /.panel panel-default -->
</div> <!-- /.container-fluid -->
@stop

@section('scripts')
<script src="/js/vue/propertyModals.js"></script>
<script>
	$(document).ready(function () {
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
						$("#image_preview").attr('src', e.target.result);
					}// reader.onload function
					reader.readAsDataURL(input.files[0]);
				} // if
			} // readURL function
			$('#upload').on('change', function () {
				readURL(this);
			});			
		});
</script>
@stop