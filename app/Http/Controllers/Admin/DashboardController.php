<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\FloorUnitCategory;
use App\Models\Category;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $property_count = Property::where('created_by', Auth::user()->id)->count();
        $today_data = Property::whereDate('created_at', Carbon::today())->where('created_by', Auth::user()->id)->count();
        $this_week = Property::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('created_by', Auth::user()->id)->count();
        $this_month = Property::select('*')->whereMonth('created_at', Carbon::now()->month)->where('created_by', Auth::user()->id)->count();
        return view('admin.pages.dashboard',compact('property_count','today_data','this_week','this_month'));
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
        //
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
    
    
    // get properties count on type basis 
    public function propertyCount(Request $request){
         if($request->type == 'all'){
             $data['count'] = Property::count();
             $data['type'] = 'TOTAL SURVEYED';
             $data['key'] = 'all';
             return $data;
         }elseif($request->type == 'month'){
            $data['count'] = Property::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count(); 
             $data['type'] = 'SURVEYED THIS MONTH';
             $data['key'] = 'month';
             return $data;
         }elseif($request->type == 'week'){
             $data['count'] = Property::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
              $data['type'] = 'SURVEYED THIS WEEK';
              $data['key'] = 'week';
             return $data;
         }elseif($request->type == 'today'){
             $data['count'] = Property::whereDate('created_at', Carbon::today())->count();
              $data['type'] = 'SURVEYED TODAY';
              $data['key'] = 'today';
             return $data;
         }
    }

    public function search_dropdown(Request $request){
        if($request->ajax()){
            $options = Category::where('cat_name', 'like', '%'.$request->search_key.'%' )->OrderBy('cat_name', 'ASC')->get();
            return response()->json(['options' => $options], 200);
        }
        return view('admin.pages.property.search_dropdown');
        
    }
    public function check_log(){
        return response()->json([], 403);
    }
    public function upload_test(){
        return view('upload_files');
    }
    public function store_files(Request $request){
        dd($request->all());
        // if ($request->hasfile('files')) {

        //     foreach ($request->file('files') as $image) {
        //         $name = $image->getClientOriginalName();
        //         $file_name = uniqid() . "." . $image->getClientOriginalExtension();
        //         $image->move(public_path() . '/uploads/property/images', $file_name);
        //         $property_img = new PropertyImage;
        //         $property_img->file_url = $file_name;
        //         $property_img->property_id = $id;
        //         $property_img->save();
        //         //    $data[] = $name;  
        //     }
        //     // if (File::exists(public_path('uploads/csv/img.png'))) {
        //     //     File::delete(public_path('uploads/csv/img.png'));
        //     // }
        // } 
    }

    public function getBrandSubCategories(Request $request)
    {
        $brand_sub_categories = FloorUnitCategory::where('parent_id', $request->c_id)->get();
        return $brand_sub_categories;
    }

    public function getSubResidentials(Request $request)
    {
        if ($request->c_id) {
            $sub_residentials = Category::where('parent_id', $request->c_id)->get();
            return $sub_residentials;
        }
    }

    public function getDefinedOptions(Request $request)
    {
        $data = Category::where('parent_id', $request->c_id)->get();
        return response()->json($data);
    }
}
