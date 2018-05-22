@extends('admin.layouts.base-2cols')

@section('title')
Admin area: dashboard
@stop

@section('content')
@include('admin.popups.add-vehicle-popup')
<div id="page-wrapper">
    <div class="row">
        {{-- successful message --}}
        <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
        <div class="col-lg-12">
            <div class="text-center page-icon">
                <div class="icon-wrapper"><i class="fa fa-truck fa-fw"></i></div>
            </div>
            <h1 class="page-header text-center">GESTION DES VEHICULES</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="sort">
                <button type="button" name="" class="active green button-styling" value='Ajouter une demande' data-toggle="modal" data-target="#addVehicle">Ajouter un véhicule <i class="fa fa-plus-circle fa-fw"></i></button>
            </div>
        </div>
    </div>

            <div class="clear20"></div>
            <div class="row">
                <div class="col-md-12">
                    <strong>Liste des véhicules enregistrés</strong>
                </div>
            </div>
            <div class="clear20"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="users-table">
                            <thead>
                                <tr>
                                    <th>Type de véhicule</th>
                                    <th>Immatriculation</th>
                                    <th>Chauffeur</th>
                                    <th>Email</th>
                                    <th>Téléphone fixe</th>
                                    <th>Téléphone mobile</th>
                                    <th>Statut</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($drivers as $driver)
                                <tr>
                                    <td>{{$driver['vehicle_name']}}</td>
                                    <td>{{$driver['number_plate']}}</td>
                                    <td>{{$driver['user_first_name']}} {{$driver['user_last_name']}}</td>
                                    <td>{{$driver['email']}}</td>
                                    <td>{{$driver['phone_number']}}</td>
                                    <td>{{$driver['mobile_number']}}</td>
                                    <td align="center">@if($driver['activated']==1) <i class="fa fa-circle green-color2"></i> @else <i class="fa fa-circle red-color2"></i> @endif</td>
                                    <td class="text-center actions">
                                        <a href="{{route('dashboard.default', ['id'=>$driver->id])}}" class="edit"><i class="fa fa-edit fa-fw"></i></a>
                                        <a href="{!! URL::route('users.delete',['id' => $driver->id, '_token' => csrf_token()]) !!}" class="trash delete"><i class="fa fa-trash-o fa-fw"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
<script>
$(".delete").click(function(){
	return confirm("Voulez-vous vraiment supprimer ce véhicule ?");
});
</script>
@stop
