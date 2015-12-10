<?php

namespace App;

use App\BaseModel;

class Customer extends BaseModel
{
    protected $fillable = [
    	'nama', 
    	'alamat', 
    	// 'kota_id', 
    	// 'propinsi_id', 
    	// 'kodepos', 

    ];

    protected $rules = [
    	'nama' => 'required|min:3',
    	'alamat' => 'required',
    ];
}
