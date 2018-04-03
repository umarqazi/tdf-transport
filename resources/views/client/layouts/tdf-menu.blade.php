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

    <a class="navbar-brand" href="{{($authUser->type==Config::get('constants.Users.TDF Manager'))? URL::to('/allDeliveryHistory'):URL::to('/driverTours')}}"><img src="{{asset('assets/images')}}/logoTDF.png" class="img-responsive"></a>
  </div>
  <!-- /.navbar-header -->
  @if($authUser->type==Config::get('constants.Users.TDF Manager'))
    <ul class="nav navbar-top-links navbar-left">
      <li><a href="{{URL('/planDriverTour')}}"><i class="fa fa-truck fa-fw"></i> Creation d'une Tournee</a></li>
      <li><a href="{{URL('/allDeliveryHistory')}}"><i class="fa fa-calendar fa-fw"></i> Historique des livraisons</a></li>
    </ul>
  @endif
  <ul class="nav navbar-top-links navbar-right">
    <li><strong class="capitalize user-name">{{$authUser->user_first_name}} {{$authUser->user_last_name}} ({{$authUser->type}})</strong></li>
    <li><a href="{{URL::to('/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a></li>
    <li><a href="#"><i class="fa fa-question-circle fa-fw"></i> Aide</a></li>
  </ul>
  <!-- /.navbar-top-links -->

  <!-- /.navbar-static-side -->
</nav>
