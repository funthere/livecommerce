<?php

namespace App;

use App\BaseModel;

class Produk extends BaseModel
{
    protected $fillable = [
			'produk',
            'kategori_id',
            'harga',
            'harga_diskon',
            'deskripsi',
            'netto',
            'foto',
            'brand_id',
      	   	'stock',
    ];

    public function rules()
    {
    	return [
    		'brand' => 'required|unique:brands,brand'.(($this->id != null) ? ','.$this->id : ''),
    	];
    }

}