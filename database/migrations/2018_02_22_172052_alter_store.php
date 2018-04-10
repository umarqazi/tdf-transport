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
          $table->integer('company_id')->unsigned();
          $table->foreign('company_id')->references('id')->on('companies');
        });
    }
    public function down()
    {
        Schema::table('stores', function($table) {
            $table->dropcolumn('company_id');
        });
    }
}
