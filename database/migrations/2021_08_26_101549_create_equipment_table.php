<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('equipment_type', function (Blueprint $table) {
            $table->id("equipment_type_id")->autoIncrement();
            $table->string("equipment_type_value");
            $table->timestamps();
        });

        Schema::create('equipment_status', function (Blueprint $table) {
            $table->id("equipment_status_id")->autoIncrement();
            $table->string("equipment_status_value");
            $table->timestamps();
        });

        Schema::create('equipments', function (Blueprint $table) {
            $table->id("equipment_id")->autoIncrement();
            $table->string("equipment_name");
            $table->string("equipment_description");
            $table->string("equipment_img")->nullable();
            $table->timestamps();
            //foreign keys
            $table->foreignId('user_id')->constrained('users')->references('id');
            $table->foreignId('equipment_status_id')->constrained('equipment_status')->references("equipment_status_id");
            $table->foreignId('equipment_type_id')->constrained('equipment_type')->references("equipment_type_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}
