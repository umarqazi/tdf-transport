@extends('client.layouts.base-fullscreen')
@include('client.cashier.search-popup')
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{URL::to('/')}}"><img src="{{asset('assets/images')}}/{{$store_info['store_name']}}/{{$store_info['store_logo']}}" class="img-responsive"></a>
  </div>
  @if($authUser->type== Config::get('constants.Users.Manager'))
  <ul class="nav navbar-top-links navbar-left">
    <li><a href="{{URL('/')}}"><i class="fa fa-home fa-fw"></i> Accueil</a></li>
    <li><a href="{{URL('/delivery')}}"><i class="fa fa-car fa-fw"></i> Ajouter une livraison</a></li>
    <li><a href="{{URL('/history')}}"><i class="fa fa-calendar fa-fw"></i> Historique des livraisons</a></li>
  </ul>
  @endif
  <!-- /.navbar-header -->
  <ul class="nav navbar-top-links navbar-right">
    <li><strong>{{$authUser->user_first_name}} {{$authUser->user_last_name}} ({{$store_info['store_name']}})</strong></li>
    <li><a href="{{URL::to('/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a></li>
    <li><a href="#"><i class="fa fa-question-circle fa-fw"></i> Aide</a></li>
    @if($authUser->type!= Config::get('constants.Users.Manager'))
    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Reglages</a></li>
    @endif
  </ul>
  <!-- /.navbar-top-links -->

  <!-- /.navbar-static-side -->
</nav>
