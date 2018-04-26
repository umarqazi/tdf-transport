<?php

namespace LaravelAcl\Http\Controllers;

use LaravelAcl\Store;
use LaravelAcl\StoreEmployees;
use LaravelAcl\Company;
use LaravelAcl\User;
use LaravelAcl\Delivery;
use LaravelAcl\TimeSlot;
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
use Jenssegers\Date\Date;
class HomeController extends Controller
{
	protected $hashKey;
	private $type;
	private $users;
	public $authUser;
	public function __construct()
	{
		Date::setLocale('fr');
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
		$startDate=Date::parse($date->startOfWeek())->format('F Y');
		$endDate=Date::parse($date->endOfWeek())->format('F Y');
		$view='client.cashier.dashboard';
		$getDeliveries=Delivery::whereBetween('datetime', [$date->startOfWeek()->format('Y-m-d'), $date->endOfWeek()->format('Y-m-d')]);
		$getDeliveries=$getDeliveries->where('store_id', $this->authUser->store_id);
		$getDeliveries=$getDeliveries->get();
		for($i=0; $i<=6; $i++){
			$deliveries[$date->startOfWeek()->addday($i)->format('d-M-Y')]=array();
		}
		foreach($getDeliveries as $key=>$delivery){
			$deliveryDate=Carbon::parse($delivery['datetime'])->format('d-M-Y');
			$deliveries[$deliveryDate]=array();
			foreach($getDeliveries as $key2=>$del){
				if($deliveryDate==Carbon::parse($del['datetime'])->format('d-M-Y'))
				{
					$records=['id'=>$del['id'], 'datetime'=>$del['datetime'],'first_name'=>$del['first_name'],'last_name'=>$del['last_name'],'city'=>$del['city'],'postal_code'=>$del['postal_code'], 'day_period'=>$del['day_period'],'status'=>$del['status']];
					$deliveries[$deliveryDate][$key2]=$records;
				}

			}
		}
		return view::make($view)->with(['startDate'=>$startDate, 'endDate'=>$endDate, 'currentDate'=>$date, 'deliveries'=>$deliveries, 'checkDate'=>$checkDate]);
	}
	public function tourPlan(Request $request)
	{
//	    dd($request->all());
		$addmodal='';
		$previousDate='';
		$currentDate=$request->date;
		$drivers=[''=>'Choisir un vehicule'];
		$user_id=$request->id;
		$tour_plan=$request->tourPlan;
		$getDrivers=User::where('type', Config::get('constants.Users.Driver'))->get();
		foreach($getDrivers as $driver){
			$drivers[$driver['id']]=$driver['vehicle_name'].', '.$driver['number_plate'];
		}
		if($currentDate==''){
			$nextDay=Carbon::now()->addDay(1)->format('Y-m-d');
			$date=Date::now()->addDay(1)->format('l d F Y');
			$previousDate=Carbon::now()->addDay(0)->format('Y-m-d');
		}else{
			$nextDay=$currentDate;
			if($currentDate==date('Y-m-d')){
				$previousDate=Carbon::now()->addDay(1)->format('Y-m-d');
				$date=Date::now()->addDay(0)->format('l d F Y');
			}else{
				$previousDate=Carbon::now()->addDay(0)->format('Y-m-d');
				$date=Date::now()->addDay(1)->format('l d F Y');
			}
		}
		$getDeliveries='';
        $getDeliveryCities= '';
        $getDeliveryFamilies= '';
        $getDeliveryStores= '';
		$user_record='';
		$tours=array();
		if($user_id){
			$user_record=User::where('id',$user_id)->select('number_plate', 'vehicle_name', 'user_first_name', 'user_last_name')->first();
			$getDeliveries=self::deliveriesWithProducts();
			$getDeliveries=$getDeliveries->where('deliveries.status', Config::get('constants.Status.Active'))->where('flag', '0')->whereDate('datetime', $nextDay);

            $getDeliveryCities      = $getDeliveries->pluck('city');
            $getDeliveryFamilies    = $getDeliveries;
            $getDeliveryFamilies    = $getDeliveryFamilies->get();
            $getDeliveryStores      = $getDeliveries;
            $getDeliveryStores      = $getDeliveryStores->get();
            $getDeliveryStores      = $getDeliveryStores->pluck('store');
            $getDeliveryStores      = array_map("unserialize", array_unique(array_map("serialize", $getDeliveryStores->toArray())));

            if($request->filterCity || $request->filterServices || $request->filterStores || $request->filterProducts){
                if (!empty($request->filterCity && $request->filterCity != 'default')){
                    $getDeliveries = $getDeliveries->where('deliveries.city',$request->filterCity);
                }

                if (!empty($request->filterServices) && $request->filterServices != 'default'){
                    $getDeliveries = $getDeliveries->where('deliveries.service', $request->filterServices);
                }

                if (!empty($request->filterStores) && $request->filterStores != 'default'){
                    $getDeliveries = $getDeliveries->where('deliveries.store_id', $request->filterStores);
                }

                if (!empty($request->filterProducts)){
                    $getDeliveries = $getDeliveries->whereIn('deliveries.product_id', $request->filterProducts);
                }
				$addmodal="deliveries";
			}
            $getDeliveries      = $getDeliveries->get();
            $tours=self::manageTours($user_id, $nextDay);
        }
		return view::make('client.tdf_manager.create_tour')->with(['previousDate'=>$previousDate,'nextDate'=>$nextDay,'date'=>$date,'vehicle_info'=>$user_record,'tour_plan'=>$tour_plan,'user_id'=>$user_id,'toursList'=>$tours,'drivers'=>$drivers, 'deliveries'=>$getDeliveries, 'deliveryCities' => $getDeliveryCities, 'deliveryFamilies' => $getDeliveryFamilies, 'deliveryStores'=>$getDeliveryStores, 'oldValues' => $request->all() , 'modal'=>$addmodal]);
	}
	public static function manageTours($user_id, $nextDay, $driver=NULL){

		if($driver=='driver'){
			$status=[Config::get('constants.Status.Active'), Config::get('constants.Status.Delivered'), Config::get('constants.Status.Return')];
		}else{
			$status=[Config::get('constants.Status.Active')];
		}
		$getDeliveries2=Delivery::whereIn('status', $status)->where('flag', '1')->whereDate('datetime', $nextDay)->select('deliveries.*', 'sub_products.product_type')->with(array('time'=>function($query){
			$query->select('tour_plan.id as tour_id','time_slot_id', 'delivery_id', 'user_id');
			}))->leftJoin('sub_products', 'deliveries.sub_product_id', '=', 'sub_products.id')->get();
			$getTime=TimeSlot::all();
			foreach($getTime as $time){
				$tours[$time['time']]=['id'=>'','delivery'=>'','time_id'=>$time['id'], 'tours'=>array()];
				if($getDeliveries2){
					foreach ($getDeliveries2 as $key => $value) {
						foreach ($value['time'] as $key2 => $record) {
							if($time['id']==$record['time_slot_id'] && $user_id==$record['user_id']){
								if($driver==NULL){
									$records=$value['first_name'].' '.$value['last_name'].' '.Date::parse($value['datetime'])->format('l d F Y').' '.$value['day_period'];
								}
								else{
									$records=$value;
								}
								$tourDetail=['time_id'=>$time['id'],
								'id'=>$record['tour_id'],
								'delivery_id'=>$record['pivot']['delivery_id'],
								'delivery'=>$records];
								array_push($tours[$time['time']]['tours'], $tourDetail);
							}
						}
					}
				}
			}
			return $tours;
		}
		public function monthView()
		{
			$startDate=carbon::now()->startofMonth();
			$endDate=carbon::now()->endofMonth();
			$getDeliveries=Delivery::select('day_period', DB::raw("DATE(datetime) as 'task_date'"), DB::raw('count(*) as total' ))->groupBy(DB::raw("DATE(datetime)"))->groupBy('day_period')->orderBy('id', 'desc');
			$getDeliveries=$getDeliveries->where('store_id', $this->authUser->store_id)->get();
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
					$message->to($email, 'TDF Transport')->subject('Réinitialisation de votre mot de passe');
				});
			}
			else
			{
				Toast::error("Aucun e-mail n'est associé à cette adresse e-mail");
				return redirect::back();
			}
			Toast::success("Votre demande de mot de passe oublié a bien été prise en compte. Merci de vérifier vos mails.");
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
			$request->datetime= str_replace('/', '-', $request->datetime);
			$date=Carbon::parse($request->datetime)->format('Y-m-d h:i:s');
			$searchResult='';
			$getDeliveryRecords=self::searchResults($request->all());
			$getDeliveryRecords=$getDeliveryRecords;
			$getDeliveryRecords=$getDeliveryRecords->where('store_id', $this->authUser->store_id);
			$getDeliveryRecords=$getDeliveryRecords->orderby('datetime', 'desc')->get();
			$searchResult='<thead><tr><th class="text-center">Date de livraison</th><th class="text-center">Client</th><th class="text-center">Adresse e-mail</th><th class="text-center">Numéro de commande</th><th class="text-center">Numéro du bon de livraison</th><th class="text-center">Téléphone</th><th class="text-center">Ville</th><th class="text-center">Code postal</th><th class="text-center">Type de prestation</th><th class="text-center">Produit(s) commandé(s)</th><th class="text-center">Prix de la livraison</th></tr></thead>';
			if(!$getDeliveryRecords->isEmpty()){
				foreach($getDeliveryRecords as $key=>$record){
					$products='';
					$getProduct=array();
					if($record['sub_product_id']==''){
						$products='Multi-produits';
					}
					else{
						$products=$record['product_type'];
					}
					if($record['delivery_price']=='Gratuit'){
						$price= 'Gratuit';
					}else{
						$price=$record['delivery_price']." €";
					}
					$url=URL('delivery').'/'.$record['id'];
					$searchResult.="<tr onclick=viewDelivery('$url') class='clickable'><td>".Date::parse($record['datetime'])->format('d/m/Y')."</td><td>".$record['first_name'].' '.$record['last_name']."</td><td>".$record['customer_email']."</td><td>".$record['order_id']."</td><td>".$record['delivery_number']."</td><td>".$record['mobile_number']."</td><td>".$record['city']."</td><td>".$record['postal_code']."</td><td>".$record['service']."</td><td>".$products."</td><td>".$price." </td></tr>";
				}
			}else{
				$searchResult.="<tr><td colspan='10'><strong>Désolé aucun résultat n'a été trouvé.</strong></td></tr>";
			}
			return $searchResult;
		}
		public static function searchResults($request){

			$getDeliveryRecords=self::deliveryProducts();
			if(!empty($request['search_field'])){
				$getDeliveryRecords=$getDeliveryRecords->where('order_id', $request['search_field'])->orwhereRaw('concat(first_name," ",last_name) like ?', '%'.$request['search_field'].'%');
			}
			if(array_key_exists('customerCheck', $request))
			{
				$getDeliveryRecords=$getDeliveryRecords->whereRaw('concat(first_name," ",last_name) like ?', '%'.$request['customer_name'].'%');
			}
			if(array_key_exists('orderCheck', $request))
			{
				$getDeliveryRecords=$getDeliveryRecords->where('order_id', $request['order_id']);
			}
			if(array_key_exists('dateCheck', $request))
			{
				$request['datetime']= str_replace('/', '-', $request['datetime']);
				$date=date('Y-m-d',strtotime($request['datetime']));
				$getDeliveryRecords=$getDeliveryRecords->whereDate('datetime','=', $date);
			}
			return $getDeliveryRecords;
		}
		public static function deliveryProducts(){
			$getDeliveryRecords=Delivery::leftJoin('sub_products', 'deliveries.sub_product_id', '=', 'sub_products.id')->leftJoin('stores', 'deliveries.store_id', '=', 'stores.id')->select('deliveries.*', 'sub_products.product_type','stores.store_name', 'stores.id as stores_id');
			return $getDeliveryRecords;
		}
		public static function deliveriesWithProducts(){
			$getDeliveryRecords=Delivery::with('product','store')->leftJoin('sub_products', 'deliveries.sub_product_id', '=', 'sub_products.id')->leftJoin('stores', 'deliveries.store_id', '=', 'stores.id')->select('deliveries.*', 'sub_products.product_type','stores.store_name', 'stores.id as stores_id');
			return $getDeliveryRecords;
		}
	}
