<?php

namespace App;

use App\BaseModel;

class Pesanan extends BaseModel
{
    protected $fillable = [
		'customer_id',
    	'penerima',
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
}
