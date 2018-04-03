@extends('client.layouts.menu')

@section('title')
TDF Month View
@stop

@section('content')
<div class="col-lg-12">
  <h1 class="page-header text-center">TABLEAU DE BORD LIVRAISONS</h1>
</div>
<div class="col-lg-12 calendar-control">
  <select onchange="showView(this)">
    <option value="dashboard">Semaine</option>
    <option value="monthlyRecords" selected="selected">Mois</option>
  </select>
</div>

<div id='calendar'></div>
{!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js') !!}
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script type="text/javascript">
$(document).ready(function() {
  // page is now ready, initialize the calendar...
  $('#calendar').fullCalendar({
    // put your options and callbacks here
    events : [
      @foreach($deliveries as $task)
      {
        title : '{{ $task->total  }} livraisons l’ {{$task->day_period}}',
        start : '{{ $task->task_date }}',
        color : @if($task->day_period=='Matin') '#999999' @else '#45818e' @endif,
      },
      @endforeach
    ]
  })
});
</script>
@stop
@section('footer_scripts')
@stop
