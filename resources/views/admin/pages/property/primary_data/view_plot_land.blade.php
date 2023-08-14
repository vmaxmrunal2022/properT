<div class="plot-land">
    <div class="col-xxl-3 col-md-3  mt-3 plot_land_blks"  >
        <div>
            <label for="" class="form-label">Plot Land Types <span class="errorcl">*</span></label>
            <input type="text" value="{{$property->GetPropertyName->cat_name}}" class="form-select" name="plot_land_type" id="plot_land_types" disabled>
            <!--<select class="form-select get-category-fields" >-->
            <!--        <option value=""> </option>-->
            <!--</select>-->
        </div>
    </div>
</div>
@foreach($categories as $category)
    @if($property->plot_land_type == $category->id)
        @include('admin.pages.property.'.str_replace("primary_data.","primary_data.view_", $category->blade_slug))
    @endif
@endforeach
<div class="category-fields-container">
    
</div>