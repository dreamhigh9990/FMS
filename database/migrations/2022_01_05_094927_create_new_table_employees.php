<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('new_password');
            $table->string('mobile')->nullable();
            $table->string('employee_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('new_pin')->nullable();
            $table->string('can_login')->nullable();
            $table->string('can_use_app')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
