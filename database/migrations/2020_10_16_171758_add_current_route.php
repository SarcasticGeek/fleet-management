<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentRoute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buses', function (Blueprint $table) {
            $table->unsignedBigInteger('current_route_id')->nullable();
            $table->foreign('current_route_id')->references('id')->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buses', function (Blueprint $table) {
            //
        });
    }
}
