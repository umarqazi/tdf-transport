@extends('client.layouts.menu')

@section('title')
    TDF Create Delivery
@stop

@section('content')

    {!! Form::model($delivery, [ 'url' => URL::route('delivery.edit'), "enctype"=>"multipart/form-data", 'id'=>'createForm'] )  !!}
    <div class="row">
        @include('toast::messages')
        <div class="col-lg-12 text-center">
            <a href="{{url('/dashboard')}}" class="back-button"><i class="fa fa-arrow-left"></i> Retour</a>
            <h1 class="page-header text-center make-center">
                @if(is_null($delivery['id']))
                    CREATION D'UNE LIVRAISON
                @else
                    Modification d'une livraison
                @endif
            </h1>
        </div>
        <div class="col-lg-12 calendar-control">
            <div class="form-inline">
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker5'>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>{{ Form::text('datetime', $dateTime, ['class'=>'form-control'])}}

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
            <h3 class="text-center">Coordonnées</h3>
            <div class="clear20"></div>
            <div class="row">
                <div class="div-border">
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
                                {{Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'Prénom'])}}
                            </div>
                            <span class="text-danger">{!! $errors->first('last_name') !!}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'Numéro et rue'])}}
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
                                {{Form::text('landline', null, ['class'=>'form-control', 'placeholder'=>'Téléphone fixe'])}}
                            </div>
                            <span class="text-danger">{!! $errors->first('landline') !!}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></div>
                                {{Form::text('mobile_number', null, ['maxlength'=>'10','class'=>'form-control', 'id'=>'mobile_number', 'placeholder'=>'Téléphone mobile'])}}
                            </div>
                            <span class="text-danger">{!! $errors->first('mobile_number') !!}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></div>
                                {{Form::text('customer_email', null, ['class'=>'form-control', 'placeholder'=>'Adresse e-mail'])}}
                            </div>
                            <span class="text-danger">{!! $errors->first('customer_email') !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h3 class="text-center">Informations sur la livraison</h3>
            <div class="clear20"></div>
            <div class="row">
                <div class="div-border">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::text('order_id', null, ['class'=>'form-control', 'placeholder'=>'Numéro de commande'])}}
                            <span class="text-danger">{!! $errors->first('order_id') !!}</span>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group" id="orderPdfDiv">
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                                    <input type="file" name="order_pdf" class="form-control" id="orderPdfFile" placeholder="Numero du bon de livraison" value="{{empty($delivery['order_pdf']) ? '':$delivery['order_pdf']}}">
                                    <div class="input-group-addon cursor-pointer" onclick="upload('orderPdfFile')"><i class="fa fa-upload fa-fw"></i></div>
                                </div>
                            </div>
                            <span class="text-danger" id="showOrderErrorPdf">{!! $errors->first('order_pdf') !!}</span>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="orderDummy" class="form-control" id="OrderdummyFile" placeholder="Numero du bon de livraison">
                            <table @if(!$delivery['order_pdf']) style="display: none" @endif id="OrderShowPdftable">
                                <tr>
                                    <td><a href="{{asset('assets/images')}}/{{ $delivery['stores_id'] }}/{{$delivery['order_pdf']}}" target="_blank" id="OrderAddPdfLink"><i class="fa fa-2x fa-file-pdf-o"></i></a></td>
                                    <td>&nbsp;</td>
                                    <td><a onclick="cancelpdf('order')" class="cancelpdf"><i class="fa fa-close"></i></a></td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            <select name="product_id" class="selectpicker form-control" onchange="getProduct(this)">
                                @foreach($products as $key => $prod)
                                    <option value="{{$key}}" {{($delivery['product_id']==$key)? 'selected':''}}>{{$prod}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{!! $errors->first('product_id') !!}</span>
                        </div>
                        <div class="form-group" id="products">
                            @if($subProduct)
                                {{ Form::select('sub_product_id', $subProduct, null, ['class'=>'full-width', "onchange"=>"getPrice(this)"])}}
                            @endif
                            <span class="text-danger">{!! $errors->first('product') !!}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::text('delivery_number', null, ['class'=>'form-control', 'placeholder'=>'Numéro de livraison'])}}
                            <span class="text-danger">{!! $errors->first('delivery_number') !!}</span>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group" id="PdfDiv">
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                                    <input type="file" name="pdf" class="form-control" id="pdfFile" placeholder="Numero du bon de livraison" value="{{empty($delivery['pdf']) ? '':$delivery['pdf']}}">
                                    <div class="input-group-addon cursor-pointer" onclick="upload('pdfFile')"><i class="fa fa-upload fa-fw"></i></div>
                                </div>
                            </div>
                            <span class="text-danger" id="showErrorPdf">{!! $errors->first('pdf') !!}</span>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="dummy" class="form-control" id="dummyFile" placeholder="Numero du bon de livraison">
                            <table @if(!$delivery['delivery_pdf']) style="display: none" @endif id="showPdftable">
                                <tr>
                                    <td><a href="{{asset('assets/images')}}/{{ $delivery['stores_id']  }}/{{$delivery['delivery_pdf']}}" target="_blank" id="addPdfLink"><i class="fa fa-2x fa-file-pdf-o"></i></a></td>
                                    <td>&nbsp;</td>
                                    <td><a onclick="cancelpdf('delivery')" class="cancelpdf"><i class="fa fa-close"></i></a></td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            {{ Form::select('service', Config::get('constants.Services'), null, ['class'=>'full-width', "onchange"=>"getPrice(this)"])}}
                            <span class="text-danger">{!! $errors->first('service') !!}</span>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                {{Form::text('delivery_price', null, ['class'=>'form-control', 'placeholder'=>'Prix de la livraison', 'id'=>'delivery_charges'])}}
                                <div class="input-group-addon"><i class="fa fa-euro fa-fw"></i></div>
                            </div>
                            <span class="text-danger">{!! $errors->first('delivery_price') !!}</span>
                            @if(auth()->user()->type==Config::get('constants.Users.Manager'))
                                <div class="form-group space">
                                    Livraison offerte {{Form::checkbox('free', 1, null, ['onclick'=>'freeDelivery(this)', 'id'=>'delivery'])}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="row">
        <div class="div-border bottom-container">
            <h3 class="text-center">Commentaire sur la livraison <i class="fa fa-comments fa-fw"></i></h3>
            <div class="clear20"></div>
            <div class="col-md-12">
                {{Form::textarea('comment', null, ['class'=>'form-control', 'placeholder'=>'Commentaire sur la livraison', "rows"=>"10"])}}
            </div>
        </div>
    </div>
    <div class="clear20"></div>
    <div class="row">
        <div class="col-md-12 text-center tbl-btns">
            <button class="button-styling" type="submit">Valider <i class="fa fa-save"></i></button>
            <a href="{{url('/')}}" class="btn btn-danger cancel-request">Annuler <i class="fa fa-undo"></i></a>
        </div>
    </div>
    {!! Form::hidden('id', null, ['id'=>'recordId']) !!}
    {!! Form::close() !!}

@stop
@section('footer_scripts')

@stop
