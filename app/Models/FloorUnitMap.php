<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use App\Models\Property;



class FloorUnitMap extends Model

{

    use HasFactory;

    

    protected $table = "floor_unit_map";

    protected $fillable = [		
        
                            // 'id',	
                            'property_id',	
                            'floor_id',	
                            'unit_name',	
                            'unit_cat_type_id',	
                            'unit_type_id',	
                            'unit_cat_id',	
                            'unit_sub_cat_id',	
                            'unit_brand_id',	
                            'floor_unit_sub_cat_id',	
                            'person_name',	
                            'mobile',	
                            'merge_parent_unit_id',	
                            'merge_parent_unit_status',	
                            'brand_name',	
                            'is_single',	
                            'block_id',	
                            'tower_id',	
                            'up_for_sale',	
                            'up_for_rent',
                        ];

    public function GetCategoryName()

    {

        return $this->belongsTo('App\Models\Category', 'foreign_key', 'other_key');

    }



    public function Property()

    {

        return $this->belongsTo(Property::class);

    }

    

}