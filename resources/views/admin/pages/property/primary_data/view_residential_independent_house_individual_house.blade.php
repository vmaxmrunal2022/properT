<div class="row residential-independent-house-individual-house residential-fields-child">
		
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House Name </label>
				<input disabled value="{{$property->building_name ?? ''}}" type="text" name="building_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No </label>
				<input disabled value="{{$property->house_no ?? ''}}" type="text" name="house_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input disabled value="{{$property->plot_no ?? ''}}" type="text" name="plot_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Street Name/No/Road No</label>
				<input disabled value="{{$property->street_details ?? ''}}" type="text" name="street_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name</label>
				<input disabled value="{{$property->locality_name ?? ''}}" type="text" name="locality_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Owner Full Name </label>
				<input disabled value="{{$property->owner_name ?? ''}}" type="text" name="owner_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input disabled value="{{$property->contact_no ?? ''}}" type="text" name="contact_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3 append-floors">
		    <div>
				<label for="" class="form-label">No of Floors</label>
                <div class="input-group mb-3">
                  <input disabled value="{{$property->no_of_floors ?? ''}}" type="text" class="form-control no_of_floors" name="no_of_floors" placeholder="Enter No of Floors" aria-label="" aria-describedby="button-addon2">
                 
                </div>
            </div>
        </div>
        


	</div>