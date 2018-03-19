<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($t) {
            $t->string('first_name');
            $t->string('last_name');
        });
    }


    public function down()
    {
        Schema::table('users', function($t) {
            $t->dropcolumn('first_name');
            $t->dropcolumn('last_name');
        });
    }
}
