@extends('client.layouts.base')

@section('title')
TDF Transport
@stop

@section('content')
<div class="login-wrapper">
  <h1>Bienvenue sur la web application de la societe TDF Transport</h1>
  <div class="form-section">
    @include('toast::messages')
    {!! Form::model(null, [ 'url' => URL::route('user.login')] )  !!}
    <input type="text" name="email" class="fld" placeholder="Identifiant">
    <span class="text-danger">{!! $errors->first('email') !!}</span>
    <input type="password" name="password" class="fld" placeholder="Mot de passe">
    <button type="submit" class="submit-btn">CONNEXION <i class="fa fa-arrow-alt-circle-right"></i></button>
    <p class="forget-pass"><a onclick="showForgotPassword()">Mot de passe oublie?</a></p>
    {!! Form::close() !!}
  </div>
  <div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  <div class="hidden" id="forgotPassword">
  <h1>Entrez votre adresse email</h1>
  <div class="form-section">
    {!! Form::model(null, [ 'url' => URL::route('post.forgetPassword')] )  !!}
    <input type="text" name="email" class="fld" placeholder="Identifiant">
    <span class="text-danger">{!! $errors->first('email') !!}</span>
    <button type="submit" class="submit-btn">Envoyer un email<i class="fa fa-arrow-alt-circle-right"></i></button>
    {!! Form::close() !!}
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
