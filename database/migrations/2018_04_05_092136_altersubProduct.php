<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltersubProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_products', function($t) {
            $t->integer('sav')->nullable()->change();
            $t->integer('livraison')->nullable()->change();
            $t->integer('livraison_montage')->nullable()->change();
            $t->integer('rétrocession')->nullable()->change();
            $t->integer('prestataire')->nullable()->change();
            $t->integer('montage')->nullable()->change();
        });
    }


    public function down()
    {
        Schema::table('sub_products', function($t) {
            $t->integer('sav');
            $t->integer('livraison');
            $t->integer('livraison_montage');
            $t->integer('rétrocession');
            $t->integer('prestataire');
            $t->integer('montage');
        });
    }
}
