<?php

namespace LaravelAcl\Http\Controllers;

use LaravelAcl\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelAcl\Company;
use LaravelAcl\DeliveryProduct;
use LaravelAcl\Store;
use view;
use Validator;
use Redirect;
use Toast;
use Config;
use File;
use Carbon\Carbon;
use DB;
use Excel;
use Illuminate\Support\Facades\App;
class DeliveryController extends Controller
{
    public $authUser;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $login=App::make('sentry');
            $this->authUser=$login->getUser();
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
            $dateTime=date('m/d/Y h:i:s', strtotime($request->date));
        }
        else
        {
            $dateTime=date('m/d/Y h:i:s');
        }

        $dayPeriod=$request->period;
        $products=array();
        if($id)
        {
            $getDelivery=Delivery::with('products')->where('id',$id)->first();
            $dateTime=date('m/d/Y h:i:s', strtotime($getDelivery['datetime']));
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
            'landline'=> 'required',
            'mobile_number'=> 'required',
            'order_id'=> 'required',
            'product'=> 'required',
            'service'=> 'required',
            'address' => 'required',
            'pdf' => 'mimes:pdf,'.$request->id

        ]);

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
            $checkProduct=DB::table('delivery_products')->where('delivery_id', $deliveryId)->get();
            if($checkProduct)
            {
                $checkProduct=DB::table('delivery_products')->where('delivery_id', $deliveryId)->delete();
            }
        }
        else
        {
            $delivery=new Delivery;
            $delivery->user_id=$this->authUser->id;
            $delivery->store_id=$this->authUser->store_id;
        }
        $delivery->save();
        $fileName='DeliveryNote'.$delivery->id;
        if($request->dummy!=NULL)
        {
            $new_path =  public_path().'/assets/images/'. $getStoreName.'/'.$fileName.'.pdf';
            $old_path =  public_path().'/assets/images/dummyImages/'. $request->dummy;
            $move = File::move($old_path, $new_path);
            $delivery->pdf=$fileName.'.pdf';
        }
        if(!empty($request->pdf))
        {
            
            $pdf=$request->file('pdf');
            $type=$fileName; 
            $name=self::storeImage($pdf, $getStoreName, $type);
            $delivery->pdf=$name;
        }
        $delivery->datetime=Carbon::parse($request->datetime)->format('Y-m-d h:i:s');
        $delivery->day_period=$request->day_period;
        $delivery->first_name=$request->first_name;
        $delivery->last_name=$request->last_name;
        $delivery->landline=$request->landline;
        $delivery->mobile_number=$request->mobile_number;
        $delivery->order_id=$request->order_id;
        $delivery->service=$request->service;
        $delivery->address=$request->address;
        $delivery->city=$request->city;
        $delivery->postal_code=$request->postal_code;
        $delivery->comment=$request->comment;
        $delivery->delivery_price=$request->delivery_price;
        $delivery->save();
        foreach($request->product as $product){
            $productArray=['delivery_id'=>$delivery->id, 'product_id'=>$product];
            DB::table('delivery_products')->insert($productArray);
        }
        Toast::success(Config::get('constants.Create Delivery Message'));
        return redirect::to('/dashboard');
    }
    public function viewDeliver(Request $request)
    {
        $id=$request->id;
        if($id)
        {
            $getDelivery=Delivery::find($id);
            $products=self::getProducts($id);
        }
        return view::make('client.cashier.view_delivery')->with(['delivery'=> $getDelivery, 'products'=>$products]);
    }
    public static function getProducts($id)
    {
        $products='';
        $getProduct=DB::table('delivery_products')->leftJoin('products', 'delivery_products.product_id', '=', 'products.id')->where('delivery_id', $id)->select('products.product_family')->get();
            foreach($getProduct as $key=>$product)
            {
                $products[$key]=$product->product_family;
            }
            return $products; 
    }
    public function uploadPdf(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pdf' => 'mimes:pdf'

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
        return redirect::to('/dashboard');
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
        foreach($deliveryId as $delivery){
            $updateStatus=Delivery::where('id', $delivery)->update(['status'=>$status['Active'] ]);
        }
        Toast::success(Config::get('constants.Validate Delivery'));
        return redirect::back();
    }
    public function history(Request $request)
    {
        $getDeliveryHistory=HomeController::searchResults($request->all());
        $getDeliveryHistory=$getDeliveryHistory->where('store_id', $this->authUser->store_id)->orderby('datetime', 'desc')->paginate(10);
        return view::make('client.cashier.delivery_history')->with('allDeliveries', $getDeliveryHistory)->withInput($request->all());
    }
    public function exportHistory(Request $request) {
        $deliveries = Delivery::where('store_id', $this->authUser->store_id)->with('products');
        if($request->fromDate)
        {
            $fromDate=Carbon::parse($request->fromDate)->format('Y-m-d h:i:s');
            $deliveries= $deliveries->where('datetime', '>=', $fromDate);
        }
        if($request->toDate)
        {
            $toDate=Carbon::parse($request->toDate)->format('Y-m-d h:i:s');
            $deliveries= $deliveries->where('datetime', '<=', $toDate);
        }
        $deliveries=$deliveries->get();
        $records = [];
        $records[] = ['Date de la livraison', 'Client','Numero de commande','Numero du bon de livraison','Telephone', 'Villes', 'Code Postal', 'Type de Prestation', 'Produit(s) commande(s)', 'Prix de la livraison'];
        foreach($deliveries as $key=>$delivery){
            $items='';
            if($delivery['delivery_price']=='Free'){ 
                $price= 'Free';
            }else{ 
                $price=$delivery['delivery_price']." €";
            }
            if($delivery['products']){
                foreach($delivery['products'] as $key=>$product){
                    $items[$key]=$product['product_family'];
                }
            $items=implode(',', $items);
            }
            
            $name=$delivery['first_name'].' '.$delivery['last_name'];
            $records[]=[$delivery['datetime'], $name,$delivery['order_id'],1,$delivery['mobile_number'],$delivery['city'],$delivery['postal_code'],$delivery['service'],$items,$price];
        }
        Excel::create('All Deliveries', function($excel) use ($records) {
            $excel->setTitle('Deliveries History');
            $excel->setCreator('TDF Transport')->setCompany('WJ Gilmore, LLC');
            $excel->setDescription('History of Deliveries');
            $excel->sheet('sheet1', function($sheet) use ($records) {
                $sheet->fromArray($records, null, 'A1', false, false);
            });

        })->download('xlsx');
    }
}
