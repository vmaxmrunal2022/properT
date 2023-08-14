@extends('admin.layouts.main')
@section('content')
@push('css')
<link href="{{ asset('assets/css/show-property-details.css') }}?v=234567" rel="stylesheet" type="text/css" />
@endpush
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


        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
           
                    <div class="card-body mt-5">
                        <div class="row border-bottom mb-3">

                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div>
                                    <label for="" class="form-label">Latitude<span class="errorcl">*</span></label>
                                    <input disabled type="text" value="{{ $property->latitude ?? '-' }}" name="locality_name" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div>
                                    <label for="" class="form-label">Longitude<span class="errorcl">*</span></label>
                                    <input disabled type="text" value="{{ $property->longitude ?? '-' }}" name="locality_name" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div>
                                    <label for="" class="form-label">GIS ID<span class="errorcl">*</span></label>
                                    <input disabled type="text" value="{{ $property->gis_id }}" name="locality_name" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div>
                                    <label for="" class="form-label">Category of the property<span class="errorcl">*</span></label>
                                    <input disabled type="text" value="{{ $property->category->cat_name }}" name="locality_name" class="form-control" id="">
                                </div>
                            </div>


                        </div>

                        @include('admin.pages.property.'.$defined_blade, [ 'floors' => $floors])
                        {{--<div class="row">
                            @if($property->up_for_sale == 1)
                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div class="form-check">
                                    <span class="mdi mdi-decagram text-success"></span>
                                    <!--<input class="form-check-input" disabled @if($property->up_for_sale == 1) checked @endif type="checkbox" name="up_for_sale" id="up_for_sale">-->
                                    <label class="form-check-label" for="up_for_sale">
                                        UP for Sale
                                    </label>
                                </div>
                            </div>
                            @endif
                            @if($property->up_for_rent == 1)
                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div class="form-check">
                                    <span class="mdi mdi-decagram text-success"></span>
                                    <!--<input class="form-check-input" disabled @if($property->up_for_rent == 1) checked @endif type="checkbox" name="up_for_rent" id="up_for_rent" >-->
                                    <label class="form-check-label" for="up_for_rent">
                                        UP for Rent
                                    </label>
                                </div>
                            </div>
                            @endif
                        </div>--}}
                        <div class="col-md-12 mb-3">
                            <label><b>Property Images</b></label>
                            <div class="apart-images">

                                @foreach ($property->images as $image)

                                @php
                                $extension = pathinfo($image->file_url, PATHINFO_EXTENSION);
                                @endphp

                                @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'], true))
                                <a data-fancybox="gallery" href="{{ asset('uploads/property/images/' . $image->file_url) }}">
                                    <img src="{{ asset('uploads/property/images/' . $image->file_url) }}" class="img-fluid">
                                </a>
                                @elseif($extension == 'pdf')
                                <a data-fancybox="gallery" href="{{ asset('uploads/property/images/' . $image->file_url) }}">
                                    <img src="{{ asset('assets/images/svg/default-pdf.svg') }}" class="img-fluid">
                                </a>
                                @endif
                                @endforeach

                            </div>
                        </div>

                        <div class="col-md-12 mb-3 {{$floor_visible_status ?? ''}}">
                            @include('admin.pages.property.view_floor', [ 'floors' => $floors])
                        </div>
                        <div class="col-xxl-12 col-md-12 my-3">
                            <div>
                                <label for="" class="form-label">Remarks </label>
                                <textarea name="remarks" disabled class="form-control" rows="3">{{$property->remarks}}</textarea>
                            </div>
                        </div>

                        @if($property->cat_id == 6)
                        <div class="col-xxl-12 col-md-12 mt-3 mb-3">
                            <div>
                                <a class="btn btn-primary me-2" href="{{url('surveyor/property/demolished/unit_details')}}/{{$property->id}}">
                                    <span class="mdi mdi-map me-2"></span> Unit Details </a>
                            </div>
                        </div>
                        @endif

                        @if($property->cat_id == 4 && $property->plot_land_type == 13)
                        <div class="col-xxl-12 col-md-12 mt-3 mb-3">
                            <div>
                                <a class="btn btn-primary me-2" href="{{url('surveyor/property/plot-land/unit_details')}}/{{$property->id}}">
                                    <span class="mdi mdi-map me-2"></span> Add Unit Details </a>
                            </div>
                        </div>
                        @endif
                        @if($property->up_for_sale == 1 || $property->up_for_rent == 1)
                            <div class="d-flex mb-2"> 
                            @if($property->up_for_sale == 1)<span class="mdi mdi-decagram text-success"></span><span class="mx-1"> up for Sale</span>     @endif
                            @if($property->up_for_rent == 1)<span class="mdi mdi-decagram text-success  mx-2"></span>   <span class=" mx-1"> up for Rent </span> @endif
                            </div>
                        @endif
                        <div class="col-md-12 mb-3 text-end">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Preview the Map
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-1" style="height:500px;">
                                            <div id="map" style="clear:both; height:100%;">
                                                <div id="map"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<button class="btn btn-primary"><span class="mdi mdi-sync me-2"></span> UPDATE</button>-->
                        </div>
                    </div>
                    <div class="card-footer" style="background-color:#e1e1ef;">
                        <div class="d-flex justify-content-end">

                            <a class="btn btn-warning me-2 edit-modal-btn" href="{{ route('surveyor.property.edit_details', [$property->id]) }}"><span class="mdi mdi-layers-edit me-2 "></span> EDIT </a>

                            <a class="btn btn-primary me-2" href="https://maps.google.com/?q={{ $property->latitude ?? '-' }},{{ $property->longitude ?? '-' }}">
                                <span class="mdi mdi-map me-2"></span> View on Google Map </a>

                        </div>
                    </div>

                </div>

            </div>
        </div>


    </div>


    <!-- Modal -->
    <input type="hidden" id="lat" value="{{ $property->latitude }}">
    <input type="hidden" id="long" value="{{ $property->longitude }}">

</div> <!-- container-fluid -->
</div><!-- End Page-content -->
@endsection
@push('scripts')
<script type="text/javascript">
    var map;

    parseInt(string)($('#long').val());
    parseInt(string)($('#lat').val());

    function initMap() {
        var latitude = parseFloat($('#lat').val()); // YOUR LATITUDE VALUE
        var longitude = parseFloat($('#long').val()); // YOUR LONGITUDE VALUE
        // var latitude = 17.4563197; // YOUR LATITUDE VALUE
        // var longitude = 78.3728344; // YOUR LONGITUDE VALUE
        var myLatLng = {
            lat: latitude,
            lng: longitude
        };
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 18
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            //title: 'Hello World'
            // setting latitude & longitude as title of the marker
            // title is shown when you hover over the marker
            title: latitude + ', ' + longitude
        });
    }
    $('.edit-modal-btn').on('click', function() {
        alert()
        $('#editProperty').modal('show');
    });

    // Images viewer
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&callback=initMap" async defer></script>

@endpush