<?php

namespace LaravelAcl\Http\Controllers;

use LaravelAcl\Product;
use Illuminate\Http\Request;
use view;
use Validator;
use Redirect;
use Excel;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name=$request->input('name');
        $companyId=$request->companyId;
        if($name)
        {
            $product=Product::where('product_family', 'like', '%'.$name.'%')->where('company_id', $companyId)->paginate(10);
        }
        else
        {
            $product=Product::where('company_id', $companyId)->paginate(10);
        }
        return view::make('admin.company.product-list')->with(['product'=> $product, 'request'=>$request, 'companyId'=>$companyId]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=$request->id;
        $company_id=$request->company_id;
        $validator = Validator::make($request->all(), [
            'product_family' => 'required',
            'product_type' => 'required',
            'delivery_charges' => 'required|numeric',
            'comission' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }
        if($id)
        {
            $addStore=Product::find($id);
            $message="Product has been updated Successfully";
        }
        else
        {
            $addStore=new Product;
            $message="Product has been added Successfully";
        }
        $addStore->product_family=$request->product_family;
        $addStore->product_type=$request->product_type;
        $addStore->delivery_charges=$request->delivery_charges;
        $addStore->comission=$request->comission;
        $addStore->company_id=$request->company_id;
        $addStore->save();

        return redirect::to('/admin/product/list/'.$addStore->company_id)->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \LaravelAcl\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \LaravelAcl\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id=$request->id;
        $companyId=$request->companyId;
        if($id)
        {
            $getProduct=Product::find($id);
        }
        else
        {
            $getProduct=new Product;
        }
        return view::make('admin.company.edit-product')->with(['product'=>$getProduct, 'companyId'=>$companyId]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \LaravelAcl\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \LaravelAcl\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
        $getStore=Product::find($id);
        $getStore->delete();
        return redirect::back()->with('message', "Product has been deleted Successfully");
    }
    public function importExport(Request $request)
    {
        $file=$request->bulk_upload;
        $company_id=$request->company_id;
        $extension=$file->getClientOriginalExtension();
        if(!in_array($extension, ['xlsx']))
        {
            return redirect::back()
                        ->withErrors('The bulk upload must be a file of type: csv, xlsx, ods.');
        }
        if($file){
            $path = $request->file('bulk_upload')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = ['product_family' => $value->family
, 'product_type' => $value->type, 'delivery_charges' => $value->delivery, 'comission' => $value->commission, 'company_id'=>$company_id];
                }
                if(!empty($insert)){
                    DB::table('products')->insert($insert);
                }
            }
        }
        return redirect::back()->with('message', 'Product has been uploaded Successfully');
    }
}
