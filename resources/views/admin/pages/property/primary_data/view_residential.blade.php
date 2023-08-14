<div class="row">

    <div class="col-xxl-3 col-md-3  mt-3 plot_land_blks"  >
        <div>
            <label for="" class="form-label">Residential Category</label>
            <input type="text" value="{{$property->residential_category->cat_name ?? ''}}" class="form-control" name="plot_land_type" id="plot_land_types" disabled>
        </div>
    </div>


    <div class="col-xxl-3 col-md-3  mt-3 plot_land_blks"  >
        <div>
            <label for="" class="form-label">Residential Sub Category</label>
            <input type="text" value="{{$property->residential_sub_category->cat_name ?? ''}}" class="form-control" name="plot_land_type" id="plot_land_types" disabled>
        </div>
    </div>
</div>


@foreach($categories as $category)
    @if($property->residential_sub_type == $category->id)
        @include('admin.pages.property.'.str_replace("primary_data.","primary_data.view_", $category->blade_slug))
    @endif
@endforeach
<div class="category-fields-container">
    
</div>