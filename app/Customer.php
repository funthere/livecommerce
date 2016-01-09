<?php

namespace App;

use App\BaseModel;

class Customer extends BaseModel
{
    protected $fillable = [
    	'nama', 
        'email',
        'no_hp',
    	'alamat', 
    	'kota_id', 
    	'propinsi_id', 
    	'kodepos', 

    ];

    protected $rules = [
    	'nama' => 'required|min:3',
    	'alamat' => 'required',
    ];

    public function pesanan()
    {
        return $this->hasOne(Customer::class);
    }
    
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }
    
    public function propinsi()
    {
        return $this->belongsTo(Propinsi::class);
    }
}
