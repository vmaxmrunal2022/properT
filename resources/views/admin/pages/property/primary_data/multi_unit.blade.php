<div class="multi-unit">
	<div class="row multi-unit multi-unit-fields-child ">
	
				<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Building Name </label>
				<input type="text" name="building_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No </label>
				<input type="text" name="house_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input type="text" name="plot_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Street Name/No/Road No <span class="errorcl">*</span></label>
				<input type="text" name="street_name" class="form-control ctfd-required" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name <span class="errorcl">*</span></label>
				<input type="text" name="locality_name" class="form-control ctfd-required" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Owner Full Name </label>
				<input type="text" name="owner_name" class="form-control is-person-name" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input type="text" name="contact_no" class="form-control is-contact-no" data-valid-length="10" id="">
			</div>
		</div>
    	{{--<div class="col-xxl-3 col-md-3 mt-3">
            <label for="" class="form-label"> Builder </label>
            <select class="form-select primay_frmdd select2-dd" name="builder_id" id="" >
                <option selected disabled>-- choose Builder --</option>
                @forelse($builders as $key=>$builder)
                <option value="{{$builder->id}}">{{$builder->name}}</option>
                @empty
                @endforelse
            </select>
        </div>--}}
		
		
		{{--<div class="col-xxl-3 col-md-3 mt-3 no_of_floors">
			<div>
				<label for="" class="form-label">No of Floors</label>
				<input type="text" name="no_of_floors" class="form-control " data-parent="multi-unit" id="">
			</div>
		</div>--}}
		<div class="col-xxl-3 col-md-3 mt-3 append-floors">
		    <div>
				<label for="" class="form-label">No of Floors <span class="errorcl">*</span></label>
                <div class="input-group ">
                  <input type="text" class="form-control no_of_floors ctfd-required is-numeric" name="no_of_floors" placeholder="Enter No of Floors" aria-label="" aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-success add-floor" type="button"  id="button-addon2">Add Floors</button>
                  </div>
                </div>
            </div>
        </div>
        
	
	</div>
</div>