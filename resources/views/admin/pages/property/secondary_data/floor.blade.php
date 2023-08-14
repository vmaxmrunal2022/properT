@for ($i = $start_index; $i < $count; $i++)
    <div
        class="row gx-2 mt-3 py-2 align-items-center floor_no_child storey pfloor-{{ $i }} rounded border border-dark">
        <div class="row dds_row floor-dds_row">
            <div class="col-auto p-0 h-100 w-10 ">
                <input class="form-check-input floor-chk d-none floor-parent-{{ $i }} mx-2 border border-dark"
                    data-parent="{{ $i }}" type="checkbox" name="floor[]" value="{{ $i }}"
                    id="flexCheckDefault">
            </div>

            <div class="col-auto storey-nou-child">
                <div>
                    <label for="" class="form-label">No of Units per Floor {{ $i + 1 }}<span
                            class="errorcl">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm no_of_units w-50"
                            data-pid="{{ $i }}" name="nth_unit[]" placeholder="0" aria-label=""
                            aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-success add-unit" type="button" id="button-addon2">Add
                                Units</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-auto">
                <div>
                    <label for="" class="form-label"> Floor Name {{ $i + 1 }} <span
                            class="errorcl">*</span></label>
                    <div class="input-group" id="floor_name{{ $i }}">
                        <input type="text" class="form-control form-control-sm" name="floor_name[]">
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
        <div class="mt-2" style="display: flex; justify-content: start;align-items: end;">
            <div class="">
                <label for="floor-check-{{$i}}" class="form-control floor-merge-btn btn btn-sm btn-outline-success mb-0"> 
                Merge Floors
                <input type="checkbox" class="d-none merge_other_floors" name="" data-current="{{$i}}" id="floor-check-{{$i}}" data-suid="1" data-pid="1" >
            </div>
            
            <div class="d-none  save-merge-btn save-merge-btn-{{$i}}">
                <label for="" class="form-label">  <span class="errorcl"></span> </label>
                <button type="button" class="btn btn-sm btn-outline-success save-floor-merge">save</button>
            </div>
        </div>
    </div> --}}

        <div class="unit-container"></div>

        <span class="remove-storey d-none">
            <span class="mdi mdi-minus-box-outline mdi-18px"></span>
        </span>

    </div>
@endfor
