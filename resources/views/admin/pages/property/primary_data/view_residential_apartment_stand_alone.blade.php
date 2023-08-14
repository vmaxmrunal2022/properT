<div class="row residential-apartment-stand-alone residential-fields-child">
		
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Apartment Name </label>
				<input disabled type="text" value="{{$property->building_name ?? ''}}" name="apartment_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No </label>
				<input disabled type="text" value="{{$property->house_no ?? ''}}" name="house_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Owner Full Name </label>
				<input disabled type="text" value="{{$property->owner_name ?? ''}}" name="owner_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input disabled type="text" value="{{$property->plot_no ?? ''}}" name="plot_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Street Name/No/Road No</label>
				<input disabled type="text" value="{{$property->street_details ?? ''}}" name="street_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name</label>
				<input disabled type="text" value="{{$property->locality_name ?? ''}}"  name="locality_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input disabled type="text" value="{{$property->contact_no ?? ''}}" name="conatact_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3 append-floors">
		    <div>
				<label for="" class="form-label">No of Floors</label>
                <div class="input-group mb-3">
                  <input disabled type="text" class="form-control no_of_floors" value="{{$property->no_of_floors ?? ''}}" name="no_of_floors" placeholder="Enter No of Floors" aria-label="" aria-describedby="button-addon2">

                </div>
            </div>
        </div>
</div>