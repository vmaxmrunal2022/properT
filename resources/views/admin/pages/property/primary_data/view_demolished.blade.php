<div class="demolished">
                                
	<div class="row demolished demolished-fields-child">

		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No</label>
				<input type="text" value="{{$property->house_no ?? ''}}" name="house_no" class="form-control" id="" disabled>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input type="text" name="plot_no" class="form-control" id="" value="{{$property->plot_no ?? ''}}" disabled>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Street Name/No/Road No</label>
				<input type="text" name="street_name" class="form-control" id="" value="{{$property->street_details ?? ''}}" disabled>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name</label>
				<input type="text" name="locality_name" class="form-control" id="" value="{{$property->locality_name ?? ''}}" disabled>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input type="text" name="contact_no" class="form-control" id="" value="{{$property->contact_no ?? ''}}" disabled>
			</div>
		</div>

	</div>

</div>