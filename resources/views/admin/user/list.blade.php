@extends('admin.layouts.base-2cols')

@section('title')
Admin area: User Management
@stop

@section('content')
@include('admin.popups.add-popup')
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
        <div class="icon-wrapper"><i class="fa fa-users"></i></div>
      </div>
      <h1 class="page-header text-center">Gestion des utilisateurs </h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="sort">
        <button type="button" name="" class="active green button-styling" value='Ajouter une demande' data-toggle="modal" data-target="#addUser">Ajouter un utilisateur <i class="fa fa-plus-circle fa-fw"></i></button>
      </div>
    </div>
  </div>
  <div class="clear20"></div>
  <div class="row">
    <div class="col-md-12">
      <strong>Liste des utilisateurs</strong>
    </div>
  </div>
  <div class="clear20"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Prénom</th>
              <th>Fonction</th>
              <th>Store Name</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($users))
            @foreach($users as $key=>$user)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->user_first_name}} {{$user->user_last_name}}</td>
              <td>{{$user->type}}</td>
              <td>
                @if($user->store_id)
                  {{\LaravelAcl\Store::find($user->store_id)->pluck('store_name')->first()}}
                @else
                  ---
                @endif
              </td>

              <td class="text-center actions">
                <a href="{{route('users.list', ['id'=>$user->id])}}" class="edit"><i class="fa fa-edit fa-fw"></i></a>
                <a href="{!! URL::route('users.delete',['id' => $user->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete trash delete_user"><i class="fa fa-trash-o fa-fw"></i></a>
              </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="5">Records not found!</td>
            </tr>
            @endif
          </tbody>
        </table>
        <div class="paginator">
          {!! $users->appends($request->except(['page']) )->render() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@stop
