@extends('client.layouts.base')

@section('title')
TDF Transport
@stop

@section('content')
<div class="login-wrapper">
  <h1>Bienvenue sur la web application de la société TDF Transport</h1>
  <div class="form-section">
    @include('toast::messages')
    {!! Form::model(null, [ 'url' => URL::route('user.login')] )  !!}
    <input type="text" name="email" class="fld" placeholder="Identifiant">
    <span class="text-danger">{!! $errors->first('email') !!}</span>
    <input type="password" name="password" class="fld" placeholder="Mot de passe">
    <button type="submit" class="submit-btn">CONNEXION <i class="fa fa-arrow-alt-circle-right"></i></button>
    <p class="forget-pass"><a data-toggle="modal" data-target="#forgotPassword">Mot de passe oublié ?</a></p>
    {!! Form::close() !!}
  </div>
  <div class="modal" id="forgotPassword" tabindex="-1" role="dialog">
  <div class="modal-dialog forgotPassword" role="document">
    <div class="modal-content">
      <div class="modal-header remove-border">
        <h5 class="modal-title modal-title">Entrez votre adresse email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body body-space">
        <div class="form-section">
          {!! Form::model(null, [ 'url' => URL::route('post.forgetPassword')] )  !!}
          <input type="text" name="email" class="fld forgetPassword-field" placeholder="Identifiant">
          <span class="text-danger">{!! $errors->first('email') !!}</span>
          <button type="submit" class="submit-btn">Envoyer<i class="fa fa-arrow-alt-circle-right"></i></button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@stop

@section('footer_scripts')
@stop
