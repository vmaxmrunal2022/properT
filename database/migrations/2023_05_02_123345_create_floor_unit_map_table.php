<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorUnitMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floor_unit_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->unsignedBigInteger('floor_id')->nullable();
            $table->string('unit_name')->nullable();
            $table->unsignedBigInteger('property_cat_id')->nullable();
            $table->unsignedBigInteger('unit_type')->nullable();
            $table->unsignedBigInteger('floor_unit_cat_id')->nullable();
            $table->unsignedBigInteger('floor_unit_sub_cat_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('person_name')->nullable();
            $table->string('mobile')->nullable();
            $table->unsignedBigInteger('merge_parent_unit_id')->nullable();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('floor_id')->references('id')->on('property_floor_map')->onDelete('cascade');
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
        Schema::dropIfExists('floor_unit_map');
    }
}
