@extends('client.layouts.menu')

@section('title')
    TDF Create Delivery
@stop

@section('content')
<?php $dateTime=''; if($delivery){$dateTime=date('m/d/Y h:i:s', strtotime($delivery['datetime']));} ?>
{!! Form::model($delivery, [ 'url' => URL::route('delivery.edit'), "enctype"=>"multipart/form-data"] )  !!}
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center">CREATION D'UNE LIVRAISON</h1>
        </div>
        <div class="col-lg-12 calendar-control">
            <div class="form-inline">
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker5'>
                        {{ Form::text('datetime', $dateTime, ['class'=>'form-control', 'readonly'])}}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <span class="text-danger">{!! $errors->first('datetime') !!}</span>
                </div>
                
                <div class="form-group">
                    {{ Form::text('day_period', null, ['readonly', 'class'=>'form-control'])}}                          
                </div>
                <span class="text-danger">{!! $errors->first('day_period') !!}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3 class="text-center">Coordonees</h3>
                <div class="clear20"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
                                {{Form::text('first_name', null, ['class'=>'form-control', 'placeholder'=>'Nom', 'readonly'])}}
                            </div>
                            <span class="text-danger">{!! $errors->first('first_name') !!}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
                                {{Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'Prenom', 'readonly'])}}
                            </div>
                            <span class="text-danger">{!! $errors->first('last_name') !!}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'Numero et rue', 'readonly'])}}
                        </div>
                        <span class="text-danger">{!! $errors->first('address') !!}</span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::text('postal_code', null, ['class'=>'form-control', 'placeholder'=>'Code Postal', 'readonly'])}}
                        </div>
                        <span class="text-danger">{!! $errors->first('postal_code') !!}</span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::text('city', null, ['class'=>'form-control', 'placeholder'=>'Ville', 'readonly'])}}
                        </div>
                        <span class="text-danger">{!! $errors->first('city') !!}</span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone fa-fw"></i></div>
                            {{Form::text('landline', null, ['class'=>'form-control', 'placeholder'=>'Telephone fixe', 'readonly'])}}
                            </div>
                            <span class="text-danger">{!! $errors->first('landline') !!}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></div>
                            {{Form::text('mobile_number', null, ['class'=>'form-control', 'placeholder'=>'Telephone mobile', 'readonly'])}}
                            </div>
                            <span class="text-danger">{!! $errors->first('mobile_number') !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="text-center">Informations sur la livraison</h3>
                <div class="clear20"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                {{Form::text('order_id', null, ['class'=>'form-control', 'placeholder'=>'Numero de commande', 'readonly'])}}
                                <div class="input-group-addon"><i class="fa fa-search fa-fw"></i></div>
                            </div>
                            <span class="text-danger">{!! $errors->first('order_id') !!}</span>
                        </div>
                        <div class="form-group">
                            {{Form::text('product', implode(',', $products), ['class'=>'form-control', 'readonly'])}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            {{Form::text('service', null, ['class'=>'form-control', 'placeholder'=>'Prix de la livraison', 'id'=>'delivery_charges', 'readonly'])}}
                        </div>
                        <span class="text-danger">{!! $errors->first('services') !!}</span>
                        <div class="form-group">
                            <div class="input-group">
                                {{Form::text('delivery_price', null, ['class'=>'form-control', 'placeholder'=>'Prix de la livraison', 'id'=>'delivery_charges', 'readonly'])}}
                                <div class="input-group-addon"><i class="fa fa-euro fa-fw"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <h3 class="text-center">Commentaire sur la livraison <i class="fa fa-comments fa-fw"></i></h3>
        <div class="clear20"></div>
        <div class="row">
            <div class="col-md-12">
                {{Form::textarea('comment', null, ['class'=>'form-control', 'placeholder'=>'Commentaire sur la livraison', "rows"=>"10", 'readonly'])}}
            </div>
        </div>
        <div class="clear20"></div>
        <div class="row">
            <div class="col-md-12 text-center tbl-btns">
                <a href="{{route('user.dashboard')}}" class="active green">Arrière</a>
            </div>
        </div>
    {!! Form::hidden('id') !!}
    {!! Form::close() !!}

@stop
@section('footer_scripts')
    
@stop