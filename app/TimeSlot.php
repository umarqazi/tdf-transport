<?php

namespace LaravelAcl;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
  protected $table='time_slot';
  public $timestamps=false;

  public function deliveries()
	{
			return $this->belongsTo('LaravelAcl\Delivery', 'tour_plan');
	}
}
