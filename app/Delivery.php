<?php

namespace LaravelAcl;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Delivery extends Model
{
    protected $dates = ['datetime', 'created_at'];

    public function getDatetimeAttribute($datetime)
    {
    	return Carbon::parse($datetime)->format("d-M");
    }
    public function products()
    {
        return $this->belongsToMany('LaravelAcl\Product', 'delivery_products');
    }
}
