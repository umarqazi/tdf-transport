@extends('admin.layouts.base-2cols')

@section('title')
  Admin area: users list
@stop

@section('content')
  @include('admin.popups.add-store')
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
        <a class="btn btn-success back-button" href="{{route('company.list')}}"><i class="fa fa-arrow-circle-left"></i> Retour</a>
      </div>

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
          <button type="button" name="" class="active green button-styling" value='Ajouter une demande' data-toggle="modal" data-target="#addStore">Ajouter un magasin <i class="fa fa-plus-circle fa-fw"></i></button>
        </div>
      </div>
    </div>
    <div class="clear20"></div>
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard.default')}}">Tableau de bord</a></li>
          <li class="breadcrumb-item"><a href="{{route('company.list')}}">Compagnie</a></li>
          <li class="breadcrumb-item active">{{$company->company_name}}</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <strong>Liste des magasins</strong>
        <span class="companyName">
        {{$company->company_name}}
      </span>
      </div>
    </div>
    <div class="clear20"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          @if(! $stores->isEmpty() )
            <table class="table table-striped table-bordered">
              <thead>
              <tr>
                <th>Magasin</th>
                <th>E-mail</th>
                <th>Téléphone</th>
                <th class="hidden-xs">Adresse</th>
                <th class="hidden-xs">Ville</th>
                <th>Code postal</th>
                <th>Employés</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
              @foreach($stores as $store)
                <tr>
                  <td>{!! $store->store_name !!}</td>
                  <td>{!! $store->email !!}</td>
                  <td>{!! $store->phone_number !!}</td>
                  <td class="hidden-xs">{!! $store->address !!}</td>
                  <td class="hidden-xs">{!! $store->city !!}</td>
                  <td class="hidden-xs">{!! $store->zip_code !!}</td>
                  <td align="center"><a class="btn btn-primary" href="{{route('employees', ['storeId'=>$store->id])}}">Voir</a></td>
                  <td class="actions" align="center">
                    @if(! $store->protected)
                      <a href="{!! URL::route('store.list', ['id' => $companyId, 'store_id' => $store->id]) !!}" title="Edit Store" class="edit"><i class="fa fa-edit fa-fw"></i></a>
                      <a href="{!! URL::route('store.delete',['id' => $store->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete trash delete_store" title="Delete Store"><i class="fa fa-trash-o fa-fw"></i></a>

                    @else
                      <i class="fa fa-times fa-2x light-blue"></i>
                      <i class="fa fa-times fa-2x margin-left-12 light-blue"></i>
                    @endif
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <div class="paginator">
              {!! $stores->links() !!}
            </div>
          @else
            <span class="text-warning"><h5>Désolé aucun magasin n'a été trouvé.</h5></span>
          @endif
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
