<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Deletecolumnsfromproducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('products', function($t) {
           $t->dropColumn('product_type');
           $t->dropColumn('delivery_charges');
           $t->dropColumn('comission');
         });
     }


     public function down()
     {
         Schema::table('products', function($t) {
           $t->string('product_type');
           $t->integer('delivery_charges');
           $t->integer('comission');
         });
     }
}
