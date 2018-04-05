<?php

namespace LaravelAcl;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function companyProduct()
	{
	    return $this->belongsTo('LaravelAcl\Company');
	}
	public function deliveries()
	{
	    return $this->belongsToMany('LaravelAcl\Delivery', 'delivery_products');
	}
  public function subProducts()
	{
	    return $this->hasMany('LaravelAcl\SubProduct');
	}
}
