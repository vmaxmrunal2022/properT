

@push('css')
<link href="{{ asset('assets/css/unit-details.css') }}?v=2369" rel="stylesheet" type="text/css" />
@endpush

<form id="AddImage" method="POST">
    @csrf
    <input type="hidden" name="property_id" value="{{$property->id}}">
    <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">
    <input type="hidden" name="unit_id" value="{{$unit_data->id}}">
    <input type="hidden" name="unit_type_id" value="{{$unit_data->unit_type_id}}">
    <input type="hidden" name="unit_cat_id" value="{{$unit_data->unit_cat_id}}">
    <input type="hidden" name="unit_sub_cat_id" value="{{$unit_data->unit_sub_cat_id}}">
    <div class="screen">
        <!-- Section for Pricing & Other Details -->
        <div class="card3">
            <div class="row mt-3 mb-3">
                <div class="col-md-4">
                    <p><b>GIS Id : </b> <span class="project-head"> {{$property->gis_id}}</span></p>
                </div>
                <div class="col-md-4">
                    <p><b>Locality Name : </b> <span class="project-head"> {{$property->locality_name}}</span></p>
                </div>
                <div class="col-md-4">
                    <p><b>Address : </b> <span class="project-head"> {{$property->city}}</span></p>
                </div>
            </div>
            <div class="mt-4 mb-4">
                <h4 class="mb-3">Add Images</h4>
                <label class="form-label  mt-3">Add images <span class="text-danger"> *</span></label>
                <div class="row" style="display:block;">
                    <div class="col-xxl-3 col-md-3 mb-3 ">
                        <div class="form-group">
                            <label class="form-label">Gallery Images </label>
                            <div class="d-flex justify-content-center flex-column">
                                <input type="file" name="gallery_images[]" id="files" multiple class="form-control file-input" style="display:none;">
                                <label for="files" class="form-label btn-anima btn-hover hoverfEffect ">
                                    <span> <i class="fa-solid fa-cloud-arrow-up me-1"></i> Add Gallery Images</span></label>
                            </div>
                            <div id="GalleryImages" ></div>
                        </div>
                    </div>
                    <div class=" row">
                        <div id="files-preview" class="removingFiles"></div>
                    </div>

                    <div class="col-xxl-3 col-md-3 mb-3 ">
                        <div class="form-group">
                            <label class="form-label">Amenities Images </label>
                            <div class="d-flex justify-content-center flex-column">
                                <input type="file" name="amenities_images[]" id="AmenityFiles" multiple class="form-control file-input" style="display:none;">
                                <label for="AmenityFiles" class="form-label btn-anima btn-hover hoverfEffect ">
                                    <span> <i class="fa-solid fa-cloud-arrow-up me-1"></i> Add Amenities Images</span></label>
                            </div>
                            <div id="AmenityImages" ></div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="amenity-files-preview" class="removingFiles"></div>
                    </div>
                    <div class="col-xxl-3 col-md-3 mb-3 ">
                        <div class="form-group">
                            <label class="form-label">Interior Images </label>
                            <div class="d-flex justify-content-center flex-column">
                                <input type="file" name="interior_images[]" id="InteriorFiles" multiple class="form-control file-input" style="display:none;">
                                <label for="InteriorFiles" class="form-label btn-anima btn-hover hoverfEffect ">
                                    <span> <i class="fa-solid fa-cloud-arrow-up me-1"></i> Add Interior Images</span></label>
                            </div>
                            <div id="InteriorImages"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="interior-files-preview" class="removingFiles"></div>
                    </div>

                    <div class="col-xxl-3 col-md-3 mb-3 ">
                        <div class="form-group">
                            <label class="form-label">Floor Plan Images </label>
                            <div class="d-flex justify-content-center flex-column">
                                <input type="file" name="floor_plan_images[]" id="FloorPlanFiles" multiple class="form-control file-input" style="display:none;">
                                <label for="FloorPlanFiles" class="form-label btn-anima btn-hover hoverfEffect ">
                                    <span> <i class="fa-solid fa-cloud-arrow-up me-1"></i> Add Floor Plan Images</span></label>
                            </div>
                            <div id="FloorPlanImages"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="floor-plan-files-preview" class="removingFiles"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="ms-auto text-end">
                <button type="button" class="btn btn-done btn-warning prevBtn"><i class="fa fa-arrow-left"></i>&nbsp;Previous </button>
                <button type="submit" class="btn btn-done btn-primary">Next &nbsp;<i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
</form>