@extends('client.layouts.menu')

@section('title')
TDF Dashboard
@stop

@section('content')
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <div class="text-center page-icon">
        <div class="icon-wrapper"><i class="fa fa-truck fa-fw"></i></div>
      </div>
      <h1 class="page-header text-center">GESTION DES VEHICULES</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="sort">
        <div class="form-inline">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-truck fa-fw"></i></div>
              <input type="text" class="form-control" id="" placeholder="Fonction de Vehicule">
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="" placeholder="N* plaque d'immatriculation">
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-id-card fa-fw"></i></div>
              <input type="text" class="form-control" id="" placeholder="Prenom, Nom du chauffer">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="clear20"></div>
  <div class="row">
    <div class="col-md-12">
      <strong>Liste des vehicules enregistres</strong>
    </div>
  </div>
  <div class="clear20"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Fonction de vehicule</th>
              <th>Immatriculation</th>
              <th>Chauffeur</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>CAMION</td>
              <td>ZX-095-AB</td>
              <td>Julien Goncalves</td>
              <td class="text-center actions">
                <a href="#" class="edit"><i class="fa fa-edit fa-fw"></i></a>
                <a href="#" class="trash"><i class="fa fa-trash-o fa-fw"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
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
