<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_produks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto');
            $table->text('keterangan');
            $table->integer('produk_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('foto_produks');
    }
}
