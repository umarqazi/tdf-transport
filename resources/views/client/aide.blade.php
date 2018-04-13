@extends('client.layouts.menu')

@section('title')
    TDF Create Delivery
@stop

@section('content')
<div class="besoin-block">
    <h2>Besoin d'aide ?</h2>
    <p>En cas de problème vous pouvez contacter la société TDF Transport, en cliquant sur le bouton ci-dessous.</p>
    <a href="mailto:contact@tdf-transport.com" class="blue-btn">Cliquez</a>
</div>
<div class="col-lg-12 text-center">
  <a href="{{url('/dashboard')}}" class="back-button">Retour <i class="fa fa-arrow-circle-left"></i></a>
</div>
    <div class="aide-footer">
        © 2018 | Web Application de livraisons V1.0 | by annie
    </div>
@stop
@section('footer_scripts')

@stop
