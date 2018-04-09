@extends('client.layouts.menu')

@section('title')
TDF Month View
@stop

@section('content')
<div class="col-lg-12">
  <h1 class="page-header text-center">RÉCAPITULATIF DES LIVRAISONS DU MOIS</h1>
</div>
<div class="pull-right selector">
  <select onchange="showView(this)">
    <option value="dashboard">Semaine</option>
    <option value="monthlyRecords" selected="selected">Mois</option>
  </select>
</div>

<div id='calendar'></div>
<script type="text/javascript">
$(document).ready(function() {
  // page is now ready, initialize the calendar...
  $('#calendar').fullCalendar({
    fixedWeekCount: false,
    // put your options and callbacks here
    events : [
      @foreach($deliveries as $task)
      {
        title : '{{ $task->total  }} livraison{{($task->total > 1)?"s": ""}} l’ {{$task->day_period}}',
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
