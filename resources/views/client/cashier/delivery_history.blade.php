@extends('client.layouts.menu')

@section('title')
TDF History
@stop

@section('content')
<div class="row">
  <h1 class="page-header text-center history-heading">HISTORIQUE DES LIVRAISONS</h1>
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
@include('client.cashier.history-records')
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
