<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function($table) {
            $table->string('company_id');
        });
    }
    public function down()
    {
        Schema::table('stores', function($table) {
            $table->dropcolumn('company_id');
        });
    }
}
