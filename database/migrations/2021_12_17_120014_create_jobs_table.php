<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('job_no');
            $table->string('connote_no');
            $table->string('m_reference')->nullable('true');
            $table->string('invoice_no')->nullable('true');
            $table->string('m_file')->nullable();
            $table->string('quote_no')->nullable();
            $table->string('job_type');
            $table->string('assigned_driver')->nullable();
            $table->string('job_status');
            $table->string('current_branch')->nullable();
            $table->string('m_connote_no')->nullable();
            $table->string('sender_branch')->nullable();
            $table->string('receiver_branch')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
