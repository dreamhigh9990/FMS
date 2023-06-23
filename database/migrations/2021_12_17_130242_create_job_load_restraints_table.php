<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobLoadRestraintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_load_restraints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_id')->unsigned();
            $table->string('bolsters');
            $table->string('chains');
            $table->string('dogs');
            $table->string('gates');
            $table->string('rt');
            $table->string('straps');
            $table->string('timber');
            $table->string('trap');
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
        Schema::dropIfExists('job_load_restraints');
    }
}
