@extends('client.layouts.base')

@section('title')
TDF Transport
@stop

@section('content')

<div class="login-wrapper">
  <h1>Changez votre mot de passe</h1>
  <div class="form-section">
    @include('toast::messages')
    {!! Form::model(null, [ 'url' => URL::route('post.change.password')] )  !!}
    <input type="hidden" name="token" class="fld" value="{{$token}}" placeholder="Password">
    <input type="password" name="password" class="fld" placeholder="Password">
    <span class="text-danger">{!! $errors->first('password') !!}</span>
    <input type="password" name="password_confirmation" class="fld" placeholder="Confirm Password">
    <button type="submit" class="submit-btn">changer le mot de passe<i class="fa fa-arrow-alt-circle-right"></i></button>
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
