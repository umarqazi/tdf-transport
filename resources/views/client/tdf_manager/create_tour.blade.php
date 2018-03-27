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

<div class="row" id="showTour" style="display:none">
  <div class="text-center page-icon">
    <div class="icon-wrapper"><i class="fa fa-calendar fa-fw"></i></div>
  </div>
  <h2 class="page-header small-heading text-center">ETAPE 2: CREATION DU PLANNING</h2>
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th class="text-center"><i class="fa fa-truck fa-fw"></i> CAMION - zx-095-AB, Julien GONGALVES</th>
            <th colspan="2">Mercredi 28 Fevrier 2018</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">8h - 10h</td>
            <td class="bg-grey">Commande n 13546 - 28/2/2018 - Matin - SAINT DENIS - 93000 - Montage - Literie</td>
            <td class="text-center actions">
              <a href="#" class="trash"><i class="fa fa-trash-o fa-fw"></i></a>
            </td>
          </tr>
          <tr>
            <td class="text-center">10h - 12h</td>
            <td colspan="2" class="text-center">
              <button class="btn btn-green" onclick="showDeliveries('2')">Ajouter une livraison <i class="fa fa-plus-circle fa-fw"></i></button>
            </td>
          </tr>
          <tr>
            <td class="text-center">12h - 14h</td>
            <td class="bg-grey">Commande n 13546 - 28/2/2018 - Matin - SAINT DENIS - 93000 - Montage - Literie</td>
            <td class="text-center actions">
              <a href="#" class="trash"><i class="fa fa-trash-o fa-fw"></i></a>
            </td>
          </tr>
          <tr>
            <td class="text-center">14h - 16h</td>
            <td class="bg-grey">Commande n 13546 - 28/2/2018 - Matin - SAINT DENIS - 93000 - Montage - Literie</td>
            <td class="text-center actions">
              <a href="#" class="trash"><i class="fa fa-trash-o fa-fw"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-12 text-center tbl-btns">
    <a href="#">Envoi du planning<br>aux chauffeurs <i class="fa fa-check-square"></i></a>
    <a href="#" class="active">Envoi du sms<br>aux clients <i class="fa fa-check-square"></i></a>
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
