<div class="row residential-independent-house-gated-community residential-fields-child">

    <div class="col-xxl-3 col-md-3 mt-3">
        <div>
            <label for="" class="form-label">Project Name <span class="errorcl">*</span></label>
            <input type="text" value="" name="project_name" class="form-control  ctfd-required" id="">
        </div>
    </div>
    <div class="col-xxl-3 col-md-3 mt-3">
        <label for="" class="form-label"> Builder </label>
        <select class="form-select primay_frmdd select2-dd" name="builder_id" id="">
            <option selected disabled>-- choose Builder --</option>
            @forelse($builders as $key=>$builder)
                <option value="{{ $builder->id }}">{{ $builder->name }}</option>
            @empty
            @endforelse
        </select>
    </div>
    <div class="col-xxl-3 col-md-3 mt-3">
        <div>
            <label for="" class="form-label">Contact No</label>
            <input type="text" value="" name="contact_no" class="form-control is-contact-no"
                data-valid-length="10" id="">
        </div>
    </div>
    <div class="col-xxl-3 col-md-3 mt-3">
        <div>
            <label for="" class="form-label">House No</label>
            <input type="text" name="house_no" value="" class="form-control" id="">
        </div>
    </div>
    <div class="col-xxl-3 col-md-3 mt-3">
        <div>
            <label for="" class="form-label">Plot No</label>
            <input type="text" name="plot_no" value="" class="form-control" id="">
        </div>
    </div>
    <div class="col-xxl-3 col-md-3 mt-3">
        <div>
            <label for="" class="form-label">Street Name/No/Road No <span class="errorcl">*</span></label>
            <input type="text" name="street_name" value="" class="form-control ctfd-required" id="">
        </div>
    </div>
    <div class="col-xxl-3 col-md-3 mt-3">
        <div>
            <label for="" class="form-label">Colony/Locality Name <span class="errorcl">*</span></label>
            <input type="text" name="locality_name" value="" class="form-control ctfd-required" id="">
        </div>
    </div>

</div>
