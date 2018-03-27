<div class="modal fade" id="deliveries" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::model(null, [ 'url' => URL::route('tour.plan')] )  !!}
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header text-center">CHOIX DE LA LIVRAISAN</h1>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <input type="hidden" name="time_slot" id="time_slot">
                <input type="hidden" name="driver_id" id="driver_id">
                <table class="table table-striped table-bordered text-center">
                  <thead>
                    <tr>
                      <th class="text-center">Date de la livraison</th>
                      <th class="text-center">Client</th>
                      <th class="text-center">Numero de commande</th>
                      <th class="text-center">Numero du bon de livraison</th>
                      <th class="text-center">Telephone</th>
                      <th class="text-center">Villes</th>
                      <th class="text-center">Code Postal</th>
                      <th class="text-center">Type de Prestation</th>
                      <th class="text-center">Produit(s) commande(s)</th>
                      <th class="text-center">Prix de la livraison</th>
                      <th class="text-center">Satisfaction client</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($deliveries as $delivery)
                    <?php
                    $items=array();
                    if($delivery['delivery_price']=='Free'){
                      $price= 'Free';
                    }else{
                      $price=$delivery['delivery_price']." €";
                    }
                    if($delivery['products']){
                      foreach($delivery['products'] as $key=>$product){
                        $items[$key]=$product['product_family'];
                      }
                      $items=implode(',', $items);
                    }
                    ?>
                    <tr>
                      <td>{{$delivery['datetime']}}</td>
                      <td>{{$delivery['first_name']}} {{$delivery['last_name']}}</td>
                      <td>@if($delivery['order_pdf'])<a href="{{asset('assets/images')}}/{{ Session::get('store_name') }}/{{$delivery['order_pdf']}}" target="_blank"><i class="fa fa-2x fa-file-pdf-o"></i></a>@endif {{$delivery['order_id']}}</td>
                      <td><a href="{{asset('assets/images')}}/{{ Session::get('store_name') }}/{{$delivery['delivery_pdf']}}" target="_blank" id="addPdfLink">{{$delivery['delivery_pdf']}}</a></td>
                      <td>{{$delivery['mobile_number']}}</td>
                      <td>{{$delivery['city']}}</td>
                      <td>{{$delivery['postal_code']}}</td>
                      <td>{{$delivery['service']}}</td>
                      <td>{{$items}}</td>
                      <td>{{$price}}</td>
                      <td>
                        <div class="checkboxDiv"><input type="checkbox" name="delivery_id" value="{{$delivery['id']}}"></div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center tbl-btns">
              <button class="button-styling" type="submit">Valider ma Selection <i class="fa fa-save"></i></button>
            </div>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
