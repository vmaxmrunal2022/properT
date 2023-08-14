<div class="row residential-independent-house-gated-community residential-fields-child">

		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Project Name</label>
				<input  type="text" value="{{$property->project_name ?? ''}}" name="project_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Builder</label>
				<input  type="text" value="{{$property->getBuilderName->name ?? ''}}" name="project_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input  type="text" value="{{$property->contact_no ?? ''}}" name="contact_no" class="form-control is-contact-no" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No</label>
				<input  type="text" name="house_no" value="{{$property->house_no ?? ''}}" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input  type="text" name="plot_no" value="{{$property->plot_no ?? ''}}" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Street Name/No/Road No<span class="errorcl">*</span></label>
				<input  type="text" name="street_name" value="{{$property->street_details ?? ''}}" class="form-control ctfd-required" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
				<input  type="text" name="locality_name" value="{{$property->locality_name ?? ''}}" class="form-control ctfd-required" id="">
			</div>
		</div>

	</div>