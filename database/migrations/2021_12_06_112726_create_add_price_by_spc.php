<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddPriceBySpc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_price_by_spc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pricing_detail_id');
            $table->foreign('pricing_detail_id')->references('id')->on('price_detail')->onDelete('cascade');
            $table->string('row_no');
            $table->bigInteger('spc_cost');
            $table->bigInteger('spc_form');
            $table->bigInteger('spc_to');
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
        Schema::dropIfExists('add_price_by_spc');
    }
}
