<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddPriceByWeight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_price_by_weight', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pricing_detail_id');
            $table->foreign('pricing_detail_id')->references('id')->on('price_detail')->onDelete('cascade');
            $table->string('row_no');
            $table->bigInteger('w_from');
            $table->bigInteger('w_to');
            $table->bigInteger('w_cost');
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
        Schema::dropIfExists('add_price_by_weight');
    }
}
