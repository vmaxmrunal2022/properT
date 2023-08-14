<form id="CompliancesForm" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row file-input-wrapper my-3">
        <div class="col-xxl-3 col-md-3 mb-3">
            <div>
                <label>
                    GHMC Approval
                </label>
                <div>
                    <input type="radio" id="html" name="ghmc_radio" value="1" onclick="toggleGhmcDiv(this)"
                        {{ isset($compliances) ? ($compliances->ghmc_radio == 1 ? 'checked' : '') : '' }}>
                    <label for="html">Yes</label>
                    <input type="radio" id="css" name="ghmc_radio" value="0" onclick="toggleGhmcDiv(this)"
                        {{ isset($compliances) ? ($compliances->ghmc_radio == 0 ? 'checked' : '') : '' }}
                        {{ isset($compliances) ? ($compliances->ghmc_radio == 1 ? 'disabled' : '') : '' }}>
                    <label for="css">No</label>
                </div>
                <span class="clr_err text-danger othe_errr ghmc_radio_err"></span>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3 hidden" id="hideGhmc"
            {{ isset($compliances) ? ($compliances->ghmc_radio == 1 ? '' : 'style=display:none') : 'style=display:none' }}>
            <div>
                <label for="files" class="form-label">
                    GHMC Approval Copy</label>
                <div class="d-flex justify-content-center flex-column ">
                    <input type="file" name="ghmc_approval_file[]" id="ghmc_approval_file"
                        class="form-control file-input" multiple="" placeholder=" " style="display:none;">
                    <label for="ghmc_approval_file" class="form-label btn-anima btn-hover hoverfEffect"> <span><i
                                class="fa-solid fa-cloud-arrow-up mx-2"></i>Add GHMC Approval
                            Copy</span></label>
                    <span class="clr_err text-danger othe_errr ghmc_approval_file_err"></span>
                </div>
            </div>
        </div>
        <div class="col-xxl-12 col-md-12 mt-3">
            @if (isset($files['ghmc']))
                @forelse($files['ghmc'] as $key=> $file)
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
                    <input type='hidden' name="ghmc_old_file[]" value="{{ $file_name['ghmc'][$key] }}">
                    <input type='hidden' name="ghmc_file_id[]" value="{{ $file_id['ghmc'][$key] }}">
                @empty
                @endforelse
            @endif
        </div>
        <div class="col-xxl-12 col-md-12 mt-3">
            <div id="files-preview"
                class="apart-images d-flex justify-content-center flex-wrap files-preview ghmcRemove">
            </div>
        </div>
    </div>
    <div class="row file-input-wrapper my-3">
        <div class="col-xxl-3 col-md-3 mb-3">
            <div>
                <label>
                    Commencement Certificate
                </label>
                <div>
                    <input type="radio" id="html" name="comm_radio" value="1" onclick="toggleCommDiv(this)"
                        {{ isset($compliances) ? ($compliances->comm_certifi_radio == 1 ? 'checked' : '') : '' }}>
                    <label for="html">Yes</label>
                    <input type="radio" id="css" name="comm_radio" value="0" onclick="toggleCommDiv(this)"
                        {{ isset($compliances) ? ($compliances->comm_certifi_radio == 0 ? 'checked' : '') : '' }}
                        {{ isset($compliances) ? ($compliances->comm_certifi_radio == 1 ? 'disabled' : '') : '' }}>
                    <label for="css">No</label>
                </div>
                <span class="clr_err text-danger othe_errr comm_radio_err"></span>
            </div>
        </div>
        <div class="col-xxl-4 col-md-4 mb-3 hidden" id="hideComm"
            {{ isset($compliances) ? ($compliances->comm_certifi_radio == 1 ? '' : 'style=display:none') : 'style=display:none' }}>
            <div>
                <label for="files" class="form-label">
                    Commencement Certificate</label>
                <div class="d-flex justify-content-center flex-column " id="commenc_file1">
                    <input type="file" name="commenc_file[]" id="commenc_file" class="form-control file-input"
                        multiple="" placeholder=" " style="display:none;">
                    <label for="commenc_file" class="form-label btn-anima btn-hover hoverfEffect"> <span><i
                                class="fa-solid fa-cloud-arrow-up mx-2"></i> Add Commencement
                            Certificate</span></label>
                </div>
                <span class="clr_err text-danger othe_errr commenc_file_err"></span>
            </div>
        </div>
        <div class="col-xxl-12 col-md-12 mt-3">
            @if (isset($files['commenc']))
                @forelse($files['commenc'] as $key => $file)
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
                    <input type='hidden' name="commenc_old_file[]" value="{{ $file_name['commenc'][$key] }}">
                    <input type='hidden' name="commenc_file_id[]" value="{{ $file_id['commenc'][$key] }}">
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
                <label for="" class="form-label">RERA Number </label>
                <input type="text" name="rear_number" class="form-control " id="" placeholder=""
                    value="{{ $compliances->rear_number ?? '' }}">
            </div>
            <span class="clr_err text-danger othe_errr rear_number_err"></span>
        </div>
        <div class="col-xxl-3 col-md-3 mb-3">
            <div>
                <label for="files" class="form-label">
                    RERA Approval Copy </label>
                <div class="d-flex justify-content-center flex-column ">
                    <input type="file" name="rear_file[]" id="rear_file" class="form-control file-input"
                        multiple="" placeholder=" " style="display:none;">
                    <label for="rear_file" class="form-label btn-anima btn-hover hoverfEffect "> <span><i
                                class="fa-solid fa-cloud-arrow-up mx-2"></i> Add RERA Approval
                            Copy</span></label>
                </div>
                <span class="clr_err text-danger othe_errr rear_file_err"></span>
            </div>
        </div>
        <div class="col-xxl-12 col-md-12 mt-3">
            @if (isset($files['rear']))
                @forelse($files['rear'] as $key => $file)
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
                    <input type='hidden' name="rear_old_file[]" value="{{ $file_name['rear'][$key] }}">
                    <input type='hidden' name="rear_file_id[]" value="{{ $file_id['rear'][$key] }}">
                @empty
                @endforelse
            @endif
        </div>
        <div class="col-xxl-12 col-md-12 mt-3">
            <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview">
            </div>
        </div>
    </div>
    <div class="row file-input-wrapper my-3">
        <div class="col-xxl-3 col-md-3 mb-3">
            <div>
                <label for="" class="form-label">DTCP/HMDA Number </label>
                <input type="text" name="hmda_number" class="form-control " id="" placeholder=""
                    value="{{ $compliances->hdma_number ?? '' }}">
            </div>
            <span class="clr_err text-danger othe_errr hmda_number_err"></span>
        </div>
        <div class="col-xxl-4 col-md-4 mb-3">
            <div>
                <label for="files" class="form-label">
                    DTCP/HMDA Approval Copy</label>
                <div class="d-flex justify-content-center flex-column ">
                    <input type="file" name="hmda_file[]" id="hmda_file" class="form-control file-input"
                        multiple="" placeholder=" " style="display:none;">
                    <label for="hmda_file" class="form-label btn-anima btn-hover hoverfEffect"> <span> <i
                                class="fa-solid fa-cloud-arrow-up mx-2"></i>Add DTCP/HMDA Approval
                            Copy</span></label>
                </div>
                <span class="clr_err text-danger othe_errr hmda_file_err"></span>
            </div>
        </div>
        <div class="col-xxl-12 col-md-12 mt-3">
            @if (isset($files['hmda']))
                @forelse($files['hmda'] as $key => $file)
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
                    <input type='hidden' name="hmda_old_file[]" value="{{ $file_name['hmda'][$key] }}">
                    <input type='hidden' name="hmda_file_id[]" value="{{ $file_id['hmda'][$key] }}">
                @empty
                @endforelse
            @endif
        </div>
        <div class="col-xxl-12 col-md-12 mt-3">
            <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview">
            </div>
        </div>
    </div>
    <div class="row file-input-wrapper my-3">
        <div class="col-xxl-3 col-md-3 mb-3">
            <div>
                <div class="d-flex justify-content-center flex-column ">
                    <input type="file" name="legal_files[]" id="legal_files" class="form-control file-input"
                        multiple="" placeholder=" " style="display:none;">
                    <label for="legal_files" class="form-label btn-anima btn-hover hoverfEffect">
                        <span> <i class="fa-solid fa-cloud-arrow-up mx-2"></i> Add Legal Documents</span></label>
                </div>
                <span class="clr_err text-danger othe_errr legal_files_err"></span>
            </div>
        </div>
        <div class="col-xxl-12 col-md-12">
            @if (isset($files['legal']))
                @forelse($files['legal'] as $key => $file)
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
                    <input type='hidden' name="legal_old_file[]" value="{{ $file_name['legal'][$key] }}">
                    <input type='hidden' name="legal_file_id[]" value="{{ $file_id['legal'][$key] }}">
                @empty
                @endforelse
            @endif
        </div>
        <div class="col-xxl-12 col-md-12">
            <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap files-preview">
            </div>
        </div>
    </div>
    <div class="row align-items-center mb-2">
        <div class="col-md-12">
            <div class="text-end">
                <input type="submit" class="btn btn-md btn-primary" value="Save" />
                <button type="button" class="btn btn-md btn-primary compliances-next-btn">Proceed</button>
            </div>
        </div>
    </div>
    </div>
</form>
