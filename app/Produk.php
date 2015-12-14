<?php

namespace App;

use Carbon\Carbon;
use App\BaseModel;
use App\Brand;
use App\Kategori;

class Produk extends BaseModel
{
    const FOTO_PATH = 'asset/produk/';

    protected $fillable = [
            'produk',
            'slug',
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

        static::saving(function ($model)
        {
            $model->process();
        });
    }

    protected function process()
    {
        if (request()->has('kategori')) $this->attributes['kategori_id'] = request()->get('kategori');
        if (request()->has('brand')) $this->attributes['brand_id'] = request()->get('brand');
        unset($this->attributes['kategori']);
        unset($this->attributes['brand']);

        if (request()->hasFile('foto') && request()->file('foto')->isValid())
        {
            if ($this->foto && $this->id && is_file($exist_file = public_path(static::FOTO_PATH).$this->find($this->id)->foto)) unlink($exist_file);

            $destinationPath = public_path(static::FOTO_PATH);
            $fileName = str_slug($this->produk.' '.date('YmdHis')) . '.' . request()->file('foto')->getClientOriginalExtension();
            $result = request()->file('foto')->move($destinationPath, $fileName);
            if ($result) {
                $this->foto = $fileName;
            }
        }   
        else 
        {
            if ($this->foto) $this->foto = $this->foto;
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

    public function getHargaRupiahAttribute()
    {
        return number_format($this->harga , 0, ',' , '.');
    }

    public function getHargaDiskonRupiahAttribute()
    {
        return number_format($this->harga_diskon , 0, ',' , '.');
    }

    public function getIsSaleAttribute()
    {
        return $this->harga_diskon > 0 && $this->harga_diskon < $this->harga;
    }

    public function getIsNewAttribute()
    {
        return $this->created_at->diffInDays(Carbon::now()) < (isset($this->global_params['lama_hari_produk_baru']) ? $this->global_params['lama_hari_produk_baru'] : 7);
    }

    public function rules()
    {
        if (!request()->has('slug')) request()->merge(['slug' => str_slug(request()->get('produk'))]);

    	return [
    		'slug' => 'required|unique:produks,slug'.(($this->id != null) ? ','.$this->id : ''),
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

    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class, 'pesanan_details')->withPivot('pesanan_id', 'produk_id', 'quantity')->withTimestamps();
    }

}