<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\PropertyImage;
use App\Models\Property;
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
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SurveyorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surveyors = User::all();
        return view('surveyor.index', compact('surveyors'));
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
        return view('surveyor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        
        $data = $request->all();

        $validator = Validator::make(
            $data,
            [
                'password' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'username' => 'required',
                'mobile' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $surveyor = new User;
       
        $surveyor->name  = $request->name;
        $surveyor->email  = $request->email;
        $surveyor->username  = $request->username;
        $surveyor->password = Hash::make($data['password']);
        $surveyor->mobile  = $request->mobile;
        $surveyor->role  = 2;
        $surveyor->save();

        return redirect()->route('completed')->with('surveyor', $surveyor->id);
    }
    
    public function management(){
        $surveyors = User::all();
        return view('surveyor.management', compact('surveyors'));
    }

    public function completed()
    {
        return view('admin.pages.property.completed');
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
       $survseyor = User::find($id);
       if($surveyor){
           return view('surveyor.show', compact('surveyor'));
       }
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
        $sub_categories = SubCategory::all();
        $property = Property::find($request->id);
        $property->images;
        return view('admin.pages.property.report_details', compact('property', 'categories', 'sub_categories'));
    }
    public function editDetails($id)
    {
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        $property = Property::find($id);
        $property->images;
        return view('admin.pages.property.edit_details', get_defined_vars());
    }
    public function updateDetails(Request $request, $id)
    {
        $input_data = $request->all();

        $validator = Validator::make(
            $input_data,
            [

                'files.*' => 'mimes:jpg,jpeg,png,bmp|max:20000',
                // 'city' => 'required',
                // 'gis_id' => 'required',
                //  'latitude' => 'required',
                //  'longitude' => 'required',
                'category' => 'required',
                'sub_category' => 'required_if:category,' . implode(',', [1, 2, 3, 4]),
                // 'house_no' => '',
                // 'plot_no' => '',
                'street_details' => 'required',
                'locality_name' => 'required',
                // 'owner_name' => '',
                // 'contact_no' => '',
                // 'remarks' => '',
            ],
            [
                // 'image_file.*.required' => 'Please upload an image',
                // 'files.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                'files.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
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
            $property->plot_no = $request->plot_no;
            $property->street_details = $request->street_details;
            $property->locality_name = $request->locality_name;
            $property->owner_name = $request->owner_name;
            $property->contact_no = $request->contact_no;
            $property->remarks = $request->remarks;
            // $property->latitude = $request->latitude;
            // $property->longitude = $request->longitude;
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
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => true,
                    'message' => 'property Updated Successfully'
                ), 200);
            }
            return redirect()->route('update_screen')->with('property', $property->id);
        } else {
            if ($request->ajax()) {
                return response()->json(array(
                    'success' => false,
                    'message' => 'Your property number not found!'
                ), 400);
            }
            $notification = array(
                'message' => 'Your property number not found!',
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

        $categories = Category::all();
        $sub_categories = SubCategory::all();
        // $property = Property::find($request->id);
        $properties = Property::query();

        if ($request->has('start_date') && !empty($request->get('start_date'))) {
            $from = date($request->get('start_date') . ' 00:00:00.000000');
            $today = new DateTime();
            $to = $today->format('Y-m-d') . " 23:58:59.000000";
        }

        if ($request->has('end_date') && !empty($request->get('end_date'))) {
            $to = date($request->get('end_date').' 23:58:59.000000');
        }
        $properties->when($request->category, function($query) use ($request) {
                $query->where('cat_id', $request->category);
        })
        ->when($request->sub_category, function($query) use ($request) {
                $query->where('sub_cat_id', $request->sub_category);
        })
        ->when($request->gis_id, function($query) use ($request) {
                $query->where('gis_id','like', '%' . $request->gis_id. '%');
        })
        ->when($request->house_no, function($query) use ($request) {
                $query->where('house_no', 'like', '%' . $request->house_no . '%');
        })
        ->when($request->locality_name, function($query) use ($request) {
                $query->where('locality_name','like', '%' . $request->locality_name  . '%');
        })
        ->when($request->plot_no, function($query) use ($request) {
                $query->where('plot_no', 'like', '%' .$request->plot_no  . '%');
        })
        ->when($request->street_name, function($query) use ($request) {
                $query->where('street_name', 'like', '%' .$request->street_name  . '%');
        })
        ->when($request->owner_name, function($query) use ($request) {
                $query->where('owner_name', 'like', '%' .$request->owner_name  . '%');
        })
        ->when($request->contact_no, function($query) use ($request) {
                $query->where('contact_no', 'like', '%' .$request->contact_no  . '%');
        });
   

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
            $properties = $properties->when($request->search, function($query) use ($request) {
                
                    $query->where(function($q) use ($request){
                        $q->where('gis_id', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('owner_name', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('house_no', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('locality_name', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('contact_no', 'LIKE', '%'.$request->search.'%');
                            // ->whereHas('property.category', function ($query) use ($value) {
                            //         $query->where('title', 'LIKE', '%'.$request->search.'%');
                            //     });
                    });
                });
                
        }
        
        $properties=$properties->where('created_by', Auth::user()->id)->orderBy('id','DESC')->paginate(10);
        $properties->setPath(route('surveyor.property.reports', [], true));

        foreach ($properties as $key => $property) {
            $properties[$key]['date'] = $property->created_at->format('d-m-Y');
            $properties[$key]['time'] = $property->created_at->format('H:i A');
            $properties[$key]['cat'] = $property->category->title ?? '';
            $properties[$key]['sub_cat'] = $property->sub_category->title ?? '';
        }

        if ($request->ajax()) {
            return view('admin.pages.property.property_pagination', ['properties' => $properties]);
        }
        return view('admin.pages.property.demo_reports', compact('properties', 'categories', 'sub_categories'));
    }

    public function exportExcel()
    {
        return Excel::download(new PropertiesExport, 'invoices.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    public function exportCsv()
    {
        return Excel::download(new PropertiesExport, 'properties.xlsx');
    }
    public function exportPdf()
    {
        $properties = Property::where('created_by', Auth::user()->id)->get();
        return view('admin.pages.property.pdf.property', compact('properties'));
        
        
        ini_set('max_execution_time', 300);
        ini_set("memory_limit","512M");
        
        $pdf = PDF::loadView('admin.pages.property.pdf.property', compact('properties'));
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->set_option('enable_html5_parser', TRUE);
        return $pdf->stream('my-pdf.pdf');

        
    
        return $pdf->download('properties.pdf');
        // return Excel::download(new PropertiesExport, 'properties.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}