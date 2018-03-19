<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($t) {
            $t->string('user_first_name');
            $t->string('user_last_name');
        });
    }


    public function down()
    {
        Schema::table('users', function($t) {
            $t->dropcolumn('user_first_name');
            $t->dropcolumn('user_last_name');
        });
    }
}
