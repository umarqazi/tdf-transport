<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alterdeliverytablefeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function($t) {
            $t->string('customer_feedback');
        });
    }


    public function down()
    {
        Schema::table('deliveries', function($t) {
            $t->dropcolumn('customer_feedback');
        });
    }
}
