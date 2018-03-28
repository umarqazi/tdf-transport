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

<div class="row">
  @include('toast::messages')
  <div class="clear20"></div>
  <div class="text-center">CREATION D'UNE TOURNEE</div>
  <hr>

  <div class="col-lg-12">
    <div class="text-center page-icon">
      <div class="icon-wrapper"><i class="fa fa-truck fa-fw"></i></div>
    </div>
    <h2 class="page-header small-heading text-center">ETAPE 1: CHOIX DU VEHICULE</h2>
    <div class="text-center">
      <div class="form-inline" id="slect-wo">
        <select id='selUser' style="width:200px" onchange="getTours(this)">
          @foreach($drivers as $key=>$driver)
          <option value='{{$key}}'>{{$driver}}</option>
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
  <h2 class="page-header small-heading text-center">ETAPE 2: CREATION DU PLANNING</h2>
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th class="text-center"><i class="fa fa-truck fa-fw"></i> <span class="capitalLetter">@if($vehicle_info){{$vehicle_info['vehicle_name']}} {{$vehicle_info['number_plate']}} {{$vehicle_info['user_first_name']}} {{$vehicle_info['user_last_name']}} @endif</span></th>
            <th colspan="2">{{$date}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($toursList as $key=>$tours)
            <tr>
              <td class="text-center" width="30%">{{$key}}</td>
              <td class="bg-grey" > @if($tours['delivery']!=NULL) {{$tours['delivery']}} @else <button class="btn btn-green" onclick="showDeliveries({{$tours['time_id']}})">Ajouter une livraison <i class="fa fa-plus-circle fa-fw"></i></button> @endif</td>
              <td class="text-center actions">
                @if($tours['delivery']!=NULL) <a href="{{URL('/deleteTour', ['id'=>$tours['id']])}}" class="trash"><i class="fa fa-trash-o fa-fw"></i></a> @endif
              </td>
            </tr>
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
