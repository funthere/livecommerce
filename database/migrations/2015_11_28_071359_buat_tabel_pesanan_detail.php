<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelPesananDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pesanan_id')->unsigned();
            $table->integer('produk_id')->unsigned();
            $table->integer('harga');
            $table->integer('quantity');
            $table->integer('diskon');
            $table->integer('jumlah');
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
        Schema::drop('pesanan_details');
    }
}
