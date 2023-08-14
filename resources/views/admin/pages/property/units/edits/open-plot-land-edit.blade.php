@extends('admin.layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<link href="{{ url('public/assets/css////unit-details.css') }}" rel="stylesheet" type="text/css" />
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
                            {{-- <a href="javascript:void(0);" class="progress-bar text-dark" role="progressbar"
                                style="width: 100%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> Amenities
                                Details(Optional)</a> --}}
                        </div>
                        <!-- step -1 -->
                        <div class="mt-4 mb-4">
                            <div id="screens">
                                <form id="SubmitPropertyDetails" method="POST">
                                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                                    <input type="hidden" name="property_cat_id" value="{{ $property->cat_id }}">

                                    <div class="screen visible">
                                        <div class="card-body">
                                            <div class="col-md-12">
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
                                                                {{ $property->street_details }}</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="mb-3">Property Details</h4>

                                            <label class="form-label required m-0">Add Area Details </label>
                                            <div class="row align-items-center mt-3 mb-3">
                                                <div class="col-md-4">
                                                    <div class="box-bdr">
                                                        <div class="d-flex">
                                                            <div>
                                                                <input type="text" maxlength="11"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control form-control-b0 col-md-3 border-none" value="{{$secondary_level_unit_data->plot_area ?? ''}}" name="plot_area" id="" placeholder="Plot Area "/>
                                                                
                                                            </div>
                                                            <div class="ms-auto" style="">
                                                                <select class="form-select form-control-b0" name="plot_area_units">
                                                                    @forelse($units as $unit)
                                                                    <option value="{{$unit->id}}"  @if($unit->id == $secondary_level_unit_data->plot_area_units) checked @endif>{{$unit->name}}</option>
                                                                    @empty
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <span id="err_plot_area"></span>
                                            </div>


                                            <label class="form-label m-0">Property Dimensions </label><br>

                                            <div class="row">
                                                <div class="col-md-3 d-flex align-items-center mt-1">
                                                    <input class="form-control " type="text" name="plot_length" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$secondary_level_unit_data->plot_length ?? ''}}"  placeholder="Length of Plot (in Ft.)">
                                                </div>

                                                <div class="col-md-3 d-flex align-items-center mt-1">
                                                    <input class="form-control " type="text" name="plot_breadth" maxlength="11"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$secondary_level_unit_data->plot_breadth ?? ''}}" placeholder=" Breadth of Plot (in Ft.)">
                                                </div>

                                            </div>

                                            <div class="clearfix mb-3"></div>

                                            <label class="form-label">Floors Allowed for Construction</label>
                                            <div class="col-md-4">
                                                <input class="form-control" name="floors_allowed" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$secondary_level_unit_data->floors_allowed ?? ''}}" type="text" placeholder="No. of Floors">
                                            </div>


                                            <div class="clearfix mb-3"></div>
                                            <label class="form-label  ">No of open side</label>

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-12 mb-3">
                                                    <div class="radio-toolbar">
                                                        <input type="radio" id="openside1" name="no_of_open_side" value="1"  @if( $secondary_level_unit_data->no_of_open_side == 1) checked @endif>
                                                        <label for="openside1">1</label>
                                                        <input type="radio" id="openside2" name="no_of_open_side"  value="2" @if( $secondary_level_unit_data->no_of_open_side == 2) checked @endif>
                                                        <label for="openside2">2</label>
                                                        <input type="radio" id="openside3" name="no_of_open_side"  value="3" @if( $secondary_level_unit_data->no_of_open_side == 3) checked @endif>
                                                        <label for="openside3">3</label>
                                                        <input type="radio" id="openside4" name="no_of_open_side" value="4"  @if( $secondary_level_unit_data->no_of_open_side == 4) checked @endif>
                                                        <label for="openside4">4</label>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="ms-auto text-end">
                                                <!-- <button class="btn btn-done btn-primary nextBtn">Next &nbsp;<i class="fa fa-arrow-right"></i></button> -->
                                                <button type="submit" class="btn btn-done btn-primary">Next &nbsp;<i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- scrren2 -->

                                {{-- <form id="PricingDetailsForm" method="POST">
                                    <div class="screen ">
                                        <input type="hidden" name="property_id" value="{{$property->id}}">
                                        <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">
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
                                                        <input type="radio" id="for-sale" value="1"
                                                            name="pricing_details_for">
                                                        <label for="for-sale">For Sale</label>
                                                        <input type="radio" id="for-rent" value="2"
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
                                                                    name="ownership" value="{{$ownership->id}}">
                                                                <label
                                                                    for="ownership{{$ownership->id}}">{{$ownership->name}}</label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span id="err_ownership"></span>
                                                </div>


                                                <div class="clearfix"></div>

                                                <div class="price-details-block">
                                                    <label class="form-label required">Price Details</label>
                                                    <div class="row align-items-center mb-3">
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control required-sale" id=""
                                                                name="expected_price" placeholder="Expected Price">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control required-sale" id=""
                                                                name="price_per_sq_ft" placeholder="Price per Sq feet">
                                                        </div>
                                                        <span id="err_expected_price"></span>
                                                        <span id="err_price_per_sq_ft"></span>

                                                        <div class="clearfix mt-3"></div>

                                                        @foreach ($price_details as $details)
                                                        <div class="col-md-2 simplecheck mb-3">
                                                            <span><input type="checkbox"
                                                                    name="price_details_{{$details->id}}"
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
                                                                        <input type="text"
                                                                            class="form-control form-control-b0 border-none"
                                                                            name="pricing_maintenance_price" id=""
                                                                            placeholder="Maintenance">
                                                                    </div>
                                                                    <div class="col-md-5 ms-auto" style=" ">
                                                                        <select class="form-select form-control-b0"
                                                                            name="maintenance_period">
                                                                            @foreach ($price_details_periods as $period)
                                                                            <option value="{{$period->id}}">
                                                                                {{$period->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mb-2">
                                                            <input type="text" class="form-control border-none"
                                                                name="pricing_expected_rental" id=""
                                                                placeholder="Expected Rental">
                                                        </div>

                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control border-none"
                                                                        name="pricing_booking_amount" id=""
                                                                        placeholder="Booking Amount">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control border-none"
                                                                        name="pricing_annual_dues_payable" id=""
                                                                        placeholder="Annual dues payble">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control border-none"
                                                                        name="pricing_membership_charge" id=""
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
                                                                    name="agreement_type" value="{{$type->id}}">
                                                                <label
                                                                    for="agreement_type{{$type->id}}">{{$type->name}}</label>
                                                                @endforeach
                                                            </div>
                                                            <span id="err_agreement_type"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="rent-details-block">
                                                    <label class="form-label required">Rent Details </label>
                                                    <div class="row align-items-center mb-3">
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control required-rent" id=""
                                                                name="expected_rent" placeholder="Expected Rent">
                                                        </div>
                                                        <span id="err_expected_rent"></span>
                                                 

                                                        <div class="clearfix mt-3"></div>

                                                        @foreach ($rent_details as $item)
                                                        <div class="col-md-2 simplecheck mb-3">
                                                            <span><input type="checkbox" name="rent_details_{{$item->id}}"
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
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control  "
                                                                        name="rent_maintenance" id=""
                                                                        placeholder="Maintenance ">
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <input type="text" class="form-control  "
                                                                        name="rent_booking_amount" id=""
                                                                        placeholder="Booking Amount ">
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <input type="text" class="form-control "
                                                                        name="rent_annual_dues_payable" id=""
                                                                        placeholder="Annual Dues Payable  ">
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <input type="text" class="form-control "
                                                                        name="rent_membership_charge" id=""
                                                                        placeholder="Membership Charge  ">
                                                                </div>
                                                            </div>
                                                        </div>

                                                       

                                                        <div class="clearfix mb-3"></div>
                                                        <label class="form-label">Duration of the Agreement </label>
                                                        <div class="col-md-4 mb-3" style="">
                                                            <select class="form-select" name="agreement_durations">
                                                                <!-- @foreach ($agreement_durations as $item)
                                                                    <option value=">{{$item->id}}">{{$item->name}}</option>
                                                                    @endforeach   -->
                                                                @for ($i = 0; $i <= 36; $i++) <option value="{{ $i }}">{{ $i
                                                                    }}</option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label">Notice Period </label>
                                                            <div class="radio-toolbar-text">
                                                                @foreach ($notice_months as $item)
                                                                <input type="radio" id="notice_period_{{$item->id}}"
                                                                    name="notice_period" value="{{$item->id}}">
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
                                                    name="remarks_on_property"></textarea>
                                            </div>








                                            <div class="card-footer">
                                                <div class="ms-auto text-end">
                                                    <button type="button" class="btn btn-done btn-warning prevBtn"><i class="fa fa-arrow-left"></i>&nbsp;Previous </button>
                                                    <button type="submit" class="btn btn-done btn-primary" id="step2">Next &nbsp;<i class="fa fa-arrow-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Section for Pricing & Other Details end -->
                                    </div>
                                </form> --}}

                                <form id="PricingDetailsForm" method="POST">
                                    <div class="screen ">
                                        <input type="hidden" name="property_id" value="{{$property->id}}">
                                        <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">
                                       

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
                                                        <input type="radio" id="for-sale" value="1" @if($secondary_level_unit_data->pricing_details_for == 1) checked @endif
                                                            name="pricing_details_for" >
                                                        <label for="for-sale">For Sale</label>
                                                        <input type="radio" id="for-rent" value="2" @if($secondary_level_unit_data->pricing_details_for == 2) checked @endif
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
                                                                    name="ownership" value="{{$ownership->id}}" @if($secondary_level_unit_data->ownership == $ownership->id) checked @endif> 
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
                                                            <input type="text" class="form-control required-sale" maxlength="11"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="" value="{{$secondary_level_unit_data->expected_price ?? ''}}"
                                                                name="expected_price" placeholder="Expected Price">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control required-sale" id="" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$secondary_level_unit_data->price_per_sq_ft ?? ''}}"
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
                                                                            name="pricing_maintenance_price" id="" value="{{$secondary_level_unit_data->mainteinance ?? ''}}"
                                                                            placeholder="Maintenance">
                                                                    </div>
                                                                    <div class="col-md-5 ms-auto" style=" ">
                                                                        <select class="form-select form-control-b0"
                                                                            name="maintenance_period">
                                                                            @foreach ($price_details_periods as $period)
                                                                            <option value="{{$period->id}}" @if($secondary_level_unit_data->maintenance_period == $period->id) selected @endif>
                                                                                {{$period->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mb-2">
                                                            <input type="text" class="form-control border-none" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                name="pricing_expected_rental" id="" value="{{$secondary_level_unit_data->expected_rental ?? ''}}"
                                                                placeholder="Expected Rental">
                                                        </div>

                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control border-none" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        name="pricing_booking_amount" id="" value="{{$secondary_level_unit_data->booking_amount ?? ''}}"
                                                                        placeholder="Booking Amount">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control border-none" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        name="pricing_annual_dues_payable" id="" value="{{$secondary_level_unit_data->annual_due_pay ?? ''}}"
                                                                        placeholder="Annual dues payble">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control border-none" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        name="pricing_membership_charge" id="" value="{{$secondary_level_unit_data->membership_charge ?? ''}}"
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
                                                                    name="agreement_type" value="{{$type->id}}" @if($secondary_level_unit_data->agreement_type == $type->id) checked @endif>
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
                                                            <input type="text" maxlength="11" class="form-control required-rent" id="" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                name="expected_rent" value="{{$secondary_level_unit_data->expected_rent ?? ''}}" placeholder="Expected Rent">
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
                                                                <div class="col-md-4">
                                                                    <div class="box-bdr">
                                                                        <div class="row d-flex">
                                                                            <div class="col-md-7">
                                                                                <input type="text" class="form-control " maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$secondary_level_unit_data->maintenance_rent ?? ''}}"
                                                                                name="rent_maintenance" id=""
                                                                                placeholder="Maintenance ">
                                                                            </div>
                                                                            <div class="col-md-5 ms-auto" style=" ">
                                                                                <select class="form-select form-control-b0"
                                                                                    name="maintenance_period_rent">
                                                                                    @foreach ($price_details_periods as $period)
                                                                                    <option value="{{$period->id}}"  @if($secondary_level_unit_data->maintenance_period == $period->id ) selected @endif>
                                                                                        {{$period->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <input type="text" class="form-control  " maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$secondary_level_unit_data->booking_amount_rent ?? ''}}"
                                                                        name="rent_booking_amount" id=""
                                                                        placeholder="Booking Amount ">
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <input type="text" class="form-control "  maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$secondary_level_unit_data->annual_dues_rent ?? ''}}"
                                                                        name="rent_annual_dues_payable" id=""
                                                                        placeholder="Annual Dues Payable  ">
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <input type="text" class="form-control" maxlength="11"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$secondary_level_unit_data->membership_charge_rent ?? ''}}"
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
                                                                @for ($i = 0; $i <= 36; $i++) <option value="{{ $i }}" @if($secondary_level_unit_data->agreement_duration == $i ) selected @endif>{{ $i
                                                                    }}</option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label">Notice Period</label>
                                                            <div class="radio-toolbar-text">
                                                                @foreach ($notice_months as $item)
                                                                <input type="radio" id="notice_period_{{$item->id}}"
                                                                    name="notice_period" value="{{$item->id}}" @if($secondary_level_unit_data->notice_period == $item->id ) checked @endif>
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
                                                    name="remarks_on_property">{{$secondary_level_unit_data->remark}}</textarea>
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
                                    <input type="hidden" name="property_id" value="{{$property->id}}">
                                    <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">
                                    <div class="screen">
                                        <!-- Section for Pricing & Other Details -->
                                        <div class="card3">
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
                                            <div class="mt-4 mb-4">
                                                <h4 class="mb-3">Add Images</h4>
                                                <!-- <label class="form-label  mt-3">Add images <span class="text-danger"> *</span></label>  -->
                                                <div class="row images-block" style="display:block;">
                                                    <div class="col-xxl-2 col-md-3 mb-3 ">
                                                        <div class="form-group">
                                                            <label class="form-label">Gallery Images </label>
                                                            <div class="d-flex justify-content-center flex-column">
                                                                <input type="file" class="unit-images"
                                                                    name="gallery_images[]" id="files" multiple accept="image/jpeg, image/jpg, image/gif"
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
                                                </div>
                                                <ul class="error_images"> </ul>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <div class="ms-auto text-end">
                                                <button type="button" class="btn btn-done btn-warning prevBtn"><i
                                                        class="fa fa-arrow-left"></i>&nbsp;Previous </button>
                                                        <button type="submit" class="btn btn-done btn-primary" id="step3">Next &nbsp;<i class="fa fa-arrow-right"></i></button>
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
        $(document).ready(function() {

            var val = $("input[name='pricing_details_for']:checked").val()
            if (val == 1) {
                $('.for-sale').show();
                $('.for-rent').hide();
            } else if (val == 2) {
                $('.for-sale').hide();
                $('.for-rent').show();
            }




            // $(document).ready(function() {
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
            // });


            //First Tab Submission
            $('form[id=SubmitPropertyDetails]').submit(function(e) {
                $('.progress-bar').removeClass('active');

                // $(".nextBtn").on("click", function() {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: "{{ route('surveyor.property.unit_details.plotland.openPlotLand.store_property_details') }}",
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
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON.errors)) {
                                    $('form[id=SubmitPropertyDetails] input[name=' + key + ']').addClass('is-invalid');
                                    $('#err_' + key).after('<span class="input-error" style="color:red">' + value + '</span>');
                            }
                             $('.btn-primary').removeClass('nextBtn');

                        } else {
                            // alert('something went wrong! please try again..');
                        }
                    },

                });
            })
            
            // scripts for form 2 
            $("input[name='pricing_details_for']").click(function() {
                var val =  $("input[name='pricing_details_for']:checked").val()
                if(val == 1){
                    $('.for-sale').show();
                    $('.for-rent').hide();
                }else if(val == 2){
                    $('.for-sale').hide();
                    $('.for-rent').show();
                }
            })


            $('form[id=PricingDetailsForm]').submit(function(e) {
              
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                console.log(formData, "formData")
                $.ajax({
                    url: "{{route('surveyor.property.unit_details.plotland.openPlotLand.store_pricing_details')}}",
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
                                $('form[id=PricingDetailsForm] input[name=' + key + ']').addClass('is-invalid');
                                $('#err_' + key).after('<span class="input-error" style="color:red">' + value + '</span>');
                            }
                            $('.btn-primary').removeClass('nextBtn');

                        } else {
                            // alert('something went wrong! please try again..');
                        }
                    }
                });
            })

          
             //Third Tab Submission
            $('form[id=SubmitUnitImages]').submit(function(e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                // console.log(formData, "formData")
                $.ajax({
                    url: "{{route('surveyor.property.unit_details.plotland.openPlotLand.update_images')}}",
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
                        toastr.success('Record Added Successfully');
                        var property_id = response.data;
                        var url = "{{ route('surveyor.property.report_details', ['id' => ':id']) }}";
                        url = url.replace(':id', property_id);
                        setTimeout(function() {
                            window.location.href = url;
                        }, 3000);
                    },
                    error: function(jqXHR, status, error) {
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON.errors)) {
                                $('.error_images').html('<li class="input-error"><span  style="color:red">' + value + '</span></li>');
                            }
                            $('.btn-primary').removeClass('nextBtn');

                        } else {
                            alert('something went wrong! please try again..');
                        }
                    }
                });
            })
           

        });
    </script>
    {{-- scripts for image preview --}}

    <script>
        $(document).ready(function() {
            // if (window.File && window.FileList && window.FileReader) {
            //     $("#files").on("change", function(e) {
    
            //         var files = e.target.files,
            //             filesLength = files.length;
            //         console.log(filesLength, "files");
            //         for (var i = 0; i < filesLength; i++) {
            //             var f = files[i]
            //             var fileReader = new FileReader();
            //             fileReader.onload = (function(e) {
            //                 var file = e.target;
            //                 $("#files-preview").append("<span class=\"image-area rounded\">" +
            //                     "<img class=\"imageThumb\" width='130' src=\"" + e.target
            //                     .result +
            //                     "\" title=\"" + file.name + "\"/>" +
            //                     "" +
            //                     "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
            //                     "</span>");
            //                 $(".remove").click(function() {
            //                     $(this).parent(".image-area").remove();
            //                 });
            //                 // $("#files-preview").css('visibility', 'visible');
            //             });
            //             fileReader.readAsDataURL(f);
            //         }
            //     });
            // } else {
            //     alert("Your browser doesn't support to File API")
            // }
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
            
        });
    </script>
    {{-- <script src="{{ url('public/assets/js/property//hospitality_extra.js') }}"></script> --}}
@endpush
