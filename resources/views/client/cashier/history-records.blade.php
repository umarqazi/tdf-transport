
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                <tr>
                    <th class="text-center vertical-middle">Date de la livraison</th>
                    <th class="text-center vertical-middle">Client</th>
                    <th class="text-center vertical-middle">Client email</th>
                    <th class="text-center vertical-middle">Numéro de commande</th>
                    <th class="text-center vertical-middle">Numéro du bon de livraison</th>
                    <th class="text-center vertical-middle">Téléphone</th>
                    <th class="text-center vertical-middle">Adresse</th>
                    <th class="text-center vertical-middle">Ville</th>
                    <th class="text-center vertical-middle">Code Postal</th>
                    <th class="text-center vertical-middle">Fonction de prestation</th>
                    <th class="text-center vertical-middle">Produit commandé</th>
                    <th class="text-center vertical-middle">Prix de la livraison</th>
                    <th class="text-center vertical-middle">Satisfaction client</th>
                    <th class="text-center vertical-middle">Informations sur la livraison (chauffeur)</th>
                    <th class="text-center vertical-middle">Statut</th>
                    <th class="text-center vertical-middle">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $total=0;?>
                @if(!$allDeliveries->isEmpty())
                    @foreach($allDeliveries as $delivery)
                        <?php
                        $items=array();
                        if($delivery['delivery_price']=='0'){
                            $price= 'Gratuit';
                        }else{
                            $price=$delivery['delivery_price']." €";
                        }
                        if($delivery['sub_product_id']==''){
                            $type="Multi-produits";
                        }else{
                            $type=$delivery['product_type'];
                        }
                        if($delivery['status']==Config::get('constants.Status.Active')){
                            $status="Validé";
                        }elseif($delivery['status']==Config::get('constants.Status.Delivered')){
                            $status="Livré";
                        }elseif($delivery['status']==Config::get('constants.Status.Return') || $delivery['status']==Config::get('constants.Status.Pending')){
                            $status="En attente";
                        }
                        $total+=$delivery['delivery_price'];
                        $url=URL('delivery').'/'.$delivery['id'];
                        ?>
                        <tr>
                            <td>{{Date::parse($delivery['datetime'])->format('d/m/Y')}}</td>
                            <td>{{$delivery['first_name']}} {{$delivery['last_name']}}</td>
                            <td>{{$delivery['customer_email']}}</td>
                            <td>@if($delivery['order_pdf'])<a href="{{asset('assets/images')}}/{{ $delivery['stores_id'] }}/{{$delivery['order_pdf']}}" target="_blank"><i class="fa fa-2x fa-file-pdf-o pdf-font"></i></a>@endif {{$delivery['order_id']}}</td>
                            <td>@if($delivery['delivery_pdf'])<a href="{{asset('assets/images')}}/{{ $delivery['stores_id'] }}/{{$delivery['delivery_pdf']}}" target="_blank" id="addPdfLink"><i class="fa fa-2x fa-file-pdf-o pdf-font"></i></a>@endif {{$delivery['delivery_number']}}</td>
                            <td>{{$delivery['mobile_number']}}</td>
                            <td>{{$delivery['address']}}</td>
                            <td>{{$delivery['city']}}</td>
                            <td>{{$delivery['postal_code']}}</td>
                            <td>{{$delivery['service']}}</td>
                            <td>{{$type}}</td>
                            <td>{{$price}}</td>
                            <td>@if($delivery['client_satisfaction']==1) <i class="fa fa-circle green-circle"></i> @elseif($delivery['client_satisfaction']==2) <i class="fa fa-circle yellow-circle"></i> @elseif($delivery['client_satisfaction']==3) <i class="fa fa-circle red-circle"></i> @endif</td>
                            <td>{{($delivery["delivery_problem"]!=0)? Config::get('constants.Driver Feedback.'.$delivery["delivery_problem"]): ""}}</td>
                            <td>{{$status}}</td>
                            <td><a class="btn btn-warning" href="{{$url}}"><i class="fa fa-pencil-square-o"></i></a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="12"><strong>Désolé aucun résultat n'a été trouvé.</strong></td>
                    </tr>
                @endif
                <tr>
                    <td colspan="11" align=right>Total: </td>
                    <td>{{$total}} €</td>
                </tr>
                </tbody>
            </table>
        </div>
        {{ $allDeliveries->links() }}
    </div>
</div>
