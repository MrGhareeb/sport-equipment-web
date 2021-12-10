<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            //insert
        });

        DB::table('equipment_type')->insert(
            array(
                ["equipment_type_value" => "Handheld"],
                ["equipment_type_value" => "Ball"],
                ["equipment_type_value" => "Helmet"],
                ["equipment_type_value" => "Snowboard"],
                ["equipment_type_value" => "Footwear"],
                ["equipment_type_value" => "Protective equipment"],
                ["equipment_type_value" => "Training equipment"],
                ["equipment_type_value" => "Special sports equipment"],
                ["equipment_type_value" => "Other"],
            )
        );

        Schema::create('equipment_status', function (Blueprint $table) {
            $table->id("equipment_status_id")->autoIncrement();
            $table->string("equipment_status_value");
            $table->timestamps();
            // insert
        });
        DB::table('equipment_status')->insert(
            array(
                ["equipment_status_value" => "Available"],
                ["equipment_status_value" => "Lost"],
                ["equipment_status_value" => "Broken"],
                ["equipment_status_value" => "Stolen"],
                ["equipment_status_value" => "Deleted"],
                ["equipment_status_value" => "For transfer"],
                
            )
        );

        Schema::create('equipments', function (Blueprint $table) {
            $table->id("equipment_id")->autoIncrement();
            $table->string("equipment_name");
            $table->string("equipment_description");
            $table->timestamps();
            //foreign keys
            $table->foreignId('user_id')->constrained('users')->references('id');
            $table->foreignId('equipment_status_id')->constrained('equipment_status')->references("equipment_status_id");
            $table->foreignId('equipment_type_id')->constrained('equipment_type')->references("equipment_type_id");
        });

        Schema::create("equipment_images", function (Blueprint $table) {
            $table->id("equipment_image_id")->autoIncrement();
            $table->string("equipment_image_path");
            $table->timestamps();
            $table->foreignId("equipment_id")->constrained("equipments")->references("equipment_id");
        });

        Schema::create("equipment_transfer", function (Blueprint $table) {
            $table->id("equipment_transfer_id");
            $table->string('equipment_transfer_token');
            $table->timestamps();
            $table->foreignId("equipment_id")->constrained("equipments")->references("equipment_id");
            $table->foreignId("user_id")->constrained("users")->references("id");
            $table->foreignId("new_user_id")->nullable()->constrained("users")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_type');
        Schema::dropIfExists('equipment_status');
        Schema::dropIfExists('equipment_images');
        Schema::dropIfExists('equipment');
        Schema::dropIfExists('equipment_transfer');
    }
}
