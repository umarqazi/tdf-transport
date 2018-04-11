<?php

namespace LaravelAcl\Http\Controllers;

use LaravelAcl\Delivery;
use LaravelAcl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelAcl\Company;
use LaravelAcl\DeliveryProduct;
use LaravelAcl\Store;
use LaravelAcl\TourPlan;
use LaravelAcl\Product;
use LaravelAcl\SubProduct;
use view;
use Validator;
use Redirect;
use Toast;
use Config;
use File;
use Carbon\Carbon;
use DB;
use Excel;
use Mail;
use Illuminate\Support\Facades\App;
use LaravelAcl\Notifications\DeliveryNotification;
use Jenssegers\Date\Date;
class DeliveryController extends Controller
{
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
  public function index(Request $request)
  {
    $id=$request->id;
    if($request->date)
    {
      $dateTime=date('d/m/Y', strtotime($request->date));
    }
    else
    {
      $dateTime=Date::now();
    }

    $dayPeriod=$request->period;
    $products=['0'=>'Multi-produits'];
    if($id)
    {
      $getDelivery=HomeController::deliveryProducts()->where('deliveries.id',$id)->first();
      $dateTime=date('d/m/Y', strtotime($getDelivery['datetime']));
    }
    else
    {
      $getDelivery=new Delivery;
    }
    $storeId=$this->authUser->store_id;
    $storeInfo=Store::find($storeId);
    $getCompanyProduct=Company::with('products')->where('id', $storeInfo['company_id'])->first();
    if($getCompanyProduct['products'])
    {
      foreach($getCompanyProduct['products'] as $product)
      {
        $products[$product['id']]=$product['product_family'];
      }
    }
    return view::make('client.cashier.create_delivery')->with(['delivery'=> $getDelivery, 'products'=>$products, 'period'=>$dayPeriod, 'dateTime'=>$dateTime]);
  }
  public function create(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'datetime' => 'required',
      'first_name'=> 'required',
      'last_name'=> 'required',
      'mobile_number'=> 'required',
      'order_id'=> 'required',
      'service'=> 'required',
      'address' => 'required',
      'pdf' => 'mimes:pdf'.$request->id,
      'order_pdf' => 'mimes:pdf'.$request->id

    ]);
    $date = str_replace('/', '-', $request->datetime);
    if ($validator->fails()) {
      return redirect::back()
      ->withErrors($validator)
      ->withInput();
    }
    $deliveryId=$request->id;
    $getStoreName=$request->session()->get('store_name');
    if($deliveryId)
    {
      $delivery=Delivery::find($deliveryId);
      $message=Config::get('constants.Edit Delivery');
    }
    else
    {
      $delivery=new Delivery;
      $delivery->user_id=$this->authUser->id;
      $delivery->store_id=$this->authUser->store_id;
      $message=Config::get('constants.Create Delivery');
    }
    $delivery->save();
    $fileName='DeliveryNote'.$delivery->id;
    $orderFileName='OrderNote'.$delivery->id;
    if($request->dummy!=NULL)
    {
      $new_path =  public_path().'/assets/images/'. $getStoreName.'/'.$fileName.'.pdf';
      $old_path =  public_path().'/assets/images/dummyImages/'. $request->dummy;
      $move = File::move($old_path, $new_path);
      $delivery->delivery_pdf=$fileName.'.pdf';
    }
    if($request->orderDummy!=NULL)
    {
      $new_path =  public_path().'/assets/images/'. $getStoreName.'/'.$orderFileName.'.pdf';
      $old_path =  public_path().'/assets/images/dummyImages/'. $request->orderDummy;
      $move = File::move($old_path, $new_path);
      $delivery->order_pdf=$orderFileName.'.pdf';
    }
    if(!empty($request->pdf))
    {

      $pdf=$request->file('pdf');
      $type=$fileName;
      $name=self::storeImage($pdf, $getStoreName, $type);
      $delivery->delivery_pdf=$name;
    }
    if(!empty($request->order_pdf))
    {

      $pdf=$request->file('order_pdf');
      $type=$orderFileName;
      $name=self::storeImage($pdf, $getStoreName, $type);
      $delivery->order_pdf=$name;
    }
    $delivery->datetime=date('Y-m-d', strtotime($date));
    $delivery->day_period=$request->day_period;
    $delivery->first_name=$request->first_name;
    $delivery->last_name=$request->last_name;
    $delivery->landline=$request->landline;
    $delivery->mobile_number=$request->mobile_number;
    $delivery->order_id=$request->order_id;
    $delivery->delivery_number=$request->delivery_number;
    $delivery->service=$request->service;
    $delivery->address=$request->address;
    $delivery->city=$request->city;
    $delivery->postal_code=$request->postal_code;
    $delivery->comment=$request->comment;
    if($request->delivery_price=='Gratuit'){
      $delivery->delivery_price='0';
    }else{
      $delivery->delivery_price=$request->delivery_price;
    }
    if($request->product_id){
      $product_id=$request->product_id;
    }else{
      $product_id=NULL;
    }
    $delivery->sub_product_id=$product_id;
    $delivery->status=Config::get('constants.Status.Pending');
    if(Auth::user()->type==Config::get('constants.Users.Manager')){
      $getManager=User::where('type', 'Manager')->where('store_id', $this->authUser->store_id)->first();
      if(!empty($getManager))
      {
        $getManager->notify(new DeliveryNotification($delivery));
      }
    }

    $delivery->save();
    Toast::success($message);
    return redirect::to('/dashboard');
  }
  public function viewDeliver(Request $request)
  {
    $id=$request->id;
    $products=array();
    if($id)
    {
      $getDeliveryRecords=HomeController::deliveryProducts();
      $getDelivery=$getDeliveryRecords->find($id);
    }
    return view::make('client.cashier.view_delivery')->with(['delivery'=> $getDelivery]);
  }
  public function uploadPdf(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'pdf' => 'mimes:pdf',
      'order_pdf' => 'mimes:pdf'

    ]);
    if ($validator->fails()) {
      header('HTTP/1.1 403 '); exit("File type must be pdf");
    }
    $pdf=$request->file('pdf');
    $type=date('Y-m-d h:i:s');
    $name=self::storeImage($pdf, 'dummyImages', $type);
    $response=['name'=>$name];
    return json_encode($response);
  }
  public function destroy(Request $request)
  {
    $id=$request->id;
    $deleteProduct=DeliveryProduct::where('delivery_id', $id)->delete();
    $delete=Delivery::where('id', $id)->delete();
    Toast::success(Config::get('constants.Delete Delivery'));
    return redirect::back();
  }
  public static function storeImage($file, $storeName, $fileType=NULL)
  {
    $name = $fileType.'.'.$file->getClientOriginalExtension();
    $destinationPath = public_path('/assets/images/'.$storeName);
    if(!File::exists($destinationPath)) {
      $result = File::makeDirectory($destinationPath, 0777, true, true);
    }
    $file->move($destinationPath, $name);
    return $name;
  }
  public function deliveryValidate(Request $request)
  {
    $deliveryId=$request->delivery_id;
    $status=Config::get('constants.Status');
    if($deliveryId){
      foreach($deliveryId as $delivery){
        $updateStatus=Delivery::where('id', $delivery)->update(['status'=>$status['Active'] ]);
      }
      Toast::success(Config::get('constants.Validate Delivery'));
    }else{
      Toast::error("sélectionnez une livraison en premier");
    }
    return redirect::back();
  }
  public function history(Request $request)
  {
    $getDeliveryHistory=HomeController::searchResults($request->all());
    $getDeliveryHistory=$getDeliveryHistory->where('store_id', $this->authUser->store_id)->orderby('datetime', 'desc')->paginate(10);
    return view::make('client.cashier.delivery_history')->with('allDeliveries', $getDeliveryHistory)->withInput($request->all());
  }
  public function exportHistory(Request $request) {
    if(Auth::user()->type==Config::get('constants.Users.TDF Manager')){
      $deliveries = HomeController::deliveryProducts()->where('deliveries.status', Config::get('constants.Status.Active'));
    }else{
      $deliveries = HomeController::deliveryProducts()->where('store_id', $this->authUser->store_id);
    }
    if($request->fromDate)
    {
      $request->fromDate= str_replace('/', '-', $request->fromDate);
      $fromDate=Carbon::parse($request->fromDate)->format('Y-m-d');
      $deliveries= $deliveries->where('datetime', '>=', $fromDate);
    }
    if($request->toDate)
    {
      $request->toDate= str_replace('/', '-', $request->toDate);
      $toDate=Carbon::parse($request->toDate)->format('Y-m-d');
      $deliveries= $deliveries->where('datetime', '<=', $toDate);
    }
    $deliveries=$deliveries->get();
    $records = [];
    $records[] = ['Date de la livraison', 'Client','Numéro de commande','Numéro du bon de livraison','Téléphone', 'Ville', 'Code Postal', 'Type de prestation', 'Produit commandé', 'Prix de la livraison', 'Statut', 'Satisfaction client'];
    foreach($deliveries as $key=>$delivery){
      $items=array();
      if($delivery['delivery_price']=='Gratuit'){
        $price= 'Gratuit';
      }else{
        $price=$delivery['delivery_price']." €";
      }
      if($delivery['product_id']==0){
        $items="Multi-produits";
      }else{
        $items=$delivery['product_family'];
      }
      $name=$delivery['first_name'].' '.$delivery['last_name'];
      if($delivery['status']==1){ $status= "Validé";}elseif($delivery['status']==2){$status= "Livre"; }else{ $status="En attente"; };
      $records[]=[date('d/m/Y', strtotime($delivery['datetime'])), $name,$delivery['order_id'],$delivery['delivery_number'],$delivery['mobile_number'],$delivery['city'],$delivery['postal_code'],$delivery['service'],$items,$price, $status, $delivery['customer_feedback']];
    }
    Excel::create('Historique des livraisons', function($excel) use ($records) {
      $excel->setTitle('Historique des livraisons');
      $excel->setCreator('TDF Transport')->setCompany('WJ Gilmore, LLC');
      $excel->setDescription('Historique des livraisons');
      $excel->sheet('sheet1', function($sheet) use ($records) {
        $sheet->fromArray($records, null, 'A1', false, false);
      });

    })->download('xlsx');
  }
  public function pTourPlan(Request $request){
    if($request->delivery_id){
      $addTour=new TourPlan;
      $addTour->time_slot_id=$request->time_slot;
      $addTour->delivery_id=$request->delivery_id;
      $addTour->user_id=$request->user_id;
      $addTour->status='0';
      $addTour->save();
      $updateDelivery=Delivery::find($request->delivery_id);
      $updateDelivery->flag='1';
      $updateDelivery->save();
      Toast::success('La livraison a été assignée au conducteur');
      $link='?tourPlan='.$addTour->id;
    }else{
      $link='';
      Toast::error("Il n'y a pas de plan de tournée pour le moment");
    }
    return redirect::to('/planDriverTour/'.$request->user_id.$link);
  }
  public function allManagerDeliveries(Request $request){
    $getDeliveryHistory=HomeController::searchResults($request->all());
    $getDeliveryHistory=$getDeliveryHistory->where('deliveries.status', Config::get('constants.Status.Active'))->orwhere('deliveries.status', Config::get('constants.Status.Delivered'))->orderby('datetime', 'desc')->paginate(10);
    return view::make('client.tdf_manager.history')->with('allDeliveries', $getDeliveryHistory)->withInput($request->all());
  }
  public function deleteTour(Request $request){
    $id=$request->id;
    $tour=TourPlan::find($id);
    $updateFlag=Delivery::where('id', $tour->delivery_id)->update(['flag'=>'0']);
    $tour=$tour->delete();
    Toast::success('La livraison a été supprimée avec succès');
    return Redirect::back();
  }
  public function sendDriverEmail(Request $request){
    $user=User::find($request->id);
    $email=$user->email;
    $delivery=TourPlan::leftJoin('deliveries', 'tour_plan.delivery_id', '=', 'deliveries.id')->where('tour_plan.user_id', $request->id)->select('deliveries.*', 'tour_plan.id as tour_id', 'tour_plan.delivery_id')->orderBy('tour_plan.id', 'dsc')->first();
    $mail=Mail::send('client.email.driver_tours', ['data'=>$delivery], function($message) use ($email)
    {
      $message->to($email, 'TDF Transport')->subject('Tour Plan');
    });
    Toast::success('Merci, le planning a été envoyé au chauffeur.');
    return Redirect::back();
  }
  public function getDeliveryPrice(Request $request){
    $id=$request->product_id;
    $service=Config::get('constants.Database Fields.'.$request->service);
    $amount='';
    if($id!=''){
      $price=SubProduct::where('id', $id)->select($service)->first();
      if($price){
        $amount=$price->$service;
      }
    }

    return $amount;
  }
  public function getProductType(Request $request){
    $id=$request->id;
    $product=SubProduct::where('product_id', $id)->get();
    $productDropDown="<select class='form-control' name='product_id' id='product_type'><option value=''>Sélectionner un produit</option>";
    if($product){
      foreach($product as $item){
        $productDropDown.="<option value='".$item['id']."'>".$item['product_type']."</option>";
      }
    }
    $productDropDown.="</select>";
    return $productDropDown;
  }
  public function allDeliveries(){
    $getDeliveries=HomeController::deliveryProducts()->paginate(10);
    return view::make('admin.deliveries.index')->with('deliveries', $getDeliveries);
  }
}
