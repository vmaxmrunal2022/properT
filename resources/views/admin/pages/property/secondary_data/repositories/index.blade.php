@if ($block_id == 'project-repositories')
    <form id="ProjectRepositoryForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row file-input-wrapper">
            <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="files" class="form-label">
                        Project Brochure</label>
                    <div class="d-flex justify-content-center flex-column ">
                        <input type="file" name="brochure_file[]" id="brochure_file" class="form-control file-input"
                            multiple="" placeholder=" " style="display:none;">
                        <label for="brochure_file" class="form-label  btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add Project
                                Brochure</span></label>
                    </div>
                    <span class="clr_err text-danger othe_errr brochure_file_err"></span>

                </div>

            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($project_repository_files['brochure']))
                    @forelse($project_repository_files['brochure'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                        width="80" height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div>
        </div>

        <div class="row file-input-wrapper">
            <div class="col-xxl-4 col-md-4 mb-3">
                <div>
                    <label for="files" class="form-label"> Project Promotional Video</label>
                    <div class="d-flex justify-content-center flex-column ">
                        <input type="file" name="video_files[]" id="video_files" class="form-control file-input"
                            multiple="" placeholder=" " style="display:none;">
                        <label for="video_files" class="form-label  btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add Project Promotional
                                Video </span></span>
                        </label>
                    </div>
                    <span class="clr_err text-danger othe_errr video_files_err"></span>
                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($project_repository_files['video_files']))
                    @forelse($project_repository_files['video_files'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                        width="80" height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div>

        </div>
        <div class="row file-input-wrapper">
            <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="files" class="form-label">
                        Images</label>
                    <div class="d-flex justify-content-center flex-column ">
                        <input type="file" name="image_files[]" id="image_files" class="form-control file-input"
                            multiple="" placeholder=" " style="display:none;">
                        <label for="image_files" class="form-label  btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add Images</span>
                            </span>
                        </label>
                        <span class="clr_err text-danger othe_errr image_files_err"></span>
                    </div>

                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($project_repository_files['image_files']))
                    @forelse($project_repository_files['image_files'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}" class="rounded-circle border border-light border-4"
                                        width="80" height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

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
                            class="form-control file-input" multiple="" placeholder=" " style="display:none;">
                        <label for="3dvideo_files" class="form-label  btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add 3D View
                                Video</span></label>
                    </div>
                    <span class="clr_err text-danger othe_errr 3dvideo_files_err"></span>

                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($project_repository_files['3dvideo_files']))
                    @forelse($project_repository_files['3dvideo_files'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}"
                                        class="rounded-circle border border-light border-4" width="80"
                                        height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

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
                        <input type="file" name="floor_file[]" id="floor_file" class="form-control file-input"
                            multiple="" placeholder=" " style="display:none;">
                        <label for="floor_file" class="form-label btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add All Floor
                                Plans</span></label>
                    </div>
                    <span class="clr_err text-danger othe_errr floor_file_err"></span>

                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($project_repository_files['floor_file']))
                    @forelse($project_repository_files['floor_file'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}"
                                        class="rounded-circle border border-light border-4" width="80"
                                        height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xxl-3 col-md-3 mb-3">
                <label for="" class="form-label"> Youtube Link </label>
                <div class="">
                    <input type="text" name="youtube_link" id="" class="form-control" multiple=""
                        placeholder="" value="{{ $project_repository->youtube_link ?? '' }}">
                </div>
            </div>
        </div>

        <div class="row align-items-center mb-2">

            {{-- <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="" class="form-label">
                        Website Address </label>
                    <input type="text" class="form-control " name="website">
                </div>
                    <span class="clr_err text-danger othe_errr website_err"></span>

            </div> --}}


            <h4 id="add-btn" class="mb-3"> Others <span class="addpuls" onclick="clone_div()"> <i
                        class="fa-solid fa-plus"></i> </span></h4>
            <div class="" id="container1">
                <div class=" row align-items-end original-div file-input-wrapper">
                    <div class="col-xxl-2 col-md-2 mb-3 ">
                        <div class="form-group">
                            <label for="files" class="form-label"> Enter the Name </label>
                            <input type="text" name="name[]" class="form-control " id=""
                                placeholder="" value="">
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-3 mb-3 ">
                        <div class="form-group">
                            <label for="files" class="form-label"> Upload (PDF, Images)
                            </label>
                            <div class="d-flex justify-content-center flex-column">
                                <input type="file" name="addFloor[]" id="addFloor"
                                    class="form-control file-input" placeholder=" " style="display:none;">
                                <label for="addFloor" class="form-label btn-anima btn-hover hoverfEffect "> <span><i
                                            class="fa-solid fa-cloud-arrow-up mx-2"></i> Add All Floor
                                        Plans</span></label>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xxl-12 col-md-12 mt-3">
                            <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div> --}}
                </div>
                <div id="app_div">
                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($project_repository_other_files))
                    @forelse($project_repository_other_files as $key=>$file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}"
                                        class="rounded-circle border border-light border-4" width="80"
                                        height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                        <span class="card-text">{{ ucwords($project_repository_other_file_name[$key]) }}</span>
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-md-12">
                <div class="text-end">
                    <input type="submit" class="btn btn-md btn-primary" value="Save & Procced" />
                </div>
            </div>
        </div>
        </div>
    </form>
@elseif($block_id == 'bt-repositories')
    <form id="TowerRepositoryForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="block_tower_id" class="form-label">
                        @if (isset($property) && $property->residential_type == 7)
                            Select Block/Tower
                        @else
                            Select Block/Unit
                        @endif
                        <span class="errorcl">*</span>
                    </label>
                    <select class="form-control" name="block_tower_id" id="block_tower_id">
                        <option value="">select</option>
                        @forelse($block_tower as $key => $value)
                            <option value={{ $value->id }}>{{ $value->name }}</option>
                        @empty
                            <option>No option</option>
                        @endforelse
                    </select>
                    <span class="clr_err text-danger othe_errr block_tower_id_err"></span>
                </div>
            </div>
        </div>
        <div class="row file-input-wrapper">

            <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="floor_plan_n" class="form-label">
                        Floor Plan
                    </label>
                    <div class="d-flex justify-content-center flex-column ">
                        <input type="file" name="floor_plan_n[]" id="floor_plan_n"
                            class="form-control file-input" multiple="" placeholder=" " style="display:none;">
                        <label for="floor_plan_n" class="form-label btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add Floor
                                Plan</span></label>
                    </div>
                    <span class="clr_err text-danger othe_errr floor_plan_n_err"></span>

                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($block_tower_repository_files['floor_plan']))
                    @forelse($block_tower_repository_files['floor_plan'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}"
                                        class="rounded-circle border border-light border-4" width="80"
                                        height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div>
        </div>
        <div class="row file-input-wrapper">
            <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="image_files_n" class="form-label">
                        Images
                    </label>
                    <div class="d-flex justify-content-center flex-column ">
                        <input type="file" name="image_files_n[]" id="image_files_n"
                            class="form-control file-input" multiple="" placeholder=" " style="display:none;">
                        <label for="image_files_n" class="form-label btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add Images</span></label>
                    </div>
                    <span class="clr_err text-danger othe_errr image_files_n_err"></span>
                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($block_tower_repository_files['image_files']))
                    @forelse($block_tower_repository_files['image_files'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}"
                                        class="rounded-circle border border-light border-4" width="80"
                                        height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div>
        </div>
        <div class="row file-input-wrapper">
            <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="3dvideo_n" class="form-label">
                        3D View Video
                    </label>
                    <div class="d-flex justify-content-center flex-column ">
                        <input type="file" name="3dvideo_n[]" id="3dvideo_n" class="form-control file-input"
                            multiple="" placeholder=" " style="display:none;">
                        <label for="3dvideo_n" class="form-label btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add 3D View
                                Video</span></label>
                    </div>
                    <span class="clr_err text-danger othe_errr 3dvideo_n_err"></span>
                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($block_tower_repository_files['3dvideo']))
                    @forelse($block_tower_repository_files['3dvideo'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}"
                                        class="rounded-circle border border-light border-4" width="80"
                                        height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div>
        </div>
        <div class="row file-input-wrapper">
            <div class="col-xxl-3 col-md-3 mb-3">
                <div>
                    <label for="tower_video_n" class="form-label">
                        Tower Video
                    </label>
                    <div class="d-flex justify-content-center flex-column ">
                        <input type="file" name="tower_video_n[]" id="tower_video_n"
                            class="form-control file-input" multiple="" placeholder=" " style="display:none;">
                        <label for="tower_video_n" class="form-label  btn-anima btn-hover hoverfEffect "> <span><i
                                    class="fa-solid fa-cloud-arrow-up mx-2"></i> Add Tower
                                Video</span></label>
                    </div>
                    <span class="clr_err text-danger othe_errr tower_video_n_err"></span>

                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($block_tower_repository_files['tower_video']))
                    @forelse($block_tower_repository_files['tower_video'] as $file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}"
                                        class="rounded-circle border border-light border-4" width="80"
                                        height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-xxl-12 col-md-12 mt-3">
                <div id="files-preview"
                    class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                </div>
            </div>
        </div>

        <div class="row ">

            <div class="col-xxl-3 col-md-3 mb-3">
                <label for="" class="form-label"> Youtube Link </label>
                <div class="">
                    <input type="text" name="youtube_link" id="" class="form-control" multiple=""
                        value="{{ $block_tower_repository->youtube_link ?? '' }}" placeholder="">
                </div>
            </div>

            <h4 id="add-btn" class="mb-3"> Others <span class="addpuls" onclick="clone_div1()"> <i
                        class="fa-solid fa-plus"></i> </span></h4>
            <div class="" id="container1">
                <div class=" row align-items-end original-div file-input-wrapper">
                    <div class="col-xxl-2 col-md-2 mb-3 ">
                        <div class="form-group">
                            <label for="name_n" class="form-label"> Enter the Name </label>
                            <input type="text" name="name_n[]" class="form-control " id=""
                                placeholder="" value="">
                        </div>
                    </div>
                    <div class="col-xxl-2 col-md-3 mb-3 ">
                        <div class="form-group">
                            <label for="addFloor_n" class="form-label"> Upload (PDF, Images)
                            </label>
                            <div class="d-flex justify-content-center flex-column">
                                <input type="file" name="addFloor_n[]" id="addFloor_n"
                                    class="form-control file-input" placeholder=" " style="display:none;">
                                <label for="addFloor_n" class="form-label  btn-anima btn-hover hoverfEffect ">
                                    <span><i class="fa-solid fa-cloud-arrow-up mx-2 mx-2"></i> Add All Floor
                                        Plans</span></label>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xxl-12 col-md-12 mt-3">
                                <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview commRemove">

                                </div>
                            </div>  --}}
                </div>
                <div id="app_div1">



                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                @if (isset($block_tower_repository_other_files))
                    @forelse($block_tower_repository_other_files as $key=>$file)
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'], true))
                            <a data-fancybox="gallery" href="{{ $file }}" class="">
                                <span>
                                    <img src="{{ $file }}"
                                        class="rounded-circle border border-light border-4" width="80"
                                        height="80"
                                        onerror="this.onerror=null; this.src='{{ $default_pdf_icon }}'">
                                </span>
                            </a>
                        @else
                            <div class="card " style="width: 18rem;">
                                <video controls>
                                    <source src="{{ asset($file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                        <span class="card-text">{{ ucwords($block_tower_repository_other_file_name[$key]) }}</span>
                    @empty
                    @endforelse
                @endif
            </div>
            <div class="col-md-12">
                <div class="text-end">
                    <!-- <input type="submit" class="btn btn-md btn-primary" value="Save & Procced" /> -->

                    <input type="submit" class="btn btn-md btn-primary" value="Save" />
                    <button type="button" class="btn btn-md btn-primary repositories-next-btn">Procced</button>
                </div>
            </div>
        </div>
        </div>
    </form>
@endif
