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
        $getCompany=Company::paginate(10);
        return view::make('admin.company.list')->with(['stores'=>$getCompany, "request" => $request]);
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
        return view::make('admin.company.edit')->with(['company'=>$company, "request" => $request]); 
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
            $message="Company has been updated Successfully";
        }
        else
        {
            $addStore=new Company;
            $message="Company has been added Successfully";
        }
        $addStore->company_name=$request->company_name;
        $addStore->save();

        return redirect::to('admin/company/list')->with('message', $message);
    }
}
