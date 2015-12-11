<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $fillable = [];

    protected $rules = [];

    protected $dependencies = [];

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
}
