@extends('client.layouts.menu')

@section('title')
    TDF Create Delivery
@stop

@section('content')

{!! Form::model($delivery, [ 'url' => URL::route('delivery.edit'), "enctype"=>"multipart/form-data"] )  !!}
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header text-center">CREATION D'UNE LIVRAISON</h1>
        </div>
        <div class="col-lg-12 calendar-control">
            <div class="form-inline">
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker5'>
                        {{ Form::text('datetime', $dateTime, ['class'=>'form-control'])}}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <span class="text-danger">{!! $errors->first('datetime') !!}</span>
                </div>
                
                <div class="form-group">
                    {{ Form::select('day_period', Config::get('constants.Day Period'), $period, [])}}                          
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
                                {{Form::text('first_name', null, ['class'=>'form-control', 'placeholder'=>'Nom'])}}
                            </div>
                            <span class="text-danger">{!! $errors->first('first_name') !!}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
                                {{Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'Prenom'])}}
                            </div>
                            <span class="text-danger">{!! $errors->first('last_name') !!}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'Numero et rue'])}}
                        </div>
                        <span class="text-danger">{!! $errors->first('address') !!}</span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::text('postal_code', null, ['class'=>'form-control', 'placeholder'=>'Code Postal'])}}
                        </div>
                        <span class="text-danger">{!! $errors->first('postal_code') !!}</span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::text('city', null, ['class'=>'form-control', 'placeholder'=>'Ville'])}}
                        </div>
                        <span class="text-danger">{!! $errors->first('city') !!}</span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone fa-fw"></i></div>
                            {{Form::text('landline', null, ['class'=>'form-control', 'placeholder'=>'Telephone fixe'])}}
                            </div>
                            <span class="text-danger">{!! $errors->first('landline') !!}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></div>
                            {{Form::text('mobile_number', null, ['class'=>'form-control', 'placeholder'=>'Telephone mobile'])}}
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
                                {{Form::text('order_id', null, ['class'=>'form-control', 'placeholder'=>'Numero de commande'])}}
                                <div class="input-group-addon"><i class="fa fa-search fa-fw"></i></div>
                            </div>
                            <span class="text-danger">{!! $errors->first('order_id') !!}</span>
                        </div>
                        <div class="form-group">
                            <select name="product[]" class="selectpicker form-control" multiple="multiple">
                                @foreach($products as $key => $prod)
                                        <?php $selected=''?>
                                    @if($delivery)
                                        @foreach($delivery['products'] as $key2=>$deliveryPoduct)
                                        @if($prod==$deliveryPoduct['product_family'])
                                        <?php $selected='selected'?>
                                        @endif
                                        @endforeach
                                    @endif
                                    <option value="{{$key}}" {{$selected}}>{{$prod}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{!! $errors->first('product') !!}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group">
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                                  <input type="file" name="pdf" class="form-control" id="pdfFile" placeholder="Numero du bon de livraison">
                                  <div class="input-group-addon cursor-pointer" onclick="upload()"><i class="fa fa-upload fa-fw"></i></div>
                                </div>
                            </div>
                            <span class="text-danger" id="showErrorPdf">{!! $errors->first('pdf') !!}</span>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="dummy" class="form-control" id="dummyFile" placeholder="Numero du bon de livraison">
                            <table @if(!$delivery['pdf']) style="display: none" @endif id="showPdftable">
                                <tr>
                                    <td><i class="fa fa-2x fa-file-pdf-o"></i></td>
                                    <td>&nbsp;</td>
                                    <td><a href="{{asset('assets/images')}}/{{ Session::get('store_name') }}/{{$delivery['pdf']}}" target="_blank" id="addPdfLink">{{$delivery['pdf']}}</a></td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            {{ Form::select('service', Config::get('constants.Services'), null, [])}}
                        </div>
                        <span class="text-danger">{!! $errors->first('services') !!}</span>
                        <div class="form-group">
                            <div class="input-group">
                                {{Form::text('delivery_price', null, ['class'=>'form-control', 'placeholder'=>'Prix de la livraison', 'id'=>'delivery_charges'])}}
                                <div class="input-group-addon"><i class="fa fa-euro fa-fw"></i></div>
                            </div>
                            <div class="form-group">
                                Livraison offerte {{Form::checkbox('free', 1, null, ['onclick'=>'freeDelivery(this)', 'id'=>'delivery'])}}
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
                {{Form::textarea('comment', null, ['class'=>'form-control', 'placeholder'=>'Commentaire sur la livraison', "rows"=>"10"])}}
            </div>
        </div>
        <div class="clear20"></div>
        <div class="row">
            <div class="col-md-12 text-center tbl-btns">
                <input type="submit" name="" class="active green" value='Ajouter une demande'>
                <!-- <a href="#" class="active green">Valider ma demande<i class="fa fa-save"></i></a>
                <a href="#" class="red">Annuler ma demande<i class="fa fa-trash-o"></i></a> -->
            </div>
        </div>
    {!! Form::hidden('id', null, ['id'=>'recordId']) !!}
    {!! Form::close() !!}

@stop
@section('footer_scripts')
    
@stop