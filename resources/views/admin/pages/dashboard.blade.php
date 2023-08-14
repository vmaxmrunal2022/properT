@extends('admin.layouts.main')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <!--
                                                                <div class="page-title-right">
                                                                    <ol class="breadcrumb m-0">
                                                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                                                        <li class="breadcrumb-item active">Basic Elements</li>
                                                                    </ol>
                                                                </div>
                                            -->

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!--<div class="row">-->
            <!--    <div class="col-xl-12 col-md-12">-->

            <!--        <div class="card">-->
            <!--            <div class="card-header align-items-center ">-->
            <!--                <div>-->
            <!--                    <button type="button" data-value="all" class="btn btn-soft-primary btn-sm get-property-count">-->
            <!--                        ALL-->
            <!--                    </button>-->
            <!--                    <button type="button" data-value="today" class="btn btn-soft-secondary btn-sm get-property-count">-->
            <!--                        Today-->
            <!--                    </button>-->
            <!--                    <button type="button" data-value="week" class="btn btn-soft-secondary btn-sm get-property-count">-->
            <!--                        Week-->
            <!--                    </button>-->
            <!--                    <button type="button" data-value="month" class="btn btn-soft-secondary btn-sm get-property-count">-->
            <!--                        Month-->
            <!--                    </button>-->
            <!--                </div>-->
            <!--            </div>-->
            <!-- end card header -->

            <!--        </div>-->

            <!--    </div>-->

            <!--</div>-->


            <div class="row">
                <div class="col-xl-12 col-md-12">

                    <div class="card">
                        <div class="card-header align-items-center ">
                            <div class="d-flex justify-content-end">

                                <a href="{{ url('surveyor/basic_details') }}" type="button"
                                    class="btn btn-secondary custom-toggle add-property">
                                    <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Add Property</span>
                                </a>

                            </div>
                        </div>
                        <!-- end card header -->

                    </div>

                </div>

            </div>



            <div class="row">

                
                     <div class="col-xl-3 col-md-6">
                          <a  href="{{ url('surveyor/property/reports') }}">
                    <!-- card -->
                    <div class="card card-animate overflow-hidden p-2">

                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200"
                                height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-success)
                                    }
                                </style>
                                <path id="Shape 8" class="s0"
                                    d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                </path>
                            </svg>
                        </div>


                        <div class="card-body" style="background-color: #FFF4E0;">

                            <div class="d-flex align-items-end justify-content-between mt-0">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span id="property-count" class="counter-value"
                                            data-target="{{ $property_count ?? '' }}">{{ $property_count ?? '' }}</span>
                                    </h4>

                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <a id="property-url" href="{{ url('surveyor/property/reports') }}">
                                        <p id="property-label" class="text-uppercase fw-bold text-dark text-truncate mb-0">
                                            Total Surveyed</p>
                                    </a>
                                </div>

                            </div>


                        </div><!-- end card body -->
                    </div><!-- end card -->
                     </a>
                </div>
               <!-- end col -->

               
                    <div class="col-xl-3 col-md-6">
                         <a  href="{{ url('surveyor/property/reports') }}?type=today">
                    <!-- card -->
                    <div class="card card-animate overflow-hidden p-2">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200"
                                height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-success)
                                    }
                                </style>
                                <path id="Shape 8" class="s0"
                                    d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                </path>
                            </svg>
                        </div>

                        <div class="card-body" style="background-color: #ceefff;">

                            <div class="d-flex align-items-end justify-content-between mt-0">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span id="property-count" class="counter-value"
                                            data-target="{{ $today_data ?? '' }}">{{ $today_data ?? '' }}</span>
                                    </h4>

                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <a id="property-url" href="{{ url('surveyor/property/reports') }}?type=today">
                                        <p id="property-label" class="text-uppercase fw-bold text-dark text-truncate mb-0">
                                            Surveyed Today</p>
                                    </a>
                                </div>

                            </div>


                        </div><!-- end card body -->
                    </div><!-- end card -->
               </a>
                </div><!-- end col -->
               
                
             
                    <div class="col-xl-3 col-md-6">
                           <a  href="{{ url('surveyor/property/reports') }}?type=week">
                    <!-- card -->
                    <div class="card card-animate overflow-hidden p-2">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200"
                                height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-success)
                                    }
                                </style>
                                <path id="Shape 8" class="s0"
                                    d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                </path>
                            </svg>
                        </div>
                        <div class="card-body" style="background-color: #F7C8E0;">

                            <div class="d-flex align-items-end justify-content-between mt-0">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span id="property-count" class="counter-value"
                                            data-target="{{ $this_week ?? '' }}">{{ $this_week ?? '' }}</span>
                                    </h4>

                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <a id="property-url" href="{{ url('surveyor/property/reports') }}?type=week">
                                        <p id="property-label"
                                            class="text-uppercase fw-bold text-dark text-truncate mb-0">Surveyed This Week
                                        </p>
                                    </a>
                                </div>

                            </div>


                        </div><!-- end card body -->
                    </div><!-- end card -->
                     </a>
                </div> 
               <!-- end col -->

            
                    <div class="col-xl-3 col-md-6">
                           <a  href="{{ url('surveyor/property/reports') }}?type=month">
                    <!-- card -->
                    <div class="card card-animate overflow-hidden p-2">
                        <div class="position-absolute start-0" style="z-index: 0;">
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200"
                                height="120">
                                <style>
                                    .s0 {
                                        opacity: .05;
                                        fill: var(--vz-success)
                                    }
                                </style>
                                <path id="Shape 8" class="s0"
                                    d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z">
                                </path>
                            </svg>
                        </div>

                        <div class="card-body" style="background-color: #B5F1CC;">

                            <div class="d-flex align-items-end justify-content-between mt-0">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span id="property-count" class="counter-value"
                                            data-target="{{ $this_month ?? '' }}">{{ $this_month ?? '' }}</span>
                                    </h4>

                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <a id="property-url" href="{{ url('surveyor/property/reports') }}?type=month">
                                        <p id="property-label"
                                            class="text-uppercase fw-bold text-dark text-truncate mb-0">Surveyed This Month
                                        </p>
                                    </a>
                                </div>

                            </div>


                        </div><!-- end card body -->
                    </div><!-- end card -->
                </a>
                </div>
              <!-- end col -->









            </div> <!-- end row-->


            <!--end row-->










        </div> <!-- container-fluid -->
    </div><!-- End Page-content -->

    @push('scripts')
        <script>
            $(document).ready(function() {
                $(".get-property-count").click(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var type = this.getAttribute('data-value');
                    $.ajax({
                        url: "{{ route('dashboard.get-property-count') }}", // the route defined in step 1
                        method: 'post',
                        data: {
                            type: type
                        },
                        success: function(response) {
                            // handle the response from the server
                            // console.log(response);
                            $('#property-label').html(response.type);
                            $('#property-count').html(response.count);
                            var url = "{{ url('surveyor/property/reports') }}/" + response.key;
                            $('#property-url').attr("href", url);

                        },
                        error: function(xhr, status, error) {
                            // handle errors
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
