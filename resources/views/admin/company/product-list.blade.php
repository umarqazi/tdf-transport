@extends('admin.layouts.base-2cols')

@section('title')
Admin area: Product List
@stop

@section('content')
@include('admin.popups.add-product')
<div id="page-wrapper">
  <div class="row">
    {{-- successful message --}}
    <?php $message = Session::get('message'); ?>
    @if( isset($message) )
    <div class="alert alert-success">{!! $message !!}</div>
    @endif
    @if($errors && ! $errors->isEmpty() )
    @foreach($errors->all() as $error)
    <div class="alert alert-danger">{!! $error !!}</div>
    @endforeach
    @endif
    <div class="col-lg-12">
      <div class="text-center page-icon">
        <div class="icon-wrapper"><i class="fa fa-truck fa-fw"></i></div>
      </div>
      <h1 class="page-header text-center">GESTION DES ENTREPRISE</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="sort">
        <button type="button" name="" class="active green button-styling" value='Ajouter une demande' data-toggle="modal" data-target="#addProduct">Ajouter un produit <i class="fa fa-plus-circle fa-fw"></i></button>
        <button type="file" name="" class="active green button-styling" value='Ajouter une demande' data-toggle="modal" data-target="#contactUsModal">Transfert groupé <i class="fa fa-plus-circle fa-fw"></i></button>
      </div>
    </div>
  </div>
  <div class="clear20"></div>
  <div class="row">
    <div class="col-md-12">
      <strong>Liste des vehicules enregistres</strong>
    </div>
  </div>
  <div class="clear20"></div>
  <div class="row">
    <!-- <div class="col-lg-3 col-md-3 col-sm-3">
    <label class="btn btn-default btn-info btn-file">
    Bulk upload <input type="file" style="display: none;">
  </label>
</div> -->
<div class="col-md-12">

  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Famille de produits</th>
          <th>Fonction de Produit</th>
          <th>Frais de livraison</th>
          <th>Commission</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @if(!empty($product))
        @foreach($product as $store)
        <tr>
          <td>{!! $store->product_family !!}</td>
          <td>{!! $store->product_type !!}</td>
          <td>{!! $store->delivery_charges !!}</td>
          <td>{!! $store->comission !!}</td>
          <td class="text-center actions">
            <a href="{{route('product.list', ['id'=>$store->company_id, 'product_id'=>$store->id])}}" class="edit"><i class="fa fa-edit fa-fw"></i></a>
            <a href="{!! URL::route('product.delete',['id' => $store->id, '_token' => csrf_token()]) !!}" class="trash delete"><i class="fa fa-trash-o fa-fw"></i></a>
          </td>
        </tr>
        @endforeach
        @else
        <tr>
          <td colspan="4">Records not found</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="contactUsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Excel File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(array('url' => URL::route("import"), 'method' => 'post', "enctype"=>"multipart/form-data") ) !!}
      <div class="modal-body">
        <div class="">
          <div class="">
            <label class="btn btn-default btn-info btn-file">
              Choose Excel File <input type="file" name="bulk_upload" style="display: none;">
            </label>
            {!! Form::hidden('company_id', $companyId) !!}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" value="Upload" class="btn btn-info">
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@stop

@section('footer_scripts')
<script>
$(".delete").click(function(){
  return confirm("Are you sure to delete this item?");
});
</script>
@stop
