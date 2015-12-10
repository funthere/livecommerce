<?php

namespace App;

use App\BaseModel;

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
}
