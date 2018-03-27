@extends('client.layouts.base')

@section('title')
TDF Transport
@stop

@section('content')

<div class="login-wrapper">
  <h1>Entrez votre adresse email</h1>
  @include('toast::messages')
  <div class="form-section">
    {!! Form::model(null, [ 'url' => URL::route('post.forgetPassword')] )  !!}
    <input type="text" name="email" class="fld" placeholder="Email">
    <span class="text-danger">{!! $errors->first('email') !!}</span>
    <button type="submit" class="submit-btn">Envoyer un email<i class="fa fa-arrow-alt-circle-right"></i></button>
    {!! Form::close() !!}
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
