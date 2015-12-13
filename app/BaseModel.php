<?php

namespace App;

use Cache;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $fillable = [];

    protected $rules = [];

    protected $dependencies = [];

    public $global_params;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->global_params = Cache::get('global_params');
    }

    public function getFillable()
    {
    	return $this->fillable;
    }

    public function getTitleOfFields($fields = [])
    {
    	if ($fields == []) $fields = $this->fillable;
    	
    	return array_map(function($x) {
    		return ucwords(implode(' ', explode('_', $x)));
    	}, $fields);
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
