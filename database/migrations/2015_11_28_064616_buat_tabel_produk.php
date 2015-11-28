<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('produk');
            $table->integer('kategori_id')->unsigned();
            $table->integer('harga')->unsigned();
            $table->integer('harga_diskon')->unsigned();
            $table->text('deskripsi');
            $table->integer('netto');
            $table->string('foto');
            $table->integer('brand_id')->unsigned();
            $table->integer('stock')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produks');
    }
}
