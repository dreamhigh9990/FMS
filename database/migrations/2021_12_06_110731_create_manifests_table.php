<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('driver', 120);
            $table->unsignedInteger('manifest_no');
            $table->string('dispatch_branch', 120);
            $table->string('receiving_branch', 120);
            $table->string('type', 120);
            $table->date('arrival_date');
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
        Schema::dropIfExists('manifests');
    }
}
