<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alterdeliverytablecolumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function($t) {
            $t->string('delivery_number');
            $t->string('delivery_problem');
            $t->string('client_satisfaction');
        });
    }


    public function down()
    {
        Schema::table('deliveries', function($t) {
            $t->dropColumn('delivery_number');
            $t->dropColumn('delivery_problem');
            $t->dropColumn('client_satisfaction');
        });
    }
}
