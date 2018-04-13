@extends('client.layouts.tdf-menu')

@section('title')
    TDF Driver
@stop

@section('content')
    @include('toast::messages')

    <span class="date_class">{{$date}} ({{$time}})</span>
    <div class="row">
        <div class="col-md-12">
            <div class="user-row">
                <i class="fa fa-user fa-fw"></i> Coordonnées du client
            </div>

            <div class="user-row">
                <ul class="list-unstyled icons driver-detail">
                    <li><i class="fa fa-user fa-fw"></i>{{$detail['first_name']}} {{$detail['last_name']}}</li>
                    <li>&nbsp;</li>
                    <li>{{$detail['address']}}</li>
                    <li>&nbsp;</li>
                    <li>{{$detail['postal_code']}} {{$detail['city']}}</li>
                    <li>&nbsp;</li>
                    <li><i class="fa fa-phone fa-fw"></i> {{$detail['mobile_number']}}</li>
                </ul>
            </div>

            <div class="user-row">
                <i class="fa fa-cubes fa-fw"></i> Informations sur la livraison
            </div>

            <div class="user-row">
                <ul class="list-unstyled icons driver-detail">

                    <div class="col-xs-6">
                        <li><strong>Commande N° : </strong></li>
                        <li>
                            <a href="{{asset('assets/images')}}/{{$detail['store_name']}}/{{$detail['order_pdf']}}" target="_blank" id="OrderAddPdfLink"><i class="fa fa-2x fa-file-pdf-o pdf-font"></i></a>
                            <a href="{{asset('assets/images')}}/{{$detail['store_name']}}/{{$detail['order_pdf']}}" target="_blank" id="OrderAddPdfLink">{{$detail['order_id']}}</a>
                        </li>
                        <li>&nbsp;</li>
                        <li><strong>Bon de livraison : Pdf </strong></li>
                        <li>

                            <a href="{{asset('assets/images')}}/{{$detail['store_name']}}/{{$detail['delivery_pdf']}}" target="_blank" id="OrderAddPdfLink"><i class="fa fa-2x fa-file-pdf-o pdf-font"></i></a>
                            <a href="{{asset('assets/images')}}/{{$detail['store_name']}}/{{$detail['delivery_pdf']}}" target="_blank" id="OrderAddPdfLink">{{$detail['delivery_number']}}</a>
                        </li>
                    </div>

                    <div class="col-xs-6">
                        <li><strong>Produit(s): </strong></li>
                        <li>- {{($detail['product_type']==NULL)? 'Multi-produits':$detail['product_type']}}</li>
                        <li>&nbsp;</li>
                        <li><strong>Prestation(s): </strong></li>
                        <li>- {{$detail['service']}}</li>
                        <li>&nbsp;</li>
                        <li><strong>Commentaire: </strong></li>
                        <li>{{$detail['comment']}}</li>
                    </div>
                </ul>
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
                <div class="checkbox driver-detail-checkbox">
                    <label>
                        <input type="checkbox" value="1" name="satisfy"> Oui
                    </label>
                </div>
                <div class="checkbox driver-detail-checkbox">
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
            <button type="submit" class="active button-styling">Envoyer les informations <i class="fa fa-check-square"></i></button>
            <a href="{{url('/driverTours')}}" class="btn btn-primary cancel-request">Retour <i class="fa fa-arrow-left"></i></a>
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
