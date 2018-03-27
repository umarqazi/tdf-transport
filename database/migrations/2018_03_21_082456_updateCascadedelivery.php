<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCascadedelivery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function($t) {
            $t->dropForeign('deliveries_user_id_foreign');
            $t->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->change();
        });
    }


    public function down()
    {
        Schema::table('deliveries', function($t) {
            $t->dropcolumn('user_id');
        });
    }
}
