<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_id')->unsigned();
            $table->string('random_no');
            $table->string('item_reference')->nullable();
            $table->string('item_qty');
            $table->string('item_type');
            $table->string('item_description')->nullable();
            $table->string('item_length');
            $table->string('item_width');
            $table->string('item_height');
            $table->string('item_weight');
            $table->string('item_tweight')->nullable();
            $table->string('item_stackable')->nullable();
            $table->string('item_plt_spc')->nullable();
            $table->string('item_cubic_m3')->nullable();
            $table->string('item_cost')->nullable();
            $table->string('item_comments')->nullable();
            $table->string('item_detail')->nullable();
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
        Schema::dropIfExists('job_items');
    }
}
