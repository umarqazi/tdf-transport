<!DOCTYPE html>
<html>
<head>
    <title>Planning des livraisons</title>
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
            padding:5px 0px;
            position: relative;
            color: white;
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
        .logo{
            width:30%;
            float:left;
        }
        .logo img{
            width:100%;
            float:left;
        }
        .blue-color{
            background-color: #4D70C8;
            color: white;
        }
        .grey-color{
            background-color: #979797;
            color: white;
        }
        .heading{
            color:#4D70C8;
            text-align: center;

        }
        .date{
            padding:10px 0px;
            text-transform: capitalize;
        }
    </style>
</head>
<body>
<?php $records=0; ?>
@foreach($data as $key=>$driver)
    @foreach($driver['tours'] as $key=>$tour)
        @if(count($tour) > 1)
            <?php $records++;?>
        @endif
    @endforeach
@endforeach
<Strong>Bonjour,</Strong>
<br>
<br>
<span>Vous trouverez ci-joint le planning des livraisons à effectuer demain</span>
<br>
<br>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tbody>
        <tr>
            <td colspan="{{$records+1}}" align="center"><strong class="date">{{$nextDate}}</strong></td>
        </tr>
        <tr>
            <td align="center" width="10%"><strong class="heading">Horaire</strong></td>
            @for($i=1; $i <=$records; $i++)
                <td align="center"><strong class="heading">Client {{$i}}</strong></td>
            @endfor
        </tr>
        <?php $number=1; ?>
        @foreach($data as $key=>$driver)
            <?php if ($number % 2 == 0) {
                $color='blue-color';
            }else{
                $color='grey-color';
            }?>
            <tr class="{{$color}}">
                <td class="text-center vertical-middle" width="10%"><strong>{{$key}}</strong></td>
                @if(!empty($driver['tours']))
                    <?php $remaining=$records;?>
                    @foreach($driver['tours'] as $key1=>$tour)
                        <td width="{{90/$records}}%">
                            <ul class="list-unstyled icons driver-plans">
                                <li><strong>Client: </strong>{{$tour['delivery']['first_name']}} {{$tour['delivery']['last_name']}}</li>
                                <li><strong>Numéro et rue: </strong>{{$tour['delivery']['address']}} </li>
                                <li><strong>Code postal & Ville: </strong>{{$tour['delivery']['postal_code']}} {{$tour['delivery']['city']}}</li>
                                <li><strong>Produit commandé: </strong> {{($tour['delivery']['product_type']!='')? $tour['delivery']['product_type']: 'Multi-produits'}}</li>
                                <li><strong>Numéro de commande: </strong> {{$tour['delivery']['order_id']}}</li>
                                <li><strong>Fonction de prestation: </strong> {{$tour['delivery']['service']}}</li>
                            </ul>
                        </td>
                        <?php $remaining--;?>
                    @endforeach
                    @if($remaining > 0)
                        @for($i=1; $i<=$remaining; $i++)
                            <td></td>
                        @endfor
                    @endif
                @else
                    <td colspan="{{$records}}"></td>
                @endif
            </tr>
            <?php $number++; ?>
        @endforeach
        </tbody>
    </table>
</div>
<br>
<br>
<span>
        Bien cordialement,
        <br>
        L'équipe TDF Transport
        <br>
        <br>
        <div class="logo">
            <img src="http://34.213.180.141/assets/images/logoTDF.png" class="img-responsive">
            <br>
            <br>
            <strong>20 rue de Moreau - 75012 PARIS</strong>
        </div>


    </span>
</body>
</html>
