<div class="multi-unit">
	<div class="row multi-unit multi-unit-fields-child ">
	
				<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Building Name </label>
				<input disabled  type="text" name="building_name" value="{{$property->building_name ?? ''}}" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No </label>
				<input disabled  type="text" name="house_no" value="{{$property->house_no ?? ''}}" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input disabled  type="text" name="plot_no" value="{{$property->plot_no ?? ''}}" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Street Name/No/Road No</label>
				<input disabled  type="text" name="street_name" value="{{$property->street_details ?? ''}}" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name</label>
				<input disabled  type="text" name="locality_name" value="{{$property->locality_name ?? ''}}" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Owner Full Name </label>
				<input disabled  type="text" name="owner_name" value="{{$property->owner_name ?? ''}}" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input disabled  type="text" name="contact_no" value="{{$property->contact_no ?? ''}}" class="form-control" id="">
			</div>
		</div>


		<div class="col-xxl-3 col-md-3 mt-3 append-floors">
		    <div>
				<label for="" class="form-label">No of Floors</label>
                <div class="input-group mb-3">
                  <input disabled  type="text" class="form-control no_of_floors" value="{{$property->no_of_floors ?? ''}}"  name="no_of_floors" placeholder="Enter No of Floors" aria-label="" aria-describedby="button-addon2">
                </div>
            </div>
        </div>
        
	
	</div>
</div>