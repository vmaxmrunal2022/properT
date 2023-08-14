<div class="under-construction">

	<div class="row under-construction-pfrm under-construction-fields-child">

		<div class="col-xxl-3 col-md-3 mt-3 ">
			<div>
				<label for="" class="form-label">under construction Types </label>
			
					<input type="text" value="{{$property->under_construction_category->cat_name ?? ''}}"  name="project_name" class="form-control" id="" disabled>
			</div>
		</div>

		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Project Name</label>
				<input type="text" value="{{$property->project_name ?? ''}}"  name="project_name" class="form-control" id="" disabled>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Builder</label>
				<input type="text" value="{{$property->getBuilderName->name ??''}}" name="builder_name" class="form-control" id="" disabled>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input type="text" name="contact_no" value="{{$property->contact_no ?? ''}}" class="form-control" id="" disabled>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No</label>
				<input type="text" name="house_no" class="form-control" id="" value="{{$property->house_no ?? ''}}" disabled>
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
				<input type="text" name="locality_name" value="{{$property->locality_name ?? ''}}" disabled class="form-control" id="">
			</div>
		</div>

	</div>

</div>