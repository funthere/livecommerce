<?php

namespace App;

use App\BaseModel;

class Brand extends BaseModel
{
    protected $fillable = [
    	'brand', 
    ];

    public function rules()
    {
    	return [
    		'brand' => 'required|unique:brands,brand'.(($this->id != null) ? ','.$this->id : ''),
    	];
    }

    public function produks()
    {
    	return $this->hasMany(Produk::class);
    }
}
