
{{-- <form id="PricingDetailsForm" action="POST">
    @csrf
    <input type="hidden" name="property_id" value="{{$property->id}}">
    <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">
    <input type="hidden" name="unit_id" value="{{$unit_data->id}}">
    <input type="hidden" name="unit_type_id" value="{{$unit_data->unit_type_id}}">
    <input type="hidden" name="unit_cat_id" value="{{$unit_data->unit_cat_id}}">
    <input type="hidden" name="unit_sub_cat_id" value="{{$unit_data->unit_sub_cat_id}}">
    <div class="screen ">
        <div class="card1">
            <div class="card-body">
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
                <div class="">
                    <h4 class="mb-3 required">Pricing &amp; Other Details</h4>
                    <div class="row align-items-center mb-2">

                        <div class="col-md-12 mb-3">
                            <div class="radio-toolbar-text required">
                                <input type="radio" id="ForSale" name="pricing_details_for" onclick="document.getElementById('Type').value=1" value="1">
                                <label for="ForSale">For Sale</label>
                                <input type="radio" id="ForRent" name="pricing_details_for" onclick="document.getElementById('Type').value=2" value="2">
                                <label for="ForRent">For Rent</label>
                            </div>
                            <span id="errpricing_details_for"></span>
                        </div>
                    </div>
                    <!-- <input type=" text" name="pricing_details_for" id=" Type" value=""> -->


                    <div class="row align-items-center mb-2" id="OwnnershipClone" style="display:none">
                        <label class="form-label">Ownership Details <span style="color:red">*</span></label>

                        <div class="col-md-12 mb-3">
                            <div class="radio-toolbar-text">
                                @forelse($ownerships as $owner)
                                <input type="radio" id="radior{{$owner->id}}" name="ownership" value="{{$owner->id}}">
                                <label for="radior{{$owner->id}}">{{$owner->name}}</label>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="row align-items-center mb-3" id="PriceDetailsClone" style="display:none">
                        <label class="form-label required">Price Details <span style="color:red">*</span> </label>
                        <div class="col-md-4">

                            <input type="text" class="form-control" id="" name="expected_price" placeholder="Expected Price">

                        </div>

                        <div class="col-md-3">

                            <input type="text" class="form-control" id="" name="price_per_sq_ft" placeholder="Price per Sq feet">

                        </div>

                        <div class="clearfix mt-3"></div>

                        @forelse($price_details as $price_detail)
                        <div class="col-md-2 simplecheck mb-3">
                            <span><input type="checkbox" name="price_details[]" value="{{$price_detail->id}}"> {{$price_detail->name}}</span>
                        </div>
                        @empty
                        @endforelse


                    </div>


                    <div class="row" id="AdditionalPrcingDetailsClone" style="display:none">
                        <label class="form-label">Additional Pricing Details </label> <small class=""><i>(Optional)</i></small>


                        <div class="col-md-4">

                            <div class="box-bdr">

                                <div class="row d-flex">

                                    <div class="col-md-7">

                                        <input type="text" class="form-control form-control-b0 col-md-3 border-none" name="mainteinance" id="" placeholder="Maintenance">

                                    </div>

                                    <div class="col-md-5 ms-auto" style="border-left: solid 1px #ddd">

                                        <select class="form-select form-control-b0" name="price_period">

                                            <option value="">Select</option>

                                            @forelse($price_details_periods as $price_period)
                                            <option value="{{$price_period->id}}">{{$price_period->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-2">

                            <input type="text" class="form-control border-none" name="expected_rental" id="" placeholder="Expected Rental">

                        </div>



                        <div class="col-md-8">

                            <div class="row">

                                <div class="col-md-4">

                                    <input type="text" class="form-control border-none" name="booking_amount" id="" placeholder="Booking Amount">

                                </div>

                                <div class="col-md-4">

                                    <input type="text" class="form-control border-none" name="annual_due_pay" id="" placeholder="Annual dues payble">

                                </div>

                                <div class="col-md-4">

                                    <input type="text" class="form-control border-none" name="membership_charge" id="" placeholder="Membership Charge">

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="clearfix mb-3"></div>
                    <div id="RemarksOnPropertyClone" style="display: none;">
                        <label class="form-label">Remarks on Property</label>
                        <textarea class="form-control" name="remark" rows="4"></textarea>
                    </div>

                    <!-- rental tab starts from here  -->
                    <div class="row align-items-center mb-2" id="AgreementTypeClone" style="display:none">
                        <label class="form-label required">Preferred Agreement Type</label>
                        <div class="col-md-12 mb-3">
                            <div class="radio-toolbar-text">
                                @forelse($agreement_types as $agrmnt_type)
                                <input type="radio" id="agrmnt_type-{{$agrmnt_type->id}}" name="agreement_type" value="{{$agrmnt_type->id}}">
                                <label for="agrmnt_type-{{$agrmnt_type->id}}">{{$agrmnt_type->name}}</label>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row align-items-center mb-3" id="RentDetailsClone" style="display:none">
                        <label class="form-label required">Rent Details <span style="color:red">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="" onkeypress="return isNumber(event)" name="expected_rent" placeholder="Expected Rent">
                        </div>

                        <div class="clearfix mt-3"></div>
                        @forelse($rent_details as $facility)
                        <div class="col-md-4 simplecheck mb-3">
                            <span><input type="checkbox" name="facility[]" value="{{$facility->id}}"> {{$facility->name}}</span>
                        </div>
                        @empty
                        @endforelse
                    </div>

                    <div class="row" id="AdditionalrentDetailClone" style="display:none">
                        <label class="form-label">Additional Rent Details </label> <small class=""><i>(Optional)</i></small>
                        <div class="col-md-12">
                            <div class="row ">
                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control col-md-3 " name="maintenance_rent" id="" placeholder="Maintenance ">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control col-md-3 " name="booking_amount_rent" id="" placeholder="Booking Amount ">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control col-md-3 " name="annual_dues_rent" id="" placeholder="Annuel Dues Payable  ">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control col-md-3 " name="membership_charge_rent" id="" placeholder="Membership Charge  ">
                                </div>

                            </div>

                        </div>


                        <!-- <div class="col-md-12" id="SecurityDepositClone" style="display:none">
                                                        <label class="form-label">Security Deposit <small class=""><i>(Optional)</i></small></label>
                                                        <div class="row">
                                                            @forelse($security_deposit as $sec_deposit)
                                                            <div class="col-md-2 simplecheck mb-3">
                                                                <input type="radio" id="security_deposit-{{$sec_deposit->id}}" name="security_deposit" value="{{$sec_deposit->id}}">
                                                                <label for="security_deposit-{{$sec_deposit->id}}">{{$sec_deposit->name}}</label>
                                                            </div>
                                                            @empty
                                                            @endforelse

                                                        </div>

                                                    </div> -->



                        <div class="clearfix mb-3"></div>

                        <div class="col-md-4 mb-3" id="AggrementDurationClone" style="display:none">

                            <label class="form-label">Duration of the Agreement </label>
                            <select class="form-select " name="agreement_duration">

                                <option value="">Select</option>
                                @for ($i = 0; $i <= 36; $i++) <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'month' : 'months' }}</option>
                                    @endfor
                            </select>

                        </div>

                        <div class="clearfix mb-3"></div>


                        <div class="col-md-12 mb-3" id="NoticeMonthClone" style="display:none">
                            <label class="form-label">Months of Notice </label>
                            <div class="radio-toolbar-text">
                                @forelse($notice_months as $notice)
                                <input type="radio" id="notice-{{$notice->id}}" name="notice_period" value="{{$notice->id}}">
                                <label for="notice-{{$notice->id}}">{{$notice->name}}</label>
                                @empty
                                @endforelse
                            </div>

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
    </div>
</form> --}}
<form id="PricingDetailsForm" action="POST">
    @csrf
    <input type="hidden" name="property_id" value="{{$property->id}}">
    <input type="hidden" name="property_cat_id" value="{{$property->cat_id}}">
    <input type="hidden" name="unit_id" value="{{$unit_data->id}}">
    <input type="hidden" name="unit_type_id" value="{{$unit_data->unit_type_id}}">
    <input type="hidden" name="unit_cat_id" value="{{$unit_data->unit_cat_id}}">
    <input type="hidden" name="unit_sub_cat_id" value="{{$unit_data->unit_sub_cat_id}}">
    <div class="screen ">
        <div class="card1">
            <div class="card-body">
                <div class="row mt-3 mb-3">
                    <div class="col-md-4">
                        <p><b>GIS Id : </b> <span class="project-head"> {{$property->gis_id}}</span></p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Locality Name : </b> <span class="project-head"> {{$property->locality_name}}</span></p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Address : </b> <span class="project-head"> {{$property->street_details}}</span></p>
                    </div>
                </div>
                <div class="">
                    <h4 class="mb-3 required">Pricing &amp; Other Details</h4>
                    <div class="row align-items-center mb-2">

                        <div class="col-md-12 mb-3">
                            <div class="radio-toolbar-text required">
                                <input type="radio" id="ForSale" name="pricing_details_for" @if($secondary_level_unit_data->pricing_details_for == 1) checked @endif onclick="document.getElementById('Type').value=1" value="1">
                                <label for="ForSale">For Sale</label>
                                <input type="radio" id="ForRent" name="pricing_details_for" @if($secondary_level_unit_data->pricing_details_for == 2) checked @endif  onclick="document.getElementById('Type').value=2" value="2">
                                <label for="ForRent">For Rent</label>
                            </div>
                            <span id="errpricing_details_for"></span>
                        </div>
                    </div>
                    <!-- <input type=" text" name="pricing_details_for" id=" Type" value=""> -->


                    <div class="row align-items-center mb-2" id="OwnnershipClone" style="display:none">
                        <label class="form-label">Ownership Details <span style="color:red">*</span></label>

                        <div class="col-md-12 mb-3">
                            <div class="radio-toolbar-text">
                                @forelse($ownerships as $owner)
                                <input type="radio" id="radior{{$owner->id}}" @if($secondary_level_unit_data->ownership == $owner->id) checked @endif name="ownership" value="{{$owner->id}}">
                                <label for="radior{{$owner->id}}">{{$owner->name}}</label>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="row align-items-center mb-3" id="PriceDetailsClone" style="display:none">
                        <label class="form-label required">Price Details <span style="color:red">*</span> </label>
                        <div class="col-md-4">

                            <input type="text" class="form-control" id="" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="expected_price" value="{{$secondary_level_unit_data->expected_price ?? ''}}" placeholder="Expected Price">

                        </div>

                        <div class="col-md-3">

                            <input type="text" class="form-control" id="" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="price_per_sq_ft" value="{{$secondary_level_unit_data->price_per_sq_ft ?? ''}}" placeholder="Price per Sq feet">

                        </div>

                        <div class="clearfix mt-3"></div>

                        @forelse($price_details as $price_detail)
                        <div class="col-md-2 simplecheck mb-3">
                            <span><input type="checkbox" name="price_details[]" @if(in_array($price_detail->id,$price_details_values)) checked @endif value="{{$price_detail->id}}"> {{$price_detail->name}}</span>
                        </div>
                        @empty
                        @endforelse


                    </div>


                    <div class="row" id="AdditionalPrcingDetailsClone" style="display:none">
                        <label class="form-label">Additional Pricing Details </label> <small class=""><i>(Optional)</i></small>


                        <div class="col-md-4">

                            <div class="box-bdr">

                                <div class="row d-flex">

                                    <div class="col-md-7">

                                        <input type="text" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control form-control-b0 col-md-3 border-none"  value="{{$secondary_level_unit_data->mainteinance ?? ''}}" name="mainteinance" id="" placeholder="Maintenance">

                                    </div>

                                    <div class="col-md-5 ms-auto" style="border-left: solid 1px #ddd">

                                        <select class="form-select form-control-b0" name="price_period">

                                            <option value="">Select</option>

                                            @forelse($price_details_periods as $price_period)
                                            <option value="{{$price_period->id}}" @if($secondary_level_unit_data->maintenance_period == $price_period->id) selected @endif>{{$price_period->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mb-2">

                            <input type="text" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control border-none" value="{{$secondary_level_unit_data->expected_rental ?? ''}}" name="expected_rental" id="" placeholder="Expected Rental">

                        </div>



                        <div class="col-md-8">

                            <div class="row">

                                <div class="col-md-4">

                                    <input type="text" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control border-none" name="booking_amount" value="{{$secondary_level_unit_data->booking_amount ?? ''}}" id="" placeholder="Booking Amount">

                                </div>

                                <div class="col-md-4">

                                    <input type="text" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control border-none" name="annual_due_pay" value="{{$secondary_level_unit_data->annual_due_pay ?? ''}}" id="" placeholder="Annual dues payble">

                                </div>

                                <div class="col-md-4">

                                    <input type="text" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control border-none" name="membership_charge" id="" value="{{$secondary_level_unit_data->membership_charge ?? ''}}" placeholder="Membership Charge">

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="clearfix mb-3"></div>
                    <div id="RemarksOnPropertyClone" style="display: none;">
                        <label class="form-label">Remarks on Property</label>
                        <textarea class="form-control" name="remark" rows="4">{{$secondary_level_unit_data->remark}}</textarea>
                    </div>

                    <!-- rental tab starts from here  -->
                    <div class="row align-items-center mb-2" id="AgreementTypeClone" style="display:none">
                        <label class="form-label required">Preferred Agreement Type</label>
                        <div class="col-md-12 mb-3">
                            <div class="radio-toolbar-text">
                                @forelse($agreement_types as $agrmnt_type)
                                <input type="radio" id="agrmnt_type-{{$agrmnt_type->id}}"  @if($secondary_level_unit_data->agreement_type == $agrmnt_type->id) checked @endif name="agreement_type" value="{{$agrmnt_type->id}}">
                                <label for="agrmnt_type-{{$agrmnt_type->id}}">{{$agrmnt_type->name}}</label>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row align-items-center mb-3" id="RentDetailsClone" style="display:none">
                        <label class="form-label required">Rent Details <span style="color:red">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="" value="{{$secondary_level_unit_data->expected_rent ?? ''}}" onkeypress="return isNumber(event)" name="expected_rent" placeholder="Expected Rent">
                        </div>

                        <div class="clearfix mt-3"></div>
                        @forelse($rent_details as $facility)
                        <div class="col-md-4 simplecheck mb-3">
                            <span><input type="checkbox" name="facility[]" @if(in_array($facility->id,$rent_details_values)) checked @endif value="{{$facility->id}}"> {{$facility->name}}</span>
                        </div>
                        @empty
                        @endforelse
                    </div>

                    <div class="row" id="AdditionalrentDetailClone" style="display:none">
                        <label class="form-label">Additional Rent Details </label> <small class=""><i>(Optional)</i></small>
                        <div class="col-md-12">
                            <div class="row ">
                                {{-- <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control col-md-3 "  maxlength="11"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="maintenance_rent" id="" value="{{$secondary_level_unit_data->maintenance_rent ?? ''}}" placeholder="Maintenance ">
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="box-bdr">
                                        <div class="row d-flex">
                                            <div class="col-md-7">
                                                <input type="text" class="form-control " maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{$secondary_level_unit_data->maintenance_rent ?? ''}}"
                                                name="maintenance_rent" id=""
                                                placeholder="Maintenance ">
                                            </div>
                                            <div class="col-md-5 ms-auto" style=" ">
                                                <select class="form-select form-control-b0" name="maintenance_period">
                                                    @foreach ($price_details_periods as $period)
                                                    <option value="{{$period->id}}"  @if($secondary_level_unit_data->maintenance_period == $period->id ) selected @endif>
                                                        {{$period->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control col-md-3 "  maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="booking_amount_rent" id=""  value="{{$secondary_level_unit_data->booking_amount_rent ?? ''}}" placeholder="Booking Amount ">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control col-md-3 "  maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="annual_dues_rent" id=""  value="{{$secondary_level_unit_data->annual_dues_rent ?? ''}}" placeholder="Annuel Dues Payable  ">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control col-md-3 " maxlength="11"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="membership_charge_rent" id="" value="{{$secondary_level_unit_data->membership_charge_rent ?? ''}}" placeholder="Membership Charge  ">
                                </div>

                            </div>

                        </div>


                        


                        <div class="clearfix mb-3"></div>

                        <div class="col-md-4 mb-3" id="AggrementDurationClone" style="display:none">

                            <label class="form-label">Duration of the Agreement </label>
                            <select class="form-select " name="agreement_duration">

                                <option value="">Select</option>
                                @for ($i = 0; $i <= 36; $i++) <option value="{{ $i }}" @if($secondary_level_unit_data->agreement_duration == $i ) selected @endif>{{ $i }} {{ $i === 1 ? 'month' : 'months' }}</option>
                                    @endfor
                            </select>

                        </div>

                        <div class="clearfix mb-3"></div>


                        <div class="col-md-12 mb-3" id="NoticeMonthClone" style="display:none">
                            <label class="form-label">Months of Notice </label>
                            <div class="radio-toolbar-text">
                                @forelse($notice_months as $notice)
                                <input type="radio" id="notice-{{$notice->id}}" name="notice_period" @if($secondary_level_unit_data->notice_period == $notice->id ) checked @endif value="{{$notice->id}}">
                                <label for="notice-{{$notice->id}}">{{$notice->name}}</label>
                                @empty
                                @endforelse
                            </div>

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
    </div>
</form>
