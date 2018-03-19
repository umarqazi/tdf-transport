<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDeliveryColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function($t) {
            $t->renameColumn('name', 'first_name');
            $t->string('last_name');
            $t->integer('status');
        });
    }


    public function down()
    {
        Schema::table('deliveries', function($t) {
            $t->renameColumn('first_name', 'name');
            $t->dropcolumn('last_name');
            $t->dropcolumn('status');
        });
    }
}
