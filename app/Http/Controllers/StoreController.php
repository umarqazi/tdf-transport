<?php

namespace LaravelAcl\Http\Controllers;

use LaravelAcl\Store;
use LaravelAcl\StoreEmployees;
use LaravelAcl\Company;
use Illuminate\Http\Request;
use view;
use Validator;
use Redirect;
use Hash;
use File;
class StoreController extends Controller
{
    public function index(Request $request)
    {
        $name=$request->input('name');
        $companyId=$request->companyId;
        $company = Company::find($request->companyId);
        $ordering=$request->input('ordering');
        $store_id=$request->store_id;
        $modal= $request->modal;
        if($name)
        {
            $getStores=Store::where('store_name', 'like', '%'.$name.'%')->orderBy('id', $request->ordering)->paginate(10);
        }
        else
        {
            $getStores=Store::where('company_id', $companyId)->paginate(10);
        }
        if($store_id){
            $store=Store::find($store_id);
            $modal="addStore";
        }
        else{
            $store=New Store;
        }

        return view::make('admin.store.list')->with(['modal'=>$modal,'stores'=>$getStores, "request" => $request, "companyId"=>$companyId, 'store'=>$store, "company" =>$company]);
    }
    public function store(Request $request)
    {
        $id=$request->id;
        $validator = Validator::make($request->all(), [
            'store_name' => 'required',
            'email' => 'required|email|unique:stores,email,'.$id,
            'phone_number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'store_logo' => 'mimes:jpeg,bmp,png,'.$request->id,
        ]);

        if ($validator->fails()) {
            return redirect::route('store.list', ['modal' => 'addStore'])
                ->withErrors($validator)
                ->withInput()
                ->with('modal','addStore');
        }
        if($id)
        {
            $addStore=Store::find($id);
            $message="Les informations sur le magasin ont été modifiées.";
        }
        else
        {
            $addStore=new Store;
            $message="Le magasin a été ajouté avec succès";
        }
        $addStore->store_name=$request->store_name;
        $addStore->email=$request->email;
        $addStore->phone_number=$request->phone_number;
        $addStore->address=$request->address;
        $addStore->city=$request->city;
        $addStore->zip_code=$request->zip_code;
        $addStore->company_id=$request->company_id;
        if(!empty($request->file('store_logo')))
        {
            $images=$request->file('store_logo');
            $addStore->save();
            $type='storeLogo'.$addStore->id;
            $name=DeliveryController::storeImage($images, $addStore->id, $type);
            $addStore->store_logo=$name;
        }
        $addStore->save();

        return redirect::to('/admin/store/list/'.$request->company_id)->with('message', $message);
    }
    public function edit(Request $request)
    {
        $id=$request->id;
        $companyId=$request->companyId;
        $storeInfo='';
        if($id)
        {
            $storeInfo=Store::find($id);
        }
        else
        {
            $storeInfo = new Store;
        }
        return view::make('admin.store.edit')->with(['store'=>$storeInfo, "request" => $request, "companyId"=>$companyId]);
    }
    public function destroy(Request $request)
    {
        $id=$request->id;
        $getStore=Store::find($id);
        $getStore->delete();
        return redirect::back()->with('message', "Le magasin a été supprimé avec succès");
    }
    public function destroyCompany(Request $request)
    {
        $id=$request->id;
        $getStore=Company::find($id);
        $getStore->delete();
        return redirect::to('/admin/company/list')->with('message', "La société et les magasins ont été supprimés");
    }
    /**** Store Employees function***/
    public function storeEmployees(Request $request)
    {
        $stores=$request->input('stores');
        $name=$request->input('name');
        $type=$request->input('type');
        $email=$request->input('email');
        $storeId=$request->storeId;
        $storee = Store::find($request->storeId);
        $ordering=$request->input('ordering');
        $id=$request->product_id;
        $modal=$request->modal;
        $getEmployees=StoreEmployees::join('stores', 'store_employees.store_id', 'stores.id')->where('store_id', $storeId);
        if($stores)
        {
            $getEmployees=$getEmployees->where('store_id', $stores);
        }
        if($type)
        {
            $getEmployees=$getEmployees->where('type', $type);
        }
        if($name)
        {
            $getEmployees=$getEmployees->where('name', 'like', '%'.$name.'%');
        }
        if($email)
        {
            $getEmployees=$getEmployees->where('email_address', $email);
        }
        $getEmployees=$getEmployees->select('store_employees.*', 'stores.store_name')->paginate(10);
        $getStores=Store::select('stores.id', 'stores.store_name')->get();
        $allStores[0]='Select Store';
        foreach($getStores as $store)
        {
            $allStores[$store->id]=$store->store_name;
        }
        if($id)
        {
            $employeeInfo=StoreEmployees::find($id);
            $modal='addEmployee';
        }
        else
        {
            $employeeInfo = new StoreEmployees;
        }
        return view::make('admin.store.employees-list')->with([ 'modal'=>$modal,'store'=>$employeeInfo,'employees'=>$getEmployees, "request" => $request, 'stores'=>$allStores, 'storeId'=>$storeId, 'storee' => $storee]);
    }
    public function addEmployee(Request $request)
    {
        $id=$request->id;
        $storeId=$request->storeId;
        $storeInfo='';
        if($id)
        {
            $employeeInfo=StoreEmployees::find($id);
        }
        else
        {
            $employeeInfo = new StoreEmployees;
        }
        return view::make('admin.store.edit-employee')->with(['store'=>$employeeInfo, "request" => $request, 'storeId'=>$storeId]);
    }
    public function pAddEmployee(Request $request)
    {
        $id=$request->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email_address' => 'required|email|unique:store_employees,email_address,'.$id,
            'landline' => 'required|numeric',
            'mobile_number' => 'required',
            'type' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect::route('employees', ['storeId'=>$request->store_id, 'modal'=>'addEmployee'])
                ->withErrors($validator)
                ->withInput()
                ->with('modal','addEmployee');
        }
        if($id)
        {
            $addEmployee=StoreEmployees::find($id);
            $message="L'employé a été mis à jour avec succès";
        }
        else
        {
            $addEmployee=new StoreEmployees;
            $message="L'employé a été ajouté avec succès";
        }
        $addEmployee->name=$request->name;
        $addEmployee->email_address=$request->email_address;
        $addEmployee->landline=$request->landline;
        $addEmployee->mobile_number=$request->mobile_number;
        $addEmployee->type=$request->type;
        $addEmployee->mobile_number=$request->mobile_number;
        $addEmployee->store_id=$request->store_id;
        $addEmployee->save();
        return redirect::to('/admin/store/employee/list/'.$request->store_id)->with('message', $message);
    }
    public function deleteEmployee(Request $request)
    {
        $id=$request->id;
        $getStore=StoreEmployees::find($id);
        $getStore->delete();
        return redirect::back()->with('message', "L'employé a été supprimé avec succès");
    }
    public static function getCompanyId(Request $request)
    {
        return $companyId=$request->companyId;
    }
}
