<?php

namespace App;

use App\BaseModel;
use App\Brand;
use App\Kategori;

class Produk extends BaseModel
{
    const FOTO_PATH = 'asset/produk/';

    protected $fillable = [
            'produk',
            'kategori_id',
            'kategori',
            'harga',
            'harga_diskon',
            'deskripsi',
            'netto',
            'foto',
            'brand_id',
            'brand',
            'stock',
    ];

    protected $dependencies = [
        'kategori', 'brand'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            $model->process();
        });

        static::updating(function ($model)
        {
            $model->process();
        });
    }

    protected function process()
    {
        if ($this->attributes['kategori']) $this->attributes['kategori_id'] = $this->attributes['kategori'];
        if ($this->attributes['brand']) $this->attributes['brand_id'] = $this->attributes['brand'];
        unset($this->attributes['kategori']);
        unset($this->attributes['brand']);

        if (request()->hasFile('foto'))
        {
            if ($this->foto && $this->id && file_exists($exist_file = public_path(static::FOTO_PATH).$this->find($this->id)->foto)) unlink($exist_file);

            $destinationPath = public_path(static::FOTO_PATH);
            $fileName = str_slug($this->attributes['produk'].' '.date('YmdHis')). request()->file('foto')->getClientOriginalExtension();
            $result = request()->file('foto')->move($destinationPath, $fileName);
            if ($result) {
                $this->attributes['foto'] = $fileName;
            }
        }   
        else 
        {
            if ($this->foto) $this->attributes['foto'] = $this->foto;
        }
    }

    public function getFillable()
    {
        $theKeys = array_flip($this->fillable);
        return array_except($this->fillable, [$theKeys['kategori'], $theKeys['brand']]);
    }

    public function getTitleOfFields($fields = [])
    {
        $theKeys = array_flip($this->fillable);
        $titles = array_except($this->fillable, [$theKeys['kategori_id'], $theKeys['brand_id']]);
        return parent::getTitleOfFields($titles);
    }

    public function rules()
    {
    	return [
    		'brand' => 'required|unique:brands,brand'.(($this->id != null) ? ','.$this->id : ''),
    	];
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

}