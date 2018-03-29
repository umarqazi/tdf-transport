@extends('client.layouts.tdf-menu')

@section('title')
TDF Driver
@stop

@section('content')


    <span class="date_class">{{$date}}</span>
    <div class="row">
        <div class="col-md-12">

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tbody>
                        @foreach($tours as $key=>$tour)
                          <tr>
                              <td class="text-center vertical-middle">{{$key}}</td>
                              <td>
                                  @if(!empty($tour['id']))
                                    <ul class="list-unstyled icons">
                                    <li><i class="fa fa-user fa-fw"></i> {{$tour['delivery']['first_name']}}</li>
                                    <li>{{$tour['delivery']['address']}}</li>
                                    <li><i class="fa fa-phone fa-fw"></i> {{$tour['delivery']['mobile_number']}}</li>
                                    <li><i class="fa fa-cubes fa-fw"></i> {{($tour['delivery']['product_family']==NULL)? 'Multi-produits':$tour['delivery']['product_family']}}</li>
                                    </ul>
                                  @endif
                              </td>
                              <td class="text-center actions vertical-middle">
                                  @if(!empty($tour['delivery_id']))
                                    <a href="{{url('/tourDeliveryDetail', ['id'=>$tour['delivery_id']])}}" class="eye">
                                    <i class="fa fa-eye fa-fw"></i>
                                    <br>
                                    Voir les details
                                    </a>
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
<script>
$(".delete").click(function(){
  return confirm("Are you sure to delete this item?");
});
</script>
@stop
