<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('user_status', function (Blueprint $table) {
            $table->id("user_status_id")->autoIncrement();
            $table->string("user_status_value");
            $table->timestamps();
        });

        Schema::create('user_type', function (Blueprint $table) {
            $table->id("user_type_id")->autoIncrement();
            $table->string("user_type_value");
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string("mobile_number")->unique();
            $table->rememberToken();
            $table->timestamps();
            //foreign keys
            $table->foreignId('user_type_id')->constrained('user_type')->references('user_type_id');
            $table->foreignId('user_status_id')->constrained('user_status')->references("user_status_id");
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
