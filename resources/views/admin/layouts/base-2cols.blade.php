@extends('admin.layouts.base')
{!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js') !!}
<?php
    if(isset($modal)) {
        echo '<script>$(document).ready(function () {$("#' . $modal . '").modal(\'show\');});</script>';
    }
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/admin/users/dashboard')}}"><img src="{{asset('assets/images')}}/logoTDF.png" class="img-responsive"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li><strong class="capitalize">{{$authUser->user_first_name}} {{$authUser->user_last_name}}</strong></li>
                <li><a href="{{route('user.logout')}}"><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a></li>
                <li><a href="#"><i class="fa fa-question-circle fa-fw"></i> Aide</a></li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Reglages</a></li>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{route('dashboard.default')}}">Gestion des vehicules <i class="fa fa-truck fa-fw"></i></a>
                        </li>
                        <li>
                            <a href="{{route('users.list')}}">Gestion des utilisateurs <i class="fa fa-user fa-fw"></i></a>
                        </li>
                        <li>
                            <a href="{{route('company.list')}}">Gestion des magasins <i class="fa fa-clipboard fa-fw"></i></a>
                        </li>
                        <li>
                            <a href="#">Gestion des livraisons <i class="fa fa-cubes fa-fw"></i></a>
                        </li>
                        <li>
                            <a href="#">Gestion des parametres <i class="fa fa-gear fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
