<style>
    .hidden {
        display: none;
        }
    .btn-save {
        background: #ef5656 !important;
        color: white !important;
        font-size: 16px !important;
    }

    span.remove-storey,
    span.remove-storey-unit {
        position: absolute;
        top: 2.5%;
        left: 96.5%;
        width: 20px;
        cursor: pointer;
    }

    span.remove-storey,
    span.remove-storey-unit {
        position: absolute;
        top: 2.5%;
        left: 96.5%;
        width: 20px;
        cursor: pointer;
    }

    .brder_round {
        position: relative;
    }

    .brder_round {
        border: 1px solid #000;
        border-radius: 3px;
        margin: 10px 0px;
        padding: 0px 10px;
    }

    .brder_round .row {

        margin: 10px 0px;
        padding: 10px;
    }

    .brder_round .newbg-row {
        border: 1px solid #3577f1;
        border-radius: 3px;
        padding: 15px 0px;
        background: #f3f6f9;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: var(--vz-nav-pills-link-active-color);
        background-color: #662e93;
    }

    .nav-pills .nav-link {
        background: 0 0;
        border: 0;
        border-radius: var(--vz-nav-pills-border-radius);
        font-size: 14px;
        font-weight: 600;
    }

    .addpuls {
        background: #662e93;
        padding: 2px 6px;
        border-radius: 3px;
        color: white;
        font-size: 14px;
        margin-left: 5px;
    }


     .apart-images img {
            padding: 4px !important;
        }

        .image-area {
            position: relative;
            /* width: 50%; */
            margin: 20px;
            background: #333;
            border-radius: 5px;
        }

        .image-area img {
            max-width: 100%;

            height: auto;
        }

        .remove-image {
            display: none;
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .remove-image:hover {
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -11px;
            right: -11px;
        }

        .remove-image:active {
            background: #E54E4E;
            top: -10px;
            right: -11px;
        }

        #files-preview {
            border: 2px dashed gray;
            background: lightgray;
            /* visibility: hidden; */

        }
</style>


@extends('admin.layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Floors</h4>

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

            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <!--APARTMENT Category-->
                    <div class="card" style="">

                        <div class="card-body ">
                            <div class="row">
                                <div class="col-xxl-3 col-md-3 d-flex align-items-end">
                                    <div>
                                        <label for="" class="form-label">Enter GIS ID <span
                                                class="errorcl">*</span></label>
                                        <input type="text" name="gis_id" class="form-control req- ctfd-required"
                                            id="gis_id" placeholder="EX:7255158845" value=""
                                            onkeypress="return isNumber(event)">
                                    </div>
                                    <div class="ms-3">
                                        <button class="btn btn-success add-block" type="button"
                                            id="btn-search-gis-id">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="defined_block"></div>
                    <div class="card" style="">
                        <div class="card-body ">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true"><i
                                            class="bi bi-clipboard-check-fill"></i> Compliances</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">Project Repository</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Block/Tower Repository</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">

                                    <div class="">
                                      <form id="CompliancesForm" method="POST"  enctype="multipart/form-data">
                                      @csrf
                                        <div class="row file-input-wrapper">
                                         <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                    <label>
                                                        GHMC Approval
                                                    </label>
                                                    <div>
                                                        <input type="radio" id="html" name="ghmc_radio"
                                                            value="1" onclick="toggleGhmcDiv(this)">
                                                        <label for="html">Yes</label>
                                                        <input type="radio" id="css" name="ghmc_radio"
                                                            value="0" onclick="toggleGhmcDiv(this)">
                                                        <label for="css">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                           <div class="col-xxl-3 col-md-3 mt-3 hidden" id="hideGhmc">
                                                <div>
                                                  
                                                        <label for="files" class="form-label">
                                                        GHMC Approval Copy</label>
                                                    <div class="d-flex justify-content-center flex-column ">
                                                    <input type="file" name="ghmc_approval_file[]" id="ghmc_approval_file"
                                                            class="form-control file-input" multiple="" placeholder=" "
                                                            style="display:none;">
                                                        <label for="ghmc_approval_file" class="form-label btn btn-secondary "> <span
                                                                class="mdi mdi-plus "></span><span> Add GHMC Approval
                                                                Copy</span></label>
                                                        <span class="clr_err text-danger othe_errr ghmc_approval_file_err"></span>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="col-xxl-12 col-md-12 mt-3">
                                            <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview ghmcRemove">

                                            </div>
                                        </div>
                                        </div>
                                         <div class="row file-input-wrapper" >
                                            <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                    <label>
                                                        Commencement Certificate
                                                    </label>
                                                    <div>
                                                        <input type="radio" id="html" name="comm_radio"
                                                            value="1" onclick="toggleCommDiv(this)">
                                                        <label for="html">Yes</label>
                                                        <input type="radio" id="css" name="comm_radio"
                                                            value="0" onclick="toggleCommDiv(this)">
                                                        <label for="css">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-md-3 mb-3 hidden" id="hideComm">
                                                <div>
                                                    <label for="files" class="form-label">
                                                        Commencement Certificate</label>
                                                    <div class="d-flex justify-content-center flex-column ">
                                                        <input type="file" name="commenc_file[]" id="commenc_file"
                                                            class="form-control file-input" multiple="" placeholder=" "
                                                            style="display:none;">
                                                        <label for="commenc_file" class="form-label btn btn-secondary "> <span
                                                                class="mdi mdi-plus "></span><span> Add Commencement
                                                                Certificate</span></label>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="col-xxl-12 col-md-12 mt-3">
                                                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row file-input-wrapper">
                                         <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                    <label for="" class="form-label">RERA Number </label>
                                                    <input type="text" name="rear_number" class="form-control "
                                                        id="" placeholder="" value="">
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                    <label for="files" class="form-label">
                                                        RERA Approval Copy </label>
                                                    <div class="d-flex justify-content-center flex-column ">
                                                        <input type="file" name="rear_file[]" id="rear_file"
                                                            class="form-control file-input" multiple="" placeholder=" "
                                                            style="display:none;">
                                                        <label for="rear_file" class="form-label btn btn-secondary "> <span
                                                                class="mdi mdi-plus "></span><span> Add RERA Approval
                                                                Copy</span></label>
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
                                            <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview">

                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="row file-input-wrapper">
                                            <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                    <label for="" class="form-label">DTCP/HMDA Number </label>
                                                    <input type="text" name="hmda_number" class="form-control "
                                                        id="" placeholder="" value="">
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                    <label for="files" class="form-label">
                                                        DTCP/HMDA Approval Copy</label>
                                                    <div class="d-flex justify-content-center flex-column ">
                                                        <input type="file" name="hmda_file[]" id="hmda_file"
                                                            class="form-control file-input" multiple="" placeholder=" "
                                                            style="display:none;">
                                                        <label for="hmda_file" class="form-label btn btn-secondary "> <span
                                                                class="mdi mdi-plus "></span><span>Add DTCP/HMDA Approval
                                                                Copy</span></label>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="col-xxl-12 col-md-12 mt-3">
                                            <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview">

                                            </div>
                                        </div>
                                        </div>

                                       
                                        <div class="row file-input-wrapper" >
                                            <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                  
                                                    <div class="d-flex justify-content-center flex-column ">
                                                        <input type="file" name="legal_files[]" id="legal_files" class="form-control file-input"
                                                            multiple placeholder=" " style="display:none;">
                                                        <label for="legal_files" class="form-label btn btn-secondary "> <span
                                                                class="mdi mdi-plus "></span><span> Add Legal Documents</span></label>
                                                                
                                                      
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="col-xxl-12 col-md-12 mt-3">
                                                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-2">
                                           
                                            <div class="col-md-12">
                                                <div class="text-end">
                                                    <input type="submit" class="btn btn-md btn-primary" value="Save & Procced" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
                                    <div class="">
                                 <form id="ProjectRepositoryForm" method="POST"  enctype="multipart/form-data">
                                      @csrf
                                        <div class="row file-input-wrapper">
                                            <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                    <label for="files" class="form-label">
                                                        Project Brochure</label>
                                                    <div class="d-flex justify-content-center flex-column ">
                                                        <input type="file" name="brochure_file[]" id="brochure_file"
                                                            class="form-control file-input" multiple="" placeholder=" "
                                                            style="display:none;">
                                                        <label for="brochure_file" class="form-label btn btn-secondary "> <span
                                                                class="mdi mdi-plus "></span><span> Add Project
                                                                Brochure</span></label>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="col-xxl-12 col-md-12 mt-3">
                                                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row file-input-wrapper">
                                            <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                    <label for="files" class="form-label"> Project Promotional
                                                        Video</label>
                                                    <div class="d-flex justify-content-center flex-column ">
                                                        <input type="file" name="video_files[]" id="video_files"
                                                            class="form-control file-input" multiple="" placeholder=" "
                                                            style="display:none;">
                                                        <label for="video_files" class="form-label btn btn-secondary ">
                                                            <span class="mdi mdi-plus "> <span> Add Project Promotional
                                                                    Video </span></span>
                                                        </label>
                                                    </div>

                                                </div>
                                                </div>
                                            <div class="col-xxl-12 col-md-12 mt-3">
                                                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                                                </div>
                                            </div>
                                           
                                        </div>
                                        <div class="row file-input-wrapper">
                                            <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                    <label for="files" class="form-label">
                                                        Images</label>
                                                    <div class="d-flex justify-content-center flex-column ">
                                                        <input type="file" name="image_files[]" id="image_files"
                                                            class="form-control file-input" multiple="" placeholder=" "
                                                            style="display:none;">
                                                        <label for="image_files" class="form-label btn btn-secondary ">
                                                            <span class="mdi mdi-plus "> <span> Add Images</span>
                                                            </span>
                                                        </label>
                                                    </div>

                                                </div>
                                                </div>
                                            <div class="col-xxl-12 col-md-12 mt-3">
                                                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row file-input-wrapper">
                                            <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                    <label for="files" class="form-label">
                                                        3D View Video
                                                    </label>
                                                    <div class="d-flex justify-content-center flex-column ">
                                                        <input type="file" name="3dvideo_files[]" id="3dvideo_files"
                                                            class="form-control file-input" multiple="" placeholder=" "
                                                            style="display:none;">
                                                        <label for="3dvideo_files" class="form-label btn btn-secondary "> <span
                                                                class="mdi mdi-plus "></span><span> Add 3D View
                                                                Video</span></label>
                                                    </div>

                                                </div>
                                                </div>
                                            <div class="col-xxl-12 col-md-12 mt-3">
                                                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row file-input-wrapper">

                                            <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                    <label for="files" class="form-label">
                                                        All Floor Plans
                                                    </label>
                                                    <div class="d-flex justify-content-center flex-column ">
                                                        <input type="file" name="floor_file[]" id="floor_file"
                                                            class="form-control file-input" multiple="" placeholder=" "
                                                            style="display:none;">
                                                        <label for="floor_file" class="form-label btn btn-secondary "> <span
                                                                class="mdi mdi-plus "></span><span> Add All Floor
                                                                Plans</span></label>
                                                    </div>

                                                </div>
                                                </div>
                                            <div class="col-xxl-12 col-md-12 mt-3">
                                                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="row align-items-center mb-2">
                                            <div class="col-xxl-3 col-md-3 mb-3">
                                                <div>
                                                    <label for="" class="form-label">
                                                        Website Address </label>
                                                    <input type="text" class="form-control " name="website">
                                                </div>

                                            </div>


                                            <h4 id="add-btn" class="mb-3"> Others <span class="addpuls"> <i
                                                        class="fa-solid fa-plus"></i> </span></h4>
                                          <div class="" id="container1">
                                                <div class=" row align-items-end original-div">       
                                                    <div class="col-xxl-2 col-md-2 mb-3 ">
                                                        <div class="form-group">
                                                            <label for="files" class="form-label"> Enter the Name </label>
                                                            <input type="text" name="name[0]" class="form-control "
                                                                id="" placeholder="" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-2 col-md-3 mb-3 ">
                                                        <div class="form-group">
                                                            <label for="files" class="form-label"> Upload (PDF, Images)
                                                            </label>
                                                            <div class="d-flex justify-content-center flex-column">
                                                                <input type="file" name="addFloor[0][]" id="files"
                                                                    class="form-control" multiple="" placeholder=" "
                                                                    style="display:none;">
                                                                <label for="files" class="form-label btn btn-secondary "> <span
                                                                        class="mdi mdi-plus "></span><span> Add All Floor
                                                                        Plans</span></label>
                                                                            </div>
                                                        </div>
                                                        </div>
                                                    {{-- <div class="col-xxl-2 col-md-2 mb-3 ">
                                                            <div class="form-group">
                                                                
                                                                    <label for="" class="form-label btn btn-danger remove-btn"> <span
                                                                            class="mdi mdi-minus "></span><span>Remove</span></label>
                                                            
                                                            </div>
                                                        </div> --}}
                                                </div>
                                                </div>


                                            <div class="col-md-12">
                                                <div class="text-end">
                                                    <input type="submit" class="btn btn-md btn-primary" value="Save & Procced" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">

                                    <div class="row ">
                                        <div class="col-xxl-3 col-md-3 mb-3">
                                            <div>
                                                <label for="files" class="form-label">
                                                    Floor Plan
                                                </label>
                                                <div class="d-flex justify-content-center flex-column ">
                                                    <input type="file" name="files[]" id="files"
                                                        class="form-control" multiple="" placeholder=" "
                                                        style="display:none;">
                                                    <label for="files" class="form-label btn btn-secondary "> <span
                                                            class="mdi mdi-plus "></span><span> Add Floor
                                                            Plan</span></label>
                                                </div>

                                            </div>
                                        </div>
                                         <div class="col-xxl-12 col-md-12 mt-3">
                                                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                                                </div>
                                            </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-xxl-3 col-md-3 mb-3">
                                            <div>
                                                <label for="files" class="form-label">
                                                    Images
                                                </label>
                                                <div class="d-flex justify-content-center flex-column ">
                                                    <input type="file" name="files[]" id="files"
                                                        class="form-control" multiple="" placeholder=" "
                                                        style="display:none;">
                                                    <label for="files" class="form-label btn btn-secondary "> <span
                                                            class="mdi mdi-plus "></span><span> Add Images</span></label>
                                                </div>

                                            </div>

                                        </div>
                                         <div class="col-xxl-12 col-md-12 mt-3">
                                                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                                                </div>
                                            </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-xxl-3 col-md-3 mb-3">
                                            <div>
                                                <label for="files" class="form-label">
                                                    3D View Video
                                                </label>
                                                <div class="d-flex justify-content-center flex-column ">
                                                    <input type="file" name="files[]" id="files"
                                                        class="form-control" multiple="" placeholder=" "
                                                        style="display:none;">
                                                    <label for="files" class="form-label btn btn-secondary "> <span
                                                            class="mdi mdi-plus "></span><span> Add 3D View
                                                            Video</span></label>
                                                </div>

                                            </div>

                                        </div>
                                         <div class="col-xxl-12 col-md-12 mt-3">
                                                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                                                </div>
                                            </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-xxl-3 col-md-3 mb-3">
                                            <div>
                                                <label for="files" class="form-label">
                                                    Tower Video
                                                </label>
                                                <div class="d-flex justify-content-center flex-column ">
                                                    <input type="file" name="files[]" id="files"
                                                        class="form-control" multiple="" placeholder=" "
                                                        style="display:none;">
                                                    <label for="files" class="form-label btn btn-secondary "> <span
                                                            class="mdi mdi-plus "></span><span> Add Tower
                                                            Video</span></label>
                                                </div>

                                            </div>

                                        </div>
                                         <div class="col-xxl-12 col-md-12 mt-3">
                                                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                                                </div>
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-xxl-3 col-md-3 mb-3">
                                            <div>
                                                <label for="" class="form-label">Select Block/Tower</label>
                                                <select class="form-select" name="category" id="category">
                                                    <option selected="">-Select Category-</option>

                                                </select>
                                            </div>
                                        </div>

                                        <h4 class="mb-3"> Others <span class="addpuls"> <i
                                                    class="fa-solid fa-plus"></i> </span></h4>
                                        <div class="col-xxl-2 col-md-2 mb-3 ">
                                            <div class="form-group">
                                                <label for="files" class="form-label"> Enter the Name </label>
                                                <input type="text" name="" class="form-control "
                                                    id="" placeholder="" value="">
                                            </div>
                                        </div>
                                        <div class="col-xxl-2 col-md-2 mb-3 ">
                                            <div class="form-group">
                                                <label for="files" class="form-label"> Upload (PDF, Images) </label>
                                                <div class="d-flex justify-content-center flex-column ">
                                                    <input type="file" name="files[]" id="files"
                                                        class="form-control" multiple="" placeholder=" "
                                                        style="display:none;">
                                                    <label for="files" class="form-label btn btn-secondary "> <span
                                                            class="mdi mdi-plus "></span><span> Add All Floor
                                                            Plans</span></label>
                                                </div>
                                            </div>
                                        </div>







                                        <div class="col-md-12">
                                            <div class="text-end">
                                                <button class="btn btn-md btn-primary"> Submit </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
            $(document).on('click', '#btn-search-gis-id', function(e) {

                let gis_id = $("#gis_id").val();

                if (gis_id == '') {
                    toastr.error('Please enter GIS ID');
                    return false
                } else {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('get_secondary_defined_block') }}",
                        data: {
                            gis_id: gis_id
                        },
                        success: function(response) {
                            if (response.status === false) {
                                toastr.error(response.message);
                                $('#defined_block').empty();
                            } else {
                                $('#defined_block').html(response);
                            }

                        }
                    });
                }

            });

        </script>
        <script>
          $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
             $(".file-input").on("change", function(e) {
                var files = e.target.files;
                var filesPreview = $(this).closest(".file-input-wrapper").find(".files-preview");

                 var maxSizeInBytes = 5242880; // 5MB
                 var allowedExtensions = ["jpg", "jpeg", "png", "gif"];

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];

                    /////for file sizs and extenions
                     var fileSize = file.size;
                    var fileExtension = file.name.split(".").pop().toLowerCase();
                    console.log(fileSize);
                    if (fileSize > maxSizeInBytes) {
                        alert("File size exceeds the allowed limit of 5MB.");
                        continue;
                    }

                    if (!allowedExtensions.includes(fileExtension)) {
                        alert("Invalid file extension. Only JPG, JPEG, PNG, and GIF files are allowed.");
                        continue;
                    }
                    /////for file sizs and extenions

                    var fileReader = new FileReader();

                    fileReader.onload = (function(file) {
                    return function(e) {
                        var imageThumb = $("<img>").addClass("imageThumb").attr("src", e.target.result).attr("width", "130");
                        var removeButton = $("<span>").addClass("remove-image btn remove").html("&#215;");
                        var imageArea = $("<span>").addClass("image-area rounded").append(imageThumb).append("<br>").append(removeButton);

                        filesPreview.append(imageArea);

                        $(".remove-image").click(function() {
                        $(this).closest(".image-area").remove();
                        });
                    };
                    })(file);

                    fileReader.readAsDataURL(file);
                }
                });

            } else {
                alert("Your browser doesn't support to File API")
            }
        });
        </script>
        <script>
            function toggleGhmcDiv(radioButton) {
            var div = document.getElementById("hideGhmc");
            if (radioButton.value === "1") {
                div.style.display = "block";
            } else {
                div.style.display = "none";
                $('#ghmc_approval_file').val('');
                $('.ghmcRemove').empty();
                
            }
            }
             function toggleCommDiv(radioButton) {
            var div = document.getElementById("hideComm");
            if (radioButton.value === "1") {
                div.style.display = "block";
            } else {
                div.style.display = "none";
                 $('#commenc_file').val('');
                $('.commRemove').empty();
            }
            }
        </script>
        {{-- <script>
        $(document).ready(function() {
            $('#myForm').submit(function(e) {
                e.preventDefault(); // Prevent form submission
                
                var form = $(this);
                var url = form.attr('action');
                var formData = new FormData(form[0]);
                
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success response
                        
                        // Example: Show a success message
                        alert(response.message);
                        
                        // You can perform further actions like clearing the form or redirecting
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        
                        // Example: Show an error message
                        console.log(xhr.responseText);
                        alert('An error occurred while submitting the form.');
                    }
                });
            });
        });
    </script> --}}
   <script>
    $(document).ready(function() {
        $('#CompliancesForm').submit(function(event) {
            event.preventDefault();
                   

            var gis_id = $("#gis_primary_id").val(); 
            var property_id = $("#property_id").val(); 
            var cat_id = $("#cat_id").val(); 
            var residential_type = $("#residential_type").val(); 
            var residential_sub_type = $("#residential_sub_type").val(); 

            var form = $(this);
            var formData = new FormData(form[0]);
            formData.append('gis_id', gis_id);
            formData.append('property_id', property_id);
            formData.append('cat_id', cat_id);
            formData.append('residential_type', residential_type);
            formData.append('residential_sub_type', residential_sub_type);
            

            toastr.warning("<br /><button type='button' value='yes' style='color: #fff;border: 1px solid #fff;margin-right: 7px;' class='btn btn-outline-success btn-sm'>Yes</button><button type='button' style='color: #fff;border: 1px solid #fff;margin-right: 7px;' value='no' class='btn btn-outline-danger btn-sm'>No</button>", 'Are you sure you want to process this?', {
                allowHtml: true,
                positionClass: 'toast-top-center',
                onclick: function(toast) {
                    var value = toast.target.value;
                    if (value == 'yes') {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            }
                        });

                        $.ajax({
                          url: "{{ route('store-compliances')}}",
                            type: 'POST',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                $('.clr_err').empty();
                                $("#overlay").fadeIn();
                            },
                            success: function(data) {
                                console.log(data.comp_id);
                                $("#comp_id").val(data.comp_id);                
                                //$('.clr_err').text('');
                                toastr.success("Successfully Added Compliances");
                                    var currentTab = $('.nav-link.active').parent();
                                    var nextTab = currentTab.next().find('button.nav-link');

                                    if (nextTab.length > 0) {
                                        currentTab.removeClass('active');
                                        nextTab.addClass('active');
                                        var target = nextTab.attr('data-bs-target');
                                        $('.tab-pane').removeClass('show active');
                                        $(target).addClass('show active');

                                        // Close the previous tab
                                        var previousTab = currentTab.find('button.nav-link');
                                        var previousTarget = previousTab.attr('data-bs-target');
                                        $(previousTarget).removeClass('show active');
                                    }
                                
                               
                                //window.location.reload();
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                if (jqXHR.status == 422) {
                                    $('.clr_err').text('');
                                    var response = JSON.parse(jqXHR.responseText);
                                    $.each(response.errors, function(key, value) {
                                        var classname = key.replace(/\.+/g, '');
                                        $('.' + classname + '_err').text(value);
                                    });
                                }
                                if (jqXHR.status == 413) {
                                    $('.clr_err').text('');
                                    alert('Check upload file size not more than 1mb');
                                }
                                $('.sucuss').css('display', 'none');
                            },
                            complete: function() {
                                $("#overlay").fadeOut();
                            }
                        });

                        toastr.remove();
                    } else {
                        toastr.remove();
                    }
                }
            });
        });
    });
</script>
<script>
$(document).ready(function() {
  // Add Div button click event
  var counter = 0; // Counter variable
  $('#add-btn').click(function() {
    // Clone the original div
    var clonedDiv = $('.original-div').first().clone();

    // Clear the input value in the cloned div
    clonedDiv.find('input').val('');
    clonedDiv.find('addFloor').val('');

     // Increment the counter variable
    counter++;

    // Update the name attribute of the cloned input field
    clonedDiv.find('input').attr('name', 'input[' + counter + ']');
    clonedDiv.find('input').attr('addFloor', 'input[' + counter + '][]');

    // Add a remove button to the cloned div
    clonedDiv.append(`<div class="col-xxl-2 col-md-2 mb-3 remove-btn">
                            <div class="form-group">
                                <button class="form-label btn btn-danger remove-btn"><span class="mdi mdi-minus"></span>Remove</button>
                            </div>
                        </div>`);

    // Append the cloned div to the container
    $('#container1').append(clonedDiv);
  });

  // Remove Div button click event
  $(document).on('click', '.remove-btn', function() {
    // Remove the parent div of the remove button
   // alert("Remove")
    $(this).parent('.original-div').remove();
  });
});
</script>
 <script>
    $(document).ready(function() {
        $('#ProjectRepositoryForm').submit(function(event) {
            event.preventDefault();
                   

            var gis_id = $("#gis_primary_id").val(); 
            var property_id = $("#property_id").val(); 
            var cat_id = $("#cat_id").val(); 
            var residential_type = $("#residential_type").val(); 
            var residential_sub_type = $("#residential_sub_type").val(); 

            var form = $(this);
            var formData = new FormData(form[0]);
            formData.append('gis_id', gis_id);
            formData.append('property_id', property_id);
            formData.append('cat_id', cat_id);
            formData.append('residential_type', residential_type);
            formData.append('residential_sub_type', residential_sub_type);
            

            toastr.warning("<br /><button type='button' value='yes' style='color: #fff;border: 1px solid #fff;margin-right: 7px;' class='btn btn-outline-success btn-sm'>Yes</button><button type='button' style='color: #fff;border: 1px solid #fff;margin-right: 7px;' value='no' class='btn btn-outline-danger btn-sm'>No</button>", 'Are you sure you want to process this?', {
                allowHtml: true,
                positionClass: 'toast-top-center',
                onclick: function(toast) {
                    var value = toast.target.value;
                    if (value == 'yes') {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            }
                        });

                        $.ajax({
                          url: "{{ route('store-compliances')}}",
                            type: 'POST',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                $('.clr_err').empty();
                                $("#overlay").fadeIn();
                            },
                            success: function(data) {
                                console.log(data.comp_id);
                                $("#comp_id").val(data.comp_id);                
                                //$('.clr_err').text('');
                                toastr.success("Successfully Added Compliances");
                                    var currentTab = $('.nav-link.active').parent();
                                    var nextTab = currentTab.next().find('button.nav-link');

                                    if (nextTab.length > 0) {
                                        currentTab.removeClass('active');
                                        nextTab.addClass('active');
                                        var target = nextTab.attr('data-bs-target');
                                        $('.tab-pane').removeClass('show active');
                                        $(target).addClass('show active');

                                        // Close the previous tab
                                        var previousTab = currentTab.find('button.nav-link');
                                        var previousTarget = previousTab.attr('data-bs-target');
                                        $(previousTarget).removeClass('show active');
                                    }
                                
                               
                                //window.location.reload();
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                if (jqXHR.status == 422) {
                                    $('.clr_err').text('');
                                    var response = JSON.parse(jqXHR.responseText);
                                    $.each(response.errors, function(key, value) {
                                        var classname = key.replace(/\.+/g, '');
                                        $('.' + classname + '_err').text(value);
                                    });
                                }
                                if (jqXHR.status == 413) {
                                    $('.clr_err').text('');
                                    alert('Check upload file size not more than 1mb');
                                }
                                $('.sucuss').css('display', 'none');
                            },
                            complete: function() {
                                $("#overlay").fadeOut();
                            }
                        });

                        toastr.remove();
                    } else {
                        toastr.remove();
                    }
                }
            });
        });
    });
</script>
    @endpush
@endsection
