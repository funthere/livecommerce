<?php

namespace App;

use App\BaseModel;
use App\Produk;

class Kategori extends BaseModel
{
    protected $fillable = [
    	'kategori', 
    ];

    public function rules()
    {
    	return [
    		'kategori' => 'required|unique:kategoris,kategori'.(($this->id != null) ? ','.$this->id : ''),
    	];
    }

    public function produks()
    {
    	return $this->hasMany(Produk::class);
    }
}
