<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('tour_plan', function($t) {
             $t->increments('id');
             $t->integer('time_id')->unsigned();
             $t->foreign('time_id')->references('id')->on('time_slot')->onDelete('cascade');
             $t->integer('delivery_id')->unsigned();
             $t->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('cascade');
             $t->integer('driver_id')->unsigned();
             $t->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');
             $t->integer('status')->unsigned();
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::dropIfExists('tour_plan');
     }
}
