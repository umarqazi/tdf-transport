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
    @if($store_info['store_logo'])
      <a class="navbar-brand" href="{{URL::to('/')}}"><img src="{{asset('assets/images')}}/{{$store_info['store_name']}}/{{$store_info['store_logo']}}" class="img-responsive"></a>
    @else
      <a class="navbar-brand" href="{{URL::to('/')}}"><img src="{{asset('assets/images')}}/logoTDF.png" class="img-responsive"></a>
    @endif
  </div>
  @if($authUser->type== Config::get('constants.Users.Manager'))
  <ul class="nav navbar-top-links navbar-left">
    <li><a href="{{URL('/')}}" class="{{ request()->is('dashboard') ? 'active-link' : '' }}"><i class="fa fa-home fa-fw"></i> Accueil</a></li>
    <li><a href="{{URL('/delivery')}}" class="{{ request()->is('delivery') ? 'active-link' : '' }}"><i class="fa fa-truck fa-fw"></i> Ajouter une livraison</a></li>
    <li><a href="{{URL('/history')}}" class="{{ request()->is('history') ? 'active-link' : '' }}"><i class="fa fa-calendar fa-fw"></i> Historique des livraisons</a></li>
  </ul>
  @endif
  <!-- /.navbar-header -->
  <ul class="nav navbar-top-links navbar-right">
    <li><strong class="capitalize user-name">{{$authUser->user_first_name}} {{$authUser->user_last_name}} ({{$store_info['store_name']}})</strong></li>
    <li><a href="{{URL::to('/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a></li>
    <li><a href="#"><i class="fa fa-question-circle fa-fw"></i> Aide</a></li>
  </ul>
</nav>
