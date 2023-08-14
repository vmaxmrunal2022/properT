<form method="post" name="" id="price-trends-frm">
    @csrf
    <div class="row">
        <div class="col-xxl-3 col-md-3  mt-3"> <label for="" class="form-label"></label>
            <div class="form-check">
                <input class="form-check-input price_trends_type" type="radio" name="price_trends_type" checked
                    id="project-price-trends" data-project_status="{{ $property->projectStatus->name ?? '' }}">
                <label class="form-check-label" for="project-price-trends"> Project </label>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3  mt-3"> <label for="" class="form-label"></label>
            <div class="form-check">
                <input class="form-check-input price_trends_type" type="radio" name="price_trends_type"
                    id="tower-price-trends">
                <label class="form-check-label" for="tower-price-trends">
                    @if ($property->residential_type == 7)
                        Tower
                    @else
                        Unit
                    @endif
                </label>
            </div>
        </div>
    </div>
    <div class="row border-bottom pt-3 pb-3"> <input type="hidden" name="pt_project_status"
            value="{{ $property->project_status ?? '' }}">
        <div class="col-xxl-3 col-md-3 mt-3 price-trends-tower-cell" style="display: none;">
            <input type="hidden" name="pt_tower_status" id="pt_tower_status"
                value="{{ $property->project_status ?? '' }}">
            <div>
                <label for="" class="form-label ">
                    @if ($property->residential_type == 7)
                        Select Tower
                    @else
                        Select Unit
                    @endif
                </label>
                <select required class="form-select filter_dropdown price-trends-tower" id="" name="tower">
                    <option selected="" disabled="">-Select-</option>
                    @forelse($towers as $tower)
                        <option value="{{ $tower->id }}" data-project_status="{{ $tower->towerStatus->name ?? '' }}"
                            data-project_status_id="{{ $tower->tower_status ?? '' }}">
                            {{ $tower->tower_name }}
                    </option> @empty
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div> <label for="" class="form-label ">Status of the Project</label> <input required type="text"
                    id="price-trends-tower-status" class="form-control"
                    value="{{ $property->projectStatus->name ?? '' }}" disabled> </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div> <label for="" class="form-label ">Date</label> <input required type="date" name="date"
                    class="form-control" value=""> </div>
        </div>
        <div class="col-xxl-3 col-md-3 mt-3">
            <div> <label for="" class="form-label ">Price in Sq.fts</label> <input required type="text" name="price"
                    class="form-control" value="" onkeypress="return isNumber(event)"> </div>
        </div>
        <div class="col-md-12">
            <div class="text-end mt-3"> <input type="submit" class="btn btn-md btn-primary" value="Save"> </div>
        </div>
    </div>
</form>
<div class="table-responsive " id="pagination_data"> @include('admin.pages.property.secondary_data.price_trends.price_trends_paginate', [
    'price_trends' => $price_trends,
])</div>
