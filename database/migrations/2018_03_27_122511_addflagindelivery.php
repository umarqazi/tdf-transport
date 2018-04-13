<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addflagindelivery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function($t) {
            $t->integer('flag');
        });
    }


    public function down()
    {
        Schema::table('deliveries', function($t) {
            $t->dropcolumn('flag');
        });
    }
}
