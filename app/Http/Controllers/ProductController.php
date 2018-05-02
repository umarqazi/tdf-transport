<?php

namespace LaravelAcl\Http\Controllers;

use LaravelAcl\Company;
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
    public function index(Request $request)
    {
        $name=$request->input('name');
        $id=$request->product_id;
        $companyId=$request->companyId;
        $company = Company::find($companyId);
        $modal='';
        if($name)
        {
            $product=Product::where('product_family', 'like', '%'.$name.'%')->where('company_id', $companyId)->paginate(10);
        }
        else
        {
            $product=Product::where('company_id', $companyId)->with('subProducts')->orderBy('id', 'desc')->paginate(10);
        }
        if($id){
            $newProduct=SubProduct::leftJoin('products', 'sub_products.product_id', '=', 'products.id')->find($id);
            $modal="addProduct";
        }else{
            $newProduct=New Product;
        }
        return view::make('admin.company.product-list')->with(['modal'=>$modal,'newProduct'=>$newProduct,'product'=> $product, 'request'=>$request, 'companyId'=>$companyId, 'company' =>$company]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_family' => 'required',
            'product_type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $message="Les informations sur le produit ont été enregistrées.";
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
    public function destroy(Request $request)
    {
        $id=$request->id;
        $getStore=Product::find($id);
        $getStore->delete();
        return redirect::back()->with('message', "Le produit a été supprimé avec succès");
    }
    public function importExport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bulk_upload' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $file=$request->bulk_upload;
        $company_id=$request->company_id;
        $extension=$file->getClientOriginalExtension();
        if(!in_array($extension, ['xlsx','xls']))
        {
            return redirect::back()
                ->withErrors('Le transfert groupé doit être un fichier de type: xlsx.');
        }
        if($file){
            $path = $request->file('bulk_upload')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                  if($value->famille_de_produits){
                    $product = ['product_family' => $value->famille_de_produits, 'company_id'=>$company_id];
                    $addProduct=self::insertProduct($product);
                    $sub_product = ['id'=>$addProduct->id,'product_type' => $value->produits,'sav' => $value->sav,'livraison' => $value->livraison,'livraison_montage' => $value->livraison_montage,'rétrocession' => $value->retrocession,'prestataire' => $value->livraison_prestataire,'montage' => $value->montage];
                    $addProduct=self::insertSubProduct($sub_product);
                  }
                }
            }
        }
        return redirect::back()->with('message', 'La liste de produit a bien été importée.');
    }
    public function destroySubProduct(Request $request)
    {
        $id=$request->id;
        $getStore=SubProduct::find($id);
        $getStore->delete();
        return redirect::back()->with('message', "Le détail du produit a été supprimé avec succès");
    }

    public function exportProducts($id){
        $company = Company::find($id);
        $products = Product::with('subProducts')->where('company_id',$id)->get()->toArray();
        $allProduct=array();
        foreach ($products as $key=>$product){
            foreach ($product['sub_products'] as $key2=>$subProduct){
                $allProduct[]=['Product Family'=>$product['product_family'], 'Type'=>$subProduct['product_type'], 'SAV'=>$subProduct['sav'], 'livraison'=>$subProduct['livraison'],'livraison_montage'=>$subProduct['livraison_montage'],'rétrocession'=>$subProduct['rétrocession'],'prestataire'=>$subProduct['prestataire'],'montage'=>$subProduct['montage']];
            }
        }
        return \Excel::create($company->company_name, function($excel) use ($allProduct , $company) {

            $excel->sheet($company->company_name, function($sheet) use ($allProduct)
            {
                $sheet->fromArray($allProduct);

            });

        })->download('xlsx');
    }
}
