<div class="row">
    <div class="col-xl-12 col-md-12">
                <!--APARTMENT Category-->
                {{--<div class="card" style="">
                    <form action="{{route('serach_by_gis_post')}}" method="post">
                    @csrf
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-xxl-3 col-md-3 d-flex align-items-end">
                                <div>
                                    <label for="" class="form-label">Enter GIS ID <span class="errorcl">*</span></label>
                                    <input type="text" name="gis_id" value="{{$property_details->gis_id}}" class="form-control req-ctfd-required" id="gis_id" placeholder="EX:7255158845" value="" onkeypress="return isNumber(event)">
                                </div>
                                <div class="ms-3">
                                    <input type="submit" value="Submit" class="btn btn-success add-floor">
                                    <!--<button class="btn btn-success add-floor" type="button" id="btn-search-gis-id">Search</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>--}}
                <form action="https://proper-t.co/testing.propert/surveyor/property/create-blocks" method="post" name="create_blocks" id="create_blocks">
                    <input type="hidden" name="_token" value="6Z9hCQgYOBkTDWrSNMSh7ruDHRrdrke9muyKpT0O">
                    {{--<div id="defined_block">
                        <div class="" style="">
                            <div class="card-body ">
                                <div class="row residential-apartment-gated-community residential-fields-child">
                                    <input type="hidden" name="property_id" class="form-control" id="" readonly="" value="5">
                                    <input type="hidden" name="gis_primary_id" class="form-control" id="gis_primary_id" readonly="" value="123456789">
                                    <input type="hidden" name="cat_id" class="form-control" id="cat_id" readonly="" value="2">
                                    <input type="hidden" name="residential_type" class="form-control" id="residential_type" readonly="" value="7">
                                    <input type="hidden" name="residential_sub_type" class="form-control" id="residential_sub_type" readonly="" value="10">

                                </div>
                            </div>
                        </div>
                    </div>--}}

                </form>
                <!--<form action="" method="post" id="contactUsForm">-->
                <form id="amenities-frm" method="POST" action="">
                    @csrf
                    <div class="" style="">
                        <div class="card-body">
                            <div class="mb-3 mb-3">
                                <!-- <h4 class="mb-3">Amenities Details <small></small></h4> -->
                               

                                @forelse($propertyAmenities as $amenity_key=>$propertyAmenity) 
                                        
                                        <label class="form-label small-heading h5"><strong>{{$propertyAmenity->name}}</strong></label>
                                        <div class="row align-items-center mb-2">
                                            @php $status = false; @endphp
                                            @forelse($propertyAmenity->children as $option_key=>$option) 
                                              
                                                @php $status = true; @endphp
                                                <div class="col-md-3 simplecheck mb-3">
                                                    <span>
                                                        <input type="checkbox" id="secondary_feature" {{ in_array($option->id, $checked_amenities) ? 'checked' : '' }} name="amenity_option{{$amenity_key}}[]" value="{{$option->id}}"> {{$option->name}}
                                                    </span>
                                                </div>
                                               
                                            @empty
                                            @endforelse
                                                @if($status == false)
                                                <div class="col-md-3 simplecheck mb-3">
                                                    <span>N/A</span>
                                                </div>
                                                @endif
                                        </div>
                                        <input type="hidden" name="secondary_feature[{{$amenity_key}}]" value="{{$propertyAmenity->id}}">
                                    @empty
                                    @endforelse
                                <input type="hidden" name="property_id" value="{{$property_id ?? 0}}">

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary btn-md save-next" data-block-type="tab" data-parent-tab="pills-profile-tab">Save</button>
                                    <button type="button" class="btn btn-md btn-primary amenities-next-btn" >Procced</button>
                                    <!--<button class="btn btn-md btn-save">Save </button>-->
                                </div>
                            </div>
                </form>
            </div>


        </div>

    </div>
</div>