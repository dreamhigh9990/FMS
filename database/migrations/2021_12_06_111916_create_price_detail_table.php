<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('price_id');
            $table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade');
            $table->string('row_no');
            $table->string('item_type_id');
            $table->string('from_address');
            $table->string('to_address');
            $table->string('discount_for_item');
            $table->string('reversal_pricing');
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
        Schema::dropIfExists('price_detail');
    }
}
