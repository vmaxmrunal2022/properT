<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyFloorMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_floor_map', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->unsignedBigInteger('floor_no')->nullable();
            $table->unsignedBigInteger('property_cat_id')->nullable();
            $table->unsignedBigInteger('units')->nullable()->default(0);
            $table->unsignedBigInteger('unit_type')->nullable();
            $table->unsignedBigInteger('floor_unit_cat_id')->nullable();
            $table->unsignedBigInteger('floor_unit_sub_cat_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('person_name')->nullable()->nullable();
            $table->string('mobile')->nullable()->nullable();
            $table->unsignedBigInteger('merge_parent_floor_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('property_floor_map');
    }
}
