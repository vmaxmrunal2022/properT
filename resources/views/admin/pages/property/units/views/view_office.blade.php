@extends('admin.layouts.main')
@section('content')
<?php

use App\Models\SecondaryUnitLevelData; ?>
<!-- <link href="{{url('public/assets/css///////////unit-details.css?v=fghn')}}" rel="stylesheet" type="text/css" /> -->
<link href="{{ asset('assets/css/view-units.css?v=6') }}" rel="stylesheet" type="text/css" />
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
    <div class="container-fluid pm-0">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                @if($secondary_level_unit_data->unit_cat_id == '102' && $secondary_level_unit_data->property_cat_id == '1')
                <h4 class="mb-sm-0">Office Details</h4>
                @elseif($secondary_level_unit_data->unit_cat_id == '149' && $secondary_level_unit_data->property_cat_id == '1')
                <h4 class="mb-sm-0">Retail Details</h4>
                @elseif($secondary_level_unit_data->unit_cat_id == '150' && $secondary_level_unit_data->property_cat_id == '1')
                <h4 class="mb-sm-0">Storage/Indusrty Details</h4>
                @elseif($secondary_level_unit_data->unit_cat_id == '151' && $secondary_level_unit_data->property_cat_id == '1')
                <h4 class="mb-sm-0">Other Details</h4>
                @elseif($secondary_level_unit_data->unit_cat_id == '109' && $secondary_level_unit_data->property_cat_id == '1')
                <h4 class="mb-sm-0">Hospitality Details</h4>
                @elseif($property->cat_id == "4" && $property->plot_land_type == "13")
                <h4 class="mb-sm-0">Plot/Land Details</h4>
                @elseif($property->cat_id == '2' && $property->residential_type == "7" && $property->residential_sub_type == "9" && $unit_data->apartment_id == "1" || $unit_data->apartment_id == "2")
                <h4 class="mb-sm-0">Serviced Apartments View</h4>
                @elseif($secondary_level_unit_data->property_cat_id == "6")
                <h4 class="mb-sm-0">Demolished Details</h4>
                @elseif($secondary_level_unit_data->property_cat_id == '2' && $unit_data->apartment_id && $unit_data->apartment_id == "3")
                <h4 class="mb-sm-0">1 RK Details</h4>
                @endif

            </div>
        </div>
        <!-- end page title -->

        <div class="container p-0 mb-3 mt-3">
            <div class="mainDiiv">
                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1GIS Id.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>GIS No</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{$property->gis_id}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1GIS Id.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Locality Name</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{$property->locality_name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1GIS Id.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Address</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{$property->street_details}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="pb-3">
            <h4 class="page-header"><span>Property Details</span></h4>
            <!-- Office View -->
            @if($secondary_level_unit_data->unit_cat_id == '102' && $secondary_level_unit_data->property_cat_id == '1')
            <div class="mainDiiv">
                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1Noofopenside.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Type of the office</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->office_type)}} </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1AreaDetails.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Add Area Details</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>Carpet Area - {{$secondary_level_unit_data->carpet_area}}
                                    {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit)}}
                                </p>
                                @if($secondary_level_unit_data->buildup_area)
                                <p>Built up Area - {{$secondary_level_unit_data->buildup_area}}
                                    {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit)}}
                                </p>
                                @endif
                                @if($secondary_level_unit_data->super_buildup_area)
                                <p>Super Built up Area - {{$secondary_level_unit_data->super_buildup_area}}
                                    {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit)}}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_3.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Property Facing</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if($secondary_level_unit_data->office_type == "83")
                <div class=" ">
                    <div class=" viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1Minnoofseats.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Min no of seats</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{$secondary_level_unit_data->min_no_of_seats}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1Maxnoofseats.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Max no of seats</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{$secondary_level_unit_data->max_no_of_seats}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1NoofCabins.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>No of Cabins</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{$secondary_level_unit_data->no_of_cabins }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1NoofMeetingRooms.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>No of Meeting Rooms</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{$secondary_level_unit_data->no_of_meeting_rooms }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1Pantry.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Pantry</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->pantry)}} </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1ConerenceRoom.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Conference Room</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->conference_room)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_1ReceptionArea.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Reception Area</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->reception_area)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="  ">
                    <div class="viewbedrooms">
                        <div>
                            <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                        </div>
                        <div>
                            <div>
                                <p><strong>Furnishing Options</strong></p>
                            </div>
                            <div class="extra-content">
                                <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if($secondary_level_unit_data->furnishing_option == "41" || $secondary_level_unit_data->furnishing_option == "42")
                
                <div class="mt-1 ">
                    <div class="bg-white clearfix p-3">
                        <p><b>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A'}}</b></p>
                        <ul class="furlist">
                            <div class="">
                                <li class="d-flex align-items-center">
                                    @forelse(SecondaryUnitLevelData::getFurnishing($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'14',$secondary_level_unit_data->furnishing_option) as $rec)
                                    <div class="semiFurnied">
                                    <div class="me-1">
                                        <img src="{{url('public/assets/'.SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->icon)}}" class="">
                                    <p class="mt-1">
                                        <small>{{SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id) ?
                                     SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->name : 'N/A'}}</small>
                                        <!-- <br> -->
                                        {{$rec->value ? ':'.$rec->value : ''}}
                                    </p>
                                    </div>
                                    
                                    </div>
                                    @empty
                                    @endforelse
                                </li>
                            </div>
                        </ul>
                    </div>
                </div>
                @endif
           


            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_1OxygenDust.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Oxygen Dust</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->oxygen_dust)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_1UPS.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>UPS</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->ups)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_1FireSafetyMeasures.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Fire Safety Measures</strong></p>
                        </div>
                        <div class="extra-content">

                            @forelse($secondary_level_unit_data->getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'8') as $rec)
                            <p>{{SecondaryUnitLevelData::getOptionName($rec->amenity_option_id)}}</p>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>No of Staircases</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{$secondary_level_unit_data->staircase ? $secondary_level_unit_data->staircase : "0"}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_1Lift.svg')}}" class="img-fluid" style="    width: 25px;">
                    </div>
                    <div>
                        <div>
                            <p><strong>Lifts</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->lifts)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Availability Status</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @if($secondary_level_unit_data->age_of_property != '')
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_10.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Age of Property</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($secondary_level_unit_data->possesion_by != '')
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_11.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Possesion by</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{$secondary_level_unit_data->possesion_by}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_11.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Owner's Preference</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{$secondary_level_unit_data->owners_preference}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Retail View -->
        @elseif($secondary_level_unit_data->unit_cat_id == '149' && $secondary_level_unit_data->property_cat_id == '1')
        <div class="mainDiiv">
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_5.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Add Area Details</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>Carpet Area - {{$secondary_level_unit_data->carpet_area}}
                                {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit)}}
                            </p>
                            @if($secondary_level_unit_data->buildup_area)
                            <p>Built up Area - {{$secondary_level_unit_data->buildup_area}}
                                {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit)}}
                            </p>
                            @endif
                            @if($secondary_level_unit_data->super_buildup_area)
                            <p>Super Built up Area - {{$secondary_level_unit_data->super_buildup_area}}
                                {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit)}}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_3.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Property Facing</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_5.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Shop facade size</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>Width : {{$secondary_level_unit_data->enterance_width ? $secondary_level_unit_data->enterance_width : 'N/A'}} {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->enterance_width_unit)}}</p>
                            <p>Height : {{$secondary_level_unit_data->ceiling_height ? $secondary_level_unit_data->ceiling_height : 'N/A'}} {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->ceiling_height_unit)}}</p>
                            <!-- <p>100 Mt</p> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class=" ">
                <div class=" viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Wash Rooms</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->washrooms)}}</p>
                            @if($secondary_level_unit_data->washrooms == "84")
                            <p>Private : {{$secondary_level_unit_data->priavate_washrooms}}</p>
                            <p>Shared : {{$secondary_level_unit_data->shared_washrooms}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Located Near</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->located_near) ? SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->located_near) : 'N/A'}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_7.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Parking Type</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->parking_type)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Availability Status</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @if($secondary_level_unit_data->age_of_property != '')
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_10.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Age of Property</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($secondary_level_unit_data->possesion_by != '')
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_11.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Possession by</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{$secondary_level_unit_data->possesion_by ? $secondary_level_unit_data->possesion_by : 'N/A'}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

        <!-- Storage View  -->
        @elseif($secondary_level_unit_data->unit_cat_id == '150' && $secondary_level_unit_data->property_cat_id == '1')
        <div class="mainDiiv">
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_2.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>No of Bathrooms</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{$secondary_level_unit_data->no_of_bathrooms}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_5.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Add Area Details</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>Carpet Area - {{$secondary_level_unit_data->carpet_area}}
                                {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit)}}
                            </p>
                            @if($secondary_level_unit_data->buildup_area)
                            <p>Built up Area - {{$secondary_level_unit_data->buildup_area}}
                                {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit)}}
                            </p>
                            @endif
                            @if($secondary_level_unit_data->super_buildup_area)
                            <p>Super Built up Area - {{$secondary_level_unit_data->super_buildup_area}}
                                {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit)}}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_3.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Property Facing</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing)}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Availability Status</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @if($secondary_level_unit_data->age_of_property != '')
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_10.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Age of Property</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($secondary_level_unit_data->possesion_by != '')
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_11.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Possession by</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{$secondary_level_unit_data->possesion_by}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

        <!-- Other View  -->
        @elseif($secondary_level_unit_data->unit_cat_id == '151' && $secondary_level_unit_data->property_cat_id == '1')
        <div class="mainDiiv">
            <!-- <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_2.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>No of Bathrooms</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{$secondary_level_unit_data->no_of_bathrooms}}</p>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_5.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Add Area Details</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>Carpet Area - {{$secondary_level_unit_data->carpet_area}}
                                {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit)}}
                            </p>
                            @if($secondary_level_unit_data->buildup_area)
                            <p>Built up Area - {{$secondary_level_unit_data->buildup_area}}
                                {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit)}}
                            </p>
                            @endif
                            @if($secondary_level_unit_data->super_buildup_area)
                            <p>Super Built up Area - {{$secondary_level_unit_data->super_buildup_area}}
                                {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit)}}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_3.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Property Facing</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing)}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Availability Status</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status)}}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($secondary_level_unit_data->availability_status == "23")
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_10.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Age of Property</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_11.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Possession by</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{$secondary_level_unit_data->possesion_by}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- for recidential && 1RK -->
        @elseif($secondary_level_unit_data->property_cat_id == '2' && $unit_data->apartment_id && $unit_data->apartment_id == "3")
        <div class="mainDiiv">
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_1.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>No of Bedrooms</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{$secondary_level_unit_data->rooms ?? 'N/A'}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_2.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>No of Bathrooms</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{$secondary_level_unit_data->washrooms ?? 'N/A'}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_3.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Property Facing</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) ?? 'N/A'}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_4.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>No of Balconies</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{$secondary_level_unit_data->balconies ?? 'N/A'}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_5.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Add Area Details</strong></p>
                        </div>
                        <div class="extra-content">
                            @if($secondary_level_unit_data->carpet_area) <p>Carpet Area - {{$secondary_level_unit_data->carpet_area }} {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit)}}</p> @endif
                            @if($secondary_level_unit_data->buildup_area) <p>Built up Area - {{$secondary_level_unit_data->buildup_area }} {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit)}}</p>@endif
                            @if($secondary_level_unit_data->super_buildup_area) <p>Super Built up Area - {{$secondary_level_unit_data->super_buildup_area }} {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit)}}</p>@endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="  ">
                <div class="viewbedrooms">
                    <div>
                        <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                    </div>
                    <div>
                        <div>
                            <p><strong>Furnishing Options</strong></p>
                        </div>
                        <div class="extra-content">
                            <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A'}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @if($secondary_level_unit_data->furnishing_option == "41" || $secondary_level_unit_data->furnishing_option == "42")
            <div class=" ">
                <div class="bg-white clearfix p-3">
                    <p><b>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A'}}</b></p>
                    <ul class="furlist">
                        <div class="">
                            <li class="d-flex align-items-center">
                                @forelse(SecondaryUnitLevelData::getFurnishing($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'14',$secondary_level_unit_data->furnishing_option) as $rec)
                                 <div class="semiFurnied">
                                <div class="me-1">
                                    <img src="{{url('public/assets/'.SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->icon)}}" class="">
                                <p class="mt-1">
                                    <small>{{SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id) ?
                                     SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->name : 'N/A'}}</small>
                                    <!-- <br> -->
                                    {{$rec->value ? ':'.$rec->value : ''}}
                                </p>
                                </div>
                               
                                 </div>
                                @empty
                                @endforelse
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
            @endif
        </div>
        <div class=" ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_7.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Reserved Parking</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>Covered Parking - {{$secondary_level_unit_data->covered_parking ?? 'N/A'}}</p>
                        <p>Open Parking - {{$secondary_level_unit_data->open_parking ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_8.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Other Rooms</strong></p>

                    </div>
                    <div class="extra-content">

                        @forelse($secondary_level_unit_data->getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'13') as $rec)

                        <p>{{SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) ? SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) : 'N/A'}}</p>

                        @empty
                        <p>-</p>
                        @endforelse


                    </div>
                </div>
            </div>
        </div>

        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_9.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Availability Status</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status)}}</p>
                    </div>
                </div>
            </div>
        </div>
        @if($secondary_level_unit_data->availability_status == '23')
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_10.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Age of Property</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($secondary_level_unit_data->availability_status != '23')
        <div class="">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_11.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Possession by</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{$secondary_level_unit_data->possesion_by}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>

    <!-- for  Hospitality  -->
    @elseif($secondary_level_unit_data->unit_cat_id == '109' && $secondary_level_unit_data->property_cat_id == '1')
    <div class="mainDiiv">
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_3.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>No of Rooms</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{$secondary_level_unit_data->rooms ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_3.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>No of Washrooms</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{$secondary_level_unit_data->washrooms ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_3.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Property Facing</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_5.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>No of Balconies</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{$secondary_level_unit_data->balconies}}</p>

                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_5.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Add Area Details</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>Carpet Area - {{$secondary_level_unit_data->carpet_area}}
                            {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit)}}
                        </p>
                        @if($secondary_level_unit_data->buildup_area)
                        <p>Built up Area - {{$secondary_level_unit_data->buildup_area}}
                            {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit)}}
                        </p>
                        @endif
                        @if($secondary_level_unit_data->super_buildup_area)
                        <p>Super Built up Area - {{$secondary_level_unit_data->super_buildup_area}}
                            {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit)}}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Other Rooms </strong></p>
                    </div>
                    <div class="extra-content">
                        @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'13') as $rec)
                        <p>{{SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) ?? 'N/A'}}</p>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Furnishing Options {{$secondary_level_unit_data->furnishing_option}}</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A'}}</p>
                        @forelse(SecondaryUnitLevelData::getFurnishing($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'14',$secondary_level_unit_data->furnishing_option) as $rec)
                        <div class="flex-item">
                            <div class="itemss-flex">
                                <div>
                                    <img src="{{url('public/assets/'.SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->icon)}}" class="img-fluid">
                                </div>
                                <div>
                                    <p>
                                        {{SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id) ?
                                     SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->name : 'N/A'}}
                                        {{$rec->value ? ':'.$rec->value : ''}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>-</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div> -->
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Furnishing Options</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>
        @if($secondary_level_unit_data->furnishing_option == "41" || $secondary_level_unit_data->furnishing_option == "42")
        <div class=" ">
            <div class="bg-white clearfix p-3 br-5">
                <p><b>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A'}}</b></p>
                <ul class="furlist">
                    <div class="">
                        <li class="d-flex align-items-center MainsemiFurn">
                            @forelse(SecondaryUnitLevelData::getFurnishing($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'14',$secondary_level_unit_data->furnishing_option) as $rec)
                            <div class="semiFurnied">
                            <div class="me-1">
                                <img src="{{url('public/assets/'.SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->icon)}}" class="">
                              <p class="mt-1">
                                <small>{{SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id) ?
                                     SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->name : 'N/A'}}</small>
                                <!-- <br> -->
                                {{$rec->value ? ':'.$rec->value : ''}}
                            </p>
                            </div>
                          
                            </div>
                            @empty
                            @endforelse
                        </li>
                    </div>
                </ul>
            </div>
        </div>
        @endif
        <div class=" ">
            <div class=" viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_7.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Availability Status </strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status)}}</p>
                    </div>
                </div>
            </div>
        </div>
        @if($secondary_level_unit_data->age_of_property != '')
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Age of Property</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property) ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($secondary_level_unit_data->availability_status != '23')
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_10.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Possesion by</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{$secondary_level_unit_data->possesion_by}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- for  Plot/Land  -->
    @elseif($property->cat_id == "4" && $property->plot_land_type == "13")
    <div class="mainDiiv">
        <div class="">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_1AddAreaDetails.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Add Area Details</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>Plot Area - {{$secondary_level_unit_data->plot_area}}
                            {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->plot_area_units)}}
                        </p>

                        @if($secondary_level_unit_data->buildup_area)
                        <p>Built up Area - {{$secondary_level_unit_data->buildup_area}}
                            {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit)}}
                        </p>
                        @endif
                        @if($secondary_level_unit_data->super_buildup_area)
                        <p>Super Built up Area - {{$secondary_level_unit_data->super_buildup_area}}
                            {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit)}}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/GroupPropertyDimensions.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Property Dimensions</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>Length of plot - {{$secondary_level_unit_data->plot_length ?? 'N/A'}} Ft</p>
                        <p>width of plot - {{$secondary_level_unit_data->plot_breadth ?? 'N/A'}} Ft</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_1FloorsAllowedforConstruction.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Floors Allowed for Construction</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>Length of plot - {{$secondary_level_unit_data->floors_allowed ?? 'N/A'}} </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_1No ofopenside.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>No of open side</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{$secondary_level_unit_data->no_of_open_side ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_DurationoftheAgreement.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Remarks On Property</strong></p>
                    </div>
                    <div class="extra-content">
                        <!-- <p>None</p> -->
                        <p>{{$secondary_level_unit_data->remark ? $secondary_level_unit_data->remark : "N/A"}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- for Serviced Apartments  -->
    @elseif($property->cat_id == '2' && $property->residential_type == "7" && $property->residential_sub_type == "9" && $unit_data->apartment_id == "1" || $unit_data->apartment_id == "2")
    <div class="mainDiiv">
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_1.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>No of Bedrooms</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{$secondary_level_unit_data->rooms ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_2.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>No of Bathrooms</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{$secondary_level_unit_data->washrooms ??  'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_3.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Property Facing</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing) ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_4.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>No of Balconies</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{$secondary_level_unit_data->balconies ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_5.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Add Area Details</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>Carpet Area - {{$secondary_level_unit_data->carpet_area}}
                            {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit)}}
                        </p>
                        @if($secondary_level_unit_data->buildup_area)
                        <p>Built up Area - {{$secondary_level_unit_data->buildup_area}}
                            {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit)}}
                        </p>
                        @endif
                        @if($secondary_level_unit_data->super_buildup_area)
                        <p>Super Built up Area - {{$secondary_level_unit_data->super_buildup_area}}
                            {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit)}}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Other Rooms</strong></p>
                    </div>
                    <div class="extra-content">
                        @forelse($secondary_level_unit_data->getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'13') as $rec)
                        <p>{{SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) ? SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) : 'N/A'}}</p>
                        @empty
                        <p>-</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="  ">
            <div class="viewbedrooms">
                <div>
                    <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
                </div>
                <div>
                    <div>
                        <p><strong>Furnishing Options</strong></p>
                    </div>
                    <div class="extra-content">
                        <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A'}}</p>
                    </div>
                </div>
            </div>
        </div>
        @if($secondary_level_unit_data->furnishing_option == "41" || $secondary_level_unit_data->furnishing_option == "42")
        <div class=" ">
            <div class="bg-white clearfix p-3">
                <p><b>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->furnishing_option) ?? 'N/A'}}</b></p>
                <ul class="furlist">
                    <div class="">
                        <li class="d-flex align-items-center">
                            @forelse(SecondaryUnitLevelData::getFurnishing($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'14',$secondary_level_unit_data->furnishing_option) as $rec)
                              <div class="semiFurnied">
                            <div class="me-1">
                                <img src="{{url('public/assets/'.SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->icon)}}" class="">
                              <p class="mt-1">
                                <small>{{SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id) ?
                                     SecondaryUnitLevelData::getMultipleFurnishedOptions($rec->amenity_option_value_id)->name : 'N/A'}}</small>
                                <!-- <br> -->
                                {{$rec->value ? ':'.$rec->value : ''}}
                            </p>
                            </div>
                          
                               </div>
                            @empty
                            @endforelse
                        </li>
                    </div>
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>
<div class=" ">
    <div class="viewbedrooms">
        <div>
            <img src="{{url('public/assets/images/Layer_7.svg')}}" class="img-fluid">
        </div>
        <div>
            <div>
                <p><strong>Reserved Parking</strong></p>
            </div>
            <div class="extra-content">
                <p>Covered Parking - {{$secondary_level_unit_data->covered_parking}}</p>
                <p>Open Parking - {{$secondary_level_unit_data->open_parking}}</p>
            </div>
        </div>
    </div>
</div>
<div class="  ">
    <div class="viewbedrooms">
        <div>
            <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
        </div>
        <div>
            <div>
                <p><strong>Availability Status</strong></p>
            </div>
            <div class="extra-content">
                <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status)}}</p>
            </div>
        </div>
    </div>
</div>

@if($secondary_level_unit_data->availability_status == '23')
<div class="  ">
    <div class="viewbedrooms">
        <div>
            <img src="{{url('public/assets/images/Layer_10.svg')}}" class="img-fluid">
        </div>
        <div>
            <div>
                <p><strong>Age of Property</strong></p>
            </div>
            <div class="extra-content">
                <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property)}}</p>
            </div>
        </div>
    </div>
</div>
@endif
@if($secondary_level_unit_data->availability_status != '23')
<div class="">
    <div class="viewbedrooms">
        <div>
            <img src="{{url('public/assets/images/Layer_11.svg')}}" class="img-fluid">
        </div>
        <div>
            <div>
                <p><strong>Possession by</strong></p>
            </div>
            <div class="extra-content">
                <p>{{$secondary_level_unit_data->possesion_by}}</p>
            </div>
        </div>
    </div>
</div>
@endif
</div>

<!-- for Demolished  -->
@elseif($secondary_level_unit_data->property_cat_id == "6")
<div class="mainDiiv">
    <div class="">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_5.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Add Area Details</strong></p>
                </div>
                <div class="extra-content">
                    <p>Plot Area - {{$secondary_level_unit_data->plot_area}}
                        {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->plot_area_unit)}}
                    </p>
                    @if($secondary_level_unit_data->carpet_area != '')
                    <p>Carpet Area - {{$secondary_level_unit_data->carpet_area}}
                        {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit)}}
                    </p>
                    @endif
                    @if($secondary_level_unit_data->buildup_area)
                    <p>Built up Area - {{$secondary_level_unit_data->buildup_area}}
                        {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit)}}
                    </p>
                    @endif
                    @if($secondary_level_unit_data->super_buildup_area)
                    <p>Super Built up Area - {{$secondary_level_unit_data->super_buildup_area}}
                        {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit)}}
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="viewbedroomsText">
            <div class="widthImage">
                <img src="{{url('public/assets/images/Layer_DurationoftheAgreement.svg')}}" class="img-fluid" style="width:50px;">
            </div>
            <div>
                <div>
                    <p><strong>Property Discription</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{$secondary_level_unit_data->property_description}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="  ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_1PreviousUse.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Previous Use </strong></p>
                </div>
                <div class="extra-content">
                    <p>{{$secondary_level_unit_data->previous_use}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="  ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_1CurrentUse.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Current Use</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{$secondary_level_unit_data->current_use}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class=" ">
    <div class="viewbedrooms">
        <div>
            <img src="{{url('public/assets/images/Layer_PriceDetails.svg')}}" class="img-fluid">
        </div>
        <div>
            <div>
                <p><strong>Price</strong></p>
            </div>
            <div class="extra-content">
                <p>{{$secondary_level_unit_data->price}}
                </p>
            </div>
        </div>
    </div>
</div>
@else
<div class=" mainDiiv">
    <div class="">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_2.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>No of Bathrooms</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{$secondary_level_unit_data->no_of_bathrooms}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_5.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Add Area Details</strong></p>
                </div>
                <div class="extra-content">
                    <p>Carpet Area - {{$secondary_level_unit_data->carpet_area}}
                        {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->carpet_area_unit)}}
                    </p>
                    @if($secondary_level_unit_data->buildup_area)
                    <p>Built up Area - {{$secondary_level_unit_data->buildup_area}}
                        {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->buildup_area_unit)}}
                    </p>
                    @endif
                    @if($secondary_level_unit_data->super_buildup_area)
                    <p>Super Built up Area - {{$secondary_level_unit_data->super_buildup_area}}
                        {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->super_buildup_area_unit)}}
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="  ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_3.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Property Facing</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->property_facing)}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="  ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_6.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Availability Status</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->availability_status)}}</p>
                </div>
            </div>
        </div>
    </div>
    @if($secondary_level_unit_data->age_of_property != '')
    <div class="  ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_10.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Age of Property</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->age_of_property)}}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($secondary_level_unit_data->possesion_by != '')
    <div class="">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_11.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Possession by</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{$secondary_level_unit_data->possesion_by}}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endif

@if($secondary_level_unit_data->property_cat_id != "6")
<hr class="pb-3">
<h4 class="page-header"><span> Pricing & Other Details</span></h4>
<div class="mainDiiv">
    <div class="  ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_rent.svg')}}" class="img-fluid">
                <!--<img src="{{url('public/assets/images/Layer_sale.svg')}}" class="img-fluid">-->
            </div>
            <div>
                <div>
                    <p><strong>Property Type</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{$secondary_level_unit_data->pricing_details_for == '1' ? "Sale" : "Rent"}}</p>
                </div>
            </div>
        </div>
    </div>
    @if($secondary_level_unit_data->pricing_details_for == "1")
    <div class="  ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_Freehold.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Ownership Details</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{SecondaryUnitLevelData::getOwnership($secondary_level_unit_data->ownership)->name ?? 'N/A'}}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="  ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_PriceDetails.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>{{$secondary_level_unit_data->pricing_details_for == '1' ? "Price Details" : "Rent Details"}}</strong></p>
                    <p>{{$secondary_level_unit_data->pricing_details_for == '1' ? $secondary_level_unit_data->expected_price : $secondary_level_unit_data->expected_rent }} ({{($secondary_level_unit_data->price_per_sq_ft) }} Sq.Ft)</p>
                </div>
                <div class="extra-content">
                    @if($secondary_level_unit_data->pricing_details_for == "1")
                    @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'22') as $rec)
                    <p>{{SecondaryUnitLevelData::getOptionName($rec->amenity_option_id)}}</p>
                    @empty
                    @endforelse
                    @else
                    @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'17') as $rec)
                    <p>{{SecondaryUnitLevelData::getOptionName($rec->amenity_option_id)}}</p>
                    @empty
                    @endforelse
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="  ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_AdditionaPricing.svg')}}" class="img-fluid img-mobile" style="">
            </div>
            <div>
                <div>
                    <p><strong>{{$secondary_level_unit_data->pricing_details_for == '1' ? "Additional Pricing Details" :
                                    "Additional Rent Details"}}
                        </strong></p>
                    <p>{{$secondary_level_unit_data->pricing_details_for == '1' ? $secondary_level_unit_data->expected_price  : $secondary_level_unit_data->expected_rent }}{{($secondary_level_unit_data->price_period)}}</p>
                </div>
                <div class="extra-content">
                    <p>Maintenance : {{$secondary_level_unit_data->pricing_details_for == '1' ? $secondary_level_unit_data->mainteinance
                                    : $secondary_level_unit_data->maintenance_rent}} ({{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->maintenance_period)}})</p>
                    @if($secondary_level_unit_data->pricing_details_for == "1")
                    <p>Expected Rental : {{$secondary_level_unit_data->pricing_details_for == '1' ? $secondary_level_unit_data->expected_rental
                                    : $secondary_level_unit_data->expected_rent}}</p>
                    @endif
                    <p>Booking Amount : {{$secondary_level_unit_data->pricing_details_for == '1' ? $secondary_level_unit_data->booking_amount
                                    : $secondary_level_unit_data->booking_amount_rent}}</p>
                    <p>Annual dues payble : {{$secondary_level_unit_data->pricing_details_for == '1' ? $secondary_level_unit_data->annual_due_pay
                                    : $secondary_level_unit_data->annual_dues_rent}}</p>
                    <p>Membership Charge : {{$secondary_level_unit_data->pricing_details_for == '1' ? $secondary_level_unit_data->membership_charge
                                    : $secondary_level_unit_data->membership_charge_rent}}</p>
                </div>
            </div>
        </div>
    </div>

    @if($secondary_level_unit_data->pricing_details_for == "2")
    <div class="   ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_PreferredAgreement.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Preferred Agreement Type</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->agreement_type) ? SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->agreement_type) : 'N/A'}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="  ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_DurationoftheAgreement.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Duration of the Agreement</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{$secondary_level_unit_data->agreement_duration ? $secondary_level_unit_data->agreement_duration : 'N/A'}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="  ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_DurationoftheAgreement.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Months of Notice</strong></p>
                </div>
                <div class="extra-content">
                    <!-- <p>None</p> -->
                    <p>{{SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->notice_period) ? SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->notice_period) : 'N/A'}}</p>
                </div>
            </div>
        </div>
    </div>
    @endif


    @if($secondary_level_unit_data->pricing_details_for == "1" || $secondary_level_unit_data->unit_cat_id == '109' && $secondary_level_unit_data->property_cat_id == '1')
    <div class="  ">
        <div class="viewbedrooms">
            <div>
                <img src="{{url('public/assets/images/Layer_DurationoftheAgreement.svg')}}" class="img-fluid">
            </div>
            <div>
                <div>
                    <p><strong>Remarks On Property</strong></p>
                </div>
                <div class="extra-content">
                    <!-- <p>None</p> -->
                    <p>{{$secondary_level_unit_data->remark ? $secondary_level_unit_data->remark : "N/A"}}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endif

<hr class="mb-3">
<h4 class="page-header"><span> Add Images</span></h4>
<div class="mainDiiv">
    @forelse($secondary_level_unit_data->getImages($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id) as $rec)
    <!-- <p>{{SecondaryUnitLevelData::getOptionName($rec->amenity_option_id)}}</p> -->
    <div class="img-container">
        <a data-fancybox="gallery" href="{{asset($rec->file_path.'/'.$rec->file_name)}}">
            <img src="{{asset($rec->file_path.'/'.$rec->file_name)}}" width="100">
        </a>
    </div>
    @empty
    @endforelse

    @if($secondary_level_unit_data->property_cat_id == '6')
    <hr class="mb-3">
    <div class=" ">
        <div class="viewbedroomsText">
            <div class="widthImage">
                <img src="{{url('public/assets/images/Layer_7.svg')}}" class="img-fluid" style="width:50px;">
            </div>
            <div>
                <div>
                    <p><strong>Property History</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{$secondary_level_unit_data->property_history}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class=" ">
        <div class="viewbedroomsText">
            <div class="widthImage">
                <img src="{{url('public/assets/images/Layer_7.svg')}}" class="img-fluid" style="width:50px;">
            </div>
            <div>
                <div>
                    <p><strong>Development Potential</strong></p>
                </div>
                <div class="extra-content">
                    <p>{{$secondary_level_unit_data->development_potential ?? "N/A"}}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@if(($property->cat_id != "4" && $property->plot_land_type != "13") && ($secondary_level_unit_data->property_cat_id != "6"))
<hr class="mb-3">
<h4 class="page-header"><span> Ameneties</span></h4>
@endif
<div class="card">
    @if(($secondary_level_unit_data->property_cat_id != "6") && ($property->cat_id != "4" && $property->plot_land_type != "13"))
    <div class="card-body">
        @if(count(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'20')) >= "1")
        <p class="ameneties-heading">Amenities</p>
        <div class="mainFlex">
            <div class="amenti-dflex">
                @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'20') as $amenity)
                <div class="flex-item">
                    <div class="itemss-flex">
                        <div>
                            <img src="{{url('public/assets/'.SecondaryUnitLevelData::getOptionValues($amenity->amenity_option_id)->icon_path)}}" class="img-fluid">
                        </div>
                        <div>
                            <p>{{SecondaryUnitLevelData::getOptionName($amenity->amenity_option_id)}}</p>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
        @endif
        <!-- bellow portion is not present at the time of data addition -->
        <!-- <p class="ameneties-heading">Property Features</p>
                    <div class="mainFlex">
                        <div class="amenti-dflex">

                            @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'28') as $amenity)
                            <div class="flex-item">
                                <div class="itemss-flex">
                                    <div>
                                        <img src="{{url('public/assets/'.SecondaryUnitLevelData::getOptionValues($amenity->amenity_option_id)->icon_path)}}" class="img-fluid">
                                    </div>
                                    <div>
                                        <p>{{SecondaryUnitLevelData::getOptionName($amenity->amenity_option_id)}}</p>
                                    </div>
                                </div>
                            </div>
                            @empty
                            @endforelse

                        </div>
                    </div> -->


        @if(count(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'29')) >= "1")
        <p class="ameneties-heading">Society / Building Features</p>
        <div class="mainFlex">
            <div class="amenti-dflex">

                @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'29') as $amenity)
                <div class="flex-item">
                    <div class="itemss-flex">
                        <div>
                            <img src="{{url('public/assets/'.SecondaryUnitLevelData::getOptionValues($amenity->amenity_option_id)->icon_path)}}" class="img-fluid">
                        </div>
                        <div>
                            <p>{{SecondaryUnitLevelData::getOptionName($amenity->amenity_option_id)}}</p>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse

            </div>
        </div>
        @endif



        @if(count(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'30')) >= "1")
        <p class="ameneties-heading">Additional Features</p>
        <div class="mainFlex">
            <div class="amenti-dflex">

                @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'30') as $amenity)
                <div class="flex-item">
                    <div class="itemss-flex">
                        <div>
                            <img src="{{url('public/assets/'.SecondaryUnitLevelData::getOptionValues($amenity->amenity_option_id)->icon_path)}}" class="img-fluid">
                        </div>
                        <div>
                            <p>{{SecondaryUnitLevelData::getOptionName($amenity->amenity_option_id)}}</p>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
        @endif

        @if(count(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'32')) >= "1")
        <p class="ameneties-heading">Water Source</p>
        <div class="mainFlex">
            <div class="amenti-dflex">
                @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'32') as $amenity)
                <div class="flex-item">
                    <div class="itemss-flex">
                        <div>
                            <img src="{{url('public/assets/'.SecondaryUnitLevelData::getOptionValues($amenity->amenity_option_id)->icon_path)}}" class="img-fluid">
                        </div>
                        <div>
                            <p>{{SecondaryUnitLevelData::getOptionName($amenity->amenity_option_id)}}</p>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
        @endif

        @if(count(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'33')) >= "1")
        <p class="ameneties-heading">Overlooking</p>
        <div class="mainFlex">
            <div class="amenti-dflex">

                @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'33') as $amenity)
                <div class="flex-item">
                    <div class="itemss-flex">
                        <div>
                            <img src="{{url('public/assets/'.SecondaryUnitLevelData::getOptionValues($amenity->amenity_option_id)->icon_path)}}" class="img-fluid">
                        </div>
                        <div>
                            <p>{{SecondaryUnitLevelData::getOptionName($amenity->amenity_option_id)}}</p>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse

            </div>
        </div>
        @endif


        @if(count(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'31')) >= "1")
        <p class="ameneties-heading">Other Features</p>
        <div class="mainFlex">
            <div class="amenti-dflex">
                @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'31') as $amenity)
                <div class="flex-item">
                    <div class="itemss-flex">
                        <div>
                            <img src="{{url('public/assets/'.SecondaryUnitLevelData::getOptionValues($amenity->amenity_option_id)->icon_path)}}" class="img-fluid">
                        </div>
                        <div>
                            <p>{{SecondaryUnitLevelData::getOptionName($amenity->amenity_option_id)}}</p>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
        @endif


        @if(count(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'34')) >= "1")
        <p class="ameneties-heading">Power Back up</p>
        <div class="mainFlex">
            <div class="amenti-dflex">

                @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'34') as $amenity)
                <div class="flex-item">
                    <div class="itemss-flex">
                        <div>
                            <img src="{{url('public/assets/'.SecondaryUnitLevelData::getOptionValues($amenity->amenity_option_id)->icon_path)}}" class="img-fluid">
                        </div>
                        <div>
                            <p>{{SecondaryUnitLevelData::getOptionName($amenity->amenity_option_id)}}</p>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
        @endif

        @if($secondary_level_unit_data->floor_type != '')
        <p class="ameneties-heading">Type of Flooring</p>
        <div class="amenti-dflex">
            <div class="flex-item">
                <div class="itemss-flex">
                    @if(SecondaryUnitLevelData::getFloor($secondary_level_unit_data->floor_type) != '')
                    <div>
                        <img src="{{url('public/assets/'.SecondaryUnitLevelData::getFloor($secondary_level_unit_data->floor_type)->icon_path)}}" class="img-fluid">
                    </div>
                    <div>
                        <p>{{SecondaryUnitLevelData::getFloor($secondary_level_unit_data->floor_type)->name ?? 'N/A'}}</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>
   
    @endif

    @if($secondary_level_unit_data->facing_road_width != '')
    <p class="ameneties-heading">Width of Facing road</p>
    <div class="flex-item">
        <div class="itemss-flex">
            <div>
                <img src="{{url('public/assets/images/Layer_1300Meters.svg')}}" class="img-fluid">
            </div>
            <div>
                <p>{{$secondary_level_unit_data->facing_road_width}} {{SecondaryUnitLevelData::getAreaUnit($secondary_level_unit_data->facing_road_width_unit)}}</p>
            </div>
        </div>
    </div>
    @endif


    @if(count(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'21')) >= "1")
    <p class="ameneties-heading">Location Advantages</p>
    <div class="mainFlex">
        <div class="amenti-dflex">

            @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'21') as $amenity)
            <div class="flex-item">
                <div class="itemss-flex">
                    <div>
                        <img src="{{url('public/assets/'.SecondaryUnitLevelData::getOptionValues($amenity->amenity_option_id)->icon_path)}}" class="img-fluid">
                    </div>
                    <div>
                        <p>{{SecondaryUnitLevelData::getOptionName($amenity->amenity_option_id)}}</p>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
    @endif
    @endif


    <div class="card-footer">
        <div class="ms-auto text-end">
            @if($property->cat_id == 4 && $property->plot_land_type == 13)
            <a href="{{url('surveyor/property/edit_unit_details/plot-land/'.$property->id)}}" class=" btn btn-done btn-primary ">Edit &nbsp;<i class=" fa fa-arrow-right"></i></a>
            @elseif($secondary_level_unit_data->property_cat_id == "6")
            <a href="{{url('surveyor/property/edit_unit_details/demolished/'.$property->id)}}" class=" btn btn-done btn-primary ">Edit &nbsp;<i class=" fa fa-arrow-right"></i></a>
            @else
            <a href="{{url('surveyor/property/edit_unit_details/'.$secondary_level_unit_data->unit_id)}}" class=" btn btn-done btn-primary ">Edit &nbsp;<i class=" fa fa-arrow-right"></i></a>
            @endif
        </div>
    </div>

</div>
</div>
</div>
</div>

<!-- End Page-content -->

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © ProperT.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end  d-sm-block">
                    Design & Develop by <a href="https://vmaxindia.com/">VMAX</a>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
@endsection
@push('scripts')
<script src="{{url('public/assets/js/property/extra.js')}}"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script>
    $(document).ready(function() {

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
                        $("#amenity-files-preview").append("<span class=\"image-area rounded\">" +
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
                        $("#interior-files-preview").append("<span class=\"image-area rounded\">" +
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
                        $("#floor-plan-files-preview").append("<span class=\"image-area rounded\">" +
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
    });
</script>
<script>
    $(document).ready(function() {
        // // Check if the <p> element inside .extra-content is empty or null
        // if ($.trim($(".extra-content p").text()) === '') {
        //     // Hide the parent of parent div with class .viewbedrooms
        //     $(".extra-content").parent().parent().hide();
        // }
        const extraContentElement = document.querySelector('.extra-content');

        // Check if the element is null or undefined
        if (extraContentElement === null) {
            console.log('Element with class "extra-content" not found.');
        } else {
            // Get the <p> tag inside the "extra-content" element
            const paragraphElement = extraContentElement.querySelector('p');

            // Check if the <p> tag is found
            if (paragraphElement === null) {
                console.log('No <p> tag found inside the "extra-content" element.');
            } else {
                // Get the text content of the <p> tag
                const paragraphContent = paragraphElement.textContent;
                console.log('Content of <p> tag inside "extra-content":', paragraphContent);
            }
        }


    });
</script>

@endpush