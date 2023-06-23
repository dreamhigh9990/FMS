<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobItemDgDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_item_dg_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->unsigned();
            $table->string('o_random_no');
            $table->string('o_dg_name');
            $table->string('o_dg_no');
            $table->string('o_dg_group');
            $table->string('o_dg_class');
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
        Schema::dropIfExists('job_item_dg_details');
    }
}
