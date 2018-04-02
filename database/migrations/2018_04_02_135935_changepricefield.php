<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Changepricefield extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('deliveries', function($t) {
           $t->integer('delivery_price')->change();
         });
     }


     public function down()
     {
         Schema::table('deliveries', function($t) {
             $t->dropColumn('delivery_price');
         });
     }
}
