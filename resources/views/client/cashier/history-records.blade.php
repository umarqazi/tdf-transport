
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered text-center">
        <thead>
          <tr>
            <th class="text-center">Date de la livraison</th>
            <th class="text-center">Client</th>
            <th class="text-center">Numéro de commande</th>
            <th class="text-center">Numéro du bon de livraison</th>
            <th class="text-center">Téléphone</th>
            <th class="text-center">Ville</th>
            <th class="text-center">Code Postal</th>
            <th class="text-center">Type de prestation</th>
            <th class="text-center">Produit commandé</th>
            <th class="text-center">Prix de la livraison</th>
            <th class="text-center">Satisfaction client</th>
            <th class="text-center">Statut</th>
          </tr>
        </thead>
        <tbody>
          <?php $total=0;?>
          @foreach($allDeliveries as $delivery)
          <?php
          $items=array();
          if($delivery['delivery_price']=='0'){
            $price= 'Gratuit';
          }else{
            $price=$delivery['delivery_price']." €";
          }
          if($delivery['product_id']==0){
            $type="Multi-produits";
          }else{
            $type=$delivery['product_family'];
          }
          if($delivery['status']==1){
            $status="Validé";
          }elseif($delivery['status']==2){
            $status="Livré";
          }else{
            $status="En attente";
          }
          $total+=$delivery['delivery_price'];
          ?>
          <tr>
            <td>{{$delivery['datetime']}}</td>
            <td>{{$delivery['first_name']}} {{$delivery['last_name']}}</td>
            <td>@if($delivery['order_pdf'])<a href="{{asset('assets/images')}}/{{ Session::get('store_name') }}/{{$delivery['order_pdf']}}" target="_blank"><i class="fa fa-2x fa-file-pdf-o"></i></a>@endif {{$delivery['order_id']}}</td>
            <td>@if($delivery['delivery_pdf'])<a href="{{asset('assets/images')}}/{{ Session::get('store_name') }}/{{$delivery['delivery_pdf']}}" target="_blank" id="addPdfLink"><i class="fa fa-2x fa-file-pdf-o"></i></a>@endif {{$delivery['delivery_number']}}</td>
            <td>{{$delivery['mobile_number']}}</td>
            <td>{{$delivery['city']}}</td>
            <td>{{$delivery['postal_code']}}</td>
            <td>{{$delivery['service']}}</td>
            <td>{{$type}}</td>
            <td>{{$price}}</td>
            <td>@if($delivery['customer_feedback']==1) <i class="fa fa-circle green-circle"></i> @elseif($delivery['customer_feedback']==2) <i class="fa fa-circle yellow-circle"></i> @elseif($delivery['customer_feedback']==3) <i class="fa fa-circle red-circle"></i> @endif</td>
            <td>{{$status}}</td>
          </tr>
          @endforeach
          <tr>
              <td colspan="9" align=right>Total: </td>
              <td>{{$total}} €</td>
          </tr>
        </tbody>
      </table>
    </div>
    {{ $allDeliveries->links() }}
  </div>
</div>
