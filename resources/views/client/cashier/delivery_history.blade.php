@extends('client.layouts.menu')

@section('title')
    TDF History
@stop

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header text-center">HISTORIQUE DES LIVRAISONS</h1>
    </div>
    {!! Form::model(null, [ 'url' => URL::route('delivery.export'), "enctype"=>"multipart/form-data", 'id'=>'searchForm'] )  !!}
    <div class="col-lg-12 calendar-control">
        <div class="form-inline">
            <div class="form-group">
                <label>Du</label>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker5'>
                        {{ Form::text('fromDate', Input::get('fromDate'), ['class'=>'form-control'])}}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <span class="text-danger">{!! $errors->first('datetime') !!}</span>
                </div>
            </div>
            <div class="form-group">
                <label>Au</label>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker6'>
                        {{ Form::text('toDate', Input::get('toDate'), ['class'=>'form-control'])}}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <span class="text-danger">{!! $errors->first('datetime') !!}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    {!! Form::model(null, [ 'url' => URL::route('post.delivery.history'), "enctype"=>"multipart/form-data"] )  !!}
        @include('client.cashier.search-form')
    {!! Form::close() !!}
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
                    @foreach($allDeliveries as $delivery)
                        <?php 
                        $items='';
                        if($delivery['delivery_price']=='Free'){ 
                            $price= 'Free';
                        }else{ 
                            $price=$delivery['delivery_price']." €";
                        }
                        if($delivery['products']){
                            foreach($delivery['products'] as $key=>$product){
                                $items[$key]=$product['product_family'];
                            }
                            $items=implode(',', $items);    
                        }
                        ?>
                        <tr>
                            <td>{{$delivery['datetime']}}</td>
                            <td>{{$delivery['first_name']}} {{$delivery['last_name']}}</td>
                            <td>{{$delivery['order_id']}}</td>
                            <td><a href="{{asset('assets/images')}}/{{ Session::get('store_name') }}/{{$delivery['pdf']}}" target="_blank" id="addPdfLink">{{$delivery['pdf']}}</a></td>
                            <td>{{$delivery['mobile_number']}}</td>
                            <td>{{$delivery['city']}}</td>
                            <td>{{$delivery['postal_code']}}</td>
                            <td>{{$delivery['service']}}</td>
                            <td>{{$items}}</td>
                            <td>{{$price}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $allDeliveries->links() }}
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center tbl-btns">
        <a onclick="downloadExcel()" class="active">Telecharger I'historique<br>des livraisons <i class="fa fa-print"></i></a>
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