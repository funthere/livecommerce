<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends BaseModel
{
    const LOGO_PATH = 'asset/metode_pembayaran/';
    
    protected $fillable = [
        'tipe',
        'nama_bank',
        'no_rekening',
        'nama_rekening',
        'logo',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->process();
        });

        static::saving(function ($model) {
            $model->process();
        });
    }

    protected function process()
    {
        if (request()->hasFile('logo') && request()->file('logo')->isValid()) {
            
            if ($this->logo && $this->id && is_file($existFile = public_path(static::LOGO_PATH).$this->find($this->id)->logo)) {
                unlink($existFile);
            }

            $destinationPath = public_path(static::LOGO_PATH);
            
            $fileName = str_slug($this->nama_bank.' '.date('YmdHis')) . '.' . request()->file('logo')->getClientOriginalExtension();
            
            $result = request()->file('logo')->move($destinationPath, $fileName);
            
            if ($result) {
                $this->logo = $fileName;
            }
        } else {
            
            if ($this->logo) {
                $this->logo = $this->logo;
            }
        }
    }
}
