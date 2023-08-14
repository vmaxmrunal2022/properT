@extends('admin.layouts.main')
@section('content')
    <style>
 
      
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Basic Details</h4>

                        {{--                         
                            <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Basic  Elements</li>
                            </ol>
                            </div> 
                        --}}


                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form action="{{ route('surveyor.property.store') }}" method="post" id="create_property" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12 col-md-12">

                        <div class="card">

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-xxl-6 col-md-6">

                                        <div class="">
                                          
                                            <div onclick="getCordinates()" class="form-group picking row">

                                                <div class="col-md-4 mb-2">
                                                    <input type="text" placeholder="Latitude" name="latitude"
                                                        id="latitude" class="form-control controls"
                                                        value="{{ old('latitude') }}">
                                                    @error('latitude')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <input type="text" placeholder="Longitude" name="longitude"
                                                        id="longitude" class="form-control controls"
                                                        value="{{ old('longitude') }}">
                                                    @error('longitude')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4">
                                                    <button class="btn btn-info " type="button">
                                                        <label style="cursor:pointer; margin-bottom:0px;">
                                                            <span class="mdi mdi-crosshairs-gps  "></span>
                                                            Pick my Location
                                                        </label>
                                                    </button>
                                                </div>


                                            </div>
                                            

                                            <!-- Search input -->


                                            <!-- Google map -->
                                            <div id="map"></div>

                                            <!-- Display geolocation data -->
                                           
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Enter GIS ID <span
                                                    class="errorcl">*</span></label>
                                            <input type="text" name="gis_id" class="form-control req-" id=" "
                                                placeholder="EX:7255158845" value="{{ old('gis_id') }}"
                                                onkeypress="return isNumber(event)">
                                            @error('gis_id')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3  mt-3">
                                        <div>
                                            <label for="" class="form-label">Category of the property <span
                                                    class="errorcl">*</span></label>
                                            <select class="form-select" name="category" id="category">
                                                <option selected disabled>-Select Category-</option>
                                                @forelse($categories as $key=>$category)
                                                    @if (old('category') == $category->id)
                                                        <option value="{{ $category->id }}" selected> {{ $category->title }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @endif

                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse

                                            </select>
                                            @error('category')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                   <div class="col-xxl-3 col-md-3  mt-3 d-none residential_blks"  >
                                        <div>
                                            <label for="" class="form-label">Residential Types <span class="errorcl">*</span></label>
                                            <select class="form-select" name="category" id="residential_types">
                                                <option selected="" disabled="">-Select Residential Types-</option>
                                                <option value="apartment">Apartment</option>
			                                    <option value="independent-house">Independent House/Villa</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                   <div class="col-xxl-3 col-md-3  mt-3 d-none residential_blks" id="" >
                                        <div>
                                            <label for="" class="form-label">Residential Sub Types <span class="errorcl">*</span></label>
                                            <select class="form-select" name="category" id="residential_sub_types">
                                                <option selected="" disabled="">-Select Residential Sub Types-</option>
                                    			<option value="residential-apartment-stand-alone" class="residential-child apartment-child d-none">Stand-alone Apartment</option>
                                    			<option value="residential-apartment-gated-community" class="residential-child apartment-child d-none">Gated Community</option>
                                    			<option value="residential-independent-house-individual-house" class="residential-child independent-house-child d-none" >Individual House </option>
                                    			<option value="residential-independent-house-gated-community" class="residential-child independent-house-child d-none">Gated Community </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                   <div class="col-xxl-3 col-md-3  mt-3 d-none plot_land_blks"  >
                                        <div>
                                            <label for="" class="form-label">Plot Land Types <span class="errorcl">*</span></label>
                                            <select class="form-select" name="category" id="plot_land_types">
                                                <option selected="" disabled="">-Select Plot Land Types-</option>
                                                <option value="plot-land-open-plot">Open plot</option>
			                                    <option value="plot-land-gated-community">Gated-community</option>
                                            </select>
                                        </div>
                                    </div>
                           
                                    
                                   

                                </div>
                                
                                <div class="residential-parent"> 
                                    	<!--// apartment-->
                                    	<div class="row residential-apartment-stand-alone residential-fields-child d-none">
                                    		
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Apartment Name <span class="errorcl">*</span></label>
                                    				<input type="text" name="apartment_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Owner Full Name <span class="errorcl">*</span></label>
                                    				<input type="text" name="owner_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Plot No<span class="errorcl">*</span></label>
                                    				<input type="text" name="plot_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Street Name/No/Road No<span class="errorcl">*</span></label>
                                    				<input type="text" name="street_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
                                    				<input type="text" name="locality_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Contact No<span class="errorcl">*</span></label>
                                    				<input type="text" name="conatact_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3 no_of_floors">
                                    			<div>
                                    				<label for="" class="form-label ">No of Floors<span class="errorcl">*</span></label>
                                    				<input type="text" name="no_of_floors" class="form-control " data-parent="residential" id="">
                                    			</div>
                                    		</div>
                                    		
                                    
                                    
                                    
                                    		<!--// Unit Name – Text Field (Optional) -->
                                    
                                    		<!--// Select Units – Checkbox/Dropdown beside (Optional) -->
                                    
                                    
                                    	</div>
                                    
                                    	<div class="row residential-apartment-gated-community residential-fields-child d-none">
                                    
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Project Name<span class="errorcl">*</span></label>
                                    				<input type="text" name="project_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Builder Name<span class="errorcl">*</span></label>
                                    				<input type="text" name="builder_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Contact No<span class="errorcl">*</span></label>
                                    				<input type="text" name="contact_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">House No<span class="errorcl">*</span></label>
                                    				<input type="text" name="house_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Plot No<span class="errorcl">*</span></label>
                                    				<input type="text" name="plot_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Street Name/No/Road No<span class="errorcl">*</span></label>
                                    				<input type="text" name="street_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
                                    				<input type="text" name="locality_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    
                                    	</div>
                                    
                                    	<!--// Independent House/Villa -->
                                    	<div class="row residential-independent-house-individual-house residential-fields-child d-none">
                                    		
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">House Name <span class="errorcl">*</span></label>
                                    				<input type="text" name="house_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">House No <span class="errorcl">*</span></label>
                                    				<input type="text" name="house_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Plot No<span class="errorcl">*</span></label>
                                    				<input type="text" name="plot_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Street Name/No/Road No<span class="errorcl">*</span></label>
                                    				<input type="text" name="street_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
                                    				<input type="text" name="locality_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Owner Full Name <span class="errorcl">*</span></label>
                                    				<input type="text" name="owner_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Contact No<span class="errorcl">*</span></label>
                                    				<input type="text" name="conatact_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3 no_of_floors">
                                    			<div>
                                    				<label for="" class="form-label">No of Floors<span class="errorcl">*</span></label>
                                    				<input type="text"  name="no_of_floors" class="form-control " data-parent="residential" id="">
                                    			</div>
                                    		</div>
                                    	
                                    
                                    
                                    
                                    		<!--// Unit Name – Text Field (Optional) -->
                                    
                                    		<!--// Select Units – Checkbox/Dropdown beside (Optional) -->
                                    
                                    
                                    	</div>
                                    
                                    	<div class="row residential-independent-house-gated-community residential-fields-child d-none">
                                    
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Project Name<span class="errorcl">*</span></label>
                                    				<input type="text" name="project_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Builder Name<span class="errorcl">*</span></label>
                                    				<input type="text" name="builder_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Contact No<span class="errorcl">*</span></label>
                                    				<input type="text" name="contact_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">House No<span class="errorcl">*</span></label>
                                    				<input type="text" name="house_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Plot No<span class="errorcl">*</span></label>
                                    				<input type="text" name="plot_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Street Name/No/Road No<span class="errorcl">*</span></label>
                                    				<input type="text" name="street_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
                                    				<input type="text" name="locality_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    
                                    	</div>
                                    
                                    </div>
                                    
                                <div class="commercial-parent">
                                    	<div class="row  commercial-fields-child d-none">
                                    		
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Building Name <span class="errorcl">*</span></label>
                                    				<input type="text" name="building_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">House No <span class="errorcl">*</span></label>
                                    				<input type="text" name="house_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Plot No<span class="errorcl">*</span></label>
                                    				<input type="text" name="plot_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Street Name/No/Road No<span class="errorcl">*</span></label>
                                    				<input type="text" name="street_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
                                    				<input type="text" name="locality_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Owner Full Name <span class="errorcl">*</span></label>
                                    				<input type="text" name="owner_name" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		<div class="col-xxl-3 col-md-3 mt-3">
                                    			<div>
                                    				<label for="" class="form-label">Contact No<span class="errorcl">*</span></label>
                                    				<input type="text" name="conatact_no" class="form-control" id="">
                                    			</div>
                                    		</div>
                                    		
                                    		<div class="col-xxl-3 col-md-3 mt-3 no_of_floors">
                                    			<div>
                                    				<label for="" class="form-label">No of Floors<span class="errorcl">*</span></label>
                                    				<input type="text" name="no_of_floors" class="form-control " data-parent="commercial" id="">
                                    			</div>
                                    		</div>
                                    
                                            <div class="row gx-2 mt-3 py-2 align-items-center bg-primary text-white">
                                                <div class="col-auto">
                                                    <!--<label for="inputPassword6" class="col-form-label"> Select Units </label>-->
                                                </div>
                                                <!--<div class="col-md-3 col-lg-3">-->
                                                <!--    <label for="" class="form-label"> Select Units <span class="errorcl">*</span></label>-->
                                                <!--    <select class="commercial-select2" multiple="multiple">-->
                                                <!--    </select>-->
                                                <!--</div>-->
                                                <div class="col-auto">
                                                    <label for="" class="form-label"> Type of Unit <span class="errorcl">*</span></label>
                                                    <select class="form-select" name="" id="comm_type_of_unit">
                                                        <option selected="" disabled="">-Select Type of Unit -</option>
                                                        <option value="1">Create a unit with Multiple Floors</option>
                                                        <option value="2">Create a unit with Multiple Units</option>
                                                    </select>
                                                </div>
                                                 <div class="col-auto ">
                                                    <label for="" class="form-label">  <span class="errorcl"></span></label>
                                                    <input type="button" name="" value="Save" class="btn btn-success mt-4" id="" placeholder="">
                                                </div>
                                               <!-- <div class="col-auto d-none commercial-office-child commercial-tou-children">-->
                                               <!--     <label for="" class="form-label">  <span class="errorcl">*</span></label>-->
                                               <!--     <select class="form-select" name="" id="comm_type_of_unit_child_dd">-->
                                               <!--         <option selected="" disabled="">-Select -</option>-->
                                               <!--         <option value="occupied">Occupied</option>-->
        			                                    <!--<option value="vacant">Vacant</option>-->
                                               <!--     </select>-->
                                               <!-- </div>-->
                                               <!-- <div class="col-auto d-none commercial-occupied-child commercial-tou-name-children">-->
                                               <!--     <label for="" class="form-label">  <span class="errorcl">*</span></label>-->
                                               <!--     <input type="text" name="" class="form-control" id="" placeholder="Please enter occupant Name">-->
                                               <!-- </div>-->
                                            </div>
                                            
                                    	</div>
                                    </div>
                                    
                                <div class="multi-unit">
                                	<div class="row multi-unit multi-unit-fields-child d-none">
                                		<div class="col-xxl-3 col-md-3 mt-3 no_of_floors">
                                			<div>
                                				<label for="" class="form-label">No of Floors<span class="errorcl">*</span></label>
                                				<input type="text" name="no_of_floors" class="form-control " data-parent="multi-unit" id="">
                                			</div>
                                		</div>	
                                		<div class="row gx-2 mt-3 py-2 align-items-center bg-primary text-white">
                                                <div class="col-auto">
                                                    <!--<label for="inputPassword6" class="col-form-label"> Select Units </label>-->
                                                </div>
                                                
                                                <div class="col-auto">
                                                    <label for="" class="form-label"> Type of Unit <span class="errorcl">*</span></label>
                                                    <select class="form-select" name="" id="comm_type_of_unit">
                                                        <option selected="" disabled="">-Select Type of Unit -</option>
                                                        <option value="1">Create a unit with Multiple Floors</option>
                                                        <option value="2">Create a unit with Multiple Units</option>
                                                    </select>
                                                </div>
                                              
                                                <div class="col-auto ">
                                                    <label for="" class="form-label">  <span class="errorcl"></span></label>
                                                    <input type="button" name="" value="Save" class="btn btn-success mt-4" id="" placeholder="">
                                                </div>
                                            </div>
                                	</div>
                                </div>
                                    
                                    
                                <div class="plot-land">
                                	<div class="row plot-land-open-plot plot-land-fields-child d-none">
                                		
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Plot Name <span class="errorcl">*</span></label>
                                				<input type="text" name="plot_name" class="form-control" id="">
                                			</div>
                                		</div>
                                		
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Plot No<span class="errorcl">*</span></label>
                                				<input type="text" name="plot_no" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Street Name/No/Road No<span class="errorcl">*</span></label>
                                				<input type="text" name="street_name" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
                                				<input type="text" name="locality_name" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Owner Full Name <span class="errorcl">*</span></label>
                                				<input type="text" name="owner_name" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Contact No<span class="errorcl">*</span></label>
                                				<input type="text" name="conatact_no" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				
                                				<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                				<label class="form-check-label" for="flexCheckDefault">
                                					Boundary Wall/Fencing available
                                				</label>
                                				
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                				<label class="form-check-label" for="flexCheckDefault">
                                					Any Legal Litigation board
                                				</label>
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                				<label class="form-check-label" for="flexCheckDefault">
                                					Ownership claim board
                                				</label>
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                				<label class="form-check-label" for="flexCheckDefault">
                                					Bank auction board
                                				</label>
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                				<label class="form-check-label" for="flexCheckDefault">
                                					For Sale/Lease Board
                                				</label>
                                			</div>
                                		</div>
                                	</div>
                                	<div class="row plot-land-gated-community plot-land-fields-child d-none">
                                
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Project Name<span class="errorcl">*</span></label>
                                				<input type="text" name="project_name" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Builder Name<span class="errorcl">*</span></label>
                                				<input type="text" name="builder_name" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Contact No<span class="errorcl">*</span></label>
                                				<input type="text" name="contact_no" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">House No<span class="errorcl">*</span></label>
                                				<input type="text" name="house_no" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Plot No<span class="errorcl">*</span></label>
                                				<input type="text" name="plot_no" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Street Name/No/Road No<span class="errorcl">*</span></label>
                                				<input type="text" name="street_name" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
                                				<input type="text" name="locality_name" class="form-control" id="">
                                			</div>
                                		</div>
                                
                                	</div>
                                </div>
                                
                                <div class="under-construction">

                                	<div class="row under-construction-pfrm under-construction-fields-child d-none">
                                
                                		<div class="col-xxl-3 col-md-3 mt-3 ">
                                			<div>
                                				<label for="" class="form-label">under construction Types <span class="errorcl">*</span></label>
                                				<select class="form-select" name="category" id="">
                                					<option selected="" disabled="">-Select under construction Types-</option>
                                					<option value="residential">Residential </option>
                                					<option value="commercial">Commercial</option>
                                					<option value="multi-unit">multi-unit</option>
                                				</select>
                                			</div>
                                		</div>
                                
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Project Name<span class="errorcl">*</span></label>
                                				<input type="text" name="project_name" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Builder Name<span class="errorcl">*</span></label>
                                				<input type="text" name="builder_name" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Contact No<span class="errorcl">*</span></label>
                                				<input type="text" name="contact_no" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">House No<span class="errorcl">*</span></label>
                                				<input type="text" name="house_no" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Plot No<span class="errorcl">*</span></label>
                                				<input type="text" name="plot_no" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Street Name/No/Road No<span class="errorcl">*</span></label>
                                				<input type="text" name="street_name" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
                                				<input type="text" name="locality_name" class="form-control" id="">
                                			</div>
                                		</div>
                                
                                	</div>
                                
                                </div>
                                
                                <div class="demolished">
                                
                                	<div class="row demolished demolished-fields-child d-none">
                                
                                
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">House No<span class="errorcl">*</span></label>
                                				<input type="text" name="house_no" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Plot No<span class="errorcl">*</span></label>
                                				<input type="text" name="plot_no" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Street Name/No/Road No<span class="errorcl">*</span></label>
                                				<input type="text" name="street_name" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Colony/Locality Name<span class="errorcl">*</span></label>
                                				<input type="text" name="locality_name" class="form-control" id="">
                                			</div>
                                		</div>
                                		<div class="col-xxl-3 col-md-3 mt-3">
                                			<div>
                                				<label for="" class="form-label">Contact No<span class="errorcl">*</span></label>
                                				<input type="text" name="contact_no" class="form-control" id="">
                                			</div>
                                		</div>
                                
                                	</div>
                                
                                </div>
                                
                                <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="files" class="form-label">
                                                Capture Property Images 
                                                <span
                                                    class="errorcl">*</span></label>
                                            <div class="d-flex justify-content-center flex-column " >
                                                <input type="file" name="files[]" id="files" class="form-control"
                                                    multiple placeholder=" " style="display:none;">
                                                    <label for="files" class="form-label btn btn-secondary "> <span class="mdi mdi-plus "></span><span> Capture Property Images</span></label>
                                                @error('files')
                                                    <span class="input-error" style="color: red">{{ $message }}</span>
                                                @enderror
                                                @error('files.*')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>@php print_r($message); @endphp</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>
                                <div class="col-xxl-12 col-md-12 mt-3">
                                        <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap">

                                        </div>
                                    </div>
                                <div class="col-xxl-12 col-md-12 mt-3">
                                        <div>
                                            <label for="" class="form-label">Remarks </label>
                                            <textarea name="remarks" class="form-control" rows="3" value="{{ old('remarks') }}"></textarea>
                                        </div>
                                    </div>
                                <div class="text-end mt-4">
                                    <button type="submit"
                                        class="btn btn-warning waves-effect waves-light w_100">Submit</button>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>
            </form>
            <!--end row-->

        </div> <!-- container-fluid -->
    </div>

    <div class="modal fade" id="create_success" aria-labelledby="exampleModalToggleLabel" tabindex="-1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="success alert">
                            <div class="alert-body">
                                <h2>Property Added Successfully</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


<script>
</script>
    <input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu"> -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->
	<!-- <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
	
    <script>
        var floorNames = [];
        $(document).on('keyup', "input[name=nth_floor_name]", function(){
            floorNames = [];
            $("input[name=nth_floor_name]").each(function(i){
                floorNames.push({"id": i, "text" : $(this).val()});
            });
            console.log(floorNames);
            $(".commercial-select2").empty();
            $.each( floorNames, function( key, value ) {
                $(".commercial-select2").append('<option value="5">'+value.text+'</option>');
            });
            //  $(".js-select2").append('<option value="5">Twitter</option>');
        });
        
        var ddOptionsObj = {
            commercial : {
                vacant : {
                    fields : ['person_name', 'mobile_number']
                },
                occupied : {
                    options : ['Office', 'Retail Space', 'Hospitals'],
                    retial_space : ["Educational Institutional", "Supermarket", "Cloth Shop" ]
                }
            },
            multi_unit : [] 
        }
        
        $(".commercial-select2").select2({
			closeOnSelect : false,
			placeholder : "select units",
			allowHtml: true,
			allowClear: true,
		});

         $(document).on('change', '#category', function(e) {
            let id = $(this).val();
            
             $('.residential-fields-child').each(function(){
                if($(this).hasClass('d-none') == false){
                    $(this).addClass('d-none');
                }
            })
            
            if($(this).attr('id') == 'category'){
                let c_id = id;
                if(c_id == 2){
                    $('.residential_blks').removeClass('d-none')
                    $('.resid_apart').toggleClass('d-none')
                    $('.resid_inhandv').toggleClass('d-none')
                    $('.apart_inhandv').toggleClass('d-none')
                }
                if(c_id != 2){
                    $('.residential_blks').addClass('d-none')
                }
                (c_id == 1) ? $('.commercial-fields-child').removeClass('d-none') : '' ;
                if(c_id != 1) { 
                    $('.commercial-fields-child').addClass('d-none') 
                    $(".commercial-select2").empty();
                }
                (c_id == 3) ? $('.multi-unit-fields-child').removeClass('d-none') : $('.multi-unit-fields-child').addClass('d-none') ;
                if(c_id == 4) { 
                    $('.plot_land_blks').removeClass('d-none');
                }
                
                if(c_id != 4) { 
                    $('.plot-land-fields-child').each(function(){
                        if($(this).hasClass('d-none') == false){
                          $(this).addClass('d-none');
                        }
                    });
                     $('.plot_land_blks').addClass('d-none');
                }
                
                (c_id == 5) ? $('.under-construction-fields-child').removeClass('d-none') : '' ;
                (c_id != 5) ? $('.under-construction-fields-child').addClass('d-none') : '' ;
                
                (c_id == 6) ? $('.demolished-fields-child').removeClass('d-none') : $('.demolished-fields-child').addClass('d-none') ;
        
                
                
            }
        });
        function showCheckboxes() {
          var checkboxes = document.getElementById("checkboxes");
          if (checkboxes.style.display === "block") {
            checkboxes.style.display = "none";
          } else {
            checkboxes.style.display = "block";
          }
        }
        
        $(document).on('change', '#residential_types', function(e) {
            let resChild = $(this).val();
            $('.residential-child').each(function(){
                if($(this).hasClass(resChild+'-child') == false){
                    if($(this).hasClass('d-none') == false){
                       $(this).addClass('d-none');
                    }
                }
                if($(this).hasClass(resChild+'-child') == true){
                    if($(this).hasClass('d-none') == true){
                       $(this).removeClass('d-none');
                    }
                }
            })
        });
        
        $(document).on('change', '#comm_type_of_unit', function(){
            ($(this).val() == 1) ? $('.floor-chk').removeClass('d-none') : $('.floor-chk').addClass('d-none') ;
            ($(this).val() == 2) ? $('.unit-chk').removeClass('d-none') : $('.unit-chk').addClass('d-none') ;
            // let dependentDdown = $(this).val();
            // dependentDdown = dependentDdown.toLowerCase();
            // (dependentDdown == 'office') ? $('.commercial-'+dependentDdown+'-child').removeClass('d-none') : $('.commercial-tou-children').addClass('d-none') ;
        });
        $(document).on('change', '#comm_type_of_unit_child_dd', function(){
            let dependentDdown = $(this).val();
            dependentDdown = dependentDdown.toLowerCase();
            (dependentDdown == 'occupied') ? $('.commercial-'+dependentDdown+'-child').removeClass('d-none') : $('.commercial-tou-name-children').addClass('d-none') ;
        });
        
        $(document).on('change', '#plot_land_types', function(e) {
            let resChild = $(this).val();
            $('.plot-land-fields-child').each(function(){
                if($(this).hasClass(resChild) == false){
                    if($(this).hasClass('d-none') == false){
                       $(this).addClass('d-none');
                    }
                }
                if($(this).hasClass(resChild) == true){
                    if($(this).hasClass('d-none') == true){
                       $(this).removeClass('d-none');
                    }
                }
            })
        });
        
        $(document).on('change', '#residential_sub_types', function(e) {
            let enabled_blocks = $(this).val();
            $('.residential-fields-child').each(function(){
                if($(this).hasClass(enabled_blocks) == false){
                    if($(this).hasClass('d-none') == false){
                       $(this).addClass('d-none');
                    }
                }
                if($(this).hasClass(enabled_blocks) == true){
                    if($(this).hasClass('d-none') == true){
                       $(this).removeClass('d-none');
                    }
                }
            })
        });
        
        $(document).on('keyup', "input[name=no_of_floors]", function(){
           $('.floor_no_child').remove();
           $('.name_of_unit_child').remove();
           
            let count = $(this).val();
            let str = '';
            var totalFloors = '';
            if(count > 100){
                toastr.error('please enter valid floor count');
                return false
            }
            let parentCat = $(this).data('parent');
            
            for(var i = 1; i <= count; i++){
              var totalFloors =  totalFloors+""+'<div class="row gx-2 mt-3 py-2 align-items-center floor_no_child bg-primary text-white"><div class="col-auto"><input class="form-check-input floor-chk d-none" type="checkbox" value="" id="flexCheckDefault"></div><div class="col-auto">'+
                                                    '<label for="inputPassword6" class="form-label">No of Units per Floor '+ i +'</label></div>'+
                                                  '<div class="col-md-3 col-lg-1">'+
                                                    '<input type="text" id="" data-pid="'+i+'" name="name_of_unit" data-parent-cat="'+parentCat+'" class="form-control" aria-describedby=""></div>'+
                                                  '<div class="col-auto"><span id="" class="form-text">Please Enter between 1-10 units.</span>'+
                                                  '</div></div>';
            }
            $(totalFloors).insertAfter( $(this).closest(".no_of_floors") );
        });
        
        $(document).on('keyup', "input[name=name_of_unit]", function(){
          
            let pId = $(this).data('pid');
            $('.nouc-'+pId).remove();
            let count = $(this).val();
            let str = '';
            var totalFloors = '';
            if(count > 10){
                toastr.error('please enter valid unit count');
                return false
            }
            let parentPropCat = $(this).data('parent-cat');
            if(parentPropCat == 'multi-unit'){
                for(var i = 1; i <= count; i++){
                  var totalFloors =  totalFloors+""+'<div class="row gx-2 mt-3 py-2 align-items-center name_of_unit_child nouc-'+pId+' bg-success text-white"><div class="col-auto"><input class="form-check-input unit-chk d-none" type="checkbox" value="" id="flexCheckDefault"></div>'+
                                                  '<div class="col-md-3 col-lg-3"><label for="inputPassword6" class="form-label">Name of Unit '+ i +'</label>'+
                                                    '<input type="text" name="nth_floor_name" data-pid="'+i+'" class="form-control" id=""></div>'+
                                                  '<div class="col-auto append-dd-to"><label for="" class="form-label"> Unit Type <span class="errorcl">*</span></label>'+
                                				'<select class="form-select  " data-suid="'+i+'" data-pid="'+pId+'" name="" id="" data-append-options="Office&Retail Space&Hospitals">'+
                                					'<option selected="" disabled="">-Select -</option>'+
                                					'<option value="residential">Residential</option>'+
                                					'<option value="commercial">Commercial</option>'+
                                				'</select></div><div class="col-auto append-dd-to"><label for="" class="form-label"> Unit Type <span class="errorcl">*</span></label>'+
                                				'<select class="form-select append-dd " data-suid="'+i+'" data-pid="'+pId+'" name="" id="" data-append-options="Office&Retail Space&Hospitals">'+
                                					'<option selected="" disabled="">-Select -</option>'+
                                					'<option value="vacant">vacant</option>'+
                                					'<option value="occupied">occupied</option>'+
                                				'</select></div></div>';
                } 
            }
            if(parentPropCat == 'commercial'){
                for(var i = 1; i <= count; i++){
                  var totalFloors =  totalFloors+""+'<div class="row gx-2 mt-3 py-2 align-items-center name_of_unit_child nouc-'+pId+' bg-success text-white"><div class="col-auto"><input class="form-check-input unit-chk d-none" type="checkbox" value="" id="flexCheckDefault"></div>'+
                                                  '<div class="col-md-3 col-lg-3"><label for="inputPassword6" class="form-label">Name of Unit '+ i +'</label>'+
                                                    '<input type="text" name="nth_floor_name" data-pid="'+i+'" class="form-control" id=""></div>'+
                                                  '<div class="col-auto append-dd-to"><label for="" class="form-label"> Unit Type <span class="errorcl">*</span></label>'+
                                				'<select class="form-select append-dd " data-suid="'+i+'" data-pid="'+pId+'" name="" id="" data-append-options="Office&Retail Space&Hospitals">'+
                                					'<option selected="" disabled="">-Select -</option>'+
                                					'<option value="vacant">vacant</option>'+
                                					'<option value="occupied">occupied</option>'+
                                				'</select></div></div>';
                } 
            }
            else{
                // for(var i = 1; i <= count; i++){
                //   var totalFloors =  totalFloors+""+'<div class="col-xxl-3 col-md-3 mt-3 name_of_unit_child nouc-'+pId+'"><div>'+
                //                             				'<label for="" class="form-label">Name of Unit '+ i +'<span class="errorcl">*</span></label>'+
                //                             				'<input type="text" name="nth_floor_name" data-pid="'+i+'" class="form-control" id="">'+
                //                             	    '</div></div>';
                // }
            }
            
            $(totalFloors).insertAfter( $(this).closest(".floor_no_child") );
        });

        $(document).on('change', '.append-dd', function(){
            let dataOptions = $(this).data('append-options');
            var totalOptions = '';
            let dataPid = $(this).data('pid');
            let dataSuid = $(this).data('suid');
            
            let cCode = '';
            let typeCode = '';
            $('.append-dd-p-rem-child_sub'+'-'+dataPid+'-'+dataSuid).remove();
            // $('.append-dd-p-rem-child'+'-'+dataPid+'-'+dataSuid).remove();
            // $('.append-dd-p-rem-child'+'-'+dataPid+'-'+dataSuid).remove();
            if($(this).hasClass('dd-child')){
                let propCatObj = ['Office', 'Retail Space', 'Hospitals'];
                cCode = '-rem-child';
                if(!propCatObj.includes($(this).val())){
                    cCode = '-rem-child_sub';
                }
               
                if($(this).val() == 'Office'){
                    dataOptions =  ["",""];
                }
                if($(this).val() == 'Retail Space'){
                    dataOptions =  ["Supermarket", "Cloth Shop"];
                }
                let subChildTypeArr = ['Office', 'Retail Space'];
                if(!subChildTypeArr.includes($(this).val())){
                  typeCode = 'text';
                }
              $('.append-dd-p'+cCode+'-'+dataPid+'-'+dataSuid).remove();
            }else{
                 
                dataOptions = dataOptions.split('&');
                $('.append-dd-p'+cCode+'-'+dataPid+'-'+dataSuid).remove();
                $('.append-dd-p'+dataPid+"-"+dataSuid).remove();
                
            }
            let ddStr = '';
            if(typeCode == 'text'){
                ddStr = '<div class="col-auto append-dd-to  append-dd-p'+dataPid+'-'+dataSuid+' append-dd-p'+cCode+'-'+dataPid+'-'+dataSuid+'"   ><label for="" class="form-label">  <span class="errorcl">*</span></label>'+
                                    				'<input type="text" class="form-control append-dd dd-child" name="" id="" data-suid="'+dataSuid+'" data-pid="'+dataPid+'">'+
                                    				'</div>';
            }else{
                if($(this).val() == 'vacant'){
                     ddStr = '<div class="col-auto append-dd-to  append-dd-p'+dataPid+'-'+dataSuid+' append-dd-p'+cCode+'-'+dataPid+'-'+dataSuid+'" ><label for="" class="form-label"> Person Name <span class="errorcl">*</span></label>'+
                				'<input type="text" class="form-control append-dd dd-child" name="" id="" data-suid="'+dataSuid+'" data-pid="'+dataPid+'">'+
                				'</div>'+
                			'<div class="col-auto append-dd-to  append-dd-p'+dataPid+'-'+dataSuid+' append-dd-p'+cCode+'-'+dataPid+'-'+dataSuid+'" ><label for="" class="form-label"> Mobile Number <span class="errorcl">*</span></label>'+
                				'<input type="text" class="form-control append-dd dd-child" name="" id="" data-suid="'+dataSuid+'" data-pid="'+dataPid+'">'+
                				'</div>';
                   
                }else{
                    $.each( dataOptions, function( key, value ) {
                        totalOptions =  totalOptions+"<option value='"+value+"'>"+value+"</option>";
                    });
                    
                    ddStr = '<div class="col-auto append-dd-to  append-dd-p'+dataPid+'-'+dataSuid+' append-dd-p'+cCode+'-'+dataPid+'-'+dataSuid+'"   ><label for="" class="form-label">  <span class="errorcl">*</span></label>'+
                                        				'<select class="form-select append-dd dd-child" name="" id="" data-suid="'+dataSuid+'" data-pid="'+dataPid+'">'+totalOptions+
                                        				'</select></div>';
                }
               
                                    				
            }
                               				
            $(ddStr).insertAfter( $(this).closest(".append-dd-to") );
        });

        $(document).on('click', '.picklocation', function(e) {
            $.ajax({
                type: "GET",
                url: "{{ url('user_loc_details') }}",
                success: function(response) {
                    $('#city').val(response.cityName);
                    console.log(response.cityName)
                }
            });
        });

        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                  
                var files = e.target.files,
                    filesLength = files.length;

                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("#files-preview").append("<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "<br/>" +
                            "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                            "</span>");
                        $(".remove").click(function() {
                            $(this).parent(".image-area").remove();
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

        function getCordinates() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    $('#latitude').val(lat);
                    $('#longitude').val(lon);

                });
            } else {
                toastr.error("Geolocation is not supported by this browser.");
            }
        }

        if (performance.navigation.type == 2) {
            // location.reload();
        }
        $('#create_success').on('hidden.bs.modal', function() {
            // location.reload();
        });
        
        $(document).on('submit','#create_property', function(){
            // alert()
        //   let opCount = $('#sub_category option').size();
        //   alert(opCount)
        })
        
        //  
    </script>
    <script>
        @foreach ($errors->all() as $error)
            // toastr.error("{{ $error }}")
        @endforeach
        @if (Session::has('message'))
            $(function() {
                $('#create_success').modal('show');
            })
        @endif
    </script>
    {{-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&sensor=false"></script> --}}



    <script>
    
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -33.8688,
                    lng: 151.2195
                },
                zoom: 13
            });

            var input = document.getElementById('searchInput');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['(cities)']
            });

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry.location.lat())
                $('#longitude').val(place.geometry.location.lng())
            });
            
        }
        var input1 = document.getElementById('searchInput');
        input1.addEventListener('blur', function() {
            // timeoutfunction allows to force the autocomplete field to only display the street name.


            setTimeout(function() {
                let s = input1.value;
                let cityName = s.split(',')[0];
                input1.value = cityName;
            }, 500);

        });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&callback=initMap"
        async defer></script>
    <script>
        function isNumber(evt) {

            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
   
    @endpush
