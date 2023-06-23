<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPalletControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_pallet_controls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_id')->unsigned();
            $table->string('in_chep')->nullable();
            $table->string('out_chep')->nullable();
            $table->string('in_loscam')->nullable();
            $table->string('out_loscam')->nullable();
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
        Schema::dropIfExists('job_pallet_controls');
    }
}
