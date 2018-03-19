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
                <input type="text" name="email" class="fld" placeholder="Name">
                <span class="text-danger">{!! $errors->first('email') !!}</span>
                <input type="password" name="password" class="fld" placeholder="Password">
                <button type="submit" class="submit-btn">CONNEXION <i class="fa fa-arrow-alt-circle-right"></i></button>
                <p class="forget-pass"><a href="{{route('forgetPassword')}}">Mot de passe oublie?</a></p>
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