<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $fillable = ['id', 'kecamatan', 'kabupaten_id'];

    public function kabupaten()
    {
    	return $this->belongsTo(Kabupaten::class);
    }
}
