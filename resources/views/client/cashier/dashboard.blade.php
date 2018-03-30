@extends('client.layouts.menu')

@section('title')
TDF Dashboard
@stop

@section('content')

<a href="{{route('create.delivery')}}" class="add-new-circle"><i class="fa fa-plus-circle"></i></a>
<div class="row">
  @include('toast::messages')
  <div class="col-lg-12">
    <h1 class="page-header text-center">TABLEAU DE BORD LIVRAISONS</h1>
  </div>
  <div class="col-lg-12 calendar-control">
    <a href="{{route('user.date.dashboard', ['startDate'=>$checkDate->startOfWeek()->addDay(-7)])}}"><i class="fa fa-arrow-circle-left"></i></a>
    <span class="start">{{$startDate}}</span> - <span class="end">{{$endDate}}</span>
    <a href="{{route('user.date.dashboard', ['endDate'=>$checkDate->endOfWeek()->addDay(8)])}}"><i class="fa fa-arrow-circle-right"></i></a>

  </div>
  <div class="col-lg-12 calendar-control">
    <table class="align-center">
      <tr>
        <td>
          <div class="form-group">
            <div class="input-group">
              <meta name="csrf-token" content="{{ csrf_token() }}" />
              {{Form::text('customer_name', null, ['class'=>'form-control', 'placeholder'=>'Rechercher un client', 'id'=>'customer'])}}
            </div>
            <span class="text-danger">{!! $errors->first('order_id') !!}</span>
          </div></td>
          <td>&nbsp;</td>
          <td width=50%><div class="form-group">
            <div class="input-group">
              {{Form::text('order_id', null, ['class'=>'form-control', 'placeholder'=>'Rechercher une commande', 'id'=>'orderId'])}}
            </div>
            <span class="text-danger">{!! $errors->first('order_id') !!}</span>
          </div>
        </td>
        <td>&nbsp;</td>
        <td><div class="form-group">
          <div class='input-group date' id='datetimepicker5'>
            {{ Form::text('datetime', null, ['class'=>'form-control', 'id'=>'datetime'])}}
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
          </div>
          <span class="text-danger">{!! $errors->first('datetime') !!}</span>
        </div>
      </td>
      <td>&nbsp;</td>
      <td><div class="form-group">
        <div class="input-group text-center tbl-btns">
          <button class="btn btn-primary" onclick="searchResult()">Search</button>
        </div>
        <span class="text-danger">{!! $errors->first('order_id') !!}</span>
      </div>
    </td>
  </tr>
</table>
</div>
<div class="pull-right selector">
  <select onchange="showView(this)">
    <option value="dashboard">Weekly</option>
    <option value="monthlyRecords">Monthly</option>
  </select>
</div>
</div>
{!! Form::model(null, [ 'url' => URL::route('validate.delivery'), "enctype"=>"multipart/form-data", "id"=>"validateForm"] )  !!}
<div class="row">
  <div class="table-responsive">
    <table class="table table-striped table-bordered data-sets">
      <thead>
        <tr>
          <th class="side-first">TRANCHE HORAIRE</th>
          <th @if(strtotime($currentDate->startOfWeek()->format('d-m-y')) == strtotime(date('d-m-y'))) class="currentDate-color" @endif><span class="day-name">LUNDI</span><div class="date">{{date('d', strtotime($currentDate->startOfWeek()))}}</div></th>
          <th @if(strtotime($currentDate->startOfWeek()->addDay(1)->format('d-m-y')) == strtotime(date('d-m-y'))) class="currentDate-color" @endif><span class="day-name">MARDI</span><div class="date">{{date('d', strtotime($currentDate->startOfWeek()->addDay(1)))}}</div></th>
          <th @if(strtotime($currentDate->startOfWeek()->addDay(2)->format('d-m-y')) == strtotime(date('d-m-y'))) class="currentDate-color" @endif><span class="day-name">MERCREDI</span><div class="date">{{date('d', strtotime($currentDate->startOfWeek()->addDay(2)))}}</div></th>
          <th @if(strtotime($currentDate->startOfWeek()->addDay(3)->format('d-m-y')) == strtotime(date('d-m-y'))) class="currentDate-color" @endif><span class="day-name">JEUDI</span><div class="date">{{date('d', strtotime($currentDate->startOfWeek()->addDay(3)))}}</div></th>
          <th @if(strtotime($currentDate->startOfWeek()->addDay(4)->format('d-m-y')) == strtotime(date('d-m-y'))) class="currentDate-color" @endif><span class="day-name">VENDREDI</span><div class="date">{{date('d', strtotime($currentDate->startOfWeek()->addDay(4)))}}</div></th>
          <th @if(strtotime($currentDate->startOfWeek()->addDay(5)->format('d-m-y')) == strtotime(date('d-m-y'))) class="currentDate-color" @endif><span class="day-name">SAMEDI</span><div class="date">{{date('d', strtotime($currentDate->startOfWeek()->addDay(5)))}}</div></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="side-first">MATIN</td>
          @foreach($deliveries as $key=>$delivery)
          @if(!empty($delivery))
          <td @if($key==date('d-M-Y', strtotime($nextDate))) class="enabled-div" @endif>
            @foreach($delivery as $dayDelivery)
            @if($dayDelivery['day_period']=='Matin')
            <table class="table table-striped table-bordered tbl-internal" >
              <tr>
                <td width="40%">{{$dayDelivery['first_name']}}</td>
                <td><a href="{{URL::to('/viewDelivery', ['id'=>$dayDelivery['id']])}}"><i class="fa fa-eye fa-fw"></i></a></td>
                <td><a href="{{URL::to('/delivery', ['id'=>$dayDelivery['id']])}}"><i class="fa fa-edit fa-fw"></i></a></td>
                <td><a href="{{URL::to('/deleteDelivery', ['id'=>$dayDelivery['id']])}}" class="delete"><i class="fa fa-trash-o fa-fw"></i></a></td>
                @if($authUser->type==Config::get('constants.Users.Manager'))
                <td><input type="checkbox" name="delivery_id[]" value="{{$dayDelivery['id']}}" {{($dayDelivery['status']=='1')?'checked':''}} class="" @if($key!=date('d-M-Y', strtotime($nextDate))) disabled @endif>
                </td>
                @endif
              </tr>

            </table>
            @endif
            @endforeach
            <div class="clearfix"></div>
            <a href="{{route('create.delivery.period', ['id'=>$key, 'day_period'=>'Matin'])}}" class="anchor-space"></a>
          </td>
          <!-- <div class="clearfix"></div>
          <a href="" class="anchor-space">&nbsp;</a> -->

          @else
          <td>

            <div class="clearfix"></div>
            <a href="{{route('create.delivery.period', ['id'=>$key, 'day_period'=>'Matin'])}}" class="anchor-space"></a>
          </td>
          @endif

          @endforeach

        </tr>
        <tr>
          <td class="side-first">APRES - MIDI</td>
          @foreach($deliveries as $key=>$delivery)
          @if(!empty($delivery))

          <td @if($key==date('d-M-Y', strtotime($nextDate))) class="enabled-div" @endif>
            @foreach($delivery as $dayDelivery)
            @if($dayDelivery['day_period']=='Apres - Midi')
            <table class="table table-striped table-bordered tbl-internal">
              <tr>
                <td width="50%">{{$dayDelivery['first_name']}}</td>
                <td><a href="{{URL::to('/viewDelivery', ['id'=>$dayDelivery['id']])}}"><i class="fa fa-eye fa-fw"></i></a></td>
                <td><a href="{{URL::to('/delivery', ['id'=>$dayDelivery['id']])}}" ><i class="fa fa-edit fa-fw"></i></a></td>
                <td><a href="{{URL::to('/deleteDelivery', ['id'=>$dayDelivery['id']])}}" class="delete"><i class="fa fa-trash-o fa-fw"></i></a></td>
                @if($authUser->type==Config::get('constants.Users.Manager'))
                <td><input type="checkbox" name="delivery_id[]" value="{{$dayDelivery['id']}}" {{($dayDelivery['status']=='1')?'checked':''}} class="" @if($key!=date('d-M-Y', strtotime($nextDate))) disabled @endif>
                </td>
                @endif
              </tr>

            </table>
            @endif
            @endforeach
            <div class="clearfix"></div>
            <a href="{{route('create.delivery.period', ['id'=>$key, 'day_period'=>'Apres - Midi'])}}" class="anchor-space"></a>
          </td>
          <!-- <div class="clearfix"></div>
          <a href="" class="anchor-space">&nbsp;</a> -->

          @else
          <td>

            <div class="clearfix"></div>
            <a href="{{route('create.delivery.period', ['id'=>$key, 'day_period'=>'Apres - Midi'])}}" class="anchor-space"></a>
          </td>
          @endif

          @endforeach
        </tr>
      </tbody>
    </table>
  </div>
</div>
@if($authUser->type==Config::get('constants.Users.Manager'))
<div class="clear20"></div>
<div class="row">
  <div class="col-md-12 text-center tbl-btns">
    <a class="active green"  data-toggle="modal" data-target="#valdiateMessage">
      Valider les livraisons sélectionnées
    </a>
    <!-- <a href="#" class="active green">Valider ma demande<i class="fa fa-save"></i></a>
    <a href="#" class="red">Annuler ma demande<i class="fa fa-trash-o"></i></a> -->
  </div>
</div>
@endif
{!! Form::hidden('id', null, ['id'=>'recordId']) !!}
{!! Form::close() !!}
@stop
@section('footer_scripts')
<script>
$(".delete").click(function(){
  return confirm("Are you sure to delete this item?");
});
</script>
@stop
