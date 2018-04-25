@extends('client.layouts.menu')

@section('title')
    TDF Create Delivery
@stop

@section('content')
<div class="besoin-block">
    <h2>Besoin d'aide ?</h2>
    <p>En cas de problème vous pouvez contacter la société TDF Transport, en cliquant sur le bouton ci-dessous.</p>
    <a href="mailto:contact@tdf-transport.com" class="blue-btn">Cliquez ici</a>
    <ul class="footer-links aid-company">
      <li><i class="fa fa-map-marker"></i> 20 rue de Moreau - 75012 PARIS</li>
      <li><i class="fa fa-phone"></i> 09 80 57 19 92</li>
      <li><i class="fa fa-envelope"></i> <a href="mailto: contact@tdf-transport.com">contact@tdf-transport.com</a> </li>
    </ul>
</div>
<div class="col-lg-12 text-center">
  <a href="{{url('/dashboard')}}" class="back-button retour-btn"><i class="fa fa-arrow-circle-left"></i> Retour</a>
</div>
    <div class="aide-footer">
        © 2018 | Web Application de livraisons V1.0 | by annei
    </div>
@stop
@section('footer_scripts')

@stop
