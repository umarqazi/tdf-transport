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
    <ul class="nav navbar-top-links navbar-left hide-menu">
      <li><a href="{{URL('/planDriverTour')}}" class="{{ request()->is('planDriverTour') ? 'active-link' : '' }}"><i class="fa fa-truck fa-fw"></i> Creation d'une Tournee</a></li>
      <li><a href="{{URL('/allDeliveryHistory')}}" class="{{ request()->is('allDeliveryHistory') ? 'active-link' : '' }}"><i class="fa fa-calendar fa-fw"></i> Historique des livraisons</a></li>
    </ul>
  @endif
  <ul class="nav navbar-top-links navbar-right hide-menu">
    <li><strong class="capitalize user-name">{{$authUser->user_first_name}} {{$authUser->user_last_name}} ({{Config::get('constants.User Type.'.$authUser->type)}})</strong></li>
    <li><a href="{{URL::to('/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a></li>
    @if($authUser->type==Config::get('constants.Users.TDF Manager'))
    <li><a href="#"><i class="fa fa-question-circle fa-fw"></i> Aide</a></li>
    @endif
  </ul>
  <!-- /.navbar-top-links -->
  <div class="navbar-default sidebar toggle-menu" role="navigation">
    <div class="sidebar-nav navbar-collapse">
      <ul class="nav" id="side-menu">
        @if($authUser->type==Config::get('constants.Users.TDF Manager'))
            <li>
              <a href="{{URL('/planDriverTour')}}" class="{{ request()->is('planDriverTour') ? 'active-link' : '' }}">
                <i class="fa fa-truck fa-fw"></i> Creation d'une Tournee</a>
            </li>
            <li>
              <a href="{{URL('/allDeliveryHistory')}}" class="{{ request()->is('allDeliveryHistory') ? 'active-link' : '' }}">
                <i class="fa fa-calendar fa-fw"></i> Historique des livraisons</a>
            </li>
        @endif

          <li>
            <a>
              <strong class="capitalize user-name">{{$authUser->user_first_name}} {{$authUser->user_last_name}} ({{$authUser->type}})</strong>
            </a>
          </li>
          <li>
            <a href="{{URL::to('/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a>
          </li>
          @if($authUser->type==Config::get('constants.Users.TDF Manager'))
            <li><a href="#"><i class="fa fa-question-circle fa-fw"></i> Aide</a></li>
          @endif
      </ul>
    </div>
    <!-- /.sidebar-collapse -->
  </div>
  <!-- /.navbar-static-side -->
</nav>
