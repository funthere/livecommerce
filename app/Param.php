<?php

namespace App;

use Cache;

class Param extends BaseModel
{
    protected $fillable = [
    	'key', 
    	'value', 
    ];

    public function rules()
    {
    	return [
    		'key' => 'required|unique:params,key'.(($this->id != null) ? ','.$this->id : ''),
    	];
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model)
        {
            $model->process();
        });

        static::deleted(function ($model)
        {
            $model->process();
        });
    }

    protected function process()
    {
    	Cache::forget('global_params');

    	$global_params = static::lists('value', 'key');

        Cache::forever('global_params', $global_params);
    }

}
