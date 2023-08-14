<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\{
    PropertyController,
    SecondaryController,
    SurveyorController,
    PropertyImagesController,
    AmenitiesController,
    CompliancesController,
    SecondaryDetailsController
};
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuilderController;
use App\Http\Controllers\SubCategoryController;
use App\Models\FloorUnitCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Database\QueryException;

// use DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});


// Route::get('/destroy-property_floor_map', function () {
//     Schema::dropIfExists('property_floor_map');
// });

// Route::get('/destroy-floor_unit_map', function () {
//     Schema::dropIfExists('floor_unit_map');
// }); 
Route::get('clear_cache', function () {
    \Artisan::call('config:cache');
    \Artisan::call('config:clear');

    dd("Cache is cleared");
    if(DB::connection()->getDatabaseName())
    {
       echo "Yes! successfully connected to the DB: " . DB::connection()->getDatabaseName();
    }else{
        echo "wertyu";
    }
});

Route::get('/update_roles', function () {
    // DB::table('roles') ->where('id', 1) ->update(['name' => 'Admin']);
    // DB::table('roles') ->where('id', 2) ->update(['name' => 'Surveyor']);
    // DB::table('roles') ->where('id', 3) ->update(['name' => 'Sales']);
    // DB::table('users')->where('id', 1)->update(['role' => '1']);
    // DB::table('users')->whereIn('id', [6,7,8,9,10,11,12,13,14,15,16,17])->update(['role' => '2']);
    
    
});


Route::get('/update_amenity_entities', function () {

    // Schema::rename('secondary_features', 'property_amenities');
    // Schema::rename('secondary_features_options', 'amenity_options');
    // Schema::rename('property_amenity_map', 'property_amenity_amenity_option');
    DB::statement('ALTER TABLE "public"."property_amenity_amenity_option" RENAME COLUMN "secondary_features_options_id" TO "amenity_option_id"');

});


// Route::get('/add_cloumn', function () {
//     try {
//     Schema::table('property_floor_map', function (Blueprint $table) {
//         $table->string('floor_name')->after('floor_no')->nullable();
//         });
//     } catch (QueryException $e) {
//         echo $e->getMessage();
//         // Handle any potential exceptions
//         // For example, if the column already exists
//         // You can log the error or perform any desired action
//     }
// });
Route::get('/add_cloumn_properties_towers', function () {
    
    Schema::table('properties', function (Blueprint $table) {
        // $table->unsignedInteger('project_status')->nullable();
        $table->date('project_expected_date_of_start')->nullable()->default(null);
        $table->date('project_expected_date_of_completion')->nullable()->default(null);
        $table->date('project_date_of_completion')->nullable()->default(null);
    });
    // Schema::table('towers', function (Blueprint $table) {
    //     $table->unsignedInteger('tower_status')->nullable();
    //     $table->date('tower_expected_date_of_start')->nullable()->default(null);
    //     $table->date('tower_expected_date_of_completion')->nullable()->default(null);
    //     $table->date('tower_date_of_completion')->nullable()->default(null);
    //     $table->unsignedInteger('construction_stage')->nullable();
    //     $table->unsignedInteger('floor_range')->nullable();
    // });
    
});

Route::get('/create_project_status_filter_fields', function () {
// Schema::dropIfExists('project_status_filter_fields');
    $data = [
        [
            "type" => "project",
            "tower_type" => 1,
            "construction_stage_id" => 0,
            "status_id" => 1,
            "field_type" => "date",
            "field_title" => "Expected Date of Start",
            "model" => NULL,
            "data_attr_type" => NULL,
            "class_name" => NULL,
            "name_attribute" => "project_expected_date_of_start",
            "level" => 0
        ],
        // Add more records here...
    ];
    
    DB::table('project_status_filter_fields')->insert($data);

    // Schema::dropIfExists('project_status_filter_fields');
    // Schema::create('project_status_filter_fields', function (Blueprint $table) {
    //     $table->increments('id');
    //     $table->enum('type', ['project', 'tower', 'floor'])->nullable();
    //     $table->enum('tower_type', ['1', '2'])->nullable()->comment('1->Towers, 2->Units');
    //     $table->unsignedInteger('construction_stage_id')->nullable()->default('0');
    //     $table->unsignedInteger('status_id')->nullable();
    //     $table->enum('field_type', ['text', 'number', 'date', 'dropdown'])->nullable();
    //     $table->string('field_title', 255)->nullable();
    //     $table->string('model', 60)->nullable();
    //     $table->enum('data_attr_type', ['project', 'tower', 'floor'])->nullable()->comment('html element data attribute');
    //     $table->string('class_name', 60)->nullable();
    //     $table->string('name_attribute', 60)->nullable();
    //     $table->unsignedInteger('level')->nullable();
    //     $table->timestamps();
    // });
});


Route::get('/add_floor_unit_categories', function () {

        
    $FloorUnitCategory = new FloorUnitCategory;
    $FloorUnitCategory->name = 'brand name';
    $FloorUnitCategory->created_by = Auth::user()->id;
    $FloorUnitCategory->parent_id =  86;
    $FloorUnitCategory->category_code = 4;
    $FloorUnitCategory->field_type = 'text';
    $FloorUnitCategory->save();

   
});




Route::get('/update_floor_unit_categories', function () {
    // 9-12
    \DB::table('floor_unit_categories')->where('id', 2)->update(['field_type' => 'select']);
    // \DB::table('categories')->where('id', 14)->update(['blade_slug' => 'primary_data.plot_land_gated_community']);
    // \DB::table('floor_unit_categories')->whereIn('id', [51])->delete();
});
Route::get('/update_username', function () {
    \DB::table('users')->where('id', 6)->update(['username' => 'vijay']);
});


$grproutes =  function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/basic_details', [PropertyController::class, 'index'])->name('basic_details');
    Route::get('/extended/basic_details', [PropertyController::class, 'basicDetailsExtended'])->name('extended.basic_details');
    Route::post('/get-property-count', [DashboardController::class, 'propertyCount'])->name('dashboard.get-property-count');
    /** ajax routes **/
    // get propery sub categories
    Route::get('/ajax/sub_categories', [SubCategoryController::class, 'get'])->name('ajax.sub_categories');

    //property
    Route::group(['prefix' => 'property'], function () {
        Route::post('/', [PropertyController::class, 'store'])->name('property.store');
        Route::get('/demo-reports', [PropertyController::class, 'reports'])->name('property.demo-reports');
        Route::get('/reports', [PropertyController::class, 'ajaxReports'])->name('property.reports');
        Route::get('/ajaxGet', [PropertyController::class, 'ajaxGet'])->name('property.ajax-get');
        Route::get('/reports/{type}', [PropertyController::class, 'reportsByType'])->name('property.type-reports');

        Route::get('/report_details/{id}', [PropertyController::class, 'reportDetails'])->name('property.report_details');
        Route::get('/edit_details/{id}', [PropertyController::class, 'editDetails'])->name('property.edit_details');
        Route::post('/update_details/{id}', [PropertyController::class, 'updateDetails'])->name('property.update_details');
        Route::get('/completed', [PropertyController::class, 'completed'])->name('completed');
        Route::get('update', [PropertyController::class, 'update_screen'])->name('update_screen');

        Route::group(['prefix' => 'image'], function () {
            Route::get('/destroy/{id}', [PropertyImagesController::class, 'destroy'])->name('property.image.destroy');
        });

        Route::get('csv/export', [PropertyController::class, 'exportCsv'])->name('properties.export.csv');
        Route::get('excel/export', [PropertyController::class, 'exportExcel'])->name('properties.export.excel');
        Route::get('pdf/export', [PropertyController::class, 'exportPdf'])->name('properties.export.pdf');
        Route::post('import', [PropertyController::class, 'import'])->name('import');
    });
    
    
    
};

 Route::group(['prefix' => 'admin', 'as' => 'admin.',], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
         Route::group(['prefix' => 'surveyor' , 'as' => 'surveyor.',], function () {
            Route::get('/userview', [SurveyorController::class, 'index'])->name('userview');
            Route::get('/create', [SurveyorController::class, 'create'])->name('create');
            Route::post('/store', [SurveyorController::class, 'store'])->name('store');
            Route::post('/show', [SurveyorController::class, 'show'])->name('show');
            Route::get('/reports', [SurveyorController::class, 'ajaxReports'])->name('reports');
            Route::get('/management', [SurveyorController::class, 'management'])->name('management');
            Route::get('/ajaxGet', [SurveyorController::class, 'ajaxGet'])->name('ajax-get');
            Route::get('/reports/{type}', [SurveyorController::class, 'reportsByType'])->name('type-reports');
            
            Route::get('/report_details/{id}', [SurveyorController::class, 'reportDetails'])->name('report_details');
            Route::get('/edit_details/{id}', [SurveyorController::class, 'editDetails'])->name('edit_details');
            Route::post('/update_details/{id}', [SurveyorController::class, 'updateDetails'])->name('update_details');
            Route::get('/completed', [SurveyorController::class, 'completed'])->name('completed');
            Route::get('update', [SurveyorController::class, 'update_screen'])->name('update_screen');
         });
    });

// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], $grproutes);

Route::group(['prefix' => 'surveyor', 'as' => 'surveyor.', 'middleware' => 'auth'], $grproutes);
Route::group(['prefix' => 'test', 'as' => 'test.', 'middleware' => 'auth'], $grproutes);

Route::get('/getBasicJson', [PropertyController::class, 'getBasicJson'])->name('getBasicJson');
 
Route::group(['prefix' => 'surveyor', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('surveyor.dashboard');
    Route::get('/basic_details', [PropertyController::class, 'index'])->name('surveyor.basic_details');
    Route::get('/basic_details_detto', [PropertyController::class, 'index_detto'])->name('surveyor.basic_details_detto');
    Route::get('/extended/basic_details', [PropertyController::class, 'basicDetailsExtended'])->name('surveyor.extended.basic_details');
    Route::post('/get-property-count', [DashboardController::class, 'propertyCount'])->name('dashboard.get-property-count');
    /** ajax routes **/
    // get propery sub categories
    Route::get('/ajax/sub_categories', [PropertyController::class, 'get_subcat_options'])->name('surveyor.ajax.sub_categories');

    //property
    Route::group(['prefix' => 'property'], function () {
        Route::post('/', [PropertyController::class, 'store'])->name('surveyor.property.store');
        Route::post('/store_detto', [PropertyController::class, 'store_detto'])->name('surveyor.property.store_detto');
        Route::get('/demo-reports', [PropertyController::class, 'reports'])->name('surveyor.property.demo-reports');
        Route::get('/reports', [PropertyController::class, 'ajaxReports'])->name('surveyor.property.reports');
        Route::get('/ajaxGet', [PropertyController::class, 'ajaxGet'])->name('surveyor.property.ajax-get');
        Route::get('/reports/{type}', [PropertyController::class, 'reportsByType'])->name('surveyor.property.type-reports');

        Route::get('/report_details/{id}', [PropertyController::class, 'reportDetails'])->name('surveyor.property.report_details');
        Route::get('/edit_details/{id}', [PropertyController::class, 'editDetails'])->name('surveyor.property.edit_details');
        Route::post('/update_details/{id}', [PropertyController::class, 'updateDetails'])->name('surveyor.property.update_details');
        Route::get('/completed', [PropertyController::class, 'completed'])->name('completed');
        Route::get('update', [PropertyController::class, 'update_screen'])->name('update_screen');

        Route::group(['prefix' => 'image'], function () {
            Route::post('/store', [PropertyImagesController::class, 'store'])->name('surveyor.property.image.store');
            Route::get('/destroy/{id}', [PropertyImagesController::class, 'destroy'])->name('surveyor.property.image.destroy');
        });

        Route::get('csv/export', [PropertyController::class, 'exportCsv'])->name('properties.export.csv');
        Route::get('excel/export', [PropertyController::class, 'exportExcel'])->name('properties.export.excel');
        Route::get('pdf/export', [PropertyController::class, 'exportPdf'])->name('properties.export.pdf');
        Route::post('import', [PropertyController::class, 'import'])->name('import');
        
        Route::get('/add-gated-comunity', [SecondaryController::class, 'add_gated_comunity'])->name('add_gated_comunity');
        Route::post('/create-blocks', [SecondaryController::class, 'createBlocks'])->name('create-blocks');
        Route::get('/add-amenities-comunity/{id}', [AmenitiesController::class, 'add_amminities'])->name('add_amminities');
        Route::post('/add-amenities-comunity', [AmenitiesController::class, 'add_amminities_post'])->name('add_amminities_post');
        Route::get('/search-gis', [AmenitiesController::class, 'serach_by_gis'])->name('serach_by_gis');
        Route::post('/search-gis', [AmenitiesController::class, 'serach_by_gis_post'])->name('serach_by_gis_post');

        ////chaitanya routes 26-05-2023
        Route::post('/store-compliances', [CompliancesController::class, 'store_compliances'])->name('store-compliances');
        Route::post('/project-repository', [CompliancesController::class, 'project_repository'])->name('project-repository');
        Route::any('/block-tower-repository', [CompliancesController::class, 'block_tower_repository'])->name('block-tower-repository');
        //Route::any('/block-tower', [CompliancesController::class, 'block_tower_repository'])->name('block-tower');

        Route::get('/gated-community-details/{id}', [SecondaryDetailsController::class, 'gated_community_details'])->name('gated-community-details');
    });
    
    Route::group(['prefix' => 'builder',  'as' => 'builder.',], function () {
        Route::get('/', [BuilderController::class, 'index'])->name('index');
        Route::post('/store', [BuilderController::class, 'store'])->name('store');
    });

    Route::get('/amenities', [SecondaryDetailsController::class, 'amenities'])->name('amenities.index');
    Route::get('/compliances', [SecondaryDetailsController::class, 'compliances'])->name('compliances.index');
    Route::get('/repositories', [SecondaryDetailsController::class, 'repositories'])->name('repositories.index');
    Route::get('/floors', [SecondaryDetailsController::class, 'floors'])->name('floors.index');

    Route::get('/builder/create', [BuilderController::class, 'index'])->name('index');
    Route::post('/update-general-details', [SecondaryController::class, 'updateGeneralDetails'])->name('update-general-details');
    Route::get('/blocks', [SecondaryController::class, 'index'])->name('blocks.index');
    Route::get('/view-block', [SecondaryController::class, 'viewBlock'])->name('view-block');
    Route::get('/view-tower', [SecondaryController::class, 'viewTower'])->name('view-tower');
    
    Route::get('/towers', [SecondaryController::class, 'towers'])->name('towers.index');
    Route::post('/create-towers', [SecondaryController::class, 'createTowers'])->name('create-towers');
     
});

// secondary blocks
Route::get('/get_secondary_defined_block', [SecondaryController::class, 'get_secondary_defined_block'])->name('get_secondary_defined_block');
Route::get('/get_blocks', [SecondaryController::class, 'getBlocks'])->name('get_blocks');
Route::get('/get-towers', [SecondaryController::class, 'getTowers'])->name('get-towers');
Route::get('/get-block-towers', [SecondaryController::class, 'getBlockTowers'])->name('get-block-towers');

// secondary details -- Floors
Route::group(['prefix' => 'secondary_details',  'as' => 'secondary_details.',], function () {
    
    Route::get('/search/gis', [SecondaryDetailsController::class, 'search_gis'])->name('search.gis');

    Route::get('/get_floors', [SecondaryController::class, 'get_floors'])->name('get_floors');
    Route::get('/get_units', [SecondaryController::class, 'get_units'])->name('get_units');
    Route::get('/test', [SecondaryDetailsController::class, 'test'])->name('test');

    Route::any('/save_floor_merge', [SecondaryDetailsController::class, 'save_floor_merge'])->name('save_floor_merge');
    Route::any('/save_unit_merge', [SecondaryDetailsController::class, 'save_unit_merge'])->name('save_unit_merge');
    
});

Route::post('sd/save_floor_merge', [PropertyController::class, 'sd_save_floor_merge'])->name('sd.save_floor_merge');

Route::get('/get_defined_block', [PropertyController::class, 'get_defined_block'])->name('get_defined_block');
Route::get('/get_sd_defined_block', [PropertyController::class, 'get_sd_defined_block'])->name('get_sd_defined_block');
Route::get('/get_block_towers', [PropertyController::class, 'get_block_towers'])->name('get_block_towers');


Route::get('/get_floors', [PropertyController::class, 'get_floors'])->name('get_floors');
Route::get('/get_edit_floors', [PropertyController::class, 'editFloors'])->name('get_edit_floors');
Route::post('/save_floor_merge', [PropertyController::class, 'save_floor_merge'])->name('save_floor_merge');
Route::post('/save_unit_merge', [PropertyController::class, 'save_unit_merge'])->name('save_unit_merge');
Route::post('/store_brand', [PropertyController::class, 'store_brand'])->name('surveyor.brand.store');
Route::get('/remove_merge', [PropertyController::class, 'remove_merge'])->name('remove_merge');
Route::get('/remove_floor', [PropertyController::class, 'remove_floor'])->name('remove_floor');
Route::get('/check_gis_id', [PropertyController::class, 'check_gis_id'])->name('check_gis_id');
Route::get('/remove_unit', [PropertyController::class, 'remove_unit'])->name('remove_unit');
Route::get('/get_units', [PropertyController::class, 'get_units'])->name('get_units');
Route::get('/get_unit_categories', [PropertyController::class, 'get_unit_categories'])->name('get_unit_categories');
Route::get('/get_data_options', [PropertyController::class, 'get_data_options'])->name('get_data_options');


Route::get('/get_sd_floors', [PropertyController::class, 'get_sd_floors'])->name('get_sd_floors');
Route::get('/get_sd_units', [PropertyController::class, 'get_sd_units'])->name('get_sd_units');
Route::get('/get_edit_secondary_data_floors', [PropertyController::class, 'editSecondaryDataFloors'])->name('get_edit_secondary_data_floors');
Route::post('/save_sd_floors', [PropertyController::class, 'save_sd_floors'])->name('save_sd_floors');
Route::post('/save_sd_floor_merge', [PropertyController::class, 'save_sd_floor_merge'])->name('save_sd_floor_merge');
Route::post('/save_sd_unit_merge', [PropertyController::class, 'save_sd_unit_merge'])->name('save_sd_unit_merge');


Route::get('/css_loader', [PropertyController::class, 'css_loader'])->name('css_loader');


Route::get('/user_loc_details', [UserController::class, 'user_loc_details'])->name('user.ip_location_details');
Route::get('/add-role', [App\Http\Controllers\HomeController::class, 'addRole'])->name('user.ip_location_details');
Route::get('/create-role', [App\Http\Controllers\HomeController::class, 'createRole'])->name('user.ip_location_details');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
