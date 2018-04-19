@extends('admin.layouts.base-2cols')

@section('title')
  Admin area: Company list
@stop

@section('content')
  @include('admin.popups.add-company-popup')
  <div id="page-wrapper">
    <div class="row">
      {{-- successful message --}}
        <?php $message = Session::get('message'); ?>
      @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
      @endif
      @if($errors->has('model') )
        <div class="alert alert-danger">{!! $errors->first('model') !!}</div>
      @endif
      <div class="col-lg-12">
        <div class="text-center page-icon">
          <div class="icon-wrapper"><i class="fa fa-building fa-fw"></i></div>
        </div>
        <h1 class="page-header text-center">GESTION DES MAGASINS</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="sort">
          <button type="button" name="" class="active green button-styling" value='Ajouter une demande' data-toggle="modal" data-target="#addCompany">Ajouter une société <i class="fa fa-plus-circle fa-fw"></i></button>
        </div>
      </div>
    </div>
    <div class="clear20"></div>
    <div class="row">
      <div class="col-md-12">
        <strong>Liste des sociétés </strong>
      </div>
    </div>
    <div class="clear20"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
            <tr>
              <th>Nom de la compagnie</th>
              <th>Magasins</th>
              <th>Des produits</th>
              <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($stores))
              @foreach($stores as $store)
                <tr>
                  <td>{!! $store->company_name !!}</td>
                  <td align="center">
                    <a href="{!! URL::route('store.list', ['companyId' => $store->id]) !!}" title="Add Employee" class="btn btn-primary">Voir les magasins</a> &nbsp;
                  </td>
                  <td align="center">
                    <a href="{!! URL::route('product.list', ['companyId' => $store->id]) !!}" title="Add Employee" class="btn btn-primary">Voir les produits</a> &nbsp;
                  </td>
                  <td class="text-center actions">
                    <a href="{{route('company.list', ['id'=>$store->id])}}" class="edit"><i class="fa fa-edit fa-fw"></i></a>
                    <a href="{!! URL::route('company.delete',['id' => $store->id, '_token' => csrf_token()]) !!}" class="trash delete delete_company"><i class="fa fa-trash-o fa-fw"></i></a>
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
@stop

@section('footer_scripts')
  <script>
      $(".delete").click(function(){
          return confirm("Are you sure to delete this item?");
      });
  </script>
@stop
