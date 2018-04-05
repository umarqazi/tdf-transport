<?php

namespace LaravelAcl\Http\Controllers;

use LaravelAcl\Product;
use LaravelAcl\SubProduct;
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
    $id=$request->product_id;
    $companyId=$request->companyId;
    $modal='';
    if($name)
    {
      $product=Product::where('product_family', 'like', '%'.$name.'%')->where('company_id', $companyId)->paginate(10);
    }
    else
    {
      $product=Product::where('company_id', $companyId)->with('subProducts')->orderBy('id', 'desc')->paginate(10);
      // echo "<pre>";print_r($product->toArray());die();
    }
    if($id){
      $newProduct=SubProduct::leftJoin('products', 'sub_products.product_id', '=', 'products.id')->find($id);
      $modal="addProduct";
    }else{
      $newProduct=New Product;
    }
    return view::make('admin.company.product-list')->with(['modal'=>$modal,'newProduct'=>$newProduct,'product'=> $product, 'request'=>$request, 'companyId'=>$companyId]);
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
    $company_id=$request->company_id;
    $validator = Validator::make($request->all(), [
      'product_family' => 'required',
      'product_type' => 'required',
    ]);

    if ($validator->fails()) {
      return redirect::back()
      ->withErrors($validator)
      ->withInput();
    }
    $message="Product has been updated Successfully";
    $addStore=self::insertProduct($request);
    if($request->product_type){
      $request['id']=$addStore->id;
      $addSubProduct=self::insertSubProduct($request);
    }
    return redirect::to('/admin/product/list/'.$addStore->company_id)->with('message', $message);
  }

  public function insertProduct($product){
    $id='';
    if(array_key_exists('id', $product)){
      $id=$product->id;
    }
    if($id)
    {
      $addStore=Product::find($id);
    }
    else
    {
      $addStore=Product::where('product_family', $product['product_family'])->first();
      if(empty($addStore)){
        $addStore=new Product;
      }
    }
    $addStore->product_family=$product['product_family'];
    $addStore->company_id=$product['company_id'];
    $addStore->save();
    return $addStore;
  }
  public function insertSubProduct($product){
    $addSubProduct=SubProduct::where('product_type', $product['product_type'])->where('product_id', $product['id'])->first();
    if(empty($addSubProduct)){
      $addSubProduct=new SubProduct;
    }
    $addSubProduct->product_type=$product['product_type'];
    $addSubProduct->sav=$product['sav'];
    $addSubProduct->livraison=$product['livraison'];
    $addSubProduct->livraison_Montage=$product['livraison_montage'];
    $addSubProduct->rétrocession=$product['rétrocession'];
    $addSubProduct->prestataire=$product['prestataire'];
    $addSubProduct->montage=$product['montage'];
    $addSubProduct->product_id=$product['id'];
    $addSubProduct->save();
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
      $getProduct=SubProduct::find($id);
    }
    else
    {
      $getProduct=new SubProduct;
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
      ->withErrors('The bulk upload must be a file of type:  xlsx.');
    }
    if($file){
      $path = $request->file('bulk_upload')->getRealPath();
      $data = Excel::load($path, function($reader) {
      })->get();
      if(!empty($data) && $data->count()){
        foreach ($data as $key => $value) {
          $product = ['product_family' => $value->product_family, 'company_id'=>$company_id];
          $addProduct=self::insertProduct($product);
          $sub_product = ['id'=>$addProduct->id,'product_type' => $value->product_detail,'sav' => $value->sav,'livraison' => $value->livraison,'livraison_montage' => $value->livraison_montage,'rétrocession' => $value->retrocession,'prestataire' => $value->livraison_prestataire,'montage' => $value->montage];
          $addProduct=self::insertSubProduct($sub_product);
        }
      }
    }
    return redirect::back()->with('message', 'Product has been uploaded Successfully');
  }
  public function destroySubProduct(Request $request)
  {
    $id=$request->id;
    $getStore=SubProduct::find($id);
    $getStore->delete();
    return redirect::back()->with('message', "Product Detail has been deleted Successfully");
  }
}
