@extends('admin.layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <link href="{{ url('public/assets/css///unit-details.css') }}" rel="stylesheet" type="text/css" />
    <style>
        p {
            margin-bottom: 0px;
        }

        .count-list,
        .check-list {
            margin: 0;
            padding: 0;
            width: 100%
        }

        .count-list li {
            list-style: none;
            float: left;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 100px;
            margin: 5px;
            height: 36px;
            width: 36px;
            text-align: center;
            line-height: 10px;
            transition: 0.3s
        }

        .count-list li:hover {
            background: #f7ecff;
            border: solid 1px #000;
            transition: 0.3s;
            cursor: pointer;
        }

        .count-list li.active {
            background: #f7ecff;
            border: solid 1px #662e93;
            transition: 0.3s;
            color: #662e93
        }

        .check-list li {
            list-style: none;
            float: left;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 100px;
            margin: 5px;
            text-align: center;
            line-height: 10px;
            transition: 0.3s
        }

        .check-list li:hover {
            background: #f7ecff;
            border: solid 1px #000;
            transition: 0.3s;
            cursor: pointer;
        }

        .check-list li.active {
            background: #f7ecff;
            border: solid 1px #662e93;
            transition: 0.3s;
            color: #662e93
        }

        .btn-primary {
            background: #662e93 !important;
            border: solid 1px #662e93;
        }

        .form-label {
            position: relative;
        }

        .required::after {
            content: '*';
            color: red;
            position: absolute;
            right: -10px;
        }

        .box-bdr {
            border: solid 1px #ddd;
            padding: 0px;
            border-radius: 6px;
        }

        .form-control-b0 {
            border: none !important;
        }

        .form-control,
        .form-select {
            /*            min-height: 50px*/
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-menu span {
            line-height: 24px;
            display: flex
        }

        input[type=checkbox] {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .input-step.step-primary button {
            background: #f7ecff;
            border: solid 1px #662e93;
            color: #662e93
        }

        .simplecheck span {
            line-height: 24px;
            display: flex
        }

        .screen {
            display: none;
        }

        .visible {
            display: block;
        }

        /*.progress-bar {*/
        /*  transition: width 0.3s ease-in-out;*/
        /*}*/
        .progress-bar {
            background-color: #deedf6 !important;
            color: black !important;
        }

        .progress-bar1 {
            background-color: #299cdb !important;
            color: white !important;
        }

        .progress-bar.active {
            background-color: #299cdb !important;
            color: white !important;
        }

        .progress-info .progress-bar::after {
            border-left-color: #7ed1ff !important;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Report Details </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="progress progress-step-arrow progress-info">
                            <a href="javascript:void(0);" class="progress-bar progress-bar1 active" role="progressbar"
                                style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Property
                                Details</a>
                            <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"> Pricing & Other Details</a>
                            <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"> Add Images</a>
                            <a href="javascript:void(0);" class="progress-bar text-dark" role="progressbar"
                                style="width: 100%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> Amenities
                                Details(Optional)</a>
                        </div>
                        <!-- step -1 -->
                        <div class="mt-4 mb-4">
                            <div id="screens">
                                <form id="SubmitPropertyDetails" method="POST">
                                    <input type="hidden" name="property_id" value="{{$property->id}}">
                                    <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">
                                    <input type="hidden" name="unit_id" value="{{$unit_data->id}}">
                                    <input type="hidden" name="unit_type_id" value="{{$unit_data->unit_type_id}}">
                                    <input type="hidden" name="unit_cat_id" value="{{$unit_data->unit_cat_id}}">
                                    <input type="hidden" name="unit_sub_cat_id" value="{{$unit_data->unit_sub_cat_id}}">

                                    <div class="screen visible">
                                        <div class="col-md-12">
                                            <div class="row mt-3 mb-3">
                                                <div class="col-md-4">
                                                    <p><b>GIS Id : </b> <span class="project-head"> {{$property->gis_id}}</span></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><b>Locality Name : </b> <span class="project-head"> {{$property->locality_name}}</span></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><b>Address : </b> <span class="project-head">  {{$property->street_details}}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="mb-3 mt-3">Property Details</h4>
                                        <label class="form-label required">No of Bedrooms</label>
                                        <div class="row align-items-start mb-3">
                                            <div class="col-md-12 mb-3">
                                                <div class="radio-toolbar"> 
                                                    <input type="radio" id="bedrooms1" name="bedrooms" value="1" @if($onerkdata->rooms == 1) checked @endif>
                                                    <label for="bedrooms1">1</label>
                                                    
                                                </div>
                                                <span id="err_bedrooms"></span>
                                            </div>
                                        </div>
                                        <div class="clearfix mb-3"></div>
                                        
                                        <label class="form-label required">No of Washrooms</label>
                                        <div class="row align-items-start mb-3">
                                            <div class="col-md-12 mb-3">
                                                <div class="radio-toolbar">
                                                    <input type="radio" id="washrooms1" name="washrooms" value="1" @if($onerkdata->washrooms == 1) checked @endif>
                                                    <label for="washrooms1">1</label>
                                                    
                                                </div>
                                                <span id="err_washrooms"></span>
                                            </div>
                                        </div>


                                        <div class="clearfix mb-3"></div>
                                        <label class="form-label mb-0 required">Property Facing</label>
                                        <div class="radio-toolbar-text">
                                            @foreach ($property_facings as $facing)
                                            <input type="radio" id="property_facing{{$facing->id}}" @if($onerkdata->property_facing == $facing->id) checked @endif name="property_facing" value="{{$facing->id}}">
                                            <label for="property_facing{{$facing->id}}">{{$facing->name}}</label>
                                            @endforeach
                                        </div>
                                        <span id="err_property_facing"></span>
                                        <div class="clearfix mb-3"></div>

                                        <label class="form-label required">No of Balconies</label>
                                        <div class="row align-items-start mb-3">
                                            <div class="col-md-12 mb-3">
                                                <div class="radio-toolbar">
                                                    <input type="radio" id="balcony1" name="balconies" value="1" @if($onerkdata->balconies == 1) checked @endif>
                                                    <label for="balcony1">1</label>
                                                    <input type="radio" id="balcony2" name="balconies" value="2" @if($onerkdata->balconies == 2) checked @endif>
                                                    <label for="balcony2">2</label>
                                                    <input type="radio" id="balcony3" name="balconies" value="3" @if($onerkdata->balconies == 3) checked @endif>
                                                    <label for="balcony3">3</label>
                                                    <input type="radio" id="balcony4" name="balconies" value="4" @if($onerkdata->balconies == 4) checked @endif>
                                                    <label for="balcony4">4</label>
                                                    @if($onerkdata->balconies > 4)
                                                    <input type="radio" id="balcony4" name="balconies" value="{{$onerkdata->balconies}}"  checked>
                                                    <label for="balcony4">{{$onerkdata->balconies}}</label>
                                                    @endif


                                                    <div class="extra-balcony-block" style="display: none;">
                                                        <input type="radio" id="extra-balcony-input" name="balconies" value="">
                                                        <label for="extra-balcony-input" id="extra-balcony-label"></label>
                                                    </div>
                                                    
                                                </div>
                                                <span id="err_balconies"></span>
                                            </div>
                                            <div class="col-md-2 add-balconies">
                                                <a style="color: var(--vz-link-color);"> + Add other</a>
                                            </div>
                                            
                                            <div class="col-md-2 other-balcony-block" style="display: none;">
                                                <input type="text" class="form-control col-md-3" placeholder="Enter Balconies" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="other_balconies" id="other-balconies">
                                            </div>
                                            <div class="col-md-2 add-extra-balcony" style="display: none;">
                                                <button type="button" class="btn btn-done btn-primary">Done</button>
                                            </div>
                                        </div>

                                        <div class="clearfix mb-3"></div>
                                        <div class="row align-items-center mt-3 mb-3 area-details-block">
                                            <label class="form-label m-0">Add Area Details <span class="text-danger"> *</span>
                                            </label>
                                            <div class="col-md-4 ">
                                                <div class="box-bdr">
                                                    <div class="d-flex">
                                                        <div>
                                                            <input type="text" maxlength="11" class="form-control form-control-b0 col-md-3 border-none required-text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$onerkdata->carpet_area ?? ''}}" name="carpet_area" id="" placeholder="carpet area">
                                                        </div>
                                                        <div class="ms-auto" style="">
                                                            <select class="form-select form-control-b0 border-left" name="carpet_area_units">
                                                                @foreach ($units as $area_units)
                                                                <option value="{{$area_units->id}}" @if($onerkdata->carpet_area_unit == $area_units->id)  selected @endif>{{$area_units->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix mb-3"></div>
                                            <div class="col-md-4 built-area-block" @if($onerkdata->buildup_area == null) style="display: none;" @endif>
                                                <div class="box-bdr">
                                                    <div class="d-flex">
                                                        <div>
                                                            <input type="text" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                class="form-control form-control-b0 col-md-3 border-none required-text" value="{{$onerkdata->buildup_area ?? ''}}"  name="built_area" id="" placeholder="Add Built up area">
                                                        </div>
                                                        <div class="ms-auto" style="">
                                                            <select class="form-select form-control-b0" name="builtup_area_units">
                                                                @foreach ($units as $area_units)
                                                                <option value="{{$area_units->id}}" @if($onerkdata->buildup_area_unit == $area_units->id)  selected @endif>{{$area_units->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix mb-3"></div>
                                            <div class="col-md-4 super-built-area-block" @if($onerkdata->super_buildup_area == null) style="display: none;" @endif>
                                                <div class="box-bdr" >
                                                    <div class="d-flex">
                                                        <div>
                                                            <input type="text" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control form-control-b0 col-md-3 border-none required-text" value="{{$onerkdata->super_buildup_area ?? ''}}" name="super_built_area" id="" placeholder="Add Super Built up area">
                                                        </div>
                                                        <div class="ms-auto" style="">
                                                            <select class="form-select form-control-b0" name="super_built_area_units">
                                                                @foreach ($units as $area_units)
                                                                <option value="{{$area_units->id}}" @if($onerkdata->super_buildup_area_unit == $area_units->id)  selected @endif>{{$area_units->name}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span id="err_carpet_area"></span>
                                            <div class="clearfix mb-3"></div>
                                            <div class="col-md-4">
                                                <div class="d-flex justify-content-between">
                                                    <div class="add-built-area"  @if($onerkdata->buildup_area != null) style="display: none;" @endif>
                                                        <a style="color: var(--vz-link-color);"> + Add Built up area</a>
                                                    </div>
                                                
                                                    <div class="add-super-built-area"  @if($onerkdata->super_buildup_area != null) style="display: none;" @endif>
                                                        <a style="color: var(--vz-link-color);"> + Add Super Built up area</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix mb-3"></div>

                                        <label class="form-label m-0"> Other Rooms </label>
                                        <small class=""><i>(Optional)</i></small>
                                        <div class="radio-toolbar-text mt-3">
                                            @foreach ($other_rooms as $room)
                                                <div class="col-md-2 simplecheck mb-3">
                                                    <span><input type="checkbox" name="other_rooms[]"  @if(in_array( $room->id,$other_room_values)) checked @endif  value="{{$room->id}}"> {{$room->name}}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="clearfix mb-3"></div>
                                        <label class="form-label m-0"> Furnishing Options <span class="text-danger">*</span></label>
                                        <div class="radio-toolbar-text Furn-semi mt-3">

                                            @foreach ($furnished_options as $furnish)
                                        
                                                <div>
                                                    <input type="radio" id="furnished-option{{$furnish->id}}" name="furnished_option" @if($furnish->id == $onerkdata->furnishing_option) checked @endif value="{{$furnish->id}}">
                                                    <label for="furnished-option{{$furnish->id}}" data-fid="{{$furnish->id}}" class="toggleItem"> {{$furnish->name}}</label>
                                                    @if ($furnish->furnished_type_options->count() > 0)   
                                                        <div id="item{{$furnish->id}}" class="dropdown-menu p-3 MobilelistFurninshed" style="display: none;">

                                                            <div class="row">

                                                                @foreach ($furnish->furnished_type_options as $option)
                                                                @if ($option->input_type == 'number')
                                                                    <div class="col-md-6 col-6 d-flex align-items-center mb-3">
                                                                        <div class="input-step step-primary float-left mr-2">
                                                                            <button type="button" class="minus">–</button>
                                                                            <input type="number" class="product-quantity" value="{{$textOptions[$option->id] ?? '1'}}" name="{{str_replace([' ', '-'], '_', $furnish->name)}}_{{str_replace([' ', '-'], '_', $option->name)}}" min="0" max="100" readonly="">
                                                                            <button type="button" class="plus">+</button>
                                                                        </div>
                                                                        <div class=" ms-2"><span> {{$option->name}}</span></div>
                                                                    </div>
                                                                @endif
                                                                @if ($option->input_type == 'checkbox')
                                                                    <div class="col-md-4  col-6 mb-3">
                                                                        <span>
                                                                            <input type="checkbox" class="loop-checkboxes" @if(isset($chechkOptions[$option->id])) @if($option->id == $chechkOptions[$option->id])  checked @endif @endif name="{{str_replace([' ', '-'], '_', $furnish->name)}}_{{str_replace([' ', '-'], '_', $option->name)}}"/> {{$option->name}}
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                                    
                                                                @endforeach
                                                            
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>
                                                    
                                        
                                                
                                            @endforeach
                                            
                                        </div>
                                        <span id="err_furnished_option"></span>

                                        <div class="clearfix mb-3"></div>

                                        <label class="form-label m-0"> Reserved Parking</label>
                                        <small class=""><i>(Optional)</i></small>
                                        <div class="row">
                                            <div class="col-md-3 d-flex align-items-center mt-3">
                                                    <div class="col-md-6 col-6 d-flex align-items-center mb-3">
                                                        <div class=" me-2"><span> Covered Parking</span></div>
                                                        <div class="input-step step-primary float-left mr-2">
                                                            <button type="button" class="minus">–</button>
                                                            <input type="number" class="product-quantity" value="{{$onerkdata->covered_parking ?? '1'}}" name="covered_parking" min="1" max="100" readonly="">
                                                            <button type="button" class="plus">+</button>
                                                        </div>
                                                    </div>
    
                                            </div>
                                            <div class="col-md-3 d-flex align-items-center mt-3">
                                                <div class="col-md-6 col-6 d-flex align-items-center mb-3">
                                                    <div class=" me-2"><span> Open Parking</span></div>
                                                    <div class="input-step step-primary float-left mr-2">
                                                        <button type="button" class="minus">–</button>
                                                        <input type="number" class="product-quantity" value="{{$onerkdata->open_parking ?? '1'}}" name="open_parking" min="1" max="100" readonly="">
                                                        <button type="button" class="plus">+</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    
                                        
                                        <div class="clearfix mb-3"></div>

                                        <div class="clearfix mb-3"></div>
                                        <label class="form-label mb-0 required">Availability Status</label>
                                        <div class="radio-toolbar-text">
                                            @foreach ($availability_status as $availability)
                                                <input type="radio" class="availability_status_radio" id="availibility_status{{$availability->id}}" @if($availability->id == $onerkdata->availability_status) checked @endif name="availability_status"  value="{{$availability->id}}" onclick="ShowBlocks({{$availability->id}})">
                                                <label for="availibility_status{{$availability->id}}">{{$availability->name}}</label>  
                                            @endforeach
                                            
                                        </div>
                                        <span id="err_availability_status"></span>

                                        <div class="clearfix mb-3"></div>
                                        <div class="age-of-property-block" @if($onerkdata->availability_status != 23) style="display: none;" @endif>
                                            <label class="form-label mb-0 required">Age of Property</label>
                                            <div class="radio-toolbar-text">
                                                @foreach ($age_props as $prop)
                                                    <input type="radio" id="age_prop{{$prop->id}}"  @if($onerkdata->age_of_property == $prop->id) checked @endif name="age_of_property" value="{{$prop->id}}">
                                                    <label for="age_prop{{$prop->id}}">{{$prop->name}}</label>
                                                @endforeach
                                                
                                            </div>
                                            
                                        </div>
                                        <span id="err_age_of_property"></span>
                                        
                                        <div class="clearfix mb-3"></div>
                                        <div class="possession-block" @if($onerkdata->availability_status != 24) style="display: none;" @endif>
                                            <label class="form-label m-0 required">Possesion by</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="date" class="form-control"  value="{{ \Carbon\Carbon::parse($onerkdata->possesion_by)->format('Y-m-d') }}" name="possession_date" />
                                                </div>
                                                
                                            </div>
                                        
                                        </div>
                                        <span id="err_possession_date"></span>
                                    
                                        <div class="card-footer">
                                            <div class="ms-auto text-end">
                                                <button type="submit" class="btn btn-done btn-primary " id="step1">Next &nbsp;<i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- scrren2 -->

                                <form id="PricingDetailsForm" method="POST">
                                    <div class="screen ">
                                        <input type="hidden" name="property_id" value="{{$property->id}}">
                                        <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">
                                        <input type="hidden" name="unit_id" value="{{$unit_data->id}}">
                                        <input type="hidden" name="unit_type_id" value="{{$unit_data->unit_type_id}}">
                                        <input type="hidden" name="unit_cat_id" value="{{$unit_data->unit_cat_id}}">
                                        <input type="hidden" name="unit_sub_cat_id" value="{{$unit_data->unit_sub_cat_id}}">

                                        <div class="card-body">
                                            <div class="row mt-3 mb-3">
                                                <div class="col-md-4">
                                                    <p><b>GIS Id : </b> <span class="project-head">
                                                            {{$property->gis_id}}</span></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><b>Locality Name : </b> <span class="project-head">
                                                            {{$property->locality_name}}</span></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><b>Address : </b> <span class="project-head">
                                                            {{$property->street_details}}</span></p>
                                                </div>
                                            </div>
                                            <h4 class="mb-3">Pricing &amp; Other Details</h4>
                                            <div class="row align-items-center mb-2">
                                                <div class="col-md-12 mb-3">
                                                    <div class="radio-toolbar-text">
                                                        <input type="radio" id="for-sale" value="1" @if($onerkdata->pricing_details_for == 1) checked @endif
                                                            name="pricing_details_for" >
                                                        <label for="for-sale">For Sale</label>
                                                        <input type="radio" id="for-rent" value="2" @if($onerkdata->pricing_details_for == 2) checked @endif
                                                            name="pricing_details_for">
                                                        <label for="for-rent">For Rent</label>
                                                    </div>
                                                </div>
                                                <span id="err_pricing_details_for"></span>
                                            </div>

                                            <div class="for-sale">

                                                <div class="ownersip-block">
                                                    <label class="form-label required">Ownership Details</label>
                                                    <div class="row align-items-center mb-2">
                                                        <div class="col-md-12 mb-3">
                                                            <div class="radio-toolbar-text ownership-input">
                                                                @foreach ($ownerships as $ownership)
                                                                <input type="radio" id="ownership{{$ownership->id}}"
                                                                    name="ownership" value="{{$ownership->id}}" @if($onerkdata->ownership == $ownership->id) checked @endif> 
                                                                <label
                                                                    for="ownership{{$ownership->id}}">{{$ownership->name}}</label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <span id="err_ownership"></span>
                                                    </div>
                                                
                                                </div>


                                                <div class="clearfix"></div>

                                                <div class="price-details-block">
                                                    <label class="form-label required">Price Details</label>
                                                    <div class="row align-items-center mb-3">
                                                        <div class="col-md-4">
                                                            <input type="text" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control required-sale" id="" value="{{$onerkdata->expected_price ?? ''}}"
                                                                name="expected_price" placeholder="Expected Price">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control required-sale" id="" value="{{$onerkdata->price_per_sq_ft ?? ''}}"
                                                                name="price_per_sq_ft" placeholder="Price per Sq feet">
                                                        </div>

                                                        <span id="err_expected_price"></span>
                                                        <span id="err_price_per_sq_ft"></span>

                                                        <div class="clearfix mt-3"></div>
                                                        @foreach ($price_details as $details)
                                                        <div class="col-md-2 simplecheck mb-3">
                                                            <span><input type="checkbox"
                                                                    name="price_details_{{$details->id}}" @if(in_array($details->id,$price_details_values)) checked @endif
                                                                    value="{{$details->id}}">{{$details->name}}</span>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="add-price-details-block">
                                                    <label class="form-label">Additional Pricing Details </label> <small
                                                        class=""><i>(Optional)</i></small>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="box-bdr">
                                                                <div class="row d-flex">
                                                                    <div class="col-md-7">
                                                                        <input type="text" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                            class="form-control form-control-b0 border-none"
                                                                            name="pricing_maintenance_price" id="" value="{{$onerkdata->mainteinance ?? ''}}"
                                                                            placeholder="Maintenance">
                                                                    </div>
                                                                    <div class="col-md-5 ms-auto" style=" ">
                                                                        <select class="form-select form-control-b0"
                                                                            name="maintenance_period">
                                                                            @foreach ($price_details_periods as $period)
                                                                            <option value="{{$period->id}}" @if($onerkdata->maintenance_period == $period->id) selected @endif>
                                                                                {{$period->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mb-2">
                                                            <input type="text" class="form-control border-none" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                name="pricing_expected_rental" id="" value="{{$onerkdata->expected_rental ?? ''}}"
                                                                placeholder="Expected Rental">
                                                        </div>

                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control border-none" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        name="pricing_booking_amount" id="" value="{{$onerkdata->booking_amount ?? ''}}"
                                                                        placeholder="Booking Amount">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control border-none" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        name="pricing_annual_dues_payable" id="" value="{{$onerkdata->annual_due_pay ?? ''}}"
                                                                        placeholder="Annual dues payble">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control border-none" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        name="pricing_membership_charge" id="" value="{{$onerkdata->membership_charge ?? ''}}"
                                                                        placeholder="Membership Charge">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="for-rent">
                                                <div class="agreement-block">
                                                    <label class="form-label required">Preferred Agreement Type</label>
                                                    <div class="row align-items-center mb-2">
                                                        <div class="col-md-12 mb-3">
                                                            <div class="radio-toolbar-text">
                                                                @foreach ($agreement_types as $type)
                                                                <input type="radio" id="agreement_type{{$type->id}}"
                                                                    name="agreement_type" value="{{$type->id}}" @if($onerkdata->agreement_type == $type->id) checked @endif>
                                                                <label
                                                                    for="agreement_type{{$type->id}}">{{$type->name}}</label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <span id="err_agreement_type"></span>
                                                    </div>
                                                </div>

                                                <div class="rent-details-block">
                                                    <label class="form-label required">Rent Details </label>
                                                    <div class="row align-items-center mb-3">
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control required-rent" id="" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                name="expected_rent" value="{{$onerkdata->expected_rent ?? ''}}" placeholder="Expected Rent">
                                                        </div>

                                                        <span id="err_expected_rent"></span>

                                                        <div class="clearfix mt-3"></div>

                                                        @foreach ($rent_details as $item)
                                                        <div class="col-md-2 simplecheck mb-3">
                                                            <span><input type="checkbox" name="rent_details_{{$item->id}}" @if(in_array($item->id,$rent_details_values)) checked @endif
                                                                    value="{{$item->id}}">{{$item->name}}</span>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="add-rent-details-block">
                                                    <label class="form-label">Additional Rent Details </label> <small
                                                        class=""><i>(Optional)</i></small>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row ">
                                                                {{-- <div class="col-md-3">
                                                                    <input type="text" class="form-control " maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$onerkdata->maintenance_rent ?? ''}}"
                                                                        name="rent_maintenance" id=""
                                                                        placeholder="Maintenance ">
                                                                </div> --}}
                                                                <div class="col-md-4">
                                                                    <div class="box-bdr">
                                                                        <div class="row d-flex">
                                                                            <div class="col-md-7">
                                                                                <input type="text" class="form-control " maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$onerkdata->maintenance_rent ?? ''}}"
                                                                                name="rent_maintenance" id=""
                                                                                placeholder="Maintenance ">
                                                                            </div>
                                                                            <div class="col-md-5 ms-auto" style=" ">
                                                                                <select class="form-select form-control-b0"
                                                                                    name="maintenance_period_rent">
                                                                                    @foreach ($price_details_periods as $period)
                                                                                    <option value="{{$period->id}}"  @if($onerkdata->maintenance_period == $period->id ) selected @endif>
                                                                                        {{$period->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <input type="text" class="form-control  " maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$onerkdata->booking_amount_rent ?? ''}}"
                                                                        name="rent_booking_amount" id=""
                                                                        placeholder="Booking Amount ">
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <input type="text" class="form-control "  maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$onerkdata->annual_dues_rent ?? ''}}"
                                                                        name="rent_annual_dues_payable" id=""
                                                                        placeholder="Annual Dues Payable  ">
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <input type="text" class="form-control"  maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$onerkdata->membership_charge_rent ?? ''}}"
                                                                        name="rent_membership_charge" id="" 
                                                                        placeholder="Membership Charge  ">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- <label class="form-label">Security Deposit <small
                                                                class=""><i>(Optional)</i></small></label>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                @foreach ($security_deposit as $item)
                                                                <div class="col-md-2 simplecheck mb-3">
                                                                    <span><input type="checkbox"
                                                                            name="scurity_deposit_{{$item->id}}"
                                                                            value="{{$item->id}}" @if(in_array($item->id,$security_deposit_values)) checked @endif>{{$item->name}} </span>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div> --}}

                                                        <div class="clearfix mb-3"></div>
                                                        <label class="form-label">Duration of the Agreement </label>
                                                        <div class="col-md-4 mb-3" style="">
                                                            <select class="form-select" name="agreement_durations">
                                                                <!-- @foreach ($agreement_durations as $item)
                                                                    <option value=">{{$item->id}}">{{$item->name}}</option>
                                                                    @endforeach   -->
                                                                @for ($i = 0; $i <= 36; $i++) <option value="{{ $i }}" @if($onerkdata->agreement_duration == $i ) selected @endif>{{ $i
                                                                    }}</option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label">Notice Period</label>
                                                            <div class="radio-toolbar-text">
                                                                @foreach ($notice_months as $item)
                                                                <input type="radio" id="notice_period_{{$item->id}}"
                                                                    name="notice_period" value="{{$item->id}}" @if($onerkdata->notice_period == $item->id ) checked @endif>
                                                                <label
                                                                    for="notice_period_{{$item->id}}">{{$item->name}}</label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="clearfix mb-3"></div>
                                            <label class="form-label">Remarks on Property</label>
                                            <div>
                                                <textarea class="form-control" rows="4"
                                                    name="remarks_on_property">{{$onerkdata->remark}}</textarea>
                                            </div>
                                            <div class="card-footer">
                                                <div class="ms-auto text-end">
                                                    <button type="button" class="btn btn-done btn-warning prevBtn"><i class="fa fa-arrow-left"></i>&nbsp;Previous </button>
                                                    <button class="btn btn-done btn-primary " id="step2">Next&nbsp;<i class="fa fa-arrow-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Section for Pricing & Other Details end -->
                                    </div>
                                </form>


                                <!-- scrren3 -->

                                <form id="SubmitUnitImages" method="POST">
                                    @csrf
                                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                                    <input type="hidden" name="property_cat_id" value="{{ $property->cat_id }}">
                                    <input type="hidden" name="unit_id" value="{{ $unit_data->id }}">
                                    <input type="hidden" name="unit_type_id" value="{{ $unit_data->unit_type_id }}">
                                    <input type="hidden" name="unit_cat_id" value="{{ $unit_data->unit_cat_id }}">
                                    <input type="hidden" name="unit_sub_cat_id" value="{{ $unit_data->unit_sub_cat_id }}">
                                    <div class="screen">
                                        <!-- Section for Pricing & Other Details -->
                                        <div class="card3">
                                            <div class="row mt-3 mb-3">
                                                <div class="col-md-4">
                                                    <p><b>GIS Id : </b> <span class="project-head">
                                                            {{ $property->gis_id }}</span></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><b>Locality Name : </b> <span class="project-head">
                                                            {{ $property->locality_name }}</span></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><b>Address : </b> <span class="project-head">
                                                        {{$property->street_details}}</span></p>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-4">
                                                <h4 class="mb-3">Add Images</h4>
                                                <!-- <label class="form-label  mt-3">Add images <span class="text-danger"> *</span></label>  -->
                                                <div class="row images-block" style="display:block;">
                                                    <div class="col-xxl-2 col-md-3 mb-3 ">
                                                        <div class="form-group">
                                                            <label class="form-label">Gallery Images </label>
                                                            <div class="d-flex justify-content-center flex-column">
                                                                <input type="file" class="unit-images"
                                                                    name="gallery_images[]" id="files" multiple
                                                                    class="form-control file-input" style="display:none;">
                                                                <label for="files"
                                                                    class="form-label btn-anima btn-hover hoverfEffect ">
                                                                    <span> <i class="fa-solid fa-cloud-arrow-up me-1"></i>
                                                                        Add Gallery Images</span></label>
                                                                <div id="gallery_images"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mainDiiv">
                                                        @forelse($galleryImages as $rec)
                                                            <div class="img-container">
                                                                <a data-fancybox="gallery" href="{{asset($rec->file_path.'/'.$rec->file_name)}}">
                                                                    <img src="{{asset($rec->file_path.'/'.$rec->file_name)}}" width="100">
                                                                </a>
                                                            </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                    <div class="row">
                                                        <div id="files-preview"></div>
                                                    </div>
                                                    <ul class="gallery_error_images"> </ul>

                                                    <div class="col-xxl-2 col-md-3 mb-3 ">
                                                        <div class="form-group">
                                                            <label class="form-label">Amenities Images </label>
                                                            <div class="d-flex justify-content-center flex-column">
                                                                <input type="file" class="unit-images"
                                                                    name="amenities_images[]" id="AmenityFiles" multiple
                                                                    class="form-control file-input" style="display:none;">
                                                                <label for="AmenityFiles"
                                                                    class="form-label btn-anima btn-hover hoverfEffect ">
                                                                    <span> <i class="fa-solid fa-cloud-arrow-up me-1"></i>
                                                                        Add Amenities Images</span></label>
                                                                <div id="amenities_images"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mainDiiv">
                                                        @forelse($AmenityImages as $rec)
                                                            <div class="img-container">
                                                                <a data-fancybox="gallery" href="{{asset($rec->file_path.'/'.$rec->file_name)}}">
                                                                    <img src="{{asset($rec->file_path.'/'.$rec->file_name)}}" width="100">
                                                                </a>
                                                            </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                    <div class="row">
                                                        <div id="amenity-files-preview"></div>
                                                    </div>
                                                    <ul class="amenities_error_images"> </ul>
                                                    <div class="col-xxl-2 col-md-3 mb-3 ">
                                                        <div class="form-group">
                                                            <label class="form-label">Interior Images </label>
                                                            <div class="d-flex justify-content-center flex-column">
                                                                <input type="file" class="unit-images"
                                                                    name="interior_images[]" id="InteriorFiles" multiple
                                                                    class="form-control file-input" style="display:none;">
                                                                <label for="InteriorFiles"
                                                                    class="form-label btn-anima btn-hover hoverfEffect ">
                                                                    <span> <i class="fa-solid fa-cloud-arrow-up me-1"></i>
                                                                        Add Interior Images</span></label>
                                                                <div id="interior_images"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mainDiiv">
                                                        @forelse($interiorImages as $rec)
                                                            <div class="img-container">
                                                                <a data-fancybox="gallery" href="{{asset($rec->file_path.'/'.$rec->file_name)}}">
                                                                    <img src="{{asset($rec->file_path.'/'.$rec->file_name)}}" width="100">
                                                                </a>
                                                            </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                    <div class="row">
                                                        <div id="interior-files-preview"></div>
                                                    </div>
                                                    <ul class="interior_error_images"> </ul>

                                                    <div class="col-xxl-2 col-md-3 mb-3 ">
                                                        <div class="form-group">
                                                            <label class="form-label">Floor Plan Images </label>
                                                            <div class="d-flex justify-content-center flex-column">
                                                                <input type="file" class="unit-images"
                                                                    name="floor_plan_images[]" id="FloorPlanFiles"
                                                                    multiple class="form-control file-input"
                                                                    style="display:none;">
                                                                <label for="FloorPlanFiles"
                                                                    class="form-label btn-anima btn-hover hoverfEffect ">
                                                                    <span> <i class="fa-solid fa-cloud-arrow-up me-1"></i>
                                                                        Add Floor Plan Images</span></label>
                                                                <div id="floor_plan_images"></div>
                                                            </div>
                                                        </div>
                                                        <div class="mainDiiv">
                                                            @forelse($floorPlanImages as $rec)
                                                                <div class="img-container">
                                                                    <a data-fancybox="gallery" href="{{asset($rec->file_path.'/'.$rec->file_name)}}">
                                                                        <img src="{{asset($rec->file_path.'/'.$rec->file_name)}}" width="100">
                                                                    </a>
                                                                </div>
                                                            @empty
                                                            @endforelse
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div id="floor-plan-files-preview"></div>
                                                    </div>
                                                    <ul class="floor_plan_error_images"> </ul>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <div class="ms-auto text-end">
                                                <button type="button" class="btn btn-done btn-warning prevBtn"><i
                                                        class="fa fa-arrow-left"></i>&nbsp;Previous </button>
                                                <button type="submit" class="btn btn-done btn-primary" id="step3">Next
                                                    &nbsp;<i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- scrren4 -->


                                <form name="AmenitiesForm" method="POST">
                                    @csrf
                                    <input type="hidden" name="property_id" value="{{$property->id}}">
                                    <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">
                                    <input type="hidden" name="unit_id" value="{{$unit_data->id}}">
                                    <input type="hidden" name="unit_type_id" value="{{$unit_data->unit_type_id}}">
                                    <input type="hidden" name="unit_cat_id" value="{{$unit_data->unit_cat_id}}">
                                    <input type="hidden" name="unit_sub_cat_id" value="{{$unit_data->unit_sub_cat_id}}">
                                    <div class="screen ">
                                        <div class="card1">
                                            <div class="row mt-3 mb-3">
                                                <div class="col-md-4">
                                                    <p><b>GIS Id : </b> <span class="project-head"> {{$property->gis_id}}</span></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><b>Locality Name : </b> <span class="project-head"> {{$property->locality_name}}</span></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><b>Address : </b> <span class="project-head">{{$property->street_details}}</span></p>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="mt-4 mb-4">
                                                    <h4 class="mb-3">Amenities Details <small><i>(Optional)</i></small></h4>
                              
                                                    <label class="form-label">Amenities</label>
                                                    <div class="row align-items-center mb-2">
                                                        @forelse($amenities as $amenity)
                                                        <div class="col-md-2 simplecheck mb-3">
                                                            <span>
                                                                <input type="checkbox" name="amenity[]" value="{{$amenity->id}}" @if(in_array($amenity->id,$amenities_values)) checked @endif> {{$amenity->name}}
                                                            </span>
                                                        </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                              
                                                    <label class="form-label">Society/Building features</label>
                                                    <div class="row align-items-center mb-2">
                                                        @forelse($Society_features as $loc_advantage)
                                                        <div class="col-md-3 simplecheck mb-3">
                                                            <span>
                                                                <input type="checkbox" name="society_features[]" value="{{$loc_advantage->id}}"  @if(in_array($loc_advantage->id,$Society_features_values)) checked @endif> {{$loc_advantage->name}}
                                                            </span>
                                                        </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                              
                                                    <label class="form-label">Additional features</label>
                                                    <div class="row align-items-center mb-2">
                                                        @forelse($additional_features as $loc_advantage)
                                                        <div class="col-md-3 simplecheck mb-3">
                                                            <span>
                                                                <input type="checkbox" name="additional_features[]" value="{{$loc_advantage->id}}" @if(in_array($loc_advantage->id,$additional_values)) checked @endif> {{$loc_advantage->name}}
                                                            </span>
                                                        </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                              
                                                    <label class="form-label">Other features</label>
                                                    <div class="row align-items-center mb-2">
                                                        @forelse($other_features as $loc_advantage)
                                                        <div class="col-md-3 simplecheck mb-3">
                                                            <span>
                                                                <input type="checkbox" name="other_features[]" value="{{$loc_advantage->id}}" @if(in_array($loc_advantage->id,$other_values)) checked @endif> {{$loc_advantage->name}}
                                                            </span>
                                                        </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                              
                                                    <label class="form-label">Water Source</label>
                                                    <div class="row align-items-center mb-2">
                                                        @forelse($water_source as $loc_advantage)
                                                        <div class="col-md-3 simplecheck mb-3">
                                                            <span>
                                                                <input type="checkbox" name="water_source[]" value="{{$loc_advantage->id}}" @if(in_array($loc_advantage->id,$water_values)) checked @endif> {{$loc_advantage->name}}
                                                            </span>
                                                        </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                              
                                                    <label class="form-label">Overlooking</label>
                                                    <div class="row align-items-center mb-2">
                                                        @forelse($overlooking as $loc_advantage)
                                                        <div class="col-md-3 simplecheck mb-3">
                                                            <span>
                                                                <input type="checkbox" name="overlooking[]" value="{{$loc_advantage->id}}" @if(in_array($loc_advantage->id,$overlooking_values)) checked @endif> {{$loc_advantage->name}}
                                                            </span>
                                                        </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                              
                                                    <label class="form-label">Power Back up</label>
                                                    <div class="row align-items-center mb-2">
                                                        @forelse($power_backup as $loc_advantage)
                                                        <div class="col-md-3 simplecheck mb-3">
                                                            <span>
                                                                <input type="checkbox" name="power_backup[]" value="{{$loc_advantage->id}}" @if(in_array($loc_advantage->id,$powerbackup_values)) checked @endif> {{$loc_advantage->name}}
                                                            </span>
                                                        </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                              
                              
                                                    <label class="form-label">Type Of Flooring</label>
                                                    <div class="row align-items-center mb-2">
                                                        <div class="col-md-4 simplecheck mb-3">
                                                            <div class="form-group">
                                                                <select class="form-select" name="floor_type">
                                                                    @forelse($flooring_type as $unit)
                                                                    <option value="{{$unit->id}}" @if($onerkdata->floor_type == $unit->id)  selected @endif>{{$unit->name}}</option>
                                                                    @empty
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                              
                                                    <label class="form-label">Width of Facing road</label>
                                                    <div class="col-md-4">
                                                        <div class="box-bdr">
                                                            <div class="d-flex">
                                                                <div>
                                                                    <input type="text" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control form-control-b0 col-md-3 border-none"  value="{{$onerkdata->facing_road_width ?? ''}}" name="facing_road_width" placeholder="">
                                                                </div>
                                                                <div class="ms-auto" style="">
                                                                    <select class="form-select form-control-b0" name="facing_road_width_unit">
                                                                        @forelse($units as $unit)
                                                                        <option value="{{$unit->id}}" @if($onerkdata->facing_road_width_unit == $unit->id)  selected @endif>{{$unit->name}}</option>
                                                                        @empty
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                              
                              
                                                    <label class="form-label">Location Advantages</label>
                                                    <div class="row align-items-center mb-2">
                                                        @forelse($location_advantages as $loc_advantage)
                                                        <div class="col-md-3 simplecheck mb-3">
                                                            <span>
                                                                <input type="checkbox" name="location_advantage[]" value="{{$loc_advantage->id}}" @if(in_array($loc_advantage->id,$location_advantages_values)) checked @endif> {{$loc_advantage->name}}
                                                            </span>
                                                        </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                              
                              
                              
                              
                                                </div>
                                            </div>
                              
                                            <div class="card-footer">
                                                <div class="ms-auto text-end">
                                                    <button type="button" class="btn btn-done btn-warning prevBtn"><i class="fa fa-arrow-left"></i>&nbsp;Previous </button>
                                                    <button type="submit" class="btn btn-done btn-primary">Submit </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                               

                            </div>
                        </div>
                    </div> <!-- container-fluid -->
                </div>
            </div>
            <!-- End Page-content -->

        </div>




    </div> <!-- container-fluid -->
    </div>
    <!--End Page-content -->
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function ShowBlocks(val) {
            if (val == 23) {
                $('.age-of-property-block').show()
                $('.possession-block').hide();
            } else {
                $('.age-of-property-block').hide();
                $('.possession-block').show();
            }
        }
        // jquery dependencies 
        $(document).ready(function() {

            var val = $("input[name='pricing_details_for']:checked").val()
            if (val == 1) {
                $('.for-sale').show();
                $('.for-rent').hide();
            } else if (val == 2) {
                $('.for-sale').hide();
                $('.for-rent').show();
            }


         // ------------------------------------  next and previous scripts  ---------------------------------- //

            const $screens = $(".screen");
            let currentScreen = 0;
           
            const $screens1 = $(".progress-bar");
            let progressbar = 0;

            function showScreen(screenIndex) {
                $screens.removeClass("visible highlight");
                $screens.eq(screenIndex).addClass("visible");

                if (screenIndex > 0) {
                    $screens.eq(screenIndex - 1).addClass("highlight");
                }
            }

            function showAtive(screenIndex) {

                $screens1.removeClass("active");
                $screens1.eq(screenIndex).addClass("active");

                if (screenIndex > 0) {
                    $screens1.eq(screenIndex - 1).addClass("active");

                }
                if (screenIndex === 2)
                    $screens1.eq(screenIndex).addClass("active");
            }

            // Initially show the first screen
            showScreen(currentScreen);

            // Next button click event handler
            $(".nextBtn").on("click", function() {
                if (currentScreen < $screens.length - 1) {
                    currentScreen++;
                    showScreen(currentScreen);
                    progressbar++;
                    showAtive(progressbar);
                }
            });

            // Previous button click event handler
            $(".prevBtn").on("click", function() {
                if (currentScreen > 0) {
                    currentScreen--;
                    showScreen(currentScreen);
                    progressbar--;
                    showAtive(progressbar);
                }
            });

           

            $('.add-balconies').click(function() {
                $('.other-balcony-block').toggle();
                $('.add-extra-balcony').toggle();
                $('#extra-balcony-input').val("");
                $('#extra-balcony-label').html('');
                $(".extra-balcony-block").hide();
                $('input[type=radio][name=balconies]').prop('checked', false);
            });
            $('.add-extra-balcony').click(function() {
                var addinVal = $('#other-balconies').val();
                if (addinVal != "" && addinVal > 4) {
                    $('.extra-balcony-block').show();
                    $('#extra-balcony-input').val(addinVal);
                    $('#extra-balcony-label').html(addinVal);
                    $('input[type=radio][id=extra-balcony-input]').prop('checked', true);
                    $('.other-balcony-block').hide();
                    $('.add-extra-balcony').hide();
                } else {
                    $('input[type="radio"][name=balconies][value="' + addinVal + '"]').prop('checked',
                        true);
                    $('.other-balcony-block').hide();
                    $('.add-extra-balcony').hide();
                }

            });
            $('.add-washrooms').click(function() {
                $('.other-washrooms-block').toggle();
                $('.add-extra-washrooms').toggle();
                $('#extra-washrooms-input').val("");
                $('#extra-washrooms-label').html('');
                $(".extra-washrooms-block").hide();
                $('input[type=radio][name=washrooms]').prop('checked', false);
            });
            $('.add-extra-washrooms').click(function() {
                var addinVal = $('#other-washrooms').val();
                if (addinVal != "" && addinVal > 4) {
                    $('.extra-washrooms-block').show();
                    $('#extra-washrooms-input').val(addinVal);
                    $('#extra-washrooms-label').html(addinVal);
                    $('input[type=radio][id=extra-washrooms-input]').prop('checked', true);
                    $('.other-washrooms-block').hide();
                    $('.add-extra-washrooms').hide();
                } else {
                    $('input[type="radio"][name=washrooms][value="' + addinVal + '"]').prop('checked',
                        true);
                    $('.other-washrooms-block').hide();
                    $('.add-extra-washrooms').hide();
                }

            });
            $('.add-bedrooms').click(function() {
                $('.other-bedrooms-block').toggle();
                $('.add-extra-bedrooms').toggle();
                $('#extra-bedrooms-input').val("");
                $('#extra-bedrooms-label').html('');
                $(".extra-bedrooms-block").hide();
                $('input[type=radio][name=bedrooms]').prop('checked', false);
            });
            $('.add-extra-bedrooms').click(function() {
                var addinVal = $('#other-bedrooms').val();
                if (addinVal != "" && addinVal > 4) {
                    $('.extra-bedrooms-block').show();
                    $('#extra-bedrooms-input').val(addinVal);
                    $('#extra-bedrooms-label').html(addinVal);
                    $('input[type=radio][id=extra-bedrooms-input]').prop('checked', true);
                    $('.other-bedrooms-block').hide();
                    $('.add-extra-bedrooms').hide();
                } else {
                    $('input[type="radio"][name=bedrooms][value="' + addinVal + '"]').prop('checked', true);
                    $('.other-bedrooms-block').hide();
                    $('.add-extra-bedrooms').hide();
                }

            });

            $('.add-super-built-area').click(function() {
                $('.super-built-area-block').show();
                $('.add-super-built-area').hide();

            });
            $('.add-built-area').click(function() {
                $('.built-area-block').show();
                $('.add-built-area').hide();

            });

            // furnished options 
            $('.toggleItem').click(function() {
                Id = $(this).data("fid");
                $('#item' + Id).toggle();
                $('.MobilelistFurninshed').each(function() {
                    if ($(this).attr('id') != 'item' + Id)
                        $(this).hide();
                })
            });

            //   for increase and decrease 
            $(document).on('click', '.plus', function() {
                const inputStep = $(this).closest('.input-step');
                const quantityInput = inputStep.find('.product-quantity');
                const currentVal = parseInt(quantityInput.val());
                const maxVal = parseInt(quantityInput.attr('max'));

                if (!isNaN(currentVal) && (isNaN(maxVal) || currentVal < maxVal)) {
                    quantityInput.val(currentVal + 1);
                }
            });
            $(document).on('click', '.minus', function() {
                const inputStep = $(this).closest('.input-step');
                const quantityInput = inputStep.find('.product-quantity');
                const currentVal = parseInt(quantityInput.val());
                const minVal = parseInt(quantityInput.attr('min'));

                if (!isNaN(currentVal) && (isNaN(minVal) || currentVal > minVal)) {
                    quantityInput.val(currentVal - 1);
                }
            });


            

            // ---------------------- form submissions ------------------------------ //

            // firt tab submission

            $('form[id=SubmitPropertyDetails]').submit(function(e) {
                $('.progress-bar').removeClass('active');

                // $(".nextBtn").on("click", function() {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: "{{ route('surveyor.property.unit_details.resedential.one_rk.store_property_details') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success response
                        
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        $('.btn-primary').addClass('nextBtn');

                        if (currentScreen < $screens.length - 1) {
                            currentScreen++;
                            showScreen(currentScreen);
                            progressbar++;
                            showAtive(progressbar);
                        }
                        
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('html, body').scrollTop(0);
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON
                                    .errors)) {
                                if (key == 'bedrooms' || key == 'washrooms' || key ==
                                    'balconies' || key == 'possession_date' || key ==
                                    'carpet_area') {
                                    $('form[id=SubmitPropertyDetails] input[name=' + key + ']')
                                        .addClass('is-invalid');
                                    $('#err_' + key).after(
                                        '<span class="input-error" style="color:red">' +
                                        value + '</span>');
                                } else if (key == 'furnished_option' || key ==
                                    'availability_status' || key == 'age_of_property' || key ==
                                    'property_facing') {
                                    $('form[id=SubmitPropertyDetails] input[name=' + key + ']')
                                        .addClass('is-invalid');
                                    $('#err_' + key).after(
                                        '<span class="input-error" style="color:red">' +
                                        value + '</span>');
                                }
                            }
                            $('.btn-primary').removeClass('nextBtn');

                        } else {
                            alert('something went wrong! please try again..');
                        }
                    },

                });
            })


              // second form submit

            $("input[name='pricing_details_for']").click(function() {
                var val = $("input[name='pricing_details_for']:checked").val()
                if (val == 1) {
                    $('.for-sale').show();
                    $('.for-rent').hide();
                } else if (val == 2) {
                    $('.for-sale').hide();
                    $('.for-rent').show();
                }
            })
      

            $('form[id=PricingDetailsForm]').submit(function(e) {
                e.preventDefault();
             //   alert(currentScreen);
                var formData = new FormData($(this)[0]);
                // console.log(formData, "formData")
                $.ajax({
                    url: "{{ route('surveyor.property.unit_details.resedential.one_rk.store_pricing_details') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        $('.btn-primary').addClass('nextBtn');
                        if (currentScreen < $screens.length - 1) {
                            currentScreen++;
                            showScreen(currentScreen);
                            progressbar++;
                            showAtive(progressbar);
                        }
                    },
                    error: function(jqXHR, status, error) {
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON.errors)) {
                                $('form[id=PricingDetailsForm] input[name=' + key + ']').addClass(
                                    'is-invalid');
                                $('#err_' + key).after('<span class="input-error" style="color:red">' +
                                    value + '</span>');
                            }
                            $('.btn-primary').removeClass('nextBtn');

                        } else {
                            alert('something went wrong! please try again..');
                        }
                    }
                });
            })

            //  scripts for third form 

            $('form[id=SubmitUnitImages]').submit(function(e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                console.log(formData, "formData")
                $.ajax({
                    url: "{{ route('surveyor.property.unit_details.resedential.one_rk.edit_unit_images') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success response
                        // console.log(response);
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        $('.btn-primary').addClass('nextBtn');
                        if (currentScreen < $screens.length - 1) {
                            currentScreen++;
                            showScreen(currentScreen);
                            progressbar++;
                            showAtive(progressbar);
                        }
                    },
                    error: function(jqXHR, status, error) {
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON.errors)) {
                                if(key.startsWith('gallery_images')){
                                    $('.gallery_error_images').append('<li class="input-error"><span  style="color:red">' + value + '</span></li>');
                                }
                                if(key.startsWith('amenities_images')){
                                    $('.amenities_error_images').append('<li class="input-error"><span  style="color:red">' + value + '</span></li>');
                                }
                                if(key.startsWith('floor_plan_images')){
                                    $('.floor_plan_error_images').append('<li class="input-error"><span  style="color:red">' + value + '</span></li>');
                                }
                                if(key.startsWith('interior_images')){
                                    $('.interior_error_images').append('<li class="input-error"><span  style="color:red">' + value + '</span></li>');
                                }
                            }
                            $('.btn-primary').removeClass('nextBtn');

                        } else {
                            alert('something went wrong! please try again..');
                        }
                    }
                });
            })

             //Fourth Tab Submission

            $('form[name=AmenitiesForm]').submit(function(e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                console.log(formData, "formData")
                $.ajax({
                    url: "{{route('surveyor.property.unit_details.resedential.one_rk.store_amenities')}}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success('Record Added Successfully');
                        var property_id = response.data;
                        var url = "{{ route('surveyor.property.report_details', ['id' => ':id']) }}";
                        url = url.replace(':id', property_id);
                        setTimeout(function() {
                            window.location.href = url;
                        }, 3000);
                        
                    },

                });
            })


        });


      
    </script>
    {{-- scripts for images preview --}}
    <script>
        
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {

                var files = e.target.files,
                    filesLength = files.length;
                console.log(filesLength, "files");
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#files-preview").append("<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "" +
                            "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                            "</span>");
                        $(".remove").click(function() {
                            var imageArea = $(this).parent(".image-area");
                            var imageIndex = imageArea.index();
                            // alert(imageIndex);
                            imageArea.remove();
                            files = Array.from(files).filter((_, i) => i !== imageIndex);
                            // console.log(files)
                            var dataTransfer = new DataTransfer();
                            for (var i = 0; i < files.length; i++) {
                                if (i !== imageIndex) {
                                    dataTransfer.items.add(files[i]);
                                }
                            }
                            $('#files')[0].files = dataTransfer.files;
                        });
                        // $("#files-preview").css('visibility', 'visible');
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
        if (window.File && window.FileList && window.FileReader) {
            $("#AmenityFiles").on("change", function(e) {

                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#amenity-files-preview").append(
                            "<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "" +
                            "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                            "</span>");
                        $(".remove").click(function() {
                            var imageArea = $(this).parent(".image-area");
                            var imageIndex = imageArea.index();
                            // alert(imageIndex);
                            imageArea.remove();
                            files = Array.from(files).filter((_, i) => i !== imageIndex);
                            // console.log(files)
                            var dataTransfer = new DataTransfer();
                            for (var i = 0; i < files.length; i++) {
                                if (i !== imageIndex) {
                                    dataTransfer.items.add(files[i]);
                                }
                            }
                            $('#AmenityFiles')[0].files = dataTransfer.files;
                        });
                        // $("#files-preview").css('visibility', 'visible');
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
        if (window.File && window.FileList && window.FileReader) {
            $("#InteriorFiles").on("change", function(e) {

                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#interior-files-preview").append(
                            "<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "" +
                            "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                            "</span>");
                        $(".remove").click(function() {
                            var imageArea = $(this).parent(".image-area");
                            var imageIndex = imageArea.index();
                            // alert(imageIndex);
                            imageArea.remove();
                            files = Array.from(files).filter((_, i) => i !== imageIndex);
                            // console.log(files)
                            var dataTransfer = new DataTransfer();
                            for (var i = 0; i < files.length; i++) {
                                if (i !== imageIndex) {
                                    dataTransfer.items.add(files[i]);
                                }
                            }
                            $('#InteriorFiles')[0].files = dataTransfer.files;
                        });
                        // $("#files-preview").css('visibility', 'visible');
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
        if (window.File && window.FileList && window.FileReader) {
            $("#FloorPlanFiles").on("change", function(e) {

                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#floor-plan-files-preview").append(
                            "<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "" +
                            "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                            "</span>");
                        $(".remove").click(function() {
                            var imageArea = $(this).parent(".image-area");
                            var imageIndex = imageArea.index();
                            // alert(imageIndex);
                            imageArea.remove();
                            files = Array.from(files).filter((_, i) => i !== imageIndex);
                            // console.log(files)
                            var dataTransfer = new DataTransfer();
                            for (var i = 0; i < files.length; i++) {
                                if (i !== imageIndex) {
                                    dataTransfer.items.add(files[i]);
                                }
                            }
                            $('#FloorPlanFiles')[0].files = dataTransfer.files;
                        });
                        // $("#files-preview").css('visibility', 'visible');
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    </script>
    {{-- <script src="{{ url('public/assets/js/property//hospitality_extra.js') }}"></script> --}}
@endpush
