<?php

namespace LaravelAcl;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    public function store()
    {
        return $this->belongsToMany('LaravelAcl\Company', 'LaravelAcl\Delivery');
    }

    public function user()
    {
        return $this->hasMany('LaravelAcl\User');
    }

    public function company()
    {
        return $this->belongsTo('LaravelAcl\Company');
    }

    public function deliveries()
    {
        return $this->hasMany('LaravelAcl\Delivery');
    }
}
