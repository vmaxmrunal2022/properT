<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PropertyImage;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\FloorUnitMap;
use App\Models\Builder;
use App\Models\Block;

class Property extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'properties';



    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    // without foreign key
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }
    public function residential_category()
    {
        return $this->belongsTo(Category::class, 'residential_type', 'id');
    }
    public function residential_sub_category()
    {
        return $this->belongsTo(Category::class, 'residential_sub_type', 'id');
    }
    
    public function under_construction_category()
    {
        return $this->belongsTo(Category::class, 'under_construction_type', 'id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_cat_id', 'id');
    }
     public function getBuilderName()
    {
        return $this->belongsTo('App\Models\Builder', 'builder_id', 'id');
    }
    public function GetPropertyName()
    {
        return $this->belongsTo('App\Models\Category', 'plot_land_type', 'id');
    }

    public function plot_land_sub_type()
    {
        return $this->belongsTo(Category::class, 'plot_land_type', 'id');
    }
    
    public function builderName()
    {
        return $this->hasMany(Builder::class, 'id', 'builder_id');
    } 

    public function floors()
    {
        return $this->hasMany(FloorUnitMap::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function projectStatus()
    {
        return $this->belongsTo(ProjectStatus::class, 'project_status', 'id');
    }
    public function property_floors()
    {
        return $this->hasMany(PropertyFloorMap::class, 'property_id', 'id');
    }
    public function pincode()
    {
        return $this->hasMany(GeoID::class, 'gis_id', 'gis_id');
    }

}
