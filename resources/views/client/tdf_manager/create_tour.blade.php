@extends('client.layouts.tdf-menu')

@section('title')
TDF Dashboard
@stop

@section('content')
@include('admin.popups.assign_deliveries')
<style>
.bs-placeholder{
  display: none;
}
</style>
{!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js') !!}
<?php
    if(isset($modal)) {
        echo '<script>$(document).ready(function () {$("#' . $modal . '").modal(\'show\');});</script>';
    }
?>
<div class="row">
  @include('toast::messages')
  <div class="clear20"></div>
  <div class="text-center page-header">CREATION D'UNE TOURNEE</div>
  <hr>

  <div class="col-lg-12">
    <div class="text-center page-icon">
      <div class="icon-wrapper"><i class="fa fa-truck fa-fw"></i></div>
    </div>
    <h2 class=" small-heading text-center">ETAPE 1: CHOIX DU VEHICULE</h2>
    <div class="text-center">
      <div class="form-inline" id="slect-wo">
        <select id='selUser' style="width:200px" onchange="getTours(this)">
          @foreach($drivers as $key=>$driver)
          <option value='{{$key}}' @if($user_id==$key) selected="selected" @endif>{{$driver}}</option>
          @endforeach
        </select>
      </div>
    </div>

  </div>
  <!-- /.col-lg-12 -->
</div>

<div class="clear20"></div>

<div class="row" id="showTour" @if(empty($toursList)) style="display:none" @endif>
  <div class="text-center page-icon">
    <div class="icon-wrapper"><i class="fa fa-calendar fa-fw"></i></div>
  </div>
  <h2 class=" small-heading text-center">ETAPE 2: CREATION DU PLANNING</h2>
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th class="text-center"><i class="fa fa-truck fa-fw"></i> @if($vehicle_info)<span class="capitalLetter"> {{$vehicle_info['vehicle_name']}} {{$vehicle_info['number_plate']}}</span> <span class="forname-capitalize">{{$vehicle_info['user_first_name']}} {{$vehicle_info['user_last_name']}}</span> @endif</span></th>
            <th colspan="2" class="text-center">{{$date}}</th>
          </tr>
        </thead>
        <tbody>
          <?php $number=1;?>
          @foreach($toursList as $key=>$tours)
            <?php if ($number % 2 == 0) {
                $color='blue-color';
              }else{
                $color='grey-color';
              }?>
            <tr>
              <td class="text-center" width="30%">{{$key}}</td>
              <td width="66%" class="text-style @if($tours['delivery']!=NULL) {{$color}} @endif" > @if($tours['delivery']!=NULL) {{$tours['delivery']}} @else <button class="btn btn-green" onclick="showDeliveries({{$tours['time_id']}})">Ajouter une livraison <i class="fa fa-plus-circle fa-fw"></i></button> @endif</td>
              <td class="text-center @if($tours['delivery']!=NULL)delete-column @endif">
                @if($tours['delivery']!=NULL) <a href="{{URL('/deleteTour', ['id'=>$tours['id']])}}" class="trash"><i class="fa fa-trash-o fa-fw"></i></a> @endif
              </td>
            </tr>
            <?php $number++; ?>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @if($tour_plan)
    <div class="col-md-12 text-center tbl-btns">
      <a href="{{url('/sendDriverEmail', ['id'=>$user_id])}}">Envoi du planning<br>aux chauffeurs <i class="fa fa-check-square"></i></a>
      <a href="#" class="active">Envoi du sms<br>aux clients <i class="fa fa-check-square"></i></a>
    </div>
  @endif
</div>
@stop
@section('footer_scripts')
<script>
$(".delete").click(function(){
  return confirm("Are you sure to delete this item?");
});
</script>
@stop
