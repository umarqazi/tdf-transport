<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTimeSlotField2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('tour_plan', function($t) {
             $t->renameColumn('driver_id', 'user_id');
         });
     }


     public function down()
     {
         Schema::table('tour_plan', function($t) {
             $t->renameColumn('driver_id', 'user_id');
         });
     }
}
