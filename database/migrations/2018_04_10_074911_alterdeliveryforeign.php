<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alterdeliveryforeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function($t) {
            $t->integer('sub_product_id')->unsigned()->nullable();
            $t->foreign('sub_product_id')->references('id')->on('sub_products')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::table('deliveries', function($t) {
            $t->dropForeign('deliveries_sub_product_id_foreign');
            $t->dropColumn('sub_product_id');
        });
    }
}
