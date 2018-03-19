<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDeliveryColumn2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('deliveries', function($t) {
            $t->integer('store_id')->unsigned()->nullable();
            $t->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('deliveries', function($t) {
            $t->dropcolumn('store_id');
        });
    }
}
