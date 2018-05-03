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
use Mail;
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
            $date=Date::now()->format('l d F Y');
            $tours=HomeController::manageTours($user_id, $nextDay, 'driver');
            return view::make('client.driver.index')->with(['tours'=>$tours, 'date'=>$date]);
        }
    }
    public function deliveryDetail(Request $request){
        $id=$request->id;
        $getDetail=HomeController::deliveryProducts()->find($id);
        $date=Date::now()->format('l d F Y');
        $time=$request->time;
        return view::make('client.driver.delivery_detail')->with(['time'=>$time,'date'=>$date, 'detail'=>$getDetail]);
    }
    public function updateDeliveryStatus(Request $request){
        $updateDelivery=Delivery::find($request->id);
        $email=$updateDelivery->customer_email;
        if($request->satisfy==1){
            $satisfy=1;
        }else{
            $satisfy=3;
        }
        $delivery_status=$request->delivery_status;
        $id=$request->id;
        if($delivery_status=='4'){
            $mail=Mail::send('client.email.client_feedback', ['data'=>$updateDelivery], function($message) use ($email)
            {
                $message->to($email, 'TDF Transport')->subject('Commentaires de livraison');
            });
            $updateDelivery->status=Config::get('constants.Status.Delivered');
        }
        else{
            $updateDelivery->status=Config::get('constants.Status.Return');
        }
        $updateDelivery->driver_feedback=$satisfy;
        $updateDelivery->delivery_problem=$delivery_status;
        $updateDelivery->save();
        Toast::success('Le statut de livraison a été mis à jour');
        return redirect::to('/driverTours');
    }
    public function pClientFeedback(Request $request){
        if($request->id){
            $getDelivery=Delivery::find($request->id);
            if(empty($getDelivery->customer_feedback)){
                $getDelivery->customer_feedback=$request->feedback;
                if($request->satisfy){
                    $getDelivery->client_satisfaction=$request->satisfy;
                }
                $getDelivery->save();
            }
        }
        Toast::success('Merci pour votre retour');
        return view('client.email.thankyou');
    }
}
