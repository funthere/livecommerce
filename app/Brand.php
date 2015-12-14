<?php

namespace App;

use App\BaseModel;

class Brand extends BaseModel
{
    protected $fillable = [
    	'brand', 
    	'slug', 
    ];

    public function rules()
    {
        if (!request()->has('slug')) request()->merge(['slug' => str_slug(request()->get('brand'))]);
    	return [
    		'brand' => 'required|unique:brands,brand'.(($this->id != null) ? ','.$this->id : ''),
    		'slug' => 'required|unique:brands,slug'.(($this->id != null) ? ','.$this->id : ''),
    	];
    }

    public function produks()
    {
    	return $this->hasMany(Produk::class);
    }
}
