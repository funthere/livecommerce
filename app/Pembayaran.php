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

    protected $dependencies  = ['pesanan', 'metode_pembayaran'];

    protected $dates = ['verified_at'];

    public function pesanan()
    {
    	return $this->belongsTo(Pesanan::class)->with('customer');
    }

    public function metode_pembayaran()
    {
    	return $this->belongsTo(MetodePembayaran::class);
    }
}
