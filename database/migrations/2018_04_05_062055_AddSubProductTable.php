<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_products', function($t) {
            $t->increments('id');
            $t->string('product_type');
            $t->integer('sav');
            $t->integer('livraison');
            $t->integer('livraison_montage');
            $t->integer('rétrocession');
            $t->integer('prestataire');
            $t->integer('montage');
            $t->integer('product_id')->unsigned();
            $t->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_product');
    }
}
