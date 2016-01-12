<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends BaseModel
{
    protected $fillable = [
    	'tipe', 
        'nama_bank',
        'no_rekening',
    	'nama_rekening', 
    ];
}
