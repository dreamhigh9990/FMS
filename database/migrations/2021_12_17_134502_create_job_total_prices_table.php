<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTotalPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_total_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_id')->unsigned();
            $table->string('job_total_price')->nullable();
            $table->string('job_handling_fee')->nullable();
            $table->string('job_unload_fee')->nullable();
            $table->string('job_pick_up_fee')->nullable();
            $table->string('job_delivery_fee')->nullable();
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
        Schema::dropIfExists('job_total_prices');
    }
}
