<?php

namespace LaravelAcl\Http\Controllers;

use LaravelAcl\Company;
use LaravelAcl\Store;
use Illuminate\Http\Request;
use view;
use Validator;
use Redirect;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function companyList(Request $request)
    {
        $id=$request->id;
        $modal="";
        if($id)
        {
            $company=Company::find($id);
            $modal="addCompany";
        }
        else
        {
            $company = new Company;
        }
        $getCompany=Company::orderBy('company_name', 'asc')->paginate(10);
        return view::make('admin.company.list')->with(['company'=>$company,'stores'=>$getCompany, "request" => $request, 'modal'=>$modal]);
    }
    public function editCompany(Request $request)
    {
        $id=$request->id;
        if($id)
        {
            $company=Company::find($id);
        }
        else
        {
            $company = new Company;
        }
        return view::make('admin.company.edit')->with(['company'=>$company, "request" => $request,'modal'=>"addCompany"]);
    }
    public function pEditCompany(Request $request)
    {
        $id=$request->id;
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        if($id)
        {
            $addStore=Company::find($id);
            $message="La société a été mise à jour avec succès";
        }
        else
        {
            $addStore=new Company;
            $message="La société a été ajoutée avec succès";
        }
        $addStore->company_name=$request->company_name;
        $addStore->save();

        return redirect::to('admin/company/list')->with('message', $message);
    }

    public function getStores(){
        $id= $_GET['id'];
        $stores=Store::where('company_id', $id)->get();
        $storeDropDown="<option value=''>Sélectionnez un magasin</option>";
        if($stores){
            foreach($stores as $item){
                $storeDropDown.="<option value='".$item['id']."'>".$item['store_name']."</option>";
            }
        }

        return $storeDropDown;
    }
}
