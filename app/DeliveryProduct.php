<?php

namespace LaravelAcl;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DeliveryProduct extends Model
{
    protected $table = 'delivery_products';

    public function deliverProduct()
	{
	    return $this->belongsTo('LaravelAcl\Delivery');
	}
	public function deliveryItems()
    {
        return $this->hasMany('LaravelAcl\Product');
    }
}
