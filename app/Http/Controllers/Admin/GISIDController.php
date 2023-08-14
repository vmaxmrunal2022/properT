<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\GeoID;

class GISIDController extends Controller
{

    public function search_mgis(Request $request)
    {

        $merge_gis_id_arr = GeoID::whereIn('gis_id', $request->merge_ids)->pluck('gis_id')->toArray();
        if(count($merge_gis_id_arr) == count($request->merge_ids)){
            $merge_gis_ids = Property::whereIn('gis_id', $request->merge_ids)->pluck('gis_id')->toArray();
            $status = (count($merge_gis_ids) > 0) ? false : true;
            return response()->json(['status' => $status, 'egis_ids' => $merge_gis_ids], 200);
        }
        
    }

}
