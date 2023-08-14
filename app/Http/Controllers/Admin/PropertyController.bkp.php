<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\PropertyImage;
use App\Models\Property;
use App\Models\FloorUnitCategory;
use App\Models\Tower;
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
use App\Models\FloorUnitMap;
use App\Models\PropertyFloorMap;
use App\Models\Builder;
use App\Models\Unit;
use Illuminate\Support\Facades\View;
use Illuminate\Http\JsonResponse;
use App\Services\FloorService;

class PropertyController extends Controller
{
    protected $floorService;

    public function __construct(FloorService $floorService)
    {
        $this->floorService = $floorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$categories = Category::where('parent_id', NULL)->OrderBy('id', 'ASC')->get();
        //$brand_parent_categories = FloorUnitCategory::where('category_code', 3)->orderBy('id', 'ASC')->get();
        // return $currentUserInfo = Location::get($ip);

        $sub_categories = Category::orderBy('id', 'ASC')->get();
        $prop_categories = Category::where('parent_id', NULL)->OrderBy('id', 'ASC')->get();
        $builders = Builder::all();

        $categories = Category::where('parent_id', NULL)->OrderBy('id', 'ASC')->get();
        $brand_parent_categories = FloorUnitCategory::where('category_code', 3)->orderBy('id', 'ASC')->get();

        return view('admin.pages.property.demo_index', get_defined_vars());
    }
    public function index_detto()
    {
        $categories = Category::all();
        $sub_categories = SubCategory::where('parent_id', 0)->get();

        // return $currentUserInfo = Location::get($ip);
        return view('admin.pages.property.index_detto', compact('categories', 'sub_categories'));
    }

    public function getBasicJson()
    {
        $b_json = json_decode(file_get_contents(asset('assets/js/property_basic_form.json')), true);
        return $b_json;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // if ($request->ajax()) {
        //     return response()->json(array(
        //         'success' => false,
        //     ), 403);
        // }

        $input_data = $request->all();

        $validator = Validator::make(
            $input_data,
            [
                // 'files' => 'required',
                // 'files.*' => 'mimes:jpg,jpeg,png,bmp|max:20000',
                // 'city' => 'required',
                'gis_id' => 'required|unique:properties',
                'latitude' => 'required',
                'longitude' => 'required',


                'category' => 'required',
                // 'sub_category' => 'required_if:category,' . implode(',', [1, 2, 3, 4]),
                // 'house_no' => 'required',
                // 'plot_no' => 'required',
                // 'street_details' => 'required',
                // 'locality_name' => 'required',
                // 'owner_name' => 'required',
                // 'contact_no' => 'required',
                // 'remarks' => 'required',
            ],
            [
                'files.*.required' => 'Please upload an image',
                'files.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                'files.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
                'category.numeric' => 'Please choose a category',
                'sub_category.numeric' => 'Please choose a Sub Category',

                // 'files.*' => 'required',
                // 'files.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                // 'files.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
                // 'files.*.required' => 'Please upload an image',
                // 'category.numeric' => 'Please choose a category',
                // 'sub_category.numeric' => 'Please choose a Sub Category',
            ]
        );

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }
            // return  $validator->getMessageBag()->toArray();
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $property = new Property;
            // $property->city = $request->city;
            $property->gis_id = $request->gis_id;
            $property->cat_id = $request->category;
            $property->sub_cat_id = $request->sub_category;
            $property->house_no = $request->house_no;
            $property->building_name = $request->building_name;
            $property->plot_no = $request->plot_no;
            $property->street_details = $request->street_name;
            $property->locality_name = $request->locality_name;
            $property->owner_name = $request->owner_name;
            $property->contact_no = $request->contact_no;
            $property->remarks = $request->remarks;
            $property->latitude = $request->latitude;
            $property->longitude = $request->longitude;
            $property->created_by = Auth::user()->id;
            $property->no_of_floors = $request->no_of_floors;
            $property->residential_type = isset($request->residential_type) ? $request->residential_type : 0;
            $property->residential_sub_type = isset($request->residential_sub_type) ? $request->residential_sub_type : 0;
            $property->project_name = isset($request->project_name) ? $request->project_name : 0;
            $property->builder_id   = isset($request->builder_id) ? $request->builder_id : 0;
            $property->plot_land_type   = isset($request->plot_land_type) ? $request->plot_land_type : 0;
            $property->plot_name    = isset($request->plot_name) ? $request->plot_name : 0;
            $property->boundary_wall_availability   = isset($request->boundary_wall_availability) ? 1 : 0;
            $property->any_legal_litigation_board   = isset($request->any_legal_litigation_board) ? 1 : 0;
            $property->ownership_claim_board    = isset($request->ownership_claim_board) ? 1 : 0;
            $property->bank_auction_board   = isset($request->bank_auction_board) ? 1 : 0;
            $property->for_sale_board   = isset($request->for_sale_board) ? 1 : 0;
            $property->under_construction_type = isset($request->under_construction_type) ? $request->under_construction_type : NULL;
            $property->up_for_sale = isset($request->up_for_sale) ? 1 : 0;
            $property->up_for_rent = isset($request->up_for_rent) ? 1 : 0;
            $property->cat_gc = isset($request->property_gcc) ? $request->property_gcc : 0;
            $property->save();


            $merge_parent_floor_id = 0;
            $child_floor_arr = [];

            // $floor_unit = ($request->merge_parent_unit_id != '') ? explode('-',$request->merge_parent_unit_id) : '';
            $merge_parent_unit_id = NULL;
            // $merge_unit_parent_floor_id = 0;  
            // $child_unit_arr = [];
            $checked_floors = isset($request->floor) ? $request->floor : [];
            for ($f = 0; $f < (int)$request->no_of_floors; $f++) {

                $floor = new PropertyFloorMap;
                $floor->property_id = $property->id;
                $floor->floor_no = $f ?? 0;
                $floor->units = $request->nth_unit[$f] ?? 0;
                $floor->floor_name = $request->floor_name[$f] ?? 0;
                $floor->merge_parent_floor_id =  NULL;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                if ($request->merge_parent_floor_id == $f) {
                    $merge_parent_floor_id = $floor->id;
                }

                // isset($request->nth_unit[$f]) ? array_push($child_floor_arr, $floor->id) : '' ;

                if (isset($request->nth_unit[$f])) {
                    if ((int)$request->nth_unit[$f] > 1) {
                        for ($u = 0; $u < (int)$request->nth_unit[$f]; $u++) {
                            $checked_units = [];
                            $nth_unit_name_key = 'nth_unit_name' . $f;
                            $uprop_category_key = 'uprop_category' . $f;
                            $uu_type_key = 'uu_type' . $f;
                            $unit_category_key = 'unit_category' . $f;
                            $unit_sub_category_key = 'unit_sub_category' . $f;
                            $unit_brand_key = 'unit_brand' . $f;
                            $person_name_key = 'person_name' . $f;
                            $mobile_key = 'mobile' . $f;
                            $floor_unit_sub_cat_id_status = 'unit_check' . $f;
                            $unit_brand_name = 'unit_brand_name' . $f;
                            $unit_up_for_sale = 'unit_up_for_sale' . $f;
                            $unit_up_for_rent = 'unit_up_for_rent' . $f;
                            $unit_brand = NULL;


                            $unit = new FloorUnitMap;
                            $unit->property_id          = $property->id;
                            $unit->floor_id             = $floor->id;
                            $unit->unit_name            = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                            $unit->unit_cat_type_id     = isset($request->$uprop_category_key[$u]) ? $request->$uprop_category_key[$u] : 0;
                            $unit->unit_type_id         = isset($request->$uu_type_key[$u]) ? $request->$uu_type_key[$u] : 0;
                            $unit->unit_cat_id          = isset($request->$unit_category_key[$u]) ? $request->$unit_category_key[$u] : 0;
                            $unit->unit_sub_cat_id      = isset($request->$unit_sub_category_key[$u]) ? $request->$unit_sub_category_key[$u] : 0;

                            $unit->person_name          = isset($request->$person_name_key[$u]) ? $request->$person_name_key[$u] : '';
                            $unit->mobile               = isset($request->$mobile_key[$u]) ? $request->$mobile_key[$u] : '';
                            $unit->up_for_sale          = isset($request->$unit_up_for_sale[$u]) ? 1 : 0;
                            $unit->up_for_rent          = isset($request->$unit_up_for_rent[$u]) ? 1 : 0;
                            $unit->merge_parent_unit_id = NULL;
                            $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0;
                            $unit->floor_unit_sub_cat_id = 0;

                            if (isset($request->$unit_brand_key[$u])) {
                                if (is_numeric($request->$unit_brand_key[$u])) {
                                    $check_floor_category = FloorUnitCategory::find($request->$unit_brand_key[$u]);
                                    if ($check_floor_category) {
                                        $unit->unit_brand_id = $request->$unit_brand_key[$u];
                                        $unit->brand_name = '';
                                    }
                                } else {
                                    $unit->unit_brand_id = 0;
                                    $unit->brand_name = $request->$unit_brand_key[$u];
                                }
                            }

                            $unit->save();

                            if ($request->merge_unit_parent_floor_id == $f && $request->merge_parent_unit_id == $u) {
                                $merge_parent_unit_id = $unit->id;
                            }
                        }
                    } else {
                        $unit = new FloorUnitMap;
                        $unit->property_id          = $property->id;
                        $unit->floor_id             = $floor->id;
                        $unit->unit_name            = '';
                        $unit->unit_cat_type_id     = $request->prop_category[$f] ?? 0;
                        $unit->unit_type_id         = $request->unit_type[$f] ?? 0;
                        $unit->unit_cat_id          = $request->fu_category[$f] ?? 0;
                        $unit->unit_sub_cat_id      = $request->fu_sub_category[$f] ?? 0;
                        // $unit->unit_brand_id        = $request->floor_brand[$f] ?? 0 ;
                        $unit->person_name          = $request->person_name[$f] ?? '';
                        $unit->mobile               = $request->mobile[$f] ?? '';
                        $unit->up_for_sale          = isset($request->floor_up_for_sale[$f]) ? 1 : 0;
                        $unit->up_for_rent          = isset($request->floor_up_for_rent[$f]) ? 1 : 0;
                        $unit->merge_parent_unit_id = NULL;
                        $unit->floor_unit_sub_cat_id = 0;
                        if (isset($request->floor_brand[$f])) {
                            if (is_numeric($request->floor_brand[$f])) {
                                $check_floor_category = FloorUnitCategory::find($request->floor_brand[$f]);
                                if ($check_floor_category) {
                                    $unit->unit_brand_id = $request->floor_brand[$f];
                                    $unit->brand_name = '';
                                }
                            } else {
                                $unit->unit_brand_id = 0;
                                $unit->brand_name = $request->floor_brand[$f];
                            }
                        }
                        // $unit->brand_name      = $request->floor_brand_name[$f] ?? '' ;
                        $unit->save();
                    }
                } else {
                    $unit = new FloorUnitMap;
                    $unit->property_id           = $property->id;
                    $unit->floor_id              = $floor->id;
                    $unit->unit_name             = '';
                    $unit->unit_cat_type_id      = $request->prop_category[$f] ?? 0;
                    $unit->unit_type_id          = $request->unit_type[$f] ?? 0;
                    $unit->unit_cat_id           = $request->fu_category[$f] ?? 0;
                    $unit->unit_sub_cat_id       = $request->fu_sub_category[$f] ?? 0;
                    // $unit->unit_brand_id         = $request->floor_brand[$f] ?? 0 ;
                    $unit->person_name           = $request->person_name[$f] ?? '';
                    $unit->mobile                = $request->mobile[$f] ?? '';
                    $unit->up_for_sale           = isset($request->floor_up_for_sale[$f]) ? 1 : 0;
                    $unit->up_for_rent           = isset($request->floor_up_for_rent[$f]) ? 1 : 0;
                    $unit->merge_parent_unit_id  = NULL;
                    $unit->floor_unit_sub_cat_id = 0;
                    // $unit->brand_name            = $request->floor_brand_name[$f] ?? '' ;
                    if (isset($request->floor_brand[$f])) {
                        if (is_numeric($request->floor_brand[$f])) {
                            $check_floor_category = FloorUnitCategory::find($request->floor_brand[$f]);
                            if ($check_floor_category) {
                                $unit->unit_brand_id = $request->floor_brand[$f];
                                $unit->brand_name = '';
                            }
                        } else {
                            $unit->unit_brand_id = 0;
                            $unit->brand_name = $request->floor_brand[$f];
                        }
                    }
                    $unit->save();
                }
            }

            $floors = PropertyFloorMap::where('property_id', $property->id)->where('merge_parent_floor_status', 1)->get();
            $parent_floor_unit = FloorUnitMap::where('floor_id', $merge_parent_floor_id)->first();
            $parent_floor        = PropertyFloorMap::where('id', $merge_parent_floor_id)->first();
            foreach ($floors as $floor) {
                if ($merge_parent_floor_id != $floor->id) {
                    $floor = PropertyFloorMap::find($floor->id);
                    $floor->units                   = 0;
                    $floor->floor_name                   = $parent_floor->floor_name;
                    $floor->merge_parent_floor_id   = $merge_parent_floor_id;
                    $floor->merge_parent_floor_status = 0;
                    $floor->save();
                    $child_floor = FloorUnitMap::where('floor_id', $floor->id)->first();
                    $child_floor->unit_cat_type_id     = $parent_floor_unit->unit_cat_type_id;
                    $child_floor->unit_type_id         = $parent_floor_unit->unit_type_id;
                    $child_floor->unit_cat_id          = $parent_floor_unit->unit_cat_id;
                    $child_floor->unit_sub_cat_id      = $parent_floor_unit->unit_sub_cat_id;
                    $child_floor->unit_brand_id        = $parent_floor_unit->unit_brand_id;
                    $child_floor->person_name          = $parent_floor_unit->person_name;
                    $child_floor->mobile               = $parent_floor_unit->mobile;
                    $child_floor->up_for_sale          = $parent_floor_unit->up_for_sale;
                    $child_floor->up_for_rent          = $parent_floor_unit->up_for_sale;
                    $child_floor->brand_name           = $parent_floor_unit->brand_name;
                    $child_floor->save();
                }
            }
            $units = FloorUnitMap::where('property_id', $property->id)->where('merge_parent_unit_status', 1)->get();
            $parent_unit = FloorUnitMap::find($merge_parent_unit_id);
            foreach ($units as $unit) {
                if ($merge_parent_unit_id != $unit->id) {
                    $unit = FloorUnitMap::find($unit->id);
                    $unit->unit_name            = $parent_unit->unit_name;
                    $unit->unit_cat_type_id     = $parent_unit->unit_cat_type_id;
                    $unit->unit_type_id         = $parent_unit->unit_type_id;
                    $unit->unit_cat_id          = $parent_unit->unit_cat_id;
                    $unit->unit_sub_cat_id      = $parent_unit->unit_sub_cat_id;
                    $unit->unit_brand_id        = $parent_unit->unit_brand_id;
                    $unit->person_name          = $parent_unit->person_name;
                    $unit->mobile               = $parent_unit->mobile;
                    $unit->up_for_sale          = $parent_unit->up_for_sale;
                    $unit->up_for_rent          = $parent_unit->up_for_rent;
                    $unit->brand_name           = $parent_unit->brand_name;
                    $unit->merge_parent_unit_id = $merge_parent_unit_id;
                    $unit->merge_parent_unit_status = 0;
                    $unit->save();
                }
            }

            if ($request->ajax()) {
                // return $floors = self::editFloors($request, $property->id);
                return response()->json(array(
                    'success' => true,
                    'data'    => [
                        'id' => $property->id,
                        'action_url' => url('surveyor/property/update_details/' . $property->id),
                    ],
                ), 200);
            }

            return redirect()->route('completed')->with('message', 'Property Added Successfully')->with('back_url', url('surveyor/property/basic_details'));
        } catch (\Exception $e) {
            $statusCode = $e->getCode();
            if ($statusCode < 100 || $statusCode >= 600) {
                $statusCode = 500;
            }
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'data'    => [],
                    'statusCode' => $statusCode,
                    'message' => get_response_description($statusCode)
                ), $statusCode);
            }
            // Handle the exception and the status code
            // ...

            // Optional: Log the exception
            // Log::error($e->getMessage());

            // Optional: Display a friendly error message to the user
            // return response()->json(['error' => 'An error occurred. Please try again.'], $statusCode);
        }

        // if ($request->ajax()) {
        //     return response()->json(array(
        //         'success' => false,
        //     ), 403);
        // }


    }

    public function editFloors(Request $request)
    {
        $property_id = $request->property_id;
        $property_cat_id = Property::find($request->property_id);
        $property_cat_id = $property_cat_id->cat_id;
        $floors = PropertyFloorMap::where('property_id', $property_id)->orderBy('id', 'ASC')->get();
        $floor_index = [];
        $parent_unit_id = [];
        $parent_floors = [];
        foreach ($floors as $key => $floor) {
            $floor_index[$floor->id] = $floor->floor_no;
            array_push($parent_floors, $floor->merge_parent_floor_id);
        }

        $units = FloorUnitMap::where('property_id', $property_id)->where('is_single', 0)->orderBy('id', 'ASC')->get();
        $parent_units = [];
        foreach ($units as $key => $unit) {
            $parent_unit_id[$unit->id] = $unit->floor_id;
            array_push($parent_units, $unit->merge_parent_unit_id);
        }
        $custom_brands = FloorUnitMap::where('property_id', $request->property_id)->get();
        $prop_categories = Category::where('parent_id', NULL)->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->get();
        $unit_category_list = FloorUnitCategory::where('category_code', 2)->get();
        $unit_sub_category_list = FloorUnitCategory::where('category_code', 3)->get();
        $brands = FloorUnitCategory::where('category_code', 4)->get();
        return view('admin.pages.property.edit_floor', get_defined_vars());
    }

    public function save_floor_merge(Request $request)
    {
        $merge_parent_floor_id = 0;
        $child_floor_arr = [];
        // $floor_unit = ($request->merge_parent_unit_id != '') ? explode('-',$request->merge_parent_unit_id) : '';
        $merge_parent_unit_id = NULL;
        // $merge_unit_parent_floor_id = 0;  
        // $child_unit_arr = [];
        $checked_floors = isset($request->floor) ? $request->floor : [];
        for ($f = 0; $f < (int)$request->no_of_floors; $f++) {
            if (!isset($request->floor_id[$f])) {
                $floor = new PropertyFloorMap;
                $floor->property_id = $request->property_id;
                $floor->floor_no = $f ?? 0;
                $floor->floor_name = $request->floor_name[$f] ?? 0;
                $floor->units = $request->nth_unit[$f] ?? 0;
                $floor->merge_parent_floor_id =  NULL;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                if ($request->merge_parent_floor_id == $f) {
                    $merge_parent_floor_id = $floor->id;
                }
                $new_floor_id = $floor->id;
                if (isset($request->nth_unit[$f])) {
                    if ((int)$request->nth_unit[$f] < 2) {

                        $unit = new FloorUnitMap;
                        $unit->property_id          = $request->property_id;
                        $unit->floor_id             = $new_floor_id;
                        $unit->unit_name            = '';
                        $unit->unit_cat_type_id     = $request->prop_category[$f] ?? 0;
                        $unit->unit_type_id         = $request->unit_type[$f] ?? 0;
                        $unit->unit_cat_id          = $request->fu_category[$f] ?? 0;
                        $unit->unit_sub_cat_id      = $request->fu_sub_category[$f] ?? 0;
                        // $unit->unit_brand_id        = $request->floor_brand[$f] ?? 0 ;
                        $unit->person_name          = $request->person_name[$f] ?? '';
                        $unit->mobile               = $request->mobile[$f] ?? '';
                        $unit->up_for_sale          = isset($request->floor_up_for_sale[$f]) ? 1 : 0;
                        $unit->up_for_rent          = isset($request->floor_up_for_rent[$f]) ? 1 : 0;
                        $unit->merge_parent_unit_id = NULL;
                        $unit->floor_unit_sub_cat_id = 0;
                        if (isset($request->floor_brand[$f])) {
                            if (is_numeric($request->floor_brand[$f])) {
                                $check_floor_category = FloorUnitCategory::find($request->floor_brand[$f]);
                                if ($check_floor_category) {
                                    $unit->unit_brand_id = $request->floor_brand[$f];
                                    $unit->brand_name = '';
                                }
                            } else {
                                $unit->unit_brand_id = 0;
                                $unit->brand_name = $request->floor_brand[$f];
                            }
                        }
                        // $unit->brand_name           = isset($request->floor_brand_name[$f]) ? $request->floor_brand_name[$f] : '';
                        $unit->save();
                    }
                }
            } elseif ($request->floor_id[$f] != 0) {
                $floor = PropertyFloorMap::find($request->floor_id[$f]);
                $floor->floor_name = $request->floor_name[$f] ?? 0;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                $unit = FloorUnitMap::where('floor_id', $floor->id)->first();
                $unit->property_id          = $request->property_id;
                $unit->floor_id             = $floor->id;
                $unit->unit_name            = '';
                $unit->unit_cat_type_id     = $request->prop_category[$f] ?? 0;
                $unit->unit_type_id         = $request->unit_type[$f] ?? 0;
                $unit->unit_cat_id          = $request->fu_category[$f] ?? 0;
                $unit->unit_sub_cat_id      = $request->fu_sub_category[$f] ?? 0;
                // $unit->unit_brand_id        = $request->floor_brand[$f] ?? 0 ;
                $unit->person_name          = $request->person_name[$f] ?? '';
                $unit->mobile               = $request->mobile[$f] ?? '';
                $unit->up_for_sale          = isset($request->floor_up_for_sale[$f]) ? 1 : 0;
                $unit->up_for_rent          = isset($request->floor_up_for_rent[$f]) ? 1 : 0;
                // $unit->merge_parent_unit_id = NULL;
                // $unit->floor_unit_sub_cat_id= 0;
                if (isset($request->floor_brand[$f])) {
                    if (is_numeric($request->floor_brand[$f])) {
                        $check_floor_category = FloorUnitCategory::find($request->floor_brand[$f]);
                        if ($check_floor_category) {
                            $unit->unit_brand_id = $request->floor_brand[$f];
                            $unit->brand_name = '';
                        }
                    } else {
                        $unit->unit_brand_id = 0;
                        $unit->brand_name = $request->floor_brand[$f];
                    }
                }
                // $unit->brand_name           = isset($request->floor_brand_name[$f]) ? $request->floor_brand_name[$f] : '';
                $unit->save();
                if ($request->merge_parent_floor_id == $request->floor_id[$f]) {
                    $merge_parent_floor_id = $floor->id;
                }
            }

            if (isset($request->nth_unit[$f])) {
                if ((int)$request->nth_unit[$f] > 1) {
                    for ($u = 0; $u < (int)$request->nth_unit[$f]; $u++) {
                        $checked_units = [];
                        $nth_unit_name_key              = 'nth_unit_name' . $f;
                        $uprop_category_key             = 'uprop_category' . $f;
                        $uu_type_key                    = 'uu_type' . $f;
                        $unit_category_key              = 'unit_category' . $f;
                        $unit_sub_category_key          = 'unit_sub_category' . $f;
                        $unit_brand_key                 = 'unit_brand' . $f;
                        $person_name_key                = 'person_name' . $f;
                        $mobile_key                     = 'mobile' . $f;
                        $floor_unit_sub_cat_id_status   = 'unit_check' . $f;
                        $unit_id_key                    = 'unit_id' . $f;
                        $unit_brand_name                = 'unit_brand_name' . $f;
                        $unit_up_for_sale               = 'unit_up_for_sale' . $f;
                        $unit_up_for_rent               = 'unit_up_for_rent' . $f;

                        if (!isset($request->$unit_id_key[$u])) {
                            $unit = new FloorUnitMap;
                            $unit->property_id          = $request->property_id;
                            $unit->floor_id             = $floor->id;
                            $unit->unit_name            = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                            $unit->unit_cat_type_id     = isset($request->$uprop_category_key[$u]) ? $request->$uprop_category_key[$u] : 0;
                            $unit->unit_type_id         = isset($request->$uu_type_key[$u]) ? $request->$uu_type_key[$u] : 0;
                            $unit->unit_cat_id          = isset($request->$unit_category_key[$u]) ? $request->$unit_category_key[$u] : 0;
                            $unit->unit_sub_cat_id      = isset($request->$unit_sub_category_key[$u]) ? $request->$unit_sub_category_key[$u] : 0;
                            // $unit->unit_brand_id        = isset($request->$unit_brand_key[$u]) ? $request->$unit_brand_key[$u] : 0;
                            $unit->person_name          = isset($request->$person_name_key[$u]) ? $request->$person_name_key[$u] : '';

                            $unit->mobile               = isset($request->$mobile_key[$u]) ? $request->$mobile_key[$u] : '';
                            $unit->up_for_sale          = isset($request->$unit_up_for_sale[$u]) ? 1 : 0;
                            $unit->up_for_rent          = isset($request->$unit_up_for_rent[$u]) ? 1 : 0;
                            if (isset($request->$unit_brand_key[$u])) {
                                if (is_numeric($request->$unit_brand_key[$u])) {
                                    $check_floor_category = FloorUnitCategory::find($request->$unit_brand_key[$u]);
                                    if ($check_floor_category) {
                                        $unit->unit_brand_id = $request->$unit_brand_key[$u];
                                        $unit->brand_name = '';
                                    }
                                } else {
                                    $unit->unit_brand_id = 0;
                                    $unit->brand_name = $request->$unit_brand_key[$u];
                                }
                            }
                            // $unit->merge_parent_unit_id = NULL;
                            // $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0 ;
                            // $unit->floor_unit_sub_cat_id = 0;
                            // $unit->brand_name           = isset($request->$unit_brand_name[$u]) ? $request->$unit_brand_name[$u] : '';
                            $unit->save();
                        }
                    }
                } else {
                }
            }
        }

        $floors              = PropertyFloorMap::where('property_id', $request->property_id)->where('merge_parent_floor_status', 1)->get();
        $parent_floor_unit   = FloorUnitMap::where('floor_id', $merge_parent_floor_id)->first();
        $parent_floor        = PropertyFloorMap::where('id', $merge_parent_floor_id)->first();
        foreach ($floors as $floor) {
            if ($merge_parent_floor_id != $floor->id) {
                $floor = PropertyFloorMap::find($floor->id);
                $floor->floor_name                = $parent_floor->floor_name;
                $floor->units                     = 0;
                $floor->merge_parent_floor_id     = $merge_parent_floor_id;
                $floor->merge_parent_floor_status = 0;
                $floor->save();

                $child_floor = FloorUnitMap::where('floor_id', $floor->id)->first();
                $child_floor->unit_cat_type_id     = $parent_floor_unit->unit_cat_type_id;
                $child_floor->unit_type_id         = $parent_floor_unit->unit_type_id;
                $child_floor->unit_cat_id          = $parent_floor_unit->unit_cat_id;
                $child_floor->unit_sub_cat_id      = $parent_floor_unit->unit_sub_cat_id;
                $child_floor->unit_brand_id        = $parent_floor_unit->unit_brand_id;
                $child_floor->person_name          = $parent_floor_unit->person_name;
                $child_floor->mobile               = $parent_floor_unit->mobile;
                $child_floor->up_for_sale          = $parent_floor_unit->up_for_sale;
                $child_floor->up_for_rent          = $parent_floor_unit->up_for_rent;
                $child_floor->brand_name           = $parent_floor_unit->brand_name;
                $child_floor->save();
            }
        }

        if ($request->ajax()) {
            return response()->json(array(
                'success' => true,
                'data'    => [
                    'id' => $request->property_id,
                    'action_url' => url('surveyor/property/update_details/' . $request->property_id),
                ],
            ), 200);
        }
    }

    public function save_unit_merge(Request $request)
    {
        $input_data = $request->all();
        // echo "<pre>";
        // print_r($input_data);
        // return;
        $merge_parent_floor_id = 0;
        $child_floor_arr = [];
        $current_floor_id = 0;
        // $floor_unit = ($request->merge_parent_unit_id != '') ? explode('-',$request->merge_parent_unit_id) : '';
        $merge_parent_unit_id = NULL;
        // $merge_unit_parent_floor_id = 0;  
        // $child_unit_arr = [];
        $checked_floors = isset($request->floor) ? $request->floor : [];
        for ($f = 0; $f < (int)$request->no_of_floors; $f++) {
            if (!isset($request->floor_id[$f])) {
                $floor = new PropertyFloorMap;
                $floor->property_id = $request->property_id;
                $floor->floor_no = $f ?? 0;
                $floor->floor_name = $request->floor_name[$f] ?? 0;
                $floor->units = $request->nth_unit[$f] ?? 0;
                $floor->merge_parent_floor_id =  NULL;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                if ($request->merge_parent_floor_id == $f) {
                    $merge_parent_floor_id = $floor->id;
                }
                $new_floor_id = $floor->id;
            } elseif ($request->floor_id[$f] != 0) {
                $floor = PropertyFloorMap::find($request->floor_id[$f]);
                $floor->units = $request->nth_unit[$f] ?? 0;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                $current_floor_id = $floor->id;
                if ($request->merge_parent_floor_id == $request->floor_id[$f]) {
                    $merge_parent_floor_id = $floor->id;
                }
            }

            if (isset($request->nth_unit[$f])) {
                if ((int)$request->nth_unit[$f] > 1) {
                    for ($u = 0; $u < (int)$request->nth_unit[$f]; $u++) {
                        $checked_units = [];
                        $nth_unit_name_key              = 'nth_unit_name' . $f;
                        $uprop_category_key             = 'uprop_category' . $f;
                        $uu_type_key                    = 'uu_type' . $f;
                        $unit_category_key              = 'unit_category' . $f;
                        $unit_sub_category_key          = 'unit_sub_category' . $f;
                        $unit_brand_key                 = 'unit_brand' . $f;
                        $person_name_key                = 'person_name' . $f;
                        $mobile_key                     = 'mobile' . $f;
                        $floor_unit_sub_cat_id_status   = 'unit_check' . $f;
                        $unit_id_key                    = 'unit_id' . $f;
                        $unit_brand_name                = 'unit_brand_name' . $f;
                        $unit_up_for_sale               = 'unit_up_for_sale' . $f;
                        $unit_up_for_rent               = 'unit_up_for_rent' . $f;
                        $checked_units = [];
                        $checked_units = isset($request->$floor_unit_sub_cat_id_status) ? $request->$floor_unit_sub_cat_id_status : [];
                        if (!isset($request->$unit_id_key[$u])) {
                            // $check_units = FloorUnitMap::where('property_id', $request->property_id)->where('floor_id', $floor->id)->count();
                            // if($check_units == 1){
                            //     FloorUnitMap::where('property_id', $request->property_id)->where('floor_id', $floor->id)->delete();
                            // }
                            $unit = new FloorUnitMap;
                            $unit->property_id          = $request->property_id;
                            $unit->floor_id             = $floor->id;
                            $unit->unit_name            = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                            $unit->unit_cat_type_id     = isset($request->$uprop_category_key[$u]) ? $request->$uprop_category_key[$u] : 0;
                            $unit->unit_type_id         = isset($request->$uu_type_key[$u]) ? $request->$uu_type_key[$u] : 0;
                            $unit->unit_cat_id          = isset($request->$unit_category_key[$u]) ? $request->$unit_category_key[$u] : 0;
                            $unit->unit_sub_cat_id      = isset($request->$unit_sub_category_key[$u]) ? $request->$unit_sub_category_key[$u] : 0;
                            // $unit->unit_brand_id        = isset($request->$unit_brand_key[$u]) ? $request->$unit_brand_key[$u] : 0;
                            $unit->person_name          = isset($request->$person_name_key[$u]) ? $request->$person_name_key[$u] : '';
                            $unit->mobile               = isset($request->$mobile_key[$u]) ? $request->$mobile_key[$u] : '';
                            $unit->up_for_sale          = isset($request->$unit_up_for_sale[$u]) ? 1 : 0;
                            $unit->up_for_rent          = isset($request->$unit_up_for_rent[$u]) ? 1 : 0;
                            $unit->merge_parent_unit_id = NULL;
                            $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0;
                            $unit->floor_unit_sub_cat_id = 0;
                            if (isset($request->$unit_brand_key[$u])) {
                                if (is_numeric($request->$unit_brand_key[$u])) {
                                    $check_floor_category = FloorUnitCategory::find($request->$unit_brand_key[$u]);
                                    if ($check_floor_category) {
                                        $unit->unit_brand_id = $request->$unit_brand_key[$u];
                                        $unit->brand_name = '';
                                    }
                                } else {
                                    $unit->unit_brand_id = 0;
                                    $unit->brand_name = $request->$unit_brand_key[$u];
                                }
                            }
                            // $unit->brand_name           = isset($request->$unit_brand_name[$u]) ? $request->$unit_brand_name[$u] : '';
                            $unit->save();
                            // echo isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0 ;
                            // echo $request->merge_unit_parent_floor_id .'-'. $f .'&&'. $request->merge_parent_unit_id .'-'. $u;

                            if ($request->merge_unit_parent_floor_id == $f && $request->merge_parent_unit_id == $u) {
                                $merge_parent_unit_id = ($request->unit_exist == 1) ? $request->merge_parent_unit_id : $unit->id;
                            }
                            // 
                            // $merge_parent_unit_id = $request->merge_parent_unit_id;
                        } elseif ($request->$unit_id_key[$u]  != 0) {

                            $unit = FloorUnitMap::find($request->$unit_id_key[$u]);
                            $unit->unit_name            = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                            $unit->unit_cat_type_id     = isset($request->$uprop_category_key[$u]) ? $request->$uprop_category_key[$u] : 0;
                            $unit->unit_type_id         = isset($request->$uu_type_key[$u]) ? $request->$uu_type_key[$u] : 0;
                            $unit->unit_cat_id          = isset($request->$unit_category_key[$u]) ? $request->$unit_category_key[$u] : 0;
                            $unit->unit_sub_cat_id      = isset($request->$unit_sub_category_key[$u]) ? $request->$unit_sub_category_key[$u] : 0;
                            // $unit->unit_brand_id        = isset($request->$unit_brand_key[$u]) ? $request->$unit_brand_key[$u] : 0;
                            $unit->person_name          = isset($request->$person_name_key[$u]) ? $request->$person_name_key[$u] : '';
                            $unit->mobile               = isset($request->$mobile_key[$u]) ? $request->$mobile_key[$u] : '';
                            $unit->up_for_sale          = isset($request->$unit_up_for_sale[$u]) ? 1 : 0;
                            $unit->up_for_rent          = isset($request->$unit_up_for_rent[$u]) ? 1 : 0;
                            $unit->property_id          = $request->property_id;
                            $unit->floor_id             = $floor->id;
                            $unit->merge_parent_unit_id = ($unit->merge_parent_unit_id != NULL) ? $unit->merge_parent_unit_id : NULL;
                            $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0;
                            $unit->floor_unit_sub_cat_id = 0;
                            if (isset($request->$unit_brand_key[$u])) {
                                if (is_numeric($request->$unit_brand_key[$u])) {
                                    $check_floor_category = FloorUnitCategory::find($request->$unit_brand_key[$u]);
                                    if ($check_floor_category) {
                                        $unit->unit_brand_id = $request->$unit_brand_key[$u];
                                        $unit->brand_name = '';
                                    }
                                } else {
                                    $unit->unit_brand_id = 0;
                                    $unit->brand_name = $request->$unit_brand_key[$u];
                                }
                            }
                            // $unit->brand_name           = isset($request->$unit_brand_name[$u]) ? $request->$unit_brand_name[$u] : '';
                            $unit->save();
                            // if($request->merge_parent_unit_id == $unit->id && $request->merge_parent_floor_id == $current_floor_id){
                            // $merge_parent_unit_id = $unit->id;
                            // }
                            $merge_parent_unit_id = $request->merge_parent_unit_id;
                        }
                        //   echo $request->floor_id[$f];

                    }
                } else {
                    if (isset($new_floor_id)) {
                        $unit = new FloorUnitMap;
                        $unit->property_id          = $request->property_id;
                        $unit->floor_id             = $new_floor_id;
                        $unit->unit_name            = '';
                        $unit->unit_cat_type_id     = $request->prop_category[$f] ?? 0;
                        $unit->unit_type_id         = $request->unit_type[$f] ?? 0;
                        $unit->unit_cat_id          = $request->fu_category[$f] ?? 0;
                        $unit->unit_sub_cat_id      = $request->fu_sub_category[$f] ?? 0;
                        $unit->unit_brand_id        = $request->floor_brand[$f] ?? 0;
                        $unit->person_name          = $request->person_name[$f] ?? '';
                        $unit->mobile               = $request->mobile[$f] ?? '';
                        $unit->up_for_sale          = isset($request->up_for_sale[$f]) ? 1 : 0;
                        $unit->up_for_rent          = isset($request->up_for_rent[$f]) ? 1 : 0;
                        $unit->merge_parent_unit_id = NULL;
                        $unit->floor_unit_sub_cat_id = 0;
                        $unit->save();
                    }
                }
            }
        }

        $units = FloorUnitMap::where('property_id', $request->property_id)->where('merge_parent_unit_status', 1)->get();
        $parent_unit = FloorUnitMap::find($merge_parent_unit_id);
        foreach ($units as $unit) {
            if ($merge_parent_unit_id != $unit->id) {
                $unit = FloorUnitMap::find($unit->id);
                $unit->unit_name            = $parent_unit->unit_name;
                $unit->unit_cat_type_id     = $parent_unit->unit_cat_type_id;
                $unit->unit_type_id         = $parent_unit->unit_type_id;
                $unit->unit_cat_id          = $parent_unit->unit_cat_id;
                $unit->unit_sub_cat_id      = $parent_unit->unit_sub_cat_id;
                $unit->unit_brand_id        = $parent_unit->unit_brand_id;
                $unit->person_name          = $parent_unit->person_name;
                $unit->mobile               = $parent_unit->mobile;
                $unit->up_for_sale          = $parent_unit->up_for_sale;
                $unit->up_for_rent          = $parent_unit->up_for_rent;
                $unit->merge_parent_unit_id = $merge_parent_unit_id;
                $unit->merge_parent_unit_status = 0;
                $unit->brand_name           = $parent_unit->brand_name;
                $unit->save();
            }
        }

        if ($request->ajax()) {
            return response()->json(array(
                'success' => true,
                'data'    => [
                    'id' => $request->property_id,
                    'action_url' => url('surveyor/property/update_details/' . $request->property_id),
                ],
            ), 200);
        }
    }

    public function remove_merge(Request $request)
    {
        $floors = PropertyFloorMap::where('property_id', $request->property_id)->get();
        foreach ($floors as $floor) {
            $floor = PropertyFloorMap::find($floor->id);
            // $floor->units                   = 0;
            $floor->merge_parent_floor_id   = 0;
            $floor->merge_parent_floor_status = 0;
            $floor->save();
        }
        $units = FloorUnitMap::where('property_id', $request->property_id)->get();
        foreach ($units as $unit) {
            $unit = FloorUnitMap::find($unit->id);
            $unit->merge_parent_unit_id   = 0;
            $unit->merge_parent_unit_status = 0;
            $unit->save();
        }
        return $request->property_id;
    }

    public function completed()
    {
        return view('admin.pages.property.completed')->with('ajax_message', 'Property Added Successfully')->with('ajax_url', url('surveyor/property/basic_details'));
    }
    public function update_screen()
    {
        return view('admin.pages.property.update');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function basicDetailsExtended()
    {
        return view('admin.pages.property.extended_basic_details');
    }

    /**
     * get all the specified resource from storage.
     */
    public function reports(Request $request)
    {

        $query = DB::table('properties')
            ->whereBetween('created_at', ['2023-03-18 00:00:00.000000', '2023-03-18 23:58:59.000000'])
            ->get();
        $properties = Property::all();
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        return view('admin.pages.property.reports', compact('properties', 'categories', 'sub_categories'));
    }
    public function reportsByType($type)
    {
        if ($type == 'all') {
            $properties = Property::all();
        } elseif ($type == 'month') {
            $properties = Property::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        } elseif ($type == 'week') {
            $properties = Property::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        } elseif ($type == 'today') {
            $properties = Property::whereDate('created_at', Carbon::today())->get();
        }
        return view('admin.pages.property.reports', compact('properties'));
    }

    /**
     * get all the specified resource from storage.
     */
    public function reportDetails(Request $request, $id)
    {
        $categories = Category::all();
        $property = Property::find($request->id);
        $property_id = $property->id;
        $floors = PropertyFloorMap::where('property_id', $property_id)->orderBy('id', 'ASC')->get();
        $floor_index = [];
        $parent_unit_id = [];
        $parent_floors = [];
        foreach ($floors as $key => $floor) {
            $floor_index[$floor->id] = $floor->floor_no;
            array_push($parent_floors, $floor->merge_parent_floor_id);
        }
        $defined_blade = Category::where('id', $property->cat_id)->value('blade_slug');
        $defined_blade = str_replace("primary_data.", "primary_data.view_", $defined_blade);
        $units = FloorUnitMap::where('property_id', $property_id)->where('is_single', 0)->orderBy('id', 'ASC')->get();
        $parent_units = [];
        foreach ($units as $key => $unit) {
            $parent_unit_id[$unit->id] = $unit->floor_id;
            array_push($parent_units, $unit->merge_parent_unit_id);
        }
        $custom_brands = FloorUnitMap::where('property_id', $property_id)->get();
        $prop_categories = Category::where('parent_id', NULL)->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->select(['id', 'name', 'field_type'])->get();
        $unit_category_list = FloorUnitCategory::where('category_code', 2)->select(['id', 'name', 'field_type'])->get();
        $unit_sub_category_list = FloorUnitCategory::where('category_code', 3)->select(['id', 'name', 'field_type'])->get();
        $brands = FloorUnitCategory::where('category_code', 4)->get();
        $floor_visible_status = ($property->residential_sub_type == 10 || $property->residential_sub_type == 12 || $property->plot_land_type == 14)   ? 'd-none' : '';
        return view('admin.pages.property.report_details', get_defined_vars());
    }
    public function editDetails($id)
    {
        $categories = Category::all();
        // $sub_categories = SubCategory::all();
        $property = Property::find($id);
        $property->images;
        $property_id = $property->id;
        $property_cat_id = $property->cat_id;
        $floors = PropertyFloorMap::where('property_id', $property_id)->orderBy('id', 'ASC')->get();
        $floor_index = [];
        $parent_unit_id = [];
        $parent_floors = [];
        foreach ($floors as $key => $floor) {
            $floor_index[$floor->id] = $floor->floor_no;
            array_push($parent_floors, $floor->merge_parent_floor_id);
        }
        $defined_blade = Category::where('id', $property->cat_id)->value('blade_slug');
        $defined_blade = str_replace("primary_data.", "primary_data.edit.edit_", $defined_blade);
        $units = FloorUnitMap::where('property_id', $property_id)->where('is_single', 0)->orderBy('id', 'ASC')->get();
        $parent_units = [];
        foreach ($units as $key => $unit) {
            $parent_unit_id[$unit->id] = $unit->floor_id;
            array_push($parent_units, $unit->merge_parent_unit_id);
        }
        $custom_brands = FloorUnitMap::where('property_id', $property_id)->get();
        $prop_categories = Category::where('parent_id', NULL)->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->select(['id', 'name', 'field_type'])->get();
        $unit_category_list = FloorUnitCategory::where('category_code', 2)->select(['id', 'name', 'field_type'])->get();
        $unit_sub_category_list = FloorUnitCategory::where('category_code', 3)->select(['id', 'name', 'field_type'])->get();
        $brands = FloorUnitCategory::where('category_code', 4)->get();
        $sub_categories = Category::where('parent_id', $property->cat_id)->orderBy('id', 'ASC')->get();
        $builders = Builder::all();
        return view('admin.pages.property.edit_details', get_defined_vars());
    }
    public function updateDetails(Request $request, $id)
    {
        $input_data = $request->all();
        $validator = Validator::make(
            $input_data,
            [

                // 'files.*' => 'mimes:jpg,jpeg,png,bmp|max:20000',
                // 'city' => 'required',
                // 'gis_id' => 'required',
                //  'latitude' => 'required',
                //  'longitude' => 'required',
                // 'category' => 'required',
                // 'sub_category' => 'required_if:category,' . implode(',', [1, 2, 3, 4]),
                // 'house_no' => '',
                // 'plot_no' => '',
                // 'street_details' => 'required',
                // 'locality_name' => 'required',
                // 'owner_name' => '',
                // 'contact_no' => '',
                // 'remarks' => '',
            ],
            [
                // 'image_file.*.required' => 'Please upload an image',
                // 'files.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                // 'files.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
                'category.numeric' => 'Please choose a category',
                'sub_category.numeric' => 'Please choose a Sub Category',
            ]
        );

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // return request()->all();
        $property = Property::find($id);
        if ($property) {
            $property->cat_id = $request->category;
            $property->sub_cat_id = $request->sub_category;
            $property->house_no = $request->house_no;
            $property->building_name = $request->building_name;
            $property->plot_no = $request->plot_no;
            $property->street_details = $request->street_name;
            $property->locality_name = $request->locality_name;
            $property->owner_name = $request->owner_name;

            $property->contact_no = $request->contact_no;
            $property->remarks = $request->remarks;
            $property->latitude = $request->latitude;
            $property->longitude = $request->longitude;
            $property->created_by = Auth::user()->id;
            $property->no_of_floors = $request->no_of_floors;
            $property->residential_type = isset($request->residential_type) ? $request->residential_type : 0;
            $property->residential_sub_type = isset($request->residential_sub_type) ? $request->residential_sub_type : 0;
            $property->project_name = isset($request->project_name) ? $request->project_name : 0;
            $property->builder_id   = isset($request->builder_id) ? $request->builder_id : 0;
            $property->plot_land_type   = isset($request->plot_land_type) ? $request->plot_land_type : 0;
            $property->plot_name    = isset($request->plot_name) ? $request->plot_name : 0;
            $property->boundary_wall_availability   = isset($request->boundary_wall_availability) ? 1 : 0;
            $property->any_legal_litigation_board   = isset($request->any_legal_litigation_board) ? 1 : 0;
            $property->ownership_claim_board    = isset($request->ownership_claim_board) ? 1 : 0;
            $property->bank_auction_board   = isset($request->bank_auction_board) ? 1 : 0;
            $property->for_sale_board   = isset($request->for_sale_board) ? 1 : 0;
            $property->under_construction_type = isset($request->under_construction_type) ? $request->under_construction_type : NULL;
            $property->up_for_sale = isset($request->up_for_sale) ? 1 : 0;
            $property->up_for_rent = isset($request->up_for_rent) ? 1 : 0;
            $property->cat_gc = isset($request->property_gcc) ? $request->property_gcc : 0;
            $property->save();

            if ($request->hasfile('files')) {

                foreach ($request->file('files') as $image) {
                    $name = $image->getClientOriginalName();
                    $file_name = uniqid() . "." . $image->getClientOriginalExtension();
                    $image->move(public_path() . '/uploads/property/images', $file_name);
                    $property_img = new PropertyImage;
                    $property_img->file_url = $file_name;
                    $property_img->property_id = $id;
                    $property_img->save();
                    //    $data[] = $name;  
                }
                // if (File::exists(public_path('uploads/csv/img.png'))) {
                //     File::delete(public_path('uploads/csv/img.png'));
                // }
            }

            // $this->floorService->processFloorData($request->all());

            $merge_parent_floor_id = 0;
            $child_floor_arr = [];

            // $floor_unit = ($request->merge_parent_unit_id != '') ? explode('-',$request->merge_parent_unit_id) : '';
            $merge_parent_unit_id = NULL;
            // $merge_unit_parent_floor_id = 0;  
            // $child_unit_arr = [];
            $checked_floors = isset($request->floor) ? $request->floor : [];
            for ($f = 0; $f < (int)$request->no_of_floors; $f++) {
                $floor_id = (isset($request->floor_id[$f])) ? $request->floor_id[$f] : '';

                $floor = PropertyFloorMap::updateOrCreate(
                    ['id' => $floor_id],
                    [
                        'property_id'   =>  $request->property_id,
                        'floor_no'  =>  $f ?? 0,
                        'units' =>  $request->nth_unit[$f] ?? 0,
                        'floor_name'    =>  $request->floor_name[$f] ?? 0,
                        // 'merge_parent_floor_id' =>   NULL ,
                        'merge_parent_floor_status' => (in_array($f, $checked_floors)) ? 1 : 0,
                    ]
                );

                if ($request->merge_parent_floor_id == $f) {
                    $merge_parent_floor_id = $floor->id;
                }

                // isset($request->nth_unit[$f]) ? array_push($child_floor_arr, $floor->id) : '' ;

                if (isset($request->nth_unit[$f])) {
                    if ((int)$request->nth_unit[$f] > 1) {
                        for ($u = 0; $u < (int)$request->nth_unit[$f]; $u++) {
                            $checked_units = [];
                            $nth_unit_name_key = 'nth_unit_name' . $f;
                            $uprop_category_key = 'uprop_category' . $f;
                            $uu_type_key = 'uu_type' . $f;
                            $unit_category_key = 'unit_category' . $f;
                            $unit_sub_category_key = 'unit_sub_category' . $f;
                            $unit_brand_key = 'unit_brand' . $f;
                            $person_name_key = 'person_name' . $f;
                            $mobile_key = 'mobile' . $f;
                            $floor_unit_sub_cat_id_status = 'unit_check' . $f;
                            $unit_brand_name = 'unit_brand_name' . $f;
                            $unit_id_key                    = 'unit_id' . $f;
                            $unit_up_for_sale = 'unit_up_for_sale' . $f;
                            $unit_up_for_rent = 'unit_up_for_rent' . $f;
                            $unit_brand = NULL;


                            $unit_id = (isset($request->$unit_id_key[$u])) ? $request->$unit_id_key[$u] : '';

                            $unit = FloorUnitMap::updateOrCreate(
                                ['id' => $unit_id],
                                [
                                    'property_id'               => $request->property_id,
                                    'floor_id'                  => $floor->id,
                                    'unit_name'                 => isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '',
                                    'unit_cat_type_id'          => isset($request->$uprop_category_key[$u]) ? $request->$uprop_category_key[$u] : 0,
                                    'unit_type_id'              => isset($request->$uu_type_key[$u]) ? $request->$uu_type_key[$u] : 0,
                                    'unit_cat_id'               => isset($request->$unit_category_key[$u]) ? $request->$unit_category_key[$u] : 0,
                                    'unit_sub_cat_id'           => isset($request->$unit_sub_category_key[$u]) ? $request->$unit_sub_category_key[$u] : 0,

                                    'person_name'               => isset($request->$person_name_key[$u]) ? $request->$person_name_key[$u] : '',
                                    'mobile'                    => isset($request->$mobile_key[$u]) ? $request->$mobile_key[$u] : '',
                                    'up_for_sale'               => isset($request->$unit_up_for_sale[$u]) ? 1 : 0,
                                    'up_for_rent'               => isset($request->$unit_up_for_rent[$u]) ? 1 : 0,
                                    // 'merge_parent_unit_id'      => NULL,
                                    'merge_parent_unit_status'  => isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0,
                                    'floor_unit_sub_cat_id'     => 0,
                                    'unit_brand_id'             => 0,
                                    'brand_name'                => '',
                                ]
                            );

                            if ($request->merge_unit_parent_floor_id == $f && $request->merge_parent_unit_id == $u) {
                                $merge_parent_unit_id = $unit->id;
                            }
                        }
                    } else {

                        $floor_unit = FloorUnitMap::where('floor_id', $floor_id)->first();
                        $floor_unit_id = (!empty($floor_id)) ? $floor_unit->id : '';
                        $floor_brand_id = 0;
                        $floor_brand_name = '';
                        if (isset($request->floor_brand[$f])) {
                            if (is_numeric($request->floor_brand[$f])) {
                                $check_floor_category = FloorUnitCategory::find($request->floor_brand[$f]);
                                if ($check_floor_category) {
                                    $floor_brand_id = $request->floor_brand[$f];
                                    $floor_brand_name = '';
                                }
                            } else {
                                $floor_brand_id = 0;
                                $floor_brand_name = $request->floor_brand[$f];
                            }
                        }
                        $unit = FloorUnitMap::updateOrCreate(['id' => $floor_unit_id], [
                            'property_id'           => $request->property_id,
                            'floor_id'              => $floor->id,
                            'unit_name'             => '',
                            'unit_cat_type_id'      => $request->prop_category[$f] ?? 0,
                            'unit_type_id'          => $request->unit_type[$f] ?? 0,
                            'unit_cat_id'           => $request->fu_category[$f] ?? 0,
                            'unit_sub_cat_id'       => $request->fu_sub_category[$f] ?? 0,
                            'person_name'           => $request->person_name[$f] ?? '',
                            'mobile'                => $request->mobile[$f] ?? '',
                            'up_for_sale'           => isset($request->floor_up_for_sale[$f]) ? 1 : 0,
                            'up_for_rent'           => isset($request->floor_up_for_rent[$f]) ? 1 : 0,
                            // 'merge_parent_unit_id'  => NULL,
                            'floor_unit_sub_cat_id' => 0,
                            'unit_brand_id'         => isset($request->floor_brand[$f]) ? (is_numeric($request->floor_brand[$f]) ? $request->floor_brand[$f] : 0) : 0,
                            'brand_name'            => isset($request->floor_brand[$f]) ? (is_numeric($request->floor_brand[$f]) ? '' : $request->floor_brand[$f]) : '',
                        ]);
                    }
                } else {
                    $unit = new FloorUnitMap;
                    $unit->property_id           = $request->property_id;
                    $unit->floor_id              = $floor->id;
                    $unit->unit_name             = '';
                    $unit->unit_cat_type_id      = $request->prop_category[$f] ?? 0;
                    $unit->unit_type_id          = $request->unit_type[$f] ?? 0;
                    $unit->unit_cat_id           = $request->fu_category[$f] ?? 0;
                    $unit->unit_sub_cat_id       = $request->fu_sub_category[$f] ?? 0;
                    // $unit->unit_brand_id         = $request->floor_brand[$f] ?? 0 ;
                    $unit->person_name           = $request->person_name[$f] ?? '';
                    $unit->mobile                = $request->mobile[$f] ?? '';
                    $unit->up_for_sale           = isset($request->floor_up_for_sale[$f]) ? 1 : 0;
                    $unit->up_for_rent           = isset($request->floor_up_for_rent[$f]) ? 1 : 0;
                    $unit->merge_parent_unit_id  = NULL;
                    $unit->floor_unit_sub_cat_id = 0;
                    // $unit->brand_name            = $request->floor_brand_name[$f] ?? '' ;
                    if (isset($request->floor_brand[$f])) {
                        if (is_numeric($request->floor_brand[$f])) {
                            $check_floor_category = FloorUnitCategory::find($request->floor_brand[$f]);
                            if ($check_floor_category) {
                                $unit->unit_brand_id = $request->floor_brand[$f];
                                $unit->brand_name = '';
                            }
                        } else {
                            $unit->unit_brand_id = 0;
                            $unit->brand_name = $request->floor_brand[$f];
                        }
                    }
                    $unit->save();
                }
            }

            $floors = PropertyFloorMap::where('property_id', $request->property_id)->where('merge_parent_floor_status', 1)->get();
            $parent_floor_unit = FloorUnitMap::where('floor_id', $merge_parent_floor_id)->first();
            $parent_floor        = PropertyFloorMap::where('id', $merge_parent_floor_id)->first();
            foreach ($floors as $floor) {
                if ($merge_parent_floor_id != $floor->id) {
                    $floor = PropertyFloorMap::find($floor->id);
                    $floor->units                   = 0;
                    $floor->floor_name                   = $parent_floor->floor_name;
                    $floor->merge_parent_floor_id   = $merge_parent_floor_id;
                    $floor->merge_parent_floor_status = 0;
                    $floor->save();
                    $child_floor = FloorUnitMap::where('floor_id', $floor->id)->first();
                    $child_floor->unit_cat_type_id     = $parent_floor_unit->unit_cat_type_id;
                    $child_floor->unit_type_id         = $parent_floor_unit->unit_type_id;
                    $child_floor->unit_cat_id          = $parent_floor_unit->unit_cat_id;
                    $child_floor->unit_sub_cat_id      = $parent_floor_unit->unit_sub_cat_id;
                    $child_floor->unit_brand_id        = $parent_floor_unit->unit_brand_id;
                    $child_floor->person_name          = $parent_floor_unit->person_name;
                    $child_floor->mobile               = $parent_floor_unit->mobile;
                    $child_floor->up_for_sale          = $parent_floor_unit->up_for_sale;
                    $child_floor->up_for_rent          = $parent_floor_unit->up_for_sale;
                    $child_floor->brand_name           = $parent_floor_unit->brand_name;
                    $child_floor->save();
                }
            }
            $units = FloorUnitMap::where('property_id', $request->property_id)->where('merge_parent_unit_status', 1)->get();
            $parent_unit = FloorUnitMap::find($merge_parent_unit_id);
            foreach ($units as $unit) {
                if ($merge_parent_unit_id != $unit->id) {
                    $unit = FloorUnitMap::find($unit->id);
                    $unit->unit_name            = $parent_unit->unit_name;
                    $unit->unit_cat_type_id     = $parent_unit->unit_cat_type_id;
                    $unit->unit_type_id         = $parent_unit->unit_type_id;
                    $unit->unit_cat_id          = $parent_unit->unit_cat_id;
                    $unit->unit_sub_cat_id      = $parent_unit->unit_sub_cat_id;
                    $unit->unit_brand_id        = $parent_unit->unit_brand_id;
                    $unit->person_name          = $parent_unit->person_name;
                    $unit->mobile               = $parent_unit->mobile;
                    $unit->up_for_sale          = $parent_unit->up_for_sale;
                    $unit->up_for_rent          = $parent_unit->up_for_rent;
                    $unit->brand_name           = $parent_unit->brand_name;
                    $unit->merge_parent_unit_id = $merge_parent_unit_id;
                    $unit->merge_parent_unit_status = 0;
                    $unit->save();
                }
            }
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'data'    => [
                        'id' => $property->id,
                        'action_url' => url('surveyor/property/update_details/' . $property->id),
                    ],
                ), 200);
            }
            return redirect()->route('update_screen')->with('property', $property->id);
        } else {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'message' => 'Your property not found!'
                ), 400);
            }
            $notification = array(
                'message' => 'Your property not found!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function ajaxGet(Request $request)
    {

        if ($request->ajax()) {
            $properties = Property::query();

            if ($request->has('start_date') && !empty($request->get('start_date'))) {
                $from = date($request->get('start_date'));
                $today = new DateTime();
                $to = $today->format('Y-m-d');
                // $to = date('2023-05-02');
            }

            if ($request->has('end_date') && !empty($request->get('end_date'))) {
                $to = date($request->get('end_date'));
            }

            if ($request->has('category') && !empty($request->get('category'))) {
                $properties = $properties->where('cat_id', $request->get('category'));
            }

            if ($request->has('sub_category') && !empty($request->get('sub_category'))) {
                $properties = $properties->where('sub_cat_id', $request->get('sub_category'));
            }

            if ($request->has('gis') && !empty($request->get('gis'))) {
                $properties = $properties->where('gis_id',  'like', '%' . $request->get('gis') . '%');
            }

            if ($request->has('house_no') && !empty($request->get('house_no'))) {
                $properties = $properties->where('house_no',  'like', '%' . $request->get('house_no') . '%');
            }

            if ($request->has('locality_name') && !empty($request->get('locality_name'))) {
                $properties = $properties->where('locality_name',  'like', '%' . $request->get('locality_name') . '%');
            }

            if ($request->has('plot_no') && !empty($request->get('plot_no'))) {
                $properties = $properties->where('plot_no',  'like', '%' . $request->get('plot_no') . '%');
            }

            if ($request->has('street_name') && !empty($request->get('street_name'))) {
                $properties = $properties->where('street_details',  'like', '%' . $request->get('street_name') . '%');
            }

            if ($request->has('owner_name') && !empty($request->get('owner_name'))) {
                $properties = $properties->where('owner_name',  'like', '%' . $request->get('owner_name') . '%');
            }

            if ($request->has('contact_no') && !empty($request->get('contact_no'))) {
                $properties = $properties->where('contact_no',  'like', '%' . $request->get('contact_no') . '%');
            }


            if ($request->has('start_date') && !empty($request->get('start_date'))) {
                $properties = $properties->where('created_at', '>=', $from)
                    ->where('created_at', '<=', $to);
                // $properties = $properties->whereBetween('created_at', [$from, $to]);
            }

            if ($request->has('type') && !empty($request->get('type'))) {

                if ($request->get('type') == 'month') {
                    $properties = $properties->whereMonth('created_at', date('m'));
                }

                $now = Carbon::now();
                if ($request->get('type') == 'week') {
                    $properties = $properties->whereBetween("created_at", [
                        $now->startOfWeek()->format('Y-m-d'), //This will return date in format like this: 2022-01-10
                        $now->endOfWeek()->format('Y-m-d')
                    ]);
                }
                if ($request->get('type') == 'today') {
                    $properties = $properties->whereMonth('created_at', Carbon::today());
                }
            }
            $limit = request('length');
            $start = request('start');

            // $query->offset($start)->limit($limit)
            $properties = $properties->get();



            foreach ($properties as $key => $property) {
                $properties[$key]['date'] = $property->created_at->format('d-m-Y');
                $properties[$key]['time'] = $property->created_at->format('H:i A');
                $properties[$key]['cat'] = $property->category->title ?? '';
                $properties[$key]['sub_cat'] = $property->sub_category->title ?? '';
            }



            // $query->offset($start)->limit($limit);

            return Datatables::of($properties)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['gis_id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['cat']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['sub_cat']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['date']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['time']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['house_no']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['locality_name']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['street_name']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['owner_name']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['contact_no']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btn = ' <a href="' . route('admin.property.report_details', $row->id) . '" >

                    <button class="btn btn-sm btn-primary" >

                        View more

                    </button>

                </a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                // ->offset(request('start'))
                // ->limit(request('length'))
                // ->skipPaging()
                // ->setTotalRecords`
                ->make(true);
        }

        // return view('users');
    }

    public function ajaxReports(Request $request)
    {
        $categories = Category::where('parent_id', NULL)->OrderBy('id', 'ASC')->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->select(['id', 'name', 'field_type'])->get();
        $residential = Category::where('parent_id', 2)->OrderBy('id', 'ASC')->get();
        $brand_parent_categories = FloorUnitCategory::where('category_code', 2)->orderBy('id', 'ASC')->get();
        $brand_sub_categories = FloorUnitCategory::where('category_code', 3)->orderBy('id', 'ASC')->get();
        $brands = FloorUnitCategory::where('category_code', 4)->orderBy('id', 'ASC')->get();
        $builders = Builder::all();
        $properties = Property::query();

        $length = $request->length;

        if ($request->has('start_date') && !empty($request->get('start_date'))) {
            $from = date($request->get('start_date') . ' 00:00:00.000000');
            $today = new DateTime();
            $to = $today->format('Y-m-d') . " 23:58:59.000000";
        }

        if ($request->has('end_date') && !empty($request->get('end_date'))) {
            $to = date($request->get('end_date') . ' 23:58:59.000000');
        }
        $properties->when($request->category, function ($query) use ($request) {
            $query->where('cat_id', $request->category);
        })
            ->when($request->gis_id, function ($query) use ($request) {
                $query->where('gis_id', 'like', '%' . $request->gis_id . '%');
            })
            ->when($request->residential_category, function ($query) use ($request) {
                $query->where('residential_type', 'like', '%' . $request->residential_category . '%');
            })
            ->when($request->residential_sub_category, function ($query) use ($request) {
                $query->where('residential_sub_type', 'like', '%' . $request->residential_sub_category . '%');
            })
            ->when($request->building_name, function ($query) use ($request) {
                $query->where('building_name', 'like', '%' . $request->building_name . '%');
            })
            ->when($request->house_no, function ($query) use ($request) {
                $query->where('house_no', 'like', '%' . $request->house_no . '%');
            })
            ->when($request->locality_name, function ($query) use ($request) {
                $query->where('locality_name', 'like', '%' . $request->locality_name  . '%');
            })
            ->when($request->plot_no, function ($query) use ($request) {
                $query->where('plot_no', 'like', '%' . $request->plot_no  . '%');
            })
            ->when($request->street_name, function ($query) use ($request) {
                $query->where('street_details', 'like', '%' . $request->street_name  . '%');
            })
            ->when($request->owner_name, function ($query) use ($request) {
                $query->where('owner_name', 'like', '%' . $request->owner_name  . '%');
            })
            ->when($request->builder_name, function ($query) use ($request) {
                $query->where('builder_id', $request->builder_name);
            })
            ->when($request->contact_no, function ($query) use ($request) {
                $query->where('contact_no', 'like', '%' . $request->contact_no  . '%');
            })
            ->when($request->no_of_floors, function ($query) use ($request) {
                $query->where('no_of_floors', $request->no_of_floors);
            });


        if (isset($request->brand_category) && !empty($request->brand_category)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_cat_id', $request->brand_category);
            });
        }
        if (isset($request->no_of_units) && !empty($request->no_of_units)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('units', $request->no_of_units);
            });
        }
        if (isset($request->brand_sub_category) && !empty($request->brand_sub_category)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_sub_cat_id', $request->brand_sub_category);
            });
        }
        if (isset($request->brand_id) && !empty($request->brand_id)) {
            $properties = $properties->whereHas('floors', function ($query) use ($request) {
                $query->where('unit_brand_id', $request->brand_sub_category);
            });
        }

        // if(isset($request->owner_name) && !empty($request->owner_name)){
        //     $properties = $properties->whereHas('builderName', function ($query) use ($request) {
        //                                 $query->where('name', 'like', '%' .$request->owner_name  . '%');
        //                             });
        // }


        if ($request->has('start_date') && !empty($request->get('start_date'))) {
            $properties = $properties->whereBetween('created_at', [$from, $to]);
        }

        if ($request->has('type') && !empty($request->get('type'))) {

            if ($request->get('type') == 'month') {
                $properties = $properties->whereMonth('created_at', date('m'));
            }

            $now = Carbon::now();
            if ($request->get('type') == 'week') {
                $properties = $properties->whereBetween("created_at", [
                    $now->startOfWeek()->format('Y-m-d'), //This will return date in format like this: 2022-01-10
                    $now->endOfWeek()->format('Y-m-d')
                ]);
            }
            if ($request->get('type') == 'today') {
                $properties = $properties->whereMonth('created_at', Carbon::today());
            }
        }

        $searchKeyword = $request->get('search');
        if (!empty($searchKeyword)) {
            $properties = $properties->when($request->search, function ($query) use ($request) {

                $query->where(function ($q) use ($request) {
                    $q->where('gis_id', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('owner_name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('house_no', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('locality_name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('contact_no', 'LIKE', '%' . $request->search . '%');
                    // ->whereHas('property.category', function ($query) use ($value) {
                    //         $query->where('title', 'LIKE', '%'.$request->search.'%');
                    //     });
                });
            });
        }


        // if(isset($length) && !empty($length)){
        //      $properties=$properties->where('created_by', Auth::user()->id)->orderBy('id','DESC')->paginate($length);
        // }else{
        $properties = $properties->where('created_by', Auth::user()->id)->orderBy('id', 'DESC')->paginate(50);
        // }
        $properties->setPath(route('surveyor.property.reports', [], true));

        foreach ($properties as $key => $property) {
            $properties[$key]['date'] = $property->created_at->format('d-m-Y');
            $properties[$key]['time'] = $property->created_at->format('H:i A');
            $properties[$key]['cat'] = $property->category->cat_name ?? '';
        }

        if ($request->ajax()) {
            return view('admin.pages.property.property_pagination', ['properties' => $properties]);
        }
        return view('admin.pages.property.demo_reports', get_defined_vars());
    }

    public function exportExcel()
    {
        return Excel::download(new PropertiesExport, 'properties.xlsx');
    }
    public function exportCsv()
    {
        return Excel::download(new PropertiesExport, 'invoices.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    public function exportPdf()
    {
        $properties = Property::where('created_by', Auth::user()->id)->get();
        return view('admin.pages.property.pdf.property', compact('properties'));


        ini_set('max_execution_time', 300);
        ini_set("memory_limit", "512M");

        $pdf = PDF::loadView('admin.pages.property.pdf.property', compact('properties'));
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->set_option('enable_html5_parser', TRUE);
        return $pdf->stream('my-pdf.pdf');



        return $pdf->download('properties.pdf');
        // return Excel::download(new PropertiesExport, 'properties.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function get_defined_block(Request $request)
    {
        try {
            $blade_slug = Category::where('id', $request->c_id)->value('blade_slug');
            $sub_categories = Category::where('parent_id', $request->c_id)->orderBy('id', 'ASC')->get();
            $prop_categories = Category::where('parent_id', NULL)->OrderBy('id', 'ASC')->get();
            $builders = Builder::all();
            $defined_block = '';
            if (isset($request->mode)) {
                $property = Property::find($request->property_id);
                $categories = Category::all();
                $defined_blade = str_replace("primary_data.", "primary_data.edit.edit_", $blade_slug);
                $defined_block = View::make(($request->mode == 'edit') ? 'admin.pages.property.' . $defined_blade :  '', get_defined_vars())->render();
            }

            $defined_block = View::make('admin.pages.property.' . $blade_slug, get_defined_vars())->render();

            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'defined_block'    => $defined_block,
                    'statusCode' => 200,
                    'message' => get_response_description(200)
                ), 200);
            }
        } catch (\Exception $e) {
            $statusCode = $e->getCode();
            if ($statusCode < 100 || $statusCode >= 600) {
                $statusCode = 500;
            }
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'defined_block'    => [],
                    'statusCode' => $statusCode,
                    'message' => get_response_description($statusCode)
                ), $statusCode);
            }
            // Handle the exception and the status code
            // ...

            // Optional: Log the exception
            // Log::error($e->getMessage());

            // Optional: Display a friendly error message to the user
            // return response()->json(['error' => 'An error occurred. Please try again.'], $statusCode);
        }
    }
    public function get_defined_options(Request $request)
    {
        $data = Category::where('parent_id', $request->c_id)->get();
        return response()->json($data);
    }

    public function get_subcat_options(Request $request)
    {
        $options = Category::where('parent_id', $request->c_id)->orderBy('id', 'ASC')->get();
        $data = ($options) ? $options : [];
        return response()->json($data);
    }

    public function get_data_options(Request $request)
    {
        $options = FloorUnitCategory::where('category_code', $request->c_code)->select(['id', 'name'])->get();
        $data = ($options) ? $options : [];
        return response()->json($data);
    }
    public function get_floors(Request $request)
    {
        try {
            $prop_categories = Category::where('parent_id', NULL)->get();
            $unit_categories = FloorUnitCategory::where('category_code', 1)->select(['id', 'name', 'field_type'])->get();
            $sub_categories = FloorUnitCategory::where('category_code', 2)->select(['id', 'name', 'field_type'])->get();
            $brands = FloorUnitCategory::where('category_code', 3)->get();
            $count = $request->count;
            $c_id = $request->c_id;
            $start_index = $request->start_index;
            $length = $request->start_index + $count;
            $floors = View::make('admin.pages.property.floor', get_defined_vars())->render();
            // $floors = view('admin.pages.property.floor', get_defined_vars())->render();
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'floors'    => $floors,
                    'statusCode' => 200,
                    'message' => get_response_description(200)
                ), 200);
            }
        } catch (\Exception $e) {
            $statusCode = $e->getCode();
            if ($statusCode < 100 || $statusCode >= 600) {
                $statusCode = 500;
            }
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'floors'    => [],
                    'statusCode' => $statusCode,
                    'message' => get_response_description($statusCode)
                ), $statusCode);
            }
            // Handle the exception and the status code
            // ...

            // Optional: Log the exception
            // Log::error($e->getMessage());

            // Optional: Display a friendly error message to the user
            // return response()->json(['error' => 'An error occurred. Please try again.'], $statusCode);
        }
    }

    public function get_units(Request $request)
    {
        $prop_categories = Category::where('parent_id', NULL)->get();
        $categories = FloorUnitCategory::where('category_code', 1)->select(['id', 'name'])->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->select(['id', 'name', 'field_type'])->get();
        $sub_categories = FloorUnitCategory::where('category_code', 2)->select(['id', 'name', 'field_type'])->get();
        $brands = FloorUnitCategory::where('category_code', 3)->select(['id', 'name'])->get();
        $count = $request->count;
        $c_id = $request->c_id;
        $floor_id = $request->floor_id;
        $start_index = $request->start_index;
        if ($request->floor_idoc != 0 && !empty($request->property_id)) {
            $unit_count = FloorUnitMap::where('property_id', $request->property_id)->where('floor_id', $request->floor_idoc)->get();
            if ($unit_count->count()  == 1) {
                $unit = FloorUnitMap::where('property_id', $request->property_id)->where('floor_id', $request->floor_idoc)->first();
                $unit->is_single = 1;
                $unit->save();
                // add_cloumn
            }
        }
        return view('admin.pages.property.unit', get_defined_vars());
    }
    public function get_unit_categories(Request $request)
    {

        if (is_numeric($request->cat_id)) {
            $unit_categories = FloorUnitCategory::where('parent_id', $request->cat_id)->get();
            $check_brand = FloorUnitCategory::where('parent_id', $request->cat_id)->groupBy('category_code')->value('category_code');
            $brand_categories = ($check_brand > 3 || $check_brand == NULL) ? FloorUnitCategory::where('parent_id', 0)->where('category_code', 4)->get() : [];
            $custom_brands = [];
            if (!empty($request->property_id)) {
                // $custom_brands = FloorUnitMap::where('property_id', $request->property_id)->get();
            }

            $data = ($unit_categories) ? $unit_categories : [];
            return response()->json(['data' => $data, 'other_options' => $custom_brands, 'check_brand' => $check_brand], 200);
        }
    }

    public function store_brand(Request $request)
    {
        $input_data = $request->all();
        $validator = Validator::make(
            $input_data,
            [
                "brand_name" => 'required'
            ]
        );

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 422);
            }
        }

        $floor_unit_category = new FloorUnitCategory;
        $floor_unit_category->name = $request->name;
        $floor_unit_category->created_by = Auth::user()->id;
        $floor_unit_category->parent_id = $request->parent_id ?? 0;
        $floor_unit_category->category_code = 4;
        $floor_unit_category->save();

        return redirect()->back()->with('message', $request->category_code_name . ' Successfully Created');
    }

    public function remove_floor(Request $request)
    {
        if (is_numeric($request->floor_id)) {
            $floor_id = $request->floor_id;
            PropertyFloorMap::where('merge_parent_floor_id', $floor_id)->delete();
            PropertyFloorMap::find($request->floor_id)->delete();
            return response()->json(['status' => true], 200);
        }
    }
    public function remove_unit(Request $request)
    {
        if (is_numeric($request->unit_id)) {
            $unit = FloorUnitMap::find($request->unit_id);
            if ($unit) {
                $property_id = $unit->property_id;
                $floor_id = $unit->floor_id;
                $unit->delete();
                return response()->json(['status' => true], 200);
                //  $units = FloorUnitMap::where('property_id', $property_id)->where('floor_id', $floor_id)->get();
                // if($units->count() == 2){

                //     $remove_unit = FloorUnitMap::where('property_id', $property_id)->where('floor_id', $floor_id)->latest()->first();
                //     $remove_unit->delete();

                //     $get_org_unit = FloorUnitMap::where('property_id', $property_id)->where('floor_id', $floor_id)->first();
                //     $get_org_unit->is_single = 0;
                //     $get_org_unit->save();
                // }
            }
        }
    }
    public function check_gis_id(Request $request)
    {
        $property = Property::where('gis_id', $request->gis_id)->first();
        if ($property) {
            return response()->json(['status' => true, 'property_id' => $property->id], 200);
        } else {
            return response()->json(['status' => false], 422);
        }
    }

    public function add_gated_comunity()
    {
        return view('admin.pages.property.add_gated_comunity', get_defined_vars());
    }

    public function amenities()
    {
        return view('admin.pages.property.secondary_data.amenities.index');
    }

    public function compliances()
    {
        return view('admin.pages.property.secondary_data.compliances.index');
    }

    public function floors()
    {
        $categories = Category::where('parent_id', NULL)->OrderBy('id', 'ASC')->get();
        $brand_parent_categories = FloorUnitCategory::where('category_code', 3)->orderBy('id', 'ASC')->get();
        return view('admin.pages.property.secondary_details_floor', get_defined_vars());
    }
    public function get_sd_defined_block(Request $request)
    {
        $property = Property::find($request->property_id);
        $blade_slug = Category::where('id', $property->cat_gc)->value('secondary_blade_slug');
        $get_property = Property::find($request->property_id);
        return view('admin.pages.property.' . $blade_slug, get_defined_vars());
    }

    public function get_sd_floors(Request $request)
    {
        $prop_categories = Category::where('parent_id', NULL)->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->select(['id', 'name', 'field_type'])->get();
        $sub_categories = FloorUnitCategory::where('category_code', 2)->select(['id', 'name', 'field_type'])->get();
        $brands = FloorUnitCategory::where('category_code', 3)->get();
        $count = $request->count;
        $c_id = $request->c_id;
        $start_index = $request->start_index;
        $length = $request->start_index + $count;

        return view('admin.pages.property.secondary_data.floor', get_defined_vars());
    }
    public function get_sd_units(Request $request)
    {
        $prop_categories = Category::where('parent_id', NULL)->get();
        $categories = FloorUnitCategory::where('category_code', 1)->select(['id', 'name'])->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->select(['id', 'name', 'field_type'])->get();
        $sub_categories = FloorUnitCategory::where('category_code', 2)->select(['id', 'name', 'field_type'])->get();
        $brands = FloorUnitCategory::where('category_code', 3)->select(['id', 'name'])->get();
        $count = $request->count;
        $c_id = $request->c_id;
        $floor_id = $request->floor_id;
        $start_index = $request->start_index;
        if ($request->floor_idoc != 0 && !empty($request->property_id)) {
            $unit_count = FloorUnitMap::where('property_id', $request->property_id)->where('floor_id', $request->floor_idoc)->get();
            if ($unit_count->count()  == 1) {
                $unit = FloorUnitMap::where('property_id', $request->property_id)->where('floor_id', $request->floor_idoc)->first();
                $unit->is_single = 1;
                $unit->save();
                // add_cloumn
            }
        }
        return view('admin.pages.property.secondary_data.unit', get_defined_vars());
    }
    public function editSecondaryDataFloors(Request $request)
    {
        $property_id = $request->property_id;
        $property_cat_id = Property::find($property_id);
        $property_cat_id = $property_cat_id->cat_id;
        $floors = PropertyFloorMap::where('property_id', $property_id)->where('tower_id', $request->tower_id)->orderBy('id', 'ASC')->get();
        $floor_index = [];
        $parent_unit_id = [];
        $parent_floors = [];
        foreach ($floors as $key => $floor) {
            $floor_index[$floor->id] = $floor->floor_no;
            array_push($parent_floors, $floor->merge_parent_floor_id);
        }

        $units = FloorUnitMap::where('property_id', $property_id)->where('is_single', 0)->where('tower_id', $request->tower_id)->orderBy('id', 'ASC')->get();
        $parent_units = [];
        foreach ($units as $key => $unit) {
            $parent_unit_id[$unit->id] = $unit->floor_id;
            array_push($parent_units, $unit->merge_parent_unit_id);
        }
        $custom_brands = FloorUnitMap::where('property_id', $request->property_id)->where('tower_id', $request->tower_id)->get();
        $prop_categories = Category::where('parent_id', NULL)->get();
        $unit_categories = FloorUnitCategory::where('category_code', 1)->get();
        $unit_category_list = FloorUnitCategory::where('category_code', 2)->get();
        $unit_sub_category_list = FloorUnitCategory::where('category_code', 3)->get();
        $brands = FloorUnitCategory::where('category_code', 4)->get();
        if (isset($request->page_type) && $request->page_type == 'view') {
            return view('admin.pages.property.secondary_data.view_floor', get_defined_vars());
        }
        return view('admin.pages.property.secondary_data.edit_floor', get_defined_vars());
    }
    public function save_sd_floor_merge(Request $request)
    {
        $merge_parent_floor_id = 0;
        $child_floor_arr = [];
        $merge_parent_unit_id = NULL;
        $checked_floors = isset($request->floor) ? $request->floor : [];
        for ($f = 0; $f < (int)$request->no_of_floors; $f++) {
            if (!isset($request->floor_id[$f])) {
                $floor = new PropertyFloorMap;
                $floor->property_id = $request->property_id;
                $floor->floor_no = $f ?? 0;
                $floor->floor_name = $request->floor_name[$f] ?? 0;
                $floor->units = $request->nth_unit[$f] ?? 0;
                $floor->tower_id = $request->tower;
                $floor->merge_parent_floor_id =  NULL;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                if ($request->merge_parent_floor_id == $f) {
                    $merge_parent_floor_id = $floor->id;
                }
                $new_floor_id = $floor->id;
                if (isset($request->nth_unit[$f])) {
                    if ((int)$request->nth_unit[$f] < 2) {
                        $unit = new FloorUnitMap;
                        $unit->property_id          = $request->property_id;
                        $unit->floor_id             = $new_floor_id;
                        $unit->unit_name            = '';
                        $unit->merge_parent_unit_id = NULL;
                        $unit->floor_unit_sub_cat_id = 0;
                        $unit->block_id             = $request->block ?? 0;
                        $unit->tower_id             = $request->tower;
                        $unit->save();
                    }
                }
            } elseif ($request->floor_id[$f] != 0) {
                $floor = PropertyFloorMap::find($request->floor_id[$f]);
                $floor->floor_name = $request->floor_name[$f] ?? 0;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->tower_id = $request->tower;
                $floor->save();
                $unit = FloorUnitMap::where('floor_id', $floor->id)->first();
                $unit->property_id          = $request->property_id;
                $unit->floor_id             = $floor->id;
                $unit->unit_name            = '';
                $unit->block_id             = $request->block ?? 0;
                $unit->tower_id             = $request->tower;
                $unit->save();
                if ($request->merge_parent_floor_id == $request->floor_id[$f]) {
                    $merge_parent_floor_id = $floor->id;
                }
            }

            if (isset($request->nth_unit[$f])) {
                if ((int)$request->nth_unit[$f] > 1) {
                    for ($u = 0; $u < (int)$request->nth_unit[$f]; $u++) {
                        $checked_units = [];
                        $nth_unit_name_key              = 'nth_unit_name' . $f;
                        $floor_unit_sub_cat_id_status   = 'unit_check' . $f;
                        $unit_id_key                    = 'unit_id' . $f;

                        if (!isset($request->$unit_id_key[$u])) {
                            $unit = new FloorUnitMap;
                            $unit->property_id          = $request->property_id;
                            $unit->floor_id             = $floor->id;
                            $unit->unit_name            = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                            $unit->block_id             = $request->block ?? 0;
                            $unit->tower_id             = $request->tower;
                            $unit->save();
                        }
                    }
                }
            }
        }

        $floors = PropertyFloorMap::where('property_id', $request->property_id)->where('merge_parent_floor_status', 1)->get();
        $parent_floor = FloorUnitMap::where('floor_id', $merge_parent_floor_id)->first();
        foreach ($floors as $floor) {
            if ($merge_parent_floor_id != $floor->id) {
                $floor = PropertyFloorMap::find($floor->id);
                $floor->units                   = 0;
                $floor->merge_parent_floor_id   = $merge_parent_floor_id;
                $floor->tower_id = $request->tower;
                $floor->merge_parent_floor_status = 0;
                $floor->save();
                $child_floor = FloorUnitMap::where('floor_id', $floor->id)->first();
                $child_floor->block_id = $request->block ?? 0;
                $child_floor->tower_id = $request->tower;
                $child_floor->save();
            }
        }

        if ($request->ajax()) {
            return response()->json(array(
                'success' => true,
                'data'    => [
                    'id' => $request->property_id,
                    'action_url' => url('surveyor/property/update_details/' . $request->property_id),
                ],
            ), 200);
        }
    }
    public function save_sd_unit_merge(Request $request)
    {
        $input_data = $request->all();
        $merge_parent_floor_id = 0;
        $child_floor_arr = [];
        $current_floor_id = 0;
        $merge_parent_unit_id = NULL;
        $checked_floors = isset($request->floor) ? $request->floor : [];
        for ($f = 0; $f < (int)$request->no_of_floors; $f++) {
            if (!isset($request->floor_id[$f])) {
                $floor = new PropertyFloorMap;
                $floor->property_id = $request->property_id;
                $floor->floor_no = $f ?? 0;
                $floor->floor_name = $request->floor_name[$f] ?? 0;
                $floor->tower_id = $request->tower;
                $floor->units = $request->nth_unit[$f] ?? 0;
                $floor->merge_parent_floor_id =  NULL;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                if ($request->merge_parent_floor_id == $f) {
                    $merge_parent_floor_id = $floor->id;
                }
                $new_floor_id = $floor->id;
            } elseif ($request->floor_id[$f] != 0) {
                $floor = PropertyFloorMap::find($request->floor_id[$f]);
                $floor->units = $request->nth_unit[$f] ?? 0;
                $floor->tower_id = $request->tower;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                $current_floor_id = $floor->id;
                if ($request->merge_parent_floor_id == $request->floor_id[$f]) {
                    $merge_parent_floor_id = $floor->id;
                }
            }

            if (isset($request->nth_unit[$f])) {
                if ((int)$request->nth_unit[$f] > 1) {
                    for ($u = 0; $u < (int)$request->nth_unit[$f]; $u++) {
                        $checked_units = [];
                        $nth_unit_name_key              = 'nth_unit_name' . $f;
                        $floor_unit_sub_cat_id_status   = 'unit_check' . $f;
                        $unit_id_key                    = 'unit_id' . $f;

                        $checked_units = [];
                        $checked_units = isset($request->$floor_unit_sub_cat_id_status) ? $request->$floor_unit_sub_cat_id_status : [];
                        if (!isset($request->$unit_id_key[$u])) {
                            $unit = new FloorUnitMap;
                            $unit->property_id          = $request->property_id;
                            $unit->floor_id             = $floor->id;
                            $unit->unit_name            = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                            $unit->block_id             = $request->block ?? 0;
                            $unit->tower_id             = $request->tower;
                            $unit->merge_parent_unit_id = NULL;
                            $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0;
                            $unit->floor_unit_sub_cat_id = 0;
                            $unit->save();
                            if ($request->merge_unit_parent_floor_id == $f && $request->merge_parent_unit_id == $u) {
                                $merge_parent_unit_id = ($request->unit_exist == 1) ? $request->merge_parent_unit_id : $unit->id;
                            }
                        } elseif ($request->$unit_id_key[$u]  != 0) {
                            $unit = FloorUnitMap::find($request->$unit_id_key[$u]);
                            $unit->unit_name            = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                            $unit->property_id          = $request->property_id;
                            $unit->floor_id             = $floor->id;
                            $unit->block_id             = $request->block ?? 0;
                            $unit->tower_id             = $request->tower;
                            $unit->merge_parent_unit_id = ($unit->merge_parent_unit_id != NULL) ? $unit->merge_parent_unit_id : NULL;
                            $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0;
                            $unit->save();
                            $merge_parent_unit_id = $request->merge_parent_unit_id;
                        }
                    }
                } else {
                    if (isset($new_floor_id)) {
                        $unit = new FloorUnitMap;
                        $unit->property_id          = $request->property_id;
                        $unit->floor_id             = $new_floor_id;
                        $unit->unit_name            = '';
                        $unit->block_id             = $request->block ?? 0;
                        $unit->tower_id             = $request->tower;
                        $unit->merge_parent_unit_id = NULL;
                        $unit->floor_unit_sub_cat_id = 0;
                        $unit->save();
                    }
                }
            }
        }

        $units = FloorUnitMap::where('property_id', $request->property_id)->where('merge_parent_unit_status', 1)->get();
        $parent_unit = FloorUnitMap::find($merge_parent_unit_id);
        foreach ($units as $unit) {
            if ($merge_parent_unit_id != $unit->id) {
                $unit = FloorUnitMap::find($unit->id);
                $unit->unit_name            = $parent_unit->unit_name;
                $unit->block_id             = $request->block ?? 0;
                $unit->tower_id             = $request->tower;
                $unit->merge_parent_unit_id = $merge_parent_unit_id;
                $unit->merge_parent_unit_status = 0;
                $unit->brand_name           = $parent_unit->brand_name;
                $unit->save();
            }
        }

        if ($request->ajax()) {
            return response()->json(array(
                'success' => true,
                'data'    => [
                    'id' => $request->property_id,
                    'action_url' => url('surveyor/property/update_details/' . $request->property_id),
                ],
            ), 200);
        }
    }
    public function get_block_towers(Request $request)
    {
        $towers = Tower::where('block_id', $request->block_id)->where('no_of_towers', '>', '0')->get();
        if ($towers) {
            return response()->json(array(
                'success' => false,
                'towers' => $towers
            ), 200);
        } else {
            return response()->json(array(
                'success' => false,
            ), 422);
        }
    }
    public function save_sd_floors(Request $request)
    {
        $merge_parent_floor_id = 0;
        $child_floor_arr = [];
        $merge_parent_unit_id = NULL;
        $checked_floors = isset($request->floor) ? $request->floor : [];
        for ($f = 0; $f < (int)$request->no_of_floors; $f++) {           
            if (!isset($request->floor_id[$f])) {               
                $floor = new PropertyFloorMap;
                $floor->property_id = $request->property_id;
                $floor->floor_no = $f ?? 0;
                $floor->units = $request->nth_unit[$f] ?? 0;
                $floor->floor_name = $request->floor_name[$f] ?? 0;
                $floor->tower_id = $request->tower;
                $floor->merge_parent_floor_id =  NULL;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
                if ($request->merge_parent_floor_id == $f) {
                    $merge_parent_floor_id = $floor->id;
                }

                if (isset($request->nth_unit[$f])) {
                    if ((int)$request->nth_unit[$f] > 1) {
                        for ($u = 0; $u < (int)$request->nth_unit[$f]; $u++) {
                            $checked_units = [];
                            $nth_unit_name_key = 'nth_unit_name' . $f;
                            $floor_unit_sub_cat_id_status = 'unit_check' . $f;
                            $unit_brand = NULL;

                            $unit = new FloorUnitMap;
                            $unit->property_id          = $request->property_id;
                            $unit->floor_id             = $floor->id;
                            $unit->unit_name            = isset($request->$nth_unit_name_key[$u]) ? $request->$nth_unit_name_key[$u] : '';
                            $unit->block_id             = $request->block ?? 0;
                            $unit->tower_id             = $request->tower;
                            $unit->merge_parent_unit_id = NULL;
                            $unit->merge_parent_unit_status = isset($request->$floor_unit_sub_cat_id_status[$u]) ? 1 : 0;
                            $unit->floor_unit_sub_cat_id = 0;
                            $unit->save();
                            if ($request->merge_unit_parent_floor_id == $f && $request->merge_parent_unit_id == $u) {
                                $merge_parent_unit_id = $unit->id;
                            }
                        }
                    } else {
                        $unit = new FloorUnitMap;
                        $unit->property_id          = $request->property_id;
                        $unit->floor_id             = $floor->id;
                        $unit->unit_name            = '';
                        $unit->block_id             = $request->block ?? 0;
                        $unit->tower_id             = $request->tower;
                        $unit->merge_parent_unit_id = NULL;
                        $unit->floor_unit_sub_cat_id = 0;
                        $unit->save();
                    }
                } else {
                    $unit = new FloorUnitMap;
                    $unit->property_id           = $request->property_id;
                    $unit->floor_id              = $floor->id;
                    $unit->unit_name             = '';
                    $unit->block_id             = $request->block ?? 0;
                    $unit->tower_id             = $request->tower;
                    $unit->merge_parent_unit_id  = NULL;
                    $unit->floor_unit_sub_cat_id = 0;
                    $unit->save();
                }
            }else{
                 $floor = PropertyFloorMap::where('',$request->floor_id[$f])->first();
                $floor->property_id = $request->property_id;
                $floor->floor_no = $f ?? 0;
                $floor->units = $request->nth_unit[$f] ?? 0;
                $floor->floor_name = $request->floor_name[$f] ?? 0;
                $floor->tower_id = $request->tower;
                $floor->merge_parent_floor_id =  NULL;
                $floor->merge_parent_floor_status =  (in_array($f, $checked_floors)) ? 1 : 0;
                $floor->save();
            }
        }
                             
        
        $floors = PropertyFloorMap::where('property_id', $request->property_id)->where('merge_parent_floor_status', 1)->get();
        $parent_floor = FloorUnitMap::where('floor_id', $merge_parent_floor_id)->first();
        foreach ($floors as $floor) {
            if ($merge_parent_floor_id != $floor->id) {
                $floor = PropertyFloorMap::find($floor->id);
                $floor->units                   = 0;
                $floor->tower_id = $request->tower;
                $floor->merge_parent_floor_id   = $merge_parent_floor_id;
                $floor->merge_parent_floor_status = 0;
                $floor->save();
                $child_floor = FloorUnitMap::where('floor_id', $floor->id)->first();
                $child_floor->brand_name           = $parent_floor->brand_name;
                $child_floor->block_id             = $request->block ?? 0;
                $child_floor->tower_id             = $request->tower;
                $child_floor->save();
            }
        }
        $units = FloorUnitMap::where('property_id', $request->property_id)->where('merge_parent_unit_status', 1)->get();
        $parent_unit = FloorUnitMap::find($merge_parent_unit_id);
        foreach ($units as $unit) {
            if ($merge_parent_unit_id != $unit->id) {
                $unit = FloorUnitMap::find($unit->id);
                $unit->unit_name            = $parent_unit->unit_name;
                $unit->block_id             = $request->block ?? 0;
                $unit->tower_id             = $request->tower;
                $unit->merge_parent_unit_id = $merge_parent_unit_id;
                $unit->merge_parent_unit_status = 0;
                $unit->save();
            }
        }
        if ($request->ajax()) {
            return response()->json(
                array(
                    'success' => true,
                    'data'    => [
                        'id' => $request->property_id,
                        'action_url' => '',
                        'message' => 'Floors Added Successfully.'
                    ],
                ),
                200
            );
        }
    }
    public function css_loader()
    {
        return view('css_loader');
    }

    public function file_compression_test()
    {
        return view('test');
    }

    public function unitDetails($unit_id, $property_id, $unit_type_id, $unit_cat_id)
    {
        // return $request->all();
        $property = Property::find($property_id);
        $prop_category_data = Category::find($property->category->id);
        $unit_data = FloorUnitMap::where('property_id', $property->id)
            ->where('unit_type_id', $unit_type_id)
            ->where('unit_cat_id', $unit_cat_id)
            ->where('id', $unit_id)
            ->first();
        $sub_categories = FloorUnitCategory::where('parent_id', $unit_cat_id)->get();
        $units = Unit::whereIn('id', ['3', '4'])->get();
        // dd($units);
        return view('admin.pages.property.unit_details', get_defined_vars());
    }
}
