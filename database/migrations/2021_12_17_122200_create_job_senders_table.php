<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_senders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_id');
            $table->string('sender_name');
            $table->string('sender_address_line_1')->nullable('true');
            $table->string('sender_address_line_2')->nullable('true');
            $table->string('suburb')->nullable('true');
            $table->string('postal_code')->nullable('true');
            $table->string('sender_state');
            $table->string('s_time')->nullable('true');
            $table->string('sender_contact');
            $table->string('s_phone')->nullable('true');
            $table->string('third_part_collection_charge')->nullable('true');
            $table->string('charge_collector_name')->nullable('true');
            $table->string('charge_collector_cost')->nullable('true');
            $table->string('ready_date')->nullable('true');
            $table->string('ready_time')->nullable('true');
            $table->string('pick_up_notes')->nullable('true');
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
        Schema::dropIfExists('job_senders');
    }
}
