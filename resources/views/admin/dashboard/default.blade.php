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
        @if($errors->has('model') )
            <div class="alert alert-danger">{!! $errors->first('model') !!}</div>
        @endif
        <div class="col-lg-12">
            <div class="text-center page-icon">
                <div class="icon-wrapper"><i class="fa fa-truck fa-fw"></i></div>
            </div>
            <h1 class="page-header text-center">GESTION DES VEHICULES</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 frm-title-icon"><a href="#">A Jout Rapide <i class="fa fa-plus-circle fa-fw"></i></a></div>
        <div class="col-md-12">
            <div class="sort">
                <button type="button" name="" class="active green button-styling" value='Ajouter une demande' data-toggle="modal" data-target="#addVehicle">Ajounter un vehicule <i class="fa fa-plus-circle fa-fw"></i></button>
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
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="users-table">
                            <thead>
                                <tr>
                                    <th>Type de vehicule</th>
                                    <th>Numero plaque d'immatriculation</th>
                                    <th>Chauffeur</th>
                                    <th>Email</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
@stop