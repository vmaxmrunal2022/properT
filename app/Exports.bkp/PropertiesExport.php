<?php

namespace App\Exports;

use App\Models\Property;
use App\Models\Category;
use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Auth;

class PropertiesExport implements FromCollection,  WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $properties = Property::select(['created_at','updated_at','gis_id', 'cat_id', 'house_no',  'locality_name', 'owner_name',  'street_details','no_of_floors' ,'remarks'])
                                ->where('created_by', Auth::user()->id)->get();
    
        foreach($properties as $key=>$property){
            $properties1[$key]['created_at'] = $property->created_at->format('Y-m-d');
            $properties1[$key]['updated_at'] = $property->created_at->format('H:i:s');
            $properties1[$key]['gis_id'] = $property->gis_id;
            $properties1[$key]['cat_id'] = $property->category->cat_name ?? '';
            $properties1[$key]['house_no'] = $property->house_no;
            $properties1[$key]['locality_name'] = $property->locality_name;
            $properties1[$key]['owner_name'] = $property->owner_name;
            $properties1[$key]['street_details'] = $property->street_details;
            $properties1[$key]['no_of_floors'] = $property->no_of_floors;
            $properties1[$key]['remarks'] = $property->remarks;
            // $properties[$key]['sub_cat_id'] = $property->sub_category->title ?? '';
            
        }
        $properties1 = collect($properties1);
        return $properties1;
        
    }
    
     public function headings(): array
    {
        return [ 'Date', 'Time','GIS Id','Category of the Property','House No', 'Colony/Locality Name', 'Owner Name', 'Street Name','No of Floors', 'Remarks'];
        // return ['GIS id', 'Property Type', 'Type of Property', 'House No', 'Plot No', 'Street Name', 'Locality Name', 'Owner Name', 'Contact Number', 'Remarks', 'Latitude', 'Longitude', 'Creation Date'];
    }
    
    public function styles($sheet)
    {
        $sheet->getStyle('A1:O1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}
