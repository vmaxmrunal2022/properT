<div class="multi-unit">
	<div class="row multi-unit multi-unit-fields-child ">
	
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Project Name</label>
				<input type="text" value="{{$property->project_name ?? ''}}" name="project_name" class="form-control" id="" >
			</div>
		</div>
    	<div class="col-xxl-3 col-md-3 mt-3">
            <label for="" class="form-label"> Builder </label>
            <select class="form-select primay_frmdd select2-dd" name="builder_id" id="" >
                <option selected disabled>-- choose Builder --</option>
                @forelse($builders as $key=>$builder)
                	<option value="{{$builder->id ?? ''}}" @if($property->builder_id == $builder->id) selected @endif>{{$builder->name ?? ''}}</option>
                @empty
                @endforelse
            </select>
        </div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input type="text" name="contact_no" class="form-control is-contact-no" id="" value="{{$property->contact_no ?? ''}}" >
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No</label>
				<input type="text" name="house_no" class="form-control" id="" value="{{$property->house_no ?? ''}}" >
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input type="text" name="plot_no" class="form-control" id="" value="{{$property->plot_no ?? ''}}" >
			</div>
		</div>
        <div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Street Name/No/Road No <span class="errorcl">*</span></label>
				<input type="text" name="street_name" class="form-control ctfd-required" id="" value="{{$property->street_details ?? ''}}" >
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name <span class="errorcl">*</span></label>
				<input type="text" name="locality_name" class="form-control ctfd-required" id="" value="{{$property->locality_name ?? ''}}" >
			</div>
		</div>
	
	</div>
</div>