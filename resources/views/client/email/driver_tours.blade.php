<!DOCTYPE html>
<html>
<head>
    <title>Tour Plan</title>
    {!! HTML::style('assets/css/bootstrap.css') !!}
    {!! HTML::style('assets/css/main.css') !!}
    {!! HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css') !!}
    <style>
      .table-bordered{
        width:100%;
        border-collapse: collapse;
      }
      .table-bordered td{
        border:1px solid #ddd;
        padding:10px;
        border-collapse: collapse;
      }
      .icons li {
    padding:10px 0px;
    position: relative;
    color: black;
    }
    .list-unstyled {
    padding-left: 0;
    list-style: none;
    }
    .driver-plans {
    width: 50%;
    float: left;
    margin: 10px 0px;
}
    </style>
</head>
<body>
    <Strong>Hi</Strong>
    <br>
    <br>
    	<span>You have a new Delivery Request in your Account. Your Delivery Detail are giving below</span>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tbody>
                @foreach($data as $key=>$driver)
                  <tr>
                      <td class="text-center vertical-middle" width="30%">{{$key}}</td>
                      <td>
                        @if(!empty($driver['tours']))
                          @foreach($driver['tours'] as $key=>$tour)

                            <a href="{{url('/tourDeliveryDetail', ['id'=>$tour['delivery_id'], 'time'=>$key])}}" >
                              <ul class="list-unstyled icons driver-plans">
                            <li><strong>Client: </strong>{{$tour['delivery']['first_name']}} {{$tour['delivery']['last_name']}}</li>
                            <li><strong>Customer Address: </strong>{{$tour['delivery']['address']}} </li>
                            <li><strong>Ville & Code Postal: </strong>{{$tour['delivery']['city']}} {{$tour['delivery']['postal_code']}}</li>
                            <li><strong>Téléphone mobile: </strong> {{$tour['delivery']['mobile_number']}}</li>
                            <li><strong>Téléphone fixe: </strong> {{$tour['delivery']['landline']}}</li>
                            <li><strong>Produit commandé: </strong> {{($tour['delivery']['product_type']!='')? $tour['delivery']['product_type']: 'Multi-produits'}}</li>
                            <li><strong>Prix de la livraison: </strong>{{($tour['delivery']['product_type']!='')? $tour['delivery']['delivery_charges']: 'Gratuit'}}</li>
                            <li><strong>Numéro de commande: </strong> {{$tour['delivery']['order_id']}}</li>
                            @if($tour['delivery']['delivery_number'])<li><strong>Numéro du bon de livraison: </strong> {{$tour['delivery']['delivery_number']}}</li>@endif
                            <li><strong>Fonction de prestation: </strong> {{$tour['delivery']['service']}}</li>
                          </ul></a>
                          @endforeach
                          @endif
                      </td>
                  </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <span>
        Regards
        <br>
        TDF Transport

    </span>
</body>
</html>
