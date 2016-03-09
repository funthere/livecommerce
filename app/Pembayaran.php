<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends BaseModel
{
    const FOTO_PATH = 'asset/bukti_pembayaran/';
  
    protected $fillable = [
		'pesanan_id',
		'metode_pembayaran_id',
		'jumlah',
		'bukti',
		'verified_at',
    ];

    protected $dependencies  = ['pesanan', 'metode_pembayaran'];

    protected $dates = ['verified_at'];

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

        static::deleted(function ($model)
        {
            $model->deleteImages();
        });
    }

    protected function process()
    {
        if (request()->has('pesanan')) $this->attributes['pesanan_id'] = request()->get('pesanan');
        if (request()->has('metode_pembayaran')) $this->attributes['metode_pembayaran_id'] = request()->get('metode_pembayaran');
        unset($this->attributes['pesanan']);
        unset($this->attributes['metode_pembayaran']);

        if (request()->hasFile('bukti') && request()->file('bukti')->isValid())
        {
            $destinationPath = public_path(static::FOTO_PATH);
            $fileName = str_slug($this->produk.' '.date('YmdHis')) . '.' . request()->file('bukti')->getClientOriginalExtension();
            $result = request()->file('bukti')->move($destinationPath, $fileName);
            if ($result) {
                $this->bukti = $fileName;
            }
        }   
        else 
        {
            if ($this->bukti) $this->bukti = $this->bukti;
        }
    }

    protected function deleteImages()
    {
        if ($this->bukti && $this->id && is_file($exist_file = public_path(static::FOTO_PATH).$this->getOriginal('bukti'))) unlink($exist_file);
    }

    public function getJumlahRupiahAttribute()
    {
        return number_format($this->jumlah , 0, ',' , '.');
    }

    public function pesanan()
    {
    	return $this->belongsTo(Pesanan::class)->with('customer');
    }

    public function metode_pembayaran()
    {
    	return $this->belongsTo(MetodePembayaran::class);
    }
}
