<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->string('p_address_line_1');
            $table->string('p_address_line_2')->nullable();
            $table->string('p_suburb')->nullable();
            $table->string('p_postal_code')->nullable();
            $table->string('p_state')->nullable();
            $table->string('p_opening_time')->nullable();
            $table->string('receiver_address_line_1')->nullable();
            $table->string('receiver_address_line_2')->nullable();
            $table->string('r_suburb')->nullable();
            $table->string('r_postal_code')->nullable();
            $table->string('receiver_state')->nullable();
            $table->string('r_opening_time')->nullable();
            $table->string('b_address_line_1')->nullable();
            $table->string('b_address_line_2')->nullable();
            $table->string('b_suburb')->nullable();
            $table->string('b_postal_code')->nullable();
            $table->string('b_state')->nullable();
            $table->string('b_opening_time')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_address');
    }
}
