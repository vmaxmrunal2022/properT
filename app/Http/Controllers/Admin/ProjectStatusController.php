<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, SubCategory, PropertyImage, Property, FloorUnitCategory, Tower, FloorUnitMap, PropertyFloorMap, Builder, ProjectStatusFilterField, ProjectStatusLog, TowerLog};

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

class ProjectStatusController extends Controller
{
    public function get_project_status_block()
    {
        return view('admin.pages.property.secondary_data.', get_defined_vars());
    }
    public function store(Request $request)
    {
        $property = Property::where('id', $request->property_id)
            ->where('status', 1)
            ->first();
        if ($property) {
            $towers = TowerLog::where('property_id', $request->property_id)
                ->orderBy('id', 'DESC')
                ->get();
            $project_status_log = ProjectStatusLog::where('property_id', $request->property_id)
                ->orderBy('id', 'DESC')
                ->get();
            // dd($project_status_log);
            $status_list = view('admin.pages.property.secondary_data.project_status.index_log', get_defined_vars())->render();
            return response()->json(
                [
                    'status' => true,
                    'statusList' => $status_list,
                    'message' => 'This property is completed.',
                ],
                200,
            );
        }
        Validator::extend('required_if_not_empty', function ($attribute, $value, $parameters, $validator) {
            $otherField = $parameters[0];

            return !empty($validator->getData()[$otherField]) ? !empty($value) : true;
        });

        $validation = [
            'project_status' => 'required',
            'project_expected_date_of_start' => 'required_if:project_status,1',
            'project_expected_date_of_completion' => 'required_if:project_status,1',
            'tower' => 'required_if:project_status,2',
            'tower_status' => 'required_if_not_empty:tower',
            'tower_expected_date_of_start' => 'required_if:tower_status,1',
            'tower_expected_date_of_completion' => 'required_if:tower_status,1',
            'project_date_of_completion' => 'required_if:project_status,3',
            'construction_stage' => 'required_if:tower_status,2',
            'floor_range' => 'required_if:construction_stage,2',
            'tower_date_of_completion' => 'required_if:tower_status,3',
        ];
        $customMessages = [
            'project_expected_date_of_start.required_if' => 'The project expected date of start field is required.',
            'project_expected_date_of_completion.required_if' => 'The project expected date of completion field is required.',
            'tower.required_if' => 'The tower field is required.',
            'tower_expected_date_of_start.required_if' => 'The tower expected date of start field is required.',
            'tower_expected_date_of_completion.required_if' => 'The tower expected date of completion field is required.',
            'project_date_of_completion.required_if' => 'The project date of completion field is required.',
            'tower_status.required_if_not_empty' => 'The tower status field is required.',
            'construction_stage.required_if' => 'The construction stage field is required.',
            'floor_range.required_if' => 'The floor range field is required.',
            'tower_date_of_completion.required_if' => 'The tower date of completion field is required.',
        ];
        $validator = Validator::make($request->all(), $validation, $customMessages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // exit();

        $property = Property::find($request->property_id);
        $property->project_status = isset($request->project_status) ? $request->project_status : null;
        $property->project_expected_date_of_start = isset($request->project_expected_date_of_start) ? $request->project_expected_date_of_start : null;
        $property->project_expected_date_of_completion = isset($request->project_expected_date_of_completion) ? $request->project_expected_date_of_completion : null;
        $property->project_date_of_completion = isset($request->project_date_of_completion) ? $request->project_date_of_completion : null;
        $property->status = isset($request->project_status) && $request->project_status == 3 ? 1 : 0;
        $property->save();

        $project_status_log = new ProjectStatusLog();
        $project_status_log->property_id = $request->property_id;
        $project_status_log->project_status = isset($request->project_status) ? $request->project_status : null;
        $project_status_log->project_expected_date_of_start = isset($request->project_expected_date_of_start) ? $request->project_expected_date_of_start : null;
        $project_status_log->project_expected_date_of_completion = isset($request->project_expected_date_of_completion) ? $request->project_expected_date_of_completion : null;
        $project_status_log->project_date_of_completion = isset($request->project_date_of_completion) ? $request->project_date_of_completion : null;
        $project_status_log->created_by = Auth::user()->id;
        $project_status_log->save();

        if (isset($request->tower)) {
            $tower = Tower::find($request->tower);
            $tower->tower_status = isset($request->tower_status) ? $request->tower_status : null;
            $tower->tower_expected_date_of_start = isset($request->tower_expected_date_of_start) ? $request->tower_expected_date_of_start : null;
            $tower->tower_expected_date_of_completion = isset($request->tower_expected_date_of_completion) ? $request->tower_expected_date_of_completion : null;
            $tower->tower_date_of_completion = isset($request->tower_date_of_completion) ? $request->tower_date_of_completion : null;
            $tower->construction_stage = isset($request->construction_stage) ? $request->construction_stage : null;
            $tower->floor_range = isset($request->floor_range) ? $request->floor_range : null;
            $tower->status = isset($request->tower_status) && $request->tower_status == 3 ? '0' : '1';
            $tower->save();

            $tower_log = new TowerLog();
            $tower_log->property_status_log_id = $project_status_log->id;
            $tower_log->property_id = $request->property_id;
            $tower_log->tower_id = $request->tower;
            $tower_log->tower_status = isset($request->tower_status) ? $request->tower_status : null;
            $tower_log->tower_expected_date_of_start = isset($request->tower_expected_date_of_start) ? $request->tower_expected_date_of_start : null;
            $tower_log->tower_expected_date_of_completion = isset($request->tower_expected_date_of_completion) ? $request->tower_expected_date_of_completion : null;
            $tower_log->tower_date_of_completion = isset($request->tower_date_of_completion) ? $request->tower_date_of_completion : null;
            $tower_log->construction_stage = isset($request->construction_stage) ? $request->construction_stage : null;
            $tower_log->floor_range = isset($request->floor_range) ? $request->floor_range : null;
            $tower_log->created_by = Auth::user()->id;
            $tower_log->save();
        }
        $towers = TowerLog::where('property_id', $request->property_id)
            ->orderBy('id', 'DESC')
            ->get();
        $project_status_log = ProjectStatusLog::where('property_id', $request->property_id)
            ->orderBy('id', 'DESC')
            ->get();
        // dd($project_status_log);
        $status_list = view('admin.pages.property.secondary_data.project_status.index_log', get_defined_vars())->render();
        return response()->json(
            [
                'status' => true,
                'statusList' => $status_list,
                'message' => 'Project Status Updated Successfully.',
            ],
            200,
        );
    }

    public function project_status_fields(Request $request)
    {
        $property_id = $request->property_id;
        $property = Property::find($property_id);
        $toggle_class_name = $request->class_name;

        $tower_type = $property->residential_type == 7 ? 1 : 2;
        $options = ProjectStatusFilterField::where('type', $request->type)
            ->where('status_id', $request->status_id)
            ->where('construction_stage_id', $request->construction_stage)
            ->where('tower_type', $tower_type)
            ->get();

        return view('admin.pages.property.secondary_data.project_status_fields', get_defined_vars());
    }

    public function project_status_history(Request $request)
    {
        $property = Property::find($request->property_id);
        $project_status_log = ProjectStatusLog::where('property_id', $property->id)
            ->orderBy('id', 'DESC')
            ->get();
        // $towers = Tower::where('property_id', $request->property_id)->where('tower_status', '!=', '')->get();
        $towers = TowerLog::where('property_id', $request->property_id)
            ->orderBy('id', 'DESC')
            ->get();
        $status_history = view('admin.pages.property.secondary_data.project_status.index_log', get_defined_vars())->render();
        return response()->json(
            [
                'status' => true,
                'statusList' => $status_history,
                'message' => 'Project Status Updated Successfully.',
            ],
            200,
        );
    }
}
