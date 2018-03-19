<?php
use LaravelAcl\Store;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
/**
 * Dashboard information
 */
View::composer(['client.layout*'], function($view){
	if(App::make('sentry')->getUser())
	{
		$storeId=App::make('sentry')->getUser()->store_id;
	    $getStoreInfo=Store::find($storeId);
	    $view->with(['store_info' => $getStoreInfo]);
	}
});
View::composer(['client.cashier*'], function($view){
	$nextDate=new Carbon;
	$nextDate=$nextDate->addDay(1);
	$view->with(['nextDate' => $nextDate]);
});
View::composer(['client*'], function($view){
	$getUser=App::make('sentry')->getUser();
	$view->with(['authUser'=> $getUser]);
});