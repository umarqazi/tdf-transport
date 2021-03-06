<?php namespace LaravelAcl;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	 use Notifiable;

	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ["type","store_id","email", "password", "permissions", "activated", "number_plate", "vehicle_name","activation_code", "activated_at", "last_login", "protected", "banned","phone_number","mobile_number"];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function deliveryTour()
	{
			return $this->belongsTo('LaravelAcl\Delivery', 'tour_plan');
	}
	public function delivery()
	{
			return $this->hasOne('LaravelAcl\Delivery', 'tour_plan');
	}
	public function store()
    {
        return $this->belongsTo('LaravelAcl\Store');
    }
}
