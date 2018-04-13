<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStoreEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_employees', function($table) {
            $table->dropColumn('password');
            $table->dropColumn('account_status');
        });
    }

    public function down()
    {
        Schema::table('store_employees', function($table) {
            $table->string('password');
            $table->string('account_status');
        });
    }
}
