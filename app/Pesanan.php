<?php

namespace App;

use App\BaseModel;

class Pesanan extends BaseModel
{
    protected $fillable = [
		'customer_id',
    	'penerima',
        'email',
    	'alamat',
    	'kota_id',
    	'propinsi_id',
    	'kodepos',
    	'jumlah',
    	'diskon',
    	'ongkir',
    	'total',
    	'kode_pesanan',
    ];

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'pesanan_details')->withPivot('pesanan_id', 'produk_id', 'quantity')->withTimestamps();
    }
}
