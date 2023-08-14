<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, SubCategory, PropertyImage, Property, FloorUnitCategory, Tower, FloorUnitMap, PropertyFloorMap, Builder, ProjectStatusFilterField, PriceTrend};

use Validator;
use Stevebauman\Location\Facades\Location;
use Carbon\Carbon;
use DataTables;
use DateTime;
use Str;
use App\Exports\PropertiesExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use PDF;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use Auth;

class PriceTrendsController extends Controller
{
    public function index(Request $request)
    {
        $price_trends = PriceTrend::where('property_id', $request->property_id)->paginate(10);
        $towers = Tower::where('property_id', $request->property_id)
            ->whereIn('tower_status', [1, 2, 4])
            ->get();
        $property = Property::find($request->property_id);
        return view('admin.pages.property.secondary_data.price_trends.index', get_defined_vars());
    }

    public function store(Request $request)
    {
        // return $request->all();
        $price_trend = new PriceTrend();
        $price_trend->property_id = $request->property_id;
        $price_trend->date = $request->date;
        $price_trend->project_status = $request->pt_project_status;
        $price_trend->tower_status = $request->pt_tower_status;
        $price_trend->tower_id = $request->tower;
        $price_trend->price = $request->price;
        $price_trend->save();

        if (!isset($request->tower)) {
            $property = Property::find($request->property_id);
            $property->price = $request->price;
            $property->save();
        }

        if ($price_trend) {
            return response()->json(['status' => true, 'message' => 'Price Trends Added Successfully.'], 200);
        }
        if ($price_trend) {
            return response()->json(['status' => false], 409);
        }
    }
}
