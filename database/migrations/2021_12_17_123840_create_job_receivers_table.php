<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_receivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_id')->unsigned();
            $table->string('receiver_name');
            $table->string('receiver_address_line_1');
            $table->string('receiver_address_line_2')->nullable();
            $table->string('r_suburb')->nullable();
            $table->string('r_postal_code')->nullable();
            $table->string('receiver_state')->nullable();
            $table->string('r_time')->nullable();
            $table->string('receiver_contact')->nullable();
            $table->string('r_phone')->nullable();
            $table->string('onforworder');
            $table->string('r_collect_at_branch')->nullable();
            $table->string('forworder_option')->nullable();
            $table->string('r_reference')->nullable();
            $table->string('r_Pick_up_notes')->nullable();
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
        Schema::dropIfExists('job_receivers');
    }
}
