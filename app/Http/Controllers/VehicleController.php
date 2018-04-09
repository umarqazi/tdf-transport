<?php

namespace LaravelAcl\Http\Controllers;

use LaravelAcl\Delivery;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use LaravelAcl\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use view;
use Toast;
use Config;
use Jenssegers\Date\Date;
class VehicleController extends Controller
{
  public function __construct()
  {
    Date::setLocale('fr');
  }
    public function toursList(){
      if(Auth::user()){
        $user_id=Auth::user()->id;
        $nextDay=Carbon::now()->format('Y-m-d');
        $date=Date::now()->format('D d M Y');
        $tours=HomeController::manageTours($user_id, $nextDay, 'driver');
        return view::make('client.driver.index')->with(['tours'=>$tours, 'date'=>$date]);
      }
    }
    public function deliveryDetail(Request $request){
      $id=$request->id;
      $getDetail=Delivery::leftJoin('products', 'deliveries.product_id', '=', 'products.id')->leftJoin('stores', 'deliveries.store_id', '=', 'stores.id')->select('deliveries.*', 'products.product_type', 'products.product_family', 'stores.store_name')->find($id);
      $date=Carbon::now()->format('D d M Y');
      return view::make('client.driver.delivery_detail')->with(['date'=>$date, 'detail'=>$getDetail]);
    }
    public function updateDeliveryStatus(Request $request){
      $satisfy=$request->satisfy;
      $delivery_status=$request->delivery_status;
      $id=$request->id;
      if($delivery_status=='4'){
        $updateDelivery=Delivery::where('id', $id)->update(['delivery_problem'=>$delivery_status,'status'=>Config::get('constants.Status.Delivered')]);
      }
      else{
        $updateDelivery=Delivery::where('id', $id)->update(['delivery_problem'=>$delivery_status]);
      }
      Toast::success('Le statut de livraison a été mis à jour');
      return redirect::back();
    }

}
