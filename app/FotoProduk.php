<?php

namespace App;

class FotoProduk extends BaseModel
{
    const FOTO_PATH = 'asset/produk/';

    protected $fillable = [
        'foto',
        'keterangan',
    ];

    protected $dependencies = [
        'produk'
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

        static::deleting(function ($model)
        {
            $model->deleteImages();
        });
    }

    protected function process()
    {
        $produk = Produk::find(request()->get('produk_id'));
        
        $this->produk_id = $produk->id;

        if (request()->hasFile('foto') && request()->file('foto')->isValid())
        {
            $this->deleteImages();

            $destinationPath = public_path(static::FOTO_PATH);
            $fileName = str_slug($produk->produk.' '.(count($produk->fotos) + 1).' '.date('YmdHis')) . '.' . request()->file('foto')->getClientOriginalExtension();
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

    protected function deleteImages()
    {
        if ($this->foto && $this->id && is_file($exist_file = public_path(static::FOTO_PATH).$this->getOriginal('foto'))) unlink($exist_file);
    }

    public function rules()
    {
        return [
            'foto' => 'image|max:5120'
        ];
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
