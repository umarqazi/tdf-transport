@extends('admin.layouts.base-2cols')

@section('title')
    Admin area: users list
@stop

@section('content')
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
                <div class="icon-wrapper"><i class="fa fa-truck fa-fw"></i></div>
            </div>
            <h1 class="page-header text-center">GESTION DES MAGASIN</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="sort">
                <button type="button" name="" class="active green button-styling" value='Ajouter une demande' data-toggle="modal" data-target="#addCompany">Ajounter un magasin <i class="fa fa-plus-circle fa-fw"></i></button>
            </div>
        </div>
    </div>
    <div class="clear20"></div>
    <div class="row">
        <div class="col-md-12">
            <strong>Liste des magasins</strong>
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
                              <th>Nom du magasin</th>
                              <th>Email</th>
                              <th>Numéro de téléphone</th>
                              <th class="hidden-xs">Address</th>
                              <th class="hidden-xs">City</th>
                              <th>Zip Code</th>
                              <th>Employees</th>
                              <th>Operations</th>
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
                              <td><a class="btn btn-primary" href="{{route('employees', ['storeId'=>$store->id])}}">View Employees</a></td>
                              <td class="actions">
                                  @if(! $store->protected)
                                      <a href="{!! URL::route('add.employee', ['storeId' => $store->id]) !!}" title="Add Employee"><i class="fa fa-plus fa-2x"></i></a> &nbsp;
                                      <a href="{!! URL::route('store.update', ['id' => $store->id]) !!}" title="Edit Store" class="edit"><i class="fa fa-edit fa-fw"></i></a>
                                      <a href="{!! URL::route('store.delete',['id' => $store->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete trash" title="Delete Store"><i class="fa fa-trash-o fa-fw"></i></a>

                                  @else
                                      <i class="fa fa-times fa-2x light-blue"></i>
                                      <i class="fa fa-times fa-2x margin-left-12 light-blue"></i>
                                  @endif
                              </td>
                          </tr>
                      </tbody>
                      @endforeach
              </table>
              <div class="paginator">
                  {!! $stores->links() !!}
              </div>
              @else
                  <span class="text-warning"><h5>No results found.</h5></span>
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