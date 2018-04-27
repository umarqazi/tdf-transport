@extends('client.layouts.base')

@section('title')
TDF Transport
@stop

@section('content')
<div class="login-wrapper">
  <h1 class="thankyou_heading">Merci, votre avis a été pris en compte</h1>
  <h3>Merci de votre participation</h3>
</div>
<script> setTimeout(function(){window.location=APP_URL}, 4000); </script>
@stop

@section('footer_scripts')
@stop
