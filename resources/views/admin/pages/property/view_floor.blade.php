{{--@forelse($floors as $floor_key=>$floor)
<div class="row gx-2 mt-3 py-2 align-items-center floor_no_child storey pfloor-{{$floor_key}} rounded border border-dark">
<input disabled type="hidden" class="" name="floor_id[]" id="floor_id" value="{{$floor->id ?? 0}}">
@if($floor->merge_parent_floor_id != NULL)
<!--<div class="floor-mask"></div>-->
<div class="row">
    <div class="merged-notch">
        <div class="notch">
            Merged With Floor {{ $floor_index[$floor->merge_parent_floor_id] + 1 }}
        </div>
    </div>
</div>
@endif
@if(in_array($floor->id, $parent_floors))
<div class="row">
    <div class="merged-notch">
        <div class="unit-notch bg-dark">
            Parent Floor
        </div>
    </div>
</div>
@endif
<div class="row floor-dds_row">


    <div class="col-md-2 storey-nou-child">
        <div>
            <label for="" class="form-label">No of Units per Floor {{$floor_key+1}}<span class="errorcl">*</span></label>
            <div class="input-group">
                <input disabled type="text" value="{{$floor->units}}" class="form-control form-control-sm no_of_units" data-pid="{{$floor_key}}" name="nth_unit[]" placeholder="0" aria-label="" aria-describedby="button-addon2">
            </div>
        </div>
    </div>

    <div class="col-md-2 storey-nou-child">
        <div>
            <label for="" class="form-label"> Floor Name <span class="errorcl">*</span></label>
            <div class="input-group">
                <input disabled type="text" value="{{$floor->floor_name}}" class="form-control form-control-sm no_of_units" data-pid="{{$floor_key}}" name="nth_unit[]" placeholder="0" aria-label="" aria-describedby="button-addon2">
            </div>
        </div>
    </div>
    @if($floor->units === 0 || $floor->units === 1)
    @forelse($units as $key=>$f_unit)
    @if($floor->id == $f_unit->floor_id)
    {{$floor->unit_cat_type_id}}
    @if($floor->unit_cat_type_id == 3)
    <div class="col-auto append-dd-to">
        <label for="" class="form-label"> Property Type <span class="errorcl">*</span></label>
        <select disabled class="form-select form-select-sm select2-dd " data-suid="1" data-pid="1" name="prop_category[]" id="">
            <option disabled selected>-- select Category --</option>
            @forelse($prop_categories->take(2) as $prop_category)
            <option value="{{$prop_category->id}}">{{$prop_category->cat_name}}</option>
            @empty

            @endforelse
        </select>
    </div>
    @endif

    <div class="col-auto append-dd-to">
        <label for="" class="form-label"> Unit Type <span class="errorcl">*</span></label>
        <select disabled class="form-select form-select-sm append-dd select2-dd floor_unit_type_dd floor_ddopt" data-fid="{{$floor_key}}" name="unit_type[{{$floor_key}}]" id="">
            <option selected="" disabled="">-Select -</option>
            @forelse($unit_categories as $unit_category_type)
            <option data-field="{{$unit_category_type->field_type}}" @if($unit_category_type->id == $f_unit->unit_type_id) selected @endif value="{{$unit_category_type->id}}">{{$unit_category_type->name}}</option>
            @empty

            @endforelse
        </select>
    </div>
    <div class="col-md-3 col-lg-3 residential-floor-name-{{$floor_key}} d-none">
        <label for="inputPassword6" class="form-label"></label>
        <input disabled type="text" id="" data-pid="{{$floor_key}}" name="[]" data-parent-cat="'+parentCat+'" class="form-control " aria-describedby="">
    </div>
    
    @if($property_cat_id != 2 && $f_unit->unit_type_id == 2 )
        @if(($property_cat_id == 3 && $f_unit->unit_cat_type_id == 1 && $unit->unit_type_id == 2) || in_array($property_cat_id, [1,4,5,6]))
    @if($f_unit->unit_cat_id != 0 && !empty($f_unit->unit_cat_id))
        <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-1-1 floor_unit_occupied_type-{{$floor_key}} @if($f_unit->unit_type_id == 2) @else d-none @endif">
            <label for="" class="form-label"> Category <span class="errorcl">*</span></label>
            <select disabled class="form-select form-select-sm append-dd dd-child select2-dd floor_ddopt" name="fu_category[{{$floor_key}}]" id="">

                @forelse($unit_category_list as $unit_category)

                <option data-field="{{$unit_category->field_type}}" @if($f_unit->unit_cat_id == $unit_category->id) selected @endif value="{{$unit_category->id}}">{{$unit_category->name}}</option>

                @empty

                @endforelse

            </select>
        </div>
        @endif
        @if($f_unit->unit_sub_cat_id != 0 && !empty($f_unit->unit_sub_cat_id))
        <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child-1-1 floor_unit_occupied_type-{{$floor_key}} @if($f_unit->unit_type_id == 2) @else d-none @endif">
            <label for="" class="form-label"> Sub Category <span class="errorcl">*</span></label>
            <select disabled class="form-select form-select-sm append-dd dd-child select2-dd floor_ddopt" name="fu_sub_category[{{$floor_key}}]" id="">
                @forelse($unit_sub_category_list as $unit_category)
                <option data-field="{{$unit_category->field_type}}" @if($f_unit->unit_sub_cat_id == $unit_category->id) selected @endif value="{{$unit_category->id}}">{{$unit_category->name}}</option>
                @empty
                @endforelse
            </select>
        </div>
        @endif
        @if(!empty($f_unit->unit_brand_id) || !empty($f_unit->brand_name))
        <div class="col-auto append-dd-to  append-dd-p1-1 append-dd-p-rem-child_sub-1-1 floor_unit_occupied_type-{{$floor_key}} @if($f_unit->unit_type_id == 2) @else d-none @endif">
            <label for="" class="form-label"> Brand <span class="errorcl">*</span> </label>
            <select disabled class="form-select form-select-sm append-dd dd-child select2-dd floor_ddopt" name="floor_brand[{{$floor_key}}]" id="" data-suid="1" data-pid="1">
                @if(empty($f_unit->unit_brand_id) && empty($f_unit->brand_name))<option selected="" disabled="">-Select Category-</option>@endif
                @if($f_unit->unit_brand_id == 0)
                @if(isset($custom_brands))
                @forelse($custom_brands->unique('brand_name') as $custom_brand)
                @if($custom_brand->brand_name != '' )
                <option data-field="{{$unit_category->field_type}}" @if($f_unit->brand_name == $custom_brand->brand_name) selected @endif value="{{$unit_category->id}}">
                    {{ ($custom_brand->brand_name != 0) ? $custom_brand->brand_name : '' }}
                </option>
                @endif
                @empty
                @endforelse
                @endif
                @else
                @forelse($brands as $unit_category)
                <option data-field="{{$unit_category->field_type}}" @if($f_unit->unit_brand_id == $unit_category->id) selected @endif value="{{$unit_category->id}}">{{$unit_category->name}}</option>
                @empty

                @endforelse
                @endif
            </select>

        </div>
        @endif
    @endif
    @endif
    <div class="col-md-3 col-lg-3 unit-tfd floor_unit_vacant_type-{{$floor_key}} @if($f_unit->unit_type_id == 1) @else d-none @endif">
        <label for="" class="form-label">Concerned Person Name</label>
        <input disabled type="text" value="{{$f_unit->person_name}}" id="" data-pid="{{$floor_key}}" name="person_name[{{$floor_key}}]" data-parent-cat="'+parentCat+'" class="form-control form-control-sm" aria-describedby="">
    </div>
    <div class="col-md-3 col-lg-3 unit-tfd floor_unit_vacant_type-{{$floor_key}} @if($f_unit->unit_type_id == 1) @else d-none @endif">
        <label for="" class="form-label">Mobile</label>
        <input disabled type="text" value="{{$f_unit->mobile}}" id="" data-pid="{{$floor_key}}" name="mobile[{{$floor_key}}]" data-parent-cat="'+parentCat+'" class="form-control form-control-sm" aria-describedby="">
    </div>
    @break
    @endif
    @empty
    @endforelse
    @endif
</div>


<div class="unit-container">
    @if($floor->units > 0 )
    @include('admin.pages.property.view_unit', ['units' => $units, 'floor_Key' => $floor_key , 'floor_id' => $floor->id])
    @endif
</div>

</div>
@empty
@endforelse--}}


<div class="">
    <div class="">
        <div class="">
            @forelse($floors as $floor_key=>$floor)
            <div class="accordion my-1" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne{{$floor_key}}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$floor_key}}" aria-expanded="<?php if ($floor_key == 0) echo 'true'; ?>" aria-controls="collapseOne">
                            {{$floor->floor_name ?? 'floor'.$floor_key+1}}
                        </button>
                    </h2>
                    <div id="collapseOne{{$floor_key}}" class="accordion-collapse collapse show" aria-labelledby="headingOne{{$floor_key}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row">
                                @if($floor->units > 0 )
                                @include('admin.pages.property.view_unit', ['units' => $units, 'floor_Key' => $floor_key , 'floor_id' => $floor->id])
                                @endif
                                @if($floor->units == 0 )

                                @forelse($units as $key=>$f_unit)
                                @if($floor->id == $f_unit->floor_id)
                                {{$floor->unit_cat_type_id}}

                                <div class="col-md-3">
                                    <a href="{{url('surveyor/property/unit_details')}}/{{$f_unit->id}}" class="active activeCard">
                                        <div class="card">
                                            <div class="card-body Unit_MainDetails">
                                                @if($floor->merge_parent_floor_id != NULL)
                                                <div class="card-header"><strong> Merged With Floor {{ $floor_index[$floor->merge_parent_floor_id] + 1 }} </strong></div>
                                                @endif
                                                @if(in_array($floor->id, $parent_floors))
                                                <div class="card-header"><strong> Parent Floor </strong></div>
                                                @endif

                                                <div class="">
                                                    
                                                    @if($property->cat_id  == 3)
                                                    <div class="Unit_Details"><span>Property Type : </span> <span>
                                                            @forelse($prop_categories->take(2) as $prop_category)
                                                            @if($prop_category->id == $f_unit->unit_cat_type_id) {{$prop_category->cat_name}} @endif
                                                            @empty
                                                            @endforelse
                                                        </span> 
                                                    </div>
                                                    @endif 
                                                    <div class="Unit_Details"><span>Unit name :</span> 
                                                        <span>{{$floor->floor_name ?? 'floor'.$floor_key+1}}</span> 
                                                    </div>  
                                                    <div class="Unit_Details"><span>Unit Type : </span> <span>
                                                            @forelse($unit_categories as $unit_category_type)
                                                            @if($unit_category_type->id == $f_unit->unit_type_id) {{$unit_category_type->name}} @endif
                                                            @empty
                                                            @endforelse
                                                        </span> </div>
                                                    @if($property->cat_id != 2 && $f_unit->unit_type_id == 2 )
                                                        @if(($property->cat_id == 3 && $f_unit->unit_cat_type_id == 1 && $f_unit->unit_type_id == 2) || in_array($property->cat_id, [1,4,5,6]))
                                                        <div class="Unit_Details"><span>Category :</span> <span>
                                                                @if($f_unit->unit_cat_id != 0 && !empty($f_unit->unit_cat_id))
                                                                @forelse($unit_category_list as $unit_category)
                                                                @if($f_unit->unit_cat_id == $unit_category->id) {{$unit_category->name}} @endif
                                                                @empty
                                                                @endforelse
                                                                @endif
                                                            </span> 
                                                        </div>
                                                        <div class="Unit_Details"><span>Sub-Category :</span> <span>
                                                                @if($f_unit->unit_sub_cat_id != 0 && !empty($f_unit->unit_sub_cat_id))
                                                                    @forelse($unit_sub_category_list as $unit_category)
                                                                    @if($f_unit->unit_sub_cat_id == $unit_category->id) {{$unit_category->name}} @endif
                                                                    @empty
                                                                    @endforelse
                                                                @else 
                                                                    N/A
                                                                @endif
                                                            </span> 
                                                        </div>
                                                        <div class="Unit_Details"><span>Brand :</span> <span>
                                                            @if(empty($f_unit->unit_brand_id) && empty($f_unit->brand_name)) N/A @endif
                                                                @if($f_unit->unit_brand_id == 0 && !empty($f_unit->brand_name))
                                                                    {{$f_unit->brand_name}}
                                                                @endif
                                                                @forelse($brands as $unit_category)
                                                                    @if($unit_category->parent_id == $f_unit->unit_sub_cat_id)
                                                                       {{$unit_category->name}}
                                                                    @endif
                                                                @empty
                                                                @endforelse
                                                            </span> 
                                                        </div>
                                                        @endif
                                                    @endif
                                                    <div class="Unit_Details"><span>Concerned Person Name :</span> <span>{{(isset($f_unit->person_name) && !empty($f_unit->person_name)) ? $f_unit->person_name : 'N/A'}}</span> </div>
                                                    <div class="Unit_Details"><span>Mobile Number :</span> <span>{{(isset($f_unit->mobile) && !empty($f_unit->mobile)) ? $f_unit->mobile : 'N/A'}}</span> </div>
                                                </div>
                                                @if($f_unit->up_for_sale == 1 || $f_unit->up_for_rent == 1)
                                                    <div class="d-flex align-items-center justify-content-between mt-1 mb-1">
                                                        @if($f_unit->up_for_sale == 1)<img src="{{url('public/assets/images/for-sale.png')}}" class="img-fluid" style="width: 46px;"> @endif
                                                        @if($f_unit->up_for_rent == 1)<img src="{{url('public/assets/images/for-rent.png')}}" class="img-fluid" style="width: 46px;"> @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                @break
                                @endif
                                @empty
                                @endforelse
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</div>