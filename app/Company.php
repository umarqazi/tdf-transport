<?php

namespace LaravelAcl;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function products()
    {
        return $this->hasMany('LaravelAcl\Product');
    }
}
