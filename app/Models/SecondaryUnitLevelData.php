<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Unit;
use App\Models\OwnershipOptions;

use App\Models\FurnishingTypeOption;

class SecondaryUnitLevelData extends Model
{
    protected $table = 'secondary_level_unit_data';
    // protected $fillable = ['property_id', 'unit_id', 'unit_type_id', 'unit_cat_id', 'property_cat_id','
    // '];
    protected $guarded = [];

    public static function getOptionName($id)
    {
        if ($id) {
            $option = UnitAmenityOption::find($id);
            return $option->name ? $option->name : '';
        } else {
            return '';
        }
    }

    public static function getOptionValues($id)
    {
        if ($id) {
            $option = UnitAmenityOption::find($id);
            return $option ? $option : '';
        } else {
            return '';
        }
    }

    public static function getAreaUnit($area_unit_id)
    {
        if ($area_unit_id) {
            $area_unit = Unit::find($area_unit_id);
            return $area_unit->name ? $area_unit->name : '';
        } else {
            return '';
        }
    }

    public static function getMultipleOptions($unit_id, $property_id, $amenity_id)
    {
        if ($unit_id && $property_id) {
            $option = UnitAmenityOptionValue::where('property_id', $property_id)->where('unit_id', $unit_id)
                ->where('amenity_id', $amenity_id)->get();

            return $option ? $option : '';
        } else {
            return '';
        }
    }

    public static function getFurnishing($unit_id, $property_id, $amenity_id, $fur_id)
    {
        if (isset($fur_id) && $fur_id != null) {
            if ($unit_id && $property_id) {
                $option = UnitAmenityOptionValue::where('property_id', $property_id)->where('unit_id', $unit_id)
                    ->where('amenity_id', $amenity_id)->where('amenity_option_id', $fur_id)
                    ->get();

                return $option ? $option : '';
            } else {
                return '';
            }
        } else {
            if ($unit_id && $property_id) {
                $option = UnitAmenityOptionValue::where('property_id', $property_id)->where('unit_id', $unit_id)
                    ->where('amenity_id', $amenity_id)
                    ->get();

                return $option ? $option : '';
            } else {
                return '';
            }
        }
    }
    public static function getMultipleFurnishedOptions($amenity_id)
    {
        if ($amenity_id) {
            $option = FurnishingTypeOption::find($amenity_id);
            return $option ? $option : '';
        } else {
            return '';
        }
    }


    // public function getOwnership()
    // {
    //     return $this->hasOne(OwnershipOptions::class, 'id', 'ownership');
    // }

    public static function getImages($unit_id, $property_id)
    {
        if ($unit_id && $property_id) {
            $option = UnitImage::where('property_id', $property_id)->where('unit_id', $unit_id)
                ->get();
            return $option ? $option : '';
        } else {
            return '';
        }
    }
    public static function getFloor($floor_id)
    {
        if ($floor_id) {
            $option = FloorType::find($floor_id);
            // dd($option);
            return $option ? $option : '';
        } else {
            return '';
        }
    }

    public static function getOwnership($id)
    {
        if ($id) {
            $option = OwnershipOptions::find($id);
            // dd($option);
            return $option ? $option : '';
        } else {
            return '';
        }
    }
}
