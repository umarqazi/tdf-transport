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
          @foreach($tours as $key1=>$driver)
          <tr>
            <td class="text-center vertical-middle" width="30%">{{$key1}}</td>
            <td>
              @if(!empty($driver['tours']))
              @foreach($driver['tours'] as $key=>$tour)
              <div class="{{($key+1)%2 == 0 ? 'even-record': 'odd-record'}}">
                @if($tour['delivery']['status']==Config::get('constants.Status.Delivered') || $tour['delivery']['status']==Config::get('constants.Status.Return'))
                <?php $left=20?>
                @for($i=1; $i <= 17; $i++)
                <div class="horizontal-line" style="left:{{$left}}px">
                </div>
                <?php $left=$left+50?>
                @endfor
                @endif
                <a @if($tour['delivery']['status']==Config::get('constants.Status.Active')) href="{{url('/tourDeliveryDetail', ['id'=>$tour['delivery_id'], 'time'=>$key1])}}" @endif>
                  <ul class="list-unstyled icons driver-plans delivery-detail-record">
                    <li><i class="fa fa-user fa-fw"></i> {{$tour['delivery']['first_name']}} {{$tour['delivery']['last_name']}}</li>
                    <li class="delivery-detail-address"> {{$tour['delivery']['address']}}</li>
                    <li class="delivery-detail-address"> {{$tour['delivery']['city']}} - {{$tour['delivery']['postal_code']}}</li>
                    <li><i class="fa fa-phone fa-fw"></i> {{$tour['delivery']['mobile_number']}}</li>
                    <li><i class="fa fa-cubes fa-fw"></i> {{$tour['delivery']['order_id']}}</li>
                  </ul>
                </a>
              </div>
              @endforeach
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="clear20"></div>

@stop
@section('footer_scripts')
@stop
