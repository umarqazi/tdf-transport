@extends('client.layouts.menu')

@section('title')
    TDF History
@stop

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header text-center">HISTORIQUE DES LIVRAISONS</h1>
    </div>
    <div class="col-lg-12 calendar-control">
        <div class="form-inline">
            <div class="form-group">
                <label>Du</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="">
                    <div class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></div>
                </div>
            </div>
            <div class="form-group">
                <label>Au</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="">
                    <div class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th class="text-center">Date de la livraison</th>
                        <th class="text-center">Client</th>
                        <th class="text-center">Numero de commande</th>
                        <th class="text-center">Numero du bon de livraison</th>
                        <th class="text-center">Telephone</th>
                        <th class="text-center">Villes</th>
                        <th class="text-center">Code Postal</th>
                        <th class="text-center">Type de Prestation</th>
                        <th class="text-center">Produit(s) commande(s)</th>
                        <th class="text-center">Prix de la livraison</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>28/02/2018</td>
                        <td>DUPOND</td>
                        <td>23465</td>
                        <td>12459</td>
                        <td>01 08 02 87 27</td>
                        <td>SAINT-DENIS</td>
                        <td>93000</td>
                        <td>Livraison</td>
                        <td>Electromenager</td>
                        <td>79€</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center tbl-btns">
        <a href="{{URL('/exportHistory')}}" class="active">Telecharger I'historique<br>des livraisons <i class="fa fa-print"></i></a>
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