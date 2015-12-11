<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelPesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->string('penerima');
            $table->string('email');
            $table->text('alamat');
            $table->integer('kota_id')->unsigned();
            $table->integer('propinsi_id')->unsigned();
            $table->string('kodepos', 5);
            $table->integer('jumlah');
            $table->integer('diskon');
            $table->integer('ongkir');
            $table->integer('total');
            $table->string('kode_pesanan', 6)->nullable();
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
        Schema::drop('pesanans');
    }
}
