<div class="row residential-apartment-gated-community residential-fields-child">

    <div class="col-xxl-3 col-md-3 mt-3">
        <div>
            <label for="" class="form-label">Project Name</label>
            <input type="text" value="{{$property->project_name ?? ''}}" name="project_name" class="form-control" id="" disabled>
        </div>
    </div>
    <div class="col-xxl-3 col-md-3 mt-3">
        <label for="" class="form-label"> Builder </label>
        <input type="text" name="contact_no" class="form-control" id="" value="{{$property->getBuilderName->name ?? ''}}" disabled>
    </div>
    <div class="col-xxl-3 col-md-3 mt-3">
        <div>
            <label for="" class="form-label">Contact No</label>
            <input type="text" name="contact_no" class="form-control" id="" value="{{$property->contact_no ?? ''}}" disabled>
        </div>
    </div>
    <div class="col-xxl-3 col-md-3 mt-3">
        <div>
            <label for="" class="form-label">House No</label>
            <input type="text" name="house_no" value="{{$property->house_no ?? ''}}" class="form-control" id="" disabled>
        </div>
    </div>
    <div class="col-xxl-3 col-md-3 mt-3">
        <div>
            <label for="" class="form-label">Plot No</label>
            <input type="text" name="plot_no" value="{{$property->plot_no ?? ''}}" class="form-control" id="" disabled>
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
            <input type="text" name="locality_name" value="{{$property->locality_name ?? ''}}" class="form-control" id="" disabled>
        </div>
    </div>
    <div class="col-xxl-3 col-md-3 mt-3">
        <div>
            <a class="btn btn-success" href="{{url('surveyor/property/gated-community-details/'.$property->id)}}"> View Gated Community Details</a>
        </div>
    </div>

</div>
