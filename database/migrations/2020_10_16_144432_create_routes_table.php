<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->integer('level')->default(0);
            $table->integer('capacity')->default(0);
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('station_id');
            $table->foreign('bus_id')->references('id')->on('buses');
            $table->foreign('station_id')->references('id')->on('stations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
