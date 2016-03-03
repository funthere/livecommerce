<?php

namespace App;
    
class Pesan extends BaseModel
{
    protected $fillable = ['nama', 'email', 'topik', 'pesan'];

    public $rules = [
        'nama' => 'required',
        'email' => 'required|email',
        'topik' => 'required',
        'pesan' => 'required',
    ];
}
