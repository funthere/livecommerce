<?php

namespace App;

use Cache;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $fillable = [];

    protected $rules = [];

    protected $dependencies = [];

    protected $rupiahs = [];

    public $global_params;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->global_params = Cache::get('global_params');
    }

    public function getTitleOfFields($fields = [])
    {
    	if ($fields == []) $fields = $this->fillable;
    	
        $newFields = [];

        foreach ($fields as $field) {
            $newFields[$field] = ucwords(implode(' ', explode('_', preg_replace('/_id$/', '', $field))));
        }

        return $newFields;
    }

    public function toArray()
    {
        $array = array_merge(parent::toArray(), $this->getRupiahArray());

        return $array;
    }

    public function getAttribute($key)
    {
        $get = parent::getAttribute($key);
        
        if ($get != null) return $get;

        $array = $this->getRupiahArray();

        if (array_key_exists($key, $array)) return $array[$key];

        return null;
    }

    public function getRupiahArray()
    {
        $array = [];

        foreach ($this->rupiahs as $attribute) 
        {
            $attributeRupiah = $attribute.'_rupiah';

            $array[$attributeRupiah] = 'Rp. '.number_format($this->attributes[$attribute] , 0, ',' , '.');
        }

        return $array;
    }


    public function rules()
    {
    	return $this->rules;
    }

    public function dependencies()
    {
        return $this->dependencies;
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
}
