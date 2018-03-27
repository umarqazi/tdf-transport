<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alterdeliverytable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('deliveries', function($t) {
             $t->string('order_pdf');
             $t->renameColumn('pdf', 'delivery_pdf');
         });
     }


     public function down()
     {
         Schema::table('deliveries', function($t) {
             $t->dropcolumn('order_pdf');
         });
     }
}
