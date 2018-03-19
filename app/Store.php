<?php

namespace LaravelAcl;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
	
    public function store()
	{
	    return $this->belongsToMany('LaravelAcl\Company', 'LaravelAcl\Delivery');
	}
}
