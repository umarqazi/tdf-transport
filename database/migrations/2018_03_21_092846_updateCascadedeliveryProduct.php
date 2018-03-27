<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCascadedeliveryProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_products', function($t) {
            $t->dropForeign('delivery_products_deliver_id_foreign');
            $t->foreign('delivery_id')
            ->references('id')->on('deliveries')
            ->onDelete('cascade')
            ->change();
            $t->dropForeign('delivery_products_product_id_foreign');
            $t->foreign('product_id')
            ->references('id')->on('products')
            ->onDelete('cascade')
            ->change();
        });
    }


    public function down()
    {
        Schema::table('delivery_products', function($t) {
            $t->dropcolumn('delivery_id');
        });
    }
}
