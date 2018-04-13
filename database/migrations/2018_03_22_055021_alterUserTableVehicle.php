<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTableVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($t) {
            $t->string('number_plate');
            $t->string('vehicle_name');
        });
    }


    public function down()
    {
        Schema::table('users', function($t) {
            $t->dropcolumn('number_plate');
            $t->dropcolumn('vehicle_name');
        });
    }
}
