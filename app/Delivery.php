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
    public function subProduct()
    {
        return $this->belongsToMany('LaravelAcl\SubProduct');
    }
    public function time()
    {
        return $this->belongsToMany('LaravelAcl\TimeSlot', 'tour_plan');
    }
    public function user()
  	{
        return $this->belongsTo('LaravelAcl\User', 'tour_plan');
  	}
  	public function product()
    {
        return $this->belongsTo('LaravelAcl\Product', 'product_id');
    }
    public function store()
    {
        return $this->belongsTo('LaravelAcl\Store');
    }

}
