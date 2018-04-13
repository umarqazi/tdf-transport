@extends('client.layouts.menu')

@section('title')
TDF Dashboard
@stop

@section('content')

<a href="{{route('create.delivery')}}" class="add-new-circle"><i class="fa fa-plus-circle"></i></a>
<div class="row">
  @include('toast::messages')
  <div class="col-lg-12">
    <h1 class="page-header text-center">Tableau de bord des livraisons</h1>
  </div>
  <div class="col-lg-12 calendar-control">
    <a href="{{route('user.date.dashboard', ['startDate'=>$checkDate->startOfWeek()->addDay(-7)])}}"><i class="fa fa-arrow-circle-left"></i></a>
    <span class="start">{{$startDate}}</span> @if($endDate != $startDate)- <span class="end">{{$endDate}} @endif</span>
    <a href="{{route('user.date.dashboard', ['endDate'=>$checkDate->endOfWeek()->addDay(8)])}}"><i class="fa fa-arrow-circle-right"></i></a>

  </div>
  <div class="custom_search">
    <input type="text" value="{{Input::get('search_field')}}" class="form-control search_dropdown" name="search_field" id='search_field' placeholder="Rechercher un client, une commande..">
    <a href="#" class="dropdown_btn"><i class="fa fa-chevron-down"></i></a>
    <button type="button" onclick="searchResult()" class="btn btn_search"><i class="fa fa-search"></i></button>
    <div class="toggle_div">
      <span>Rechercher par</span>
      <div class="form-group">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="customerCheck" name="customerCheck">
          </label>
        </div>
        <div class="input-group">
          <meta name="csrf-token" content="{{ csrf_token() }}" />
          {{Form::text('customer_name', Input::get('customer_name'), ['class'=>'form-control', 'placeholder'=>'Rechercher un client', 'id'=>'customer'])}}
        </div>
      </div>

      <div class="form-group">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="orderCheck" name="orderCheck">
          </label>
        </div>
        <div class="input-group">
          {{Form::text('order_id', Input::get('order_id'), ['class'=>'form-control', 'placeholder'=>'Rechercher une commande', 'id'=>'orderId'])}}
        </div>

      </div>

      <div class="form-group">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="dateCheck" name="dateCheck">
          </label>
        </div>
        <div class='input-group date' id='datetimepicker7'>
          {{ Form::text('datetime', Input::get('datetime'), ['placeholder'=>'Rechercher par date','class'=>'form-control', 'id'=>'datetime'])}}
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>

      </div>

      <div class="form-group">
        <div class="input-group text-center tbl-btns">
          <button type="button" onclick="searchResult()" class='btn btn-primary button-padding'>
            RECHERCHER <i class="fa fa-search"></i>
          </button>
        </div>

      </div>
    </div>
  </div>
  <div class="pull-right selector">
    <select onchange="showView(this)">
      <option value="dashboard">Semaine</option>
      <option value="monthlyRecords">Mois</option>
    </select>
    <a href="{{url('/dashboard')}}" class="pull-right btn btn-primary current-day">Aujourd'hui</a>
  </div>
</div>
{!! Form::model(null, [ 'url' => URL::route('validate.delivery'), "enctype"=>"multipart/form-data", "id"=>"validateForm"] )  !!}
<div class="row">
  <div class="table-responsive">
    <table class="table table-striped table-bordered data-sets">
      <thead>
        <tr>
          <th class="side-first" width=20%>Tranche horaire</th>
          @for($i=0; $i<=5; $i++)
          <th width=14% @if(strtotime($currentDate->startOfWeek()->addDay($i)->format('d-m-y')) == strtotime(date('d-m-y'))) class="currentDate-color" @endif><span class="day-name">{{Date::parse($currentDate->startOfWeek()->addDay($i))->format('l')}}</span><div class="date">{{date('d', strtotime($currentDate->startOfWeek()->addDay($i)))}}</div> @if(date('Y-m-d', strtotime($nextDate)) == date('Y-m-d', strtotime($currentDate->startOfWeek()->addDay($i))) && $authUser->type==Config::get('constants.Users.Manager'))<input type="checkbox" id="checkbox"> <span class="checkAll">Cocher tout</span>@endif</th>

          @endfor

        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="side-first">MATIN</td>
          @foreach($deliveries as $key=>$delivery)
          @if(!empty($delivery))
          <td
          @if((strtotime($key)==strtotime(date('d-M-Y')) && $authUser->type==Config::get('constants.Users.Manager')) || strtotime($key) >= strtotime(date('d-M-Y', strtotime($nextDate))))
          class="enabled-div" @else class="disabled-div"
          @endif>
            <?php $number=1;?>
            @foreach($delivery as $dayDelivery)
            @if($dayDelivery['day_period']==Config::get('constants.Day Period.matin'))
            <?php if ($number % 2 == 0) {
              $color='blue-color';
            }else{
              $color='grey-color';
            }?>
            <table class="table table-striped table-bordered tbl-internal" >
              <tr>
                <td width="70%" class="{{$color}}">{{$dayDelivery['first_name']}} {{$dayDelivery['last_name']}} {{$dayDelivery['city']}} {{$dayDelivery['postal_code']}}</td>
                <td><a href="{{URL::to('/delivery', ['id'=>$dayDelivery['id']])}}"><i class="fa fa-edit fa-fw"></i></a></td>
                <td><a href="{{URL::to('/deleteDelivery', ['id'=>$dayDelivery['id']])}}" class="delete"><i class="fa fa-trash-o fa-fw"></i></a></td>
                @if($authUser->type==Config::get('constants.Users.Manager'))
                <td><input type="checkbox" class="deliveryCheckbox" name="delivery_id[]" value="{{$dayDelivery['id']}}" {{($dayDelivery['status']=='1')?'checked disabled':''}} class="" @if(strtotime($key) != strtotime(date('d-M-Y')) && $key!=date('d-M-Y', strtotime($nextDate))) disabled @endif>
                </td>
                @endif
              </tr>

            </table>
            <?php  $number++ ?>
            @endif
            @endforeach
            <div class="clearfix"></div>
            @if((strtotime($key)==strtotime(date('d-M-Y')) && $authUser->type==Config::get('constants.Users.Manager')) || strtotime(date('d-M-Y', strtotime($key))) >= strtotime(date('d-M-Y', strtotime($nextDate)))) <a href="{{route('create.delivery.period', ['id'=>$key, 'day_period'=>Config::get('constants.Day Period.matin')])}}" class="anchor-space"></a> @endif
          </td>
          <!-- <div class="clearfix"></div>
          <a href="" class="anchor-space">&nbsp;</a> -->

          @else
          <td @if(strtotime($key) >= strtotime(date('d-M-Y', strtotime($nextDate)))) class="enabled-div set-heigth" @else class="disabled-div" @endif>

            <div class="clearfix"></div>
            @if(strtotime(date('d-M-Y', strtotime($key))) >= strtotime(date('d-M-Y', strtotime($nextDate))))<a href="{{route('create.delivery.period', ['id'=>$key, 'day_period'=>Config::get('constants.Day Period.matin')])}}" class="anchor-space"></a> @endif
          </td>
          @endif

          @endforeach

        </tr>
        <tr>
          <td class="side-first">APRES - MIDI</td>
          @foreach($deliveries as $key=>$delivery)
          @if(!empty($delivery))
          <td @if((strtotime($key)==strtotime(date('d-M-Y')) && $authUser->type==Config::get('constants.Users.Manager')) ||  strtotime($key) >= strtotime(date('d-M-Y', strtotime($nextDate)))) class="enabled-div" @else class="disabled-div" @endif>
            <?php $number2=1;?>
            @foreach($delivery as $dayDelivery)
            @if($dayDelivery['day_period']==Config::get('constants.Day Period.après-midi'))
            <?php if ($number2 % 2 == 0) {
              $color='blue-color';
            }else{
              $color='grey-color';
            }?>
            <table class="table table-striped table-bordered tbl-internal">
              <tr>
                <td width="70%" class="{{$color}}">{{$dayDelivery['first_name']}} {{$dayDelivery['last_name']}} {{$dayDelivery['city']}} {{$dayDelivery['postal_code']}}</td>
                <td><a href="{{URL::to('/delivery', ['id'=>$dayDelivery['id']])}}" ><i class="fa fa-edit fa-fw"></i></a></td>
                <td><a href="{{URL::to('/deleteDelivery', ['id'=>$dayDelivery['id']])}}" class="delete"><i class="fa fa-trash-o fa-fw"></i></a></td>
                @if($authUser->type==Config::get('constants.Users.Manager'))
                <td><input type="checkbox" class="deliveryCheckbox" name="delivery_id[]" value="{{$dayDelivery['id']}}" {{($dayDelivery['status']=='1')?'checked disabled':''}} class="" @if(strtotime($key) != strtotime(date('d-M-Y')) && $key!=date('d-M-Y', strtotime($nextDate))) disabled @endif>
                </td>
                @endif
              </tr>

            </table>
            <?php $number2++;?>
            @endif
            @endforeach
            <div class="clearfix"></div>
            @if((strtotime($key)==strtotime(date('d-M-Y')) && $authUser->type==Config::get('constants.Users.Manager')) ||  strtotime(date('d-M-Y', strtotime($key))) >= strtotime(date('d-M-Y', strtotime($nextDate))))<a href="{{route('create.delivery.period', ['id'=>$key, 'day_period'=>Config::get('constants.Day Period.après-midi')])}}" class="anchor-space"></a> @endif
          </td>
          @else
          <td @if(strtotime($key) >= strtotime(date('d-M-Y', strtotime($nextDate)))) class="enabled-div set-heigth" @else class="disabled-div" @endif>

            <div class="clearfix"></div>
            @if((strtotime($key)==strtotime(date('d-M-Y')) && $authUser->type==Config::get('constants.Users.Manager')) ||  strtotime(date('d-M-Y', strtotime($key))) >= strtotime(date('d-M-Y', strtotime($nextDate))))<a href="{{route('create.delivery.period', ['id'=>$key, 'day_period'=>Config::get('constants.Day Period.après-midi')])}}" class="anchor-space"></a> @endif
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
    <button class="button-styling" type="button" data-toggle="modal" data-target="#valdiateMessage">Valider les livraisons sélectionnées <i class="fa fa-save"></i></button>
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
