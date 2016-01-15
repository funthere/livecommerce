<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends BaseModel
{
    protected $fillable = [
		'pesanan_id',
		'metode_pembayaran_id',
		'jumlah',
		'bukti',
		'verified_at',
    ];

    protected $dates = ['verified_at'];

    public function pesanan()
    {
    	return $this->hasOne(Pesanan::class);
    }

    public function metode_pembayaran()
    {
    	return $this->hasOne(MetodePembayaran::class);
    }
}
