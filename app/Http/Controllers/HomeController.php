<?php

namespace LaravelAcl\Http\Controllers;

use LaravelAcl\Store;
use LaravelAcl\StoreEmployees;
use LaravelAcl\Company;
use LaravelAcl\User;
use LaravelAcl\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;
use view;
use Validator;
use Redirect;
use Hash;
use Toast;
use Mail;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\App;
class HomeController extends Controller
{
	protected $hashKey;
    private $type;
    private $users;
    public $authUser;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authUser=Auth::user();
            if($this->authUser)
            {
                $this->type=$this->authUser->type;
            }

            return $next($request);
        });
        $this->users=Config::get('constants.Users');
    }
    public function index()
    {
        
        return view::make('client.home.home');
    }
    public function dashboard(Request $request)
    {
        
        $startDate='';
        $endDate='';
        $date='';
        $deliveries=array();
        $checkDate='';
        if($request->date)
        {
            $date = new Carbon($request->date);
            $checkDate = new Carbon($request->date);
        }
        else
        {
            $date = Carbon::now();
            $checkDate = Carbon::now();
        }
		$startDate=Carbon::parse($date->startOfWeek())->format('d M y');
		$endDate=Carbon::parse($date->endOfWeek())->format('d M y');
        $view='client.cashier.dashboard';
        $getDeliveries=Delivery::whereBetween('datetime', [$date->startOfWeek()->format('Y-m-d h:i:s'), $date->endOfWeek()->format('Y-m-d h:i:s')]);
        if($this->type==$this->users['Cashier'])
        {
            $getDeliveries=$getDeliveries->where('user_id', $this->authUser->id);
        }
        else
        {
            $getDeliveries=$getDeliveries->where('store_id', $this->authUser->store_id);
        }
        $getDeliveries=$getDeliveries->get();
        for($i=0; $i<=5; $i++){
        	$deliveries[$date->startOfWeek()->addday($i)->format('d-M-Y')]=array();
        }
        foreach($getDeliveries as $key=>$delivery){
        	$deliveryDate=Carbon::parse($delivery['datetime'])->format('d-M-Y');
        	$deliveries[$deliveryDate]=array();
        	foreach($getDeliveries as $key2=>$del){
        		if($deliveryDate==Carbon::parse($del['datetime'])->format('d-M-Y'))
        		{
        			$records=['id'=>$del['id'], 'datetime'=>$del['datetime'],'first_name'=>$del['first_name'], 'day_period'=>$del['day_period'],'status'=>$del['status']];
        				$deliveries[$deliveryDate][$key2]=$records;
        		}

        	}
        }
    	return view::make($view)->with(['startDate'=>$startDate, 'endDate'=>$endDate, 'currentDate'=>$date, 'deliveries'=>$deliveries, 'checkDate'=>$checkDate]);
    }
    public function monthView()
    {
        $startDate=carbon::now()->startofMonth();
        $endDate=carbon::now()->endofMonth();
        $getDeliveries=Delivery::select('day_period', DB::raw("DATE(datetime) as 'task_date'"), DB::raw('count(*) as total' ))->groupBy(DB::raw("DATE(datetime)"))->groupBy('day_period')->orderBy(DB::raw("DATE(datetime)"), 'asc');
       if($this->type==$this->users['Cashier'])
        {
            $getDeliveries=$getDeliveries->where('user_id', $this->authUser->id);
        }
        else
        {
            $getDeliveries=$getDeliveries->where('store_id', $this->authUser->store_id);
        }
        $getDeliveries=$getDeliveries->get();
        return view::make('client.cashier.month_view')->with(['deliveries'=>$getDeliveries]);
    }
    public function forgetPassword()
    {
    	return view::make('client.home.forget-password');
    }
    public function pForgetPassword(Request $request)
    {
    	$email=$request->email;
    	$checkEmail=User::where('email', $email)->first();
    	$token = $this->createNewToken();
    	$request['token']=$token;
    	if($checkEmail)
    	{
    		$checkEmail->reset_password_code=$token;
    		$checkEmail->save();
    		$mail=Mail::send('client.email.change-password', ['data'=>$request], function($message) use ($email)
	        {
	            $message->to($email, 'TDF Transport')->subject('Changed Password');
	        });
    	}
    	else
    	{
    		Toast::error('There is no Email associated with this Email Address');
        	return redirect::back();
    	}
    	Toast::success("Please check your Email");
    	return redirect('/');
    }
    public function changePassword(Request $request)
    {
    	$token=$request->token;
    	return view::make('client.home.change-password')->with('token', $token);	
    }
    public function pChangePassword(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $token=$request->token;
        $checkEmail=User::where('reset_password_code', $token)->first();
        if($checkEmail)
        {
        	$checkEmail->password=Hash::make($request->password);
        	$checkEmail->save();
        }
        Toast::success('Your Password has been changed Successfully');
        return redirect('/');
    }
    public function createNewToken()
    {
        return hash_hmac('sha256', rand(), $this->hashKey);
    }
    public function searchRecords(Request $request)
    {
        $name=$request->customer_name;
        $order_id=$request->order_id;
        $date=Carbon::parse($request->datetime)->format('Y-m-d h:i:s');
        
        $searchResult='';
        $getDeliveryRecords=self::searchResults($request->all());
        if($this->type==$this->users['Cashier'])
        {
            $getDeliveryRecords=$getDeliveryRecords->where('user_id', $this->authUser->id);
        }
        else
        {
            $getDeliveryRecords=$getDeliveryRecords->where('store_id', $this->authUser->store_id);
        }
        $getDeliveryRecords=$getDeliveryRecords->orderby('datetime', 'desc')->get();
        $searchResult='<thead><tr><th class="text-center">Date de la livraison</th><th class="text-center">Client</th><th class="text-center">Numero de commande</th><th class="text-center">Numero du bon de livraison</th><th class="text-center">Telephone</th><th class="text-center">Villes</th><th class="text-center">Code Postal</th><th class="text-center">Type de Prestation</th><th class="text-center">Produit(s) commande(s)</th><th class="text-center">Prix de la livraison</th></tr></thead>';
        foreach($getDeliveryRecords as $key=>$record){
            $products='';
            $getProduct=DeliveryController::getProducts($record['id']);
            if($getProduct){
                $products=implode(',',$getProduct);
            }
                if($record['delivery_price']=='Free'){ 
                    $price= 'Free';
                }else{ 
                    $price=$record['delivery_price']." €";
                }
            $searchResult.="<tr><td>".Carbon::parse($record['datetime'])->format('Y-m-d')."</td><td>".$record['first_name'].' '.$record['last_name']."</td><td>".$record['order_id']."</td><td></td><td>".$record['mobile_number']."</td><td>".$record['city']."</td><td>".$record['postal_code']."</td><td>".$record['service']."</td><td>".$products."</td><td>".$price." </td></tr>";
        }
        return $searchResult;
    }
    public static function searchResults($request){
        $getDeliveryRecords=Delivery::with('products');
        if(!empty($request['customer_name']))
        {
           $getDeliveryRecords=$getDeliveryRecords->whereRaw('concat(first_name," ",last_name) like ?', '%'.$request['customer_name'].'%');
        }
        if(!empty($request['order_id']))
        {
           $getDeliveryRecords=$getDeliveryRecords->where('order_id', $request['order_id']);
        }
        if(!empty($request['date']))
        {
            $getDeliveryRecords=$getDeliveryRecords->where('datetime','<=', $request['date']);
        }

        return $getDeliveryRecords;
    }
}
