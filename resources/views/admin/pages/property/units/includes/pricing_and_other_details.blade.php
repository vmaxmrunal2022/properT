

@push('css')
<link href="{{ asset('assets/css/unit-details.css') }}?v=2369" rel="stylesheet" type="text/css" />
@endpush

<!-- Section for Pricing & Other Details -->
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
                        <p><b>Address : </b> <span class="project-head"> {{$property->city}}</span></p>
                    </div>
                </div>
                <div class="">
                    <h4 class="mb-3 ">Pricing &amp; Other Details</h4>
                    <div class="row align-items-center mb-2">

                        <div class="col-md-12 mb-3">
                            <div class="radio-toolbar-text ">
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
                        <label class="form-label ">Ownership Details <span class="text-danger"> *</span> </label>

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
                        <label class="form-label ">Price Details <span class="text-danger"> *</span> </label>
                        <div class="col-md-4">

                            <input type="text" class="form-control" id="" onkeypress="return isNumber(event)" name="expected_price" placeholder="Expected Price">

                        </div>

                        <div class="col-md-3">

                            <input type="text" class="form-control" onkeypress="return isNumber(event)" id="" name="price_per_sq_ft" placeholder="Price per Sq feet">

                        </div>

                        <div class="clearfix mt-3"></div>

                        @forelse($price_details as $price_detail)
                        <div class="col-md-3 simplecheck mb-3">
                            <span><input type="checkbox" name="price_details[]" value="{{$price_detail->id}}"> {{$price_detail->name}}</span>
                        </div>
                        @empty
                        @endforelse


                    </div>


                    <div class="row" id="AdditionalPrcingDetailsClone" style="display:none">
                        <label class="form-label">Additional Pricing Details <small class=""><i>(Optional)</i></small></label> 


                        <div class="col-md-4">

                            <div class="box-bdr">

                                <div class="row d-flex">

                                    <div class="col-md-7">

                                        <input type="text" class="form-control form-control-b0 col-md-3 border-none" onkeypress="return isNumber(event)" name="mainteinance" id="" placeholder="Maintenance">

                                    </div>

                                    <div class="col-md-5 ms-auto" style="">

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

                            <input type="text" class="form-control border-none" onkeypress="return isNumber(event)" name="expected_rental" id="" placeholder="Expected Rental">

                        </div>



                        <div class="col-md-8">

                            <div class="row">

                                <div class="col-md-4">

                                    <input type="text" class="form-control border-none" onkeypress="return isNumber(event)" name="booking_amount" id="" placeholder="Booking Amount">

                                </div>

                                <div class="col-md-4">

                                    <input type="text" class="form-control border-none" onkeypress="return isNumber(event)" name="annual_due_pay" id="" placeholder="Annual dues payble">

                                </div>

                                <div class="col-md-4">

                                    <input type="text" class="form-control border-none" onkeypress="return isNumber(event)" name="membership_charge" id="" placeholder="Membership Charge">

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
                        <label class="form-label ">Preferred Agreement Type <span class="text-danger"> *</span></label>
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
                        <label class="form-label ">Rent Details  <span class="text-danger"> *</span></label>
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
                                <div class="col-md-4">

                                    <div class="box-bdr">

                                        <div class="row d-flex">

                                            <div class="col-md-7">

                                                <input type="text" class="form-control form-control-b0 col-md-3 border-none" onkeypress="return isNumber(event)" name="maintenance_rent" id="" placeholder="Maintenance">

                                            </div>

                                            <div class="col-md-5 ms-auto" style="border-left: solid 1px #ddd">

                                                <select class="form-select form-control-b0" name="maintenance_period">

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

                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control col-md-3 " onkeypress="return isNumber(event)" name="booking_amount_rent" id="" placeholder="Booking Amount ">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control col-md-3 " onkeypress="return isNumber(event)" name="annual_dues_rent" id="" placeholder="Annuel Dues Payable  ">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control col-md-3 " onkeypress="return isNumber(event)" name="membership_charge_rent" id="" placeholder="Membership Charge  ">
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
</form>
<!--screen 2 end -->