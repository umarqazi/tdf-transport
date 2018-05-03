@extends('admin.layouts.base-2cols')

@section('title')
    Admin area: Livraison
@stop

@section('content')
    <div id="page-wrapper">
        <div class="row">
            @include('toast::messages')
            {{-- successful message --}}
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
                <div class="alert alert-success">{!! $message !!}</div>
            @endif
            <div class="col-lg-12">
                <div class="text-center page-icon">
                    <div class="icon-wrapper"><i class="fa fa-truck fa-fw"></i></div>
                </div>
                <h1 class="page-header text-center">GESTION DES LIVRAISONS</h1>
            </div>
        </div>

        <div class="clear20"></div>
        <div class="row">
        </div>
        <div class="clear20"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="users-table">
                        <thead>
                        <tr>
                            <th class="text-center vertical-middle">Date de la livraison</th>
                            <th class="text-center vertical-middle">Client</th>
                            <th class="text-center vertical-middle">E-mail</th>
                            <th class="text-center vertical-middle">Numéro de commande</th>
                            <th class="text-center vertical-middle">Numéro du bon de livraison</th>
                            <th class="text-center vertical-middle">Téléphone</th>
                            <th class="text-center vertical-middle">Ville</th>
                            <th class="text-center vertical-middle">Code Postal</th>
                            <th class="text-center vertical-middle">Type de prestation</th>
                            <th class="text-center vertical-middle">Produit commandé</th>
                            <th class="text-center vertical-middle">Prix de la livraison</th>
                            <th class="text-center vertical-middle">Satisfaction client</th>
                            <th class="text-center vertical-middle">Statut</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total=0;?>
                        @foreach($deliveries as $delivery)
                            <?php
                            $items=array();
                            if($delivery['delivery_price']=='0'){
                                $price= 'Gratuit';
                            }else{
                                $price=$delivery['delivery_price']." €";
                            }
                            if($delivery['sub_product_id']==''){
                                $type="Multi-produits";
                            }else{
                                $type=$delivery['product_type'];
                            }
                            if($delivery['status']==1){
                                $status="Validé";
                            }elseif($delivery['status']==2){
                                $status="Livré";
                            }else{
                                $status="En attente";
                            }
                            $total+=$delivery['delivery_price'];
                            $url=URL('/admin/delivery/edit').'/'.$delivery['id'];
                            ?>
                            <tr onclick="viewDelivery('{{$url}}')" class="clickable">
                                <td>{{Date::parse($delivery['datetime'])->format('d/m/Y')}}</td>
                                <td>{{$delivery['first_name']}} {{$delivery['last_name']}}</td>
                                <td>{{$delivery['customer_email']}}</td>
                                <td>@if($delivery['order_pdf'])<a href="{{asset('assets/images')}}/{{ $delivery['store_id'] }}/{{$delivery['order_pdf']}}" target="_blank"><i class="fa fa-2x fa-file-pdf-o pdf-font"></i></a>@endif {{$delivery['order_id']}}</td>
                                <td>@if($delivery['delivery_pdf'])<a href="{{asset('assets/images')}}/{{ $delivery['store_id'] }}/{{$delivery['delivery_pdf']}}" target="_blank" id="addPdfLink"><i class="fa fa-2x fa-file-pdf-o pdf-font"></i></a>@endif {{$delivery['delivery_number']}}</td>
                                <td>{{$delivery['mobile_number']}}</td>
                                <td>{{$delivery['city']}}</td>
                                <td>{{$delivery['postal_code']}}</td>
                                <td>{{$delivery['service']}}</td>
                                <td>{{$type}}</td>
                                <td>{{$price}}</td>
                                <td>@if($delivery['customer_feedback']==1) <i class="fa fa-circle green-circle"></i> @elseif($delivery['customer_feedback']==2) <i class="fa fa-circle yellow-circle"></i> @elseif($delivery['customer_feedback']==3) <i class="fa fa-circle red-circle"></i> @endif</td>
                                <td>{{$status}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $deliveries->links() }}
            </div>
        </div>

    </div>
@stop
