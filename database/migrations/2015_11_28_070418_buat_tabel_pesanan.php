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
            $table->integer('customer_id')->unsigned()->nullable();
            $table->string('penerima');
            $table->string('email');
            $table->text('alamat');
            $table->integer('propinsi_id')->unsigned()->nullable();
            $table->integer('kota_id')->unsigned()->nullable();
            $table->integer('kecamatan_id')->unsigned()->nullable();
            $table->string('kodepos', 5);
            $table->integer('jumlah');
            $table->integer('diskon');
            $table->integer('ongkir');
            $table->integer('total');
            $table->string('kode_pesanan', 6)->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('propinsi_id')->references('id')->on('propinsis')->onDelete('set null');
            $table->foreign('kota_id')->references('id')->on('kotas')->onDelete('set null');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('set null');
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
