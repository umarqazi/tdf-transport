@extends('admin.layouts.base-2cols')

@section('title')
  Admin area: Employees list
@stop

@section('content')
  @include('admin.popups.add-employee')
  <div id="page-wrapper">
    <div class="row">
      {{-- successful message --}}
        <?php $message = Session::get('message'); ?>
      @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
      @endif
      <div class="col-lg-12">
        <a class="btn btn-success back-button" href="{{URL::previous()}}"><i class="fa fa-arrow-circle-left"></i> Retour</a>

        <div class="text-center page-icon">
          <div class="icon-wrapper"><i class="fa fa-users fa-fw"></i></div>
        </div>
        <h1 class="page-header text-center">GESTION DES EMPLOYÉS</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="sort">
          <button type="button" name="" class="active green button-styling" value='Ajouter une demande' data-toggle="modal" data-target="#addEmployee">Ajouter un employé <i class="fa fa-plus-circle fa-fw"></i></button>
        </div>
      </div>
    </div>
    <div class="clear20"></div>
    <div class="row">
      <div class="col-md-12">
        <strong>Liste des employés</strong>
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
              <th>Nom du magasin</th>
              <th>Nom</th>
              <th>E-mail</th>
              <th> Téléphone : mobile</th>
              <th>Téléphone fixe</th>
              <th>Fonction</th>
              <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($employees))
              @foreach($employees as $employee)
                <tr>
                  <td>{!! $employee->store_name !!}</td>
                  <td>{!! $employee->name !!}</td>
                  <td>{!! $employee->email_address !!}</td>
                  <td>{!! $employee->mobile_number !!}</td>
                  <td class="hidden-xs">{!! $employee->landline !!}</td>
                  <td class="hidden-xs">{!! $employee->type !!}</td>
                  <td class="text-center actions">
                    <a href="{{route('employees', ['id'=>$employee->store_id, 'product_id'=>$employee->id])}}" class="edit"><i class="fa fa-edit fa-fw"></i></a>
                    <a href="{!! URL::route('employee.delete',['id' => $employee->id, '_token' => csrf_token()]) !!}" class="trash delete"><i class="fa fa-trash-o fa-fw"></i></a>
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
