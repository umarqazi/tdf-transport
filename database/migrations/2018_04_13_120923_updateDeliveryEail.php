<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDeliveryEail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('deliveries', function($t) {
           $t->string('customer_email');
         });
     }
     public function down()
     {
         Schema::table('deliveries', function($t) {
          $t->dropColumn('customer_email');
         });
     }
}
