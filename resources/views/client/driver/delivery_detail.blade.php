@extends('client.layouts.tdf-menu')

@section('title')
TDF Driver
@stop

@section('content')
@include('toast::messages')

    <span class="date_class">{{$date}}</span>
    <div class="row">
        <div class="col-md-12">

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tbody>
                          <tr>
                              <td width=30%><i class="fa fa-user fa-fw"></i> Coordonnees du client</td>
                              <td>
                                    <ul class="list-unstyled icons">
                                    <li><i class="fa fa-user fa-fw"></i>{{$detail['first_name']}}</li>
                                    <li>&nbsp;</li>
                                    <li>{{$detail['address']}}</li>
                                    <li>&nbsp;</li>
                                    <li><i class="fa fa-phone fa-fw"></i> {{$detail['mobile_number']}}</li>
                                    <li>&nbsp;</li>
                                    </ul>
                              </td>
                          </tr>
                          <tr>
                              <td><i class="fa fa-cubes fa-fw"></i> Informations dur la Livraison</td>
                              <td>
                                <ul class="list-unstyled icons">
                                  <li><strong>Commande n: </strong></li>
                                  <li>
                                    <div class="col-md-12 pdf-space">
                                      <a href="{{asset('assets/images')}}/{{$detail['store_name']}}/{{$detail['order_pdf']}}" target="_blank" id="OrderAddPdfLink"><i class="fa fa-2x fa-file-pdf-o"></i></a>
                                      <a href="{{asset('assets/images')}}/{{$detail['store_name']}}/{{$detail['order_pdf']}}" target="_blank" id="OrderAddPdfLink">{{$detail['order_id']}}</a></li>
                                    </div>
                                  <li>
                                  <li>&nbsp;</li>
                                  <li><strong>Bon de Livaraison: </strong></li>
                                  <li>
                                    <div class="col-md-12 pdf-space">
                                      <a href="{{asset('assets/images')}}/{{$detail['store_name']}}/{{$detail['delivery_pdf']}}" target="_blank" id="OrderAddPdfLink"><i class="fa fa-2x fa-file-pdf-o"></i></a>
                                      <a href="{{asset('assets/images')}}/{{$detail['store_name']}}/{{$detail['delivery_pdf']}}" target="_blank" id="OrderAddPdfLink">{{$detail['delivery_number']}}</a></li>
                                    </div>
                                  <li>
                                  <li>&nbsp;</li>
                                  <li><strong>Produit(s): </strong></li>
                                  <li>- {{($detail['product_type']==NULL)? 'Multi-produits':$detail['product_type']}}</li>
                                  <li>&nbsp;</li>
                                  <li><strong>Prestation(s): </strong></li>
                                  <li>- {{$detail['service']}}</li>
                                  <li>&nbsp;</li>
                                  <li><strong>Commentaire: </strong></li>
                                  <li>{{$detail['comment']}}</li>
                                </ul>
                              </td>
                          </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{!! Form::model(null, [ 'url' => URL::route('update.delivery.status'), "enctype"=>"multipart/form-data"] )  !!}
    <div class="clear20"></div>

    <div class="text-center">Signaler une anomalie</div>

    <div class="clear20"></div>

    <div class="text-center">
        <div class="form-inline">
            <select class="form-control" name="delivery_status">
                <option value="">Faire un choix</option>
                <option value="1">1. Client absent</option>
                <option value="2">2. Produit casse lors du transport / montage</option>
                <option value="3">3. Produit manquant / Livraison partielle</option>
                <option value="4">4. Rien a signaler</option>
            </select>
        </div>
    </div>

    <div class="clear20"></div>

    <div class="row">
        <div class="col-md-12 text-center">
            <div class="form-inline">
                  <label>Client Satisfait?</label>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" name="satisfy"> Oui
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="0" name="satisfy"> Non
                    </label>
                  </div>
            </div>
        </div>
    </div>

    <div class="clear20"></div>

    <div class="row">
        <div class="col-md-12 text-center tbl-btns tbl-btns-2">
            <button type="submit" class="active button-styling">Envoier les Informations <i class="fa fa-check-square"></i></button>
        </div>
    </div>
    {!! Form::hidden('id', $detail['id'], []) !!}
    {!! Form::close() !!}
    <div class="clear20"></div>

@stop
@section('footer_scripts')
<script>
$(".delete").click(function(){
  return confirm("Are you sure to delete this item?");
});
</script>
@stop
