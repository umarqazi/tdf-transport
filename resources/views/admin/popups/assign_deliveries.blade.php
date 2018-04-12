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
            <h1 class="page-header text-center">Choix de la livraison</h1>
          </div>
          <div class="col-md-6">
              <span class="delivery-heading">Liste des livraisons du jour <i class="fa fa-cubes fa-fw"></i></span>
          </div>
          <div class="col-md-6 pull-right text-center">
              <table class="filter-tale">
                  <tr>
                      <td><i class="fa fa-filter"></i></td>
                      <td>
                          <a href="{{url('/planDriverTour', ['id'=>$user_id, 'city'=>'city'])}}" class="filter-button color1">VILLE</a>
                          <a href="{{url('/planDriverTour', ['id'=>$user_id, 'service'=>'service'])}}" class="filter-button color2">TYPE DE PRESTATION</a>
                            <a href="{{url('/planDriverTour', ['id'=>$user_id, 'product'=>'product'])}}" class="filter-button color3">PRODUITS</a>
                    </td>
                  </tr>
              </table>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <input type="hidden" name="time_slot" id="time_slot">
                {{Form::hidden('user_id', $user_id, [])}}
                <table class="table table-striped table-bordered text-center heading-font">
                  <thead>
                    <tr>
                      <th class="text-center">Date de la livraison</th>
                      <th class="text-center">Tranche horaire</th>
                      <th class="text-center">Client</th>
                      <th class="text-center">Numero de commande</th>
                      <th class="text-center">Numero du bon de livraison</th>
                      <th class="text-center">Telephone</th>
                      <th class="text-center">Adresse</th>
                      <th class="text-center">Villes</th>
                      <th class="text-center">Code Postal</th>
                      <th class="text-center">Fonction de Prestation</th>
                      <th class="text-center">Produit(s) commande(s)</th>
                      <th class="text-center">Prix de la livraison</th>
                      <th class="text-center">Sélection de la livraison</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($deliveries))
                      @foreach($deliveries as $delivery)
                      <?php
                      $items=array();
                      if($delivery['delivery_price']=='Gratuit'){
                        $price= 'Gratuit';
                      }else{
                        $price=$delivery['delivery_price']." €";
                      }
                      ?>
                      <tr>
                        <td>{{date('d/m/Y', strtotime($delivery['datetime']))}}</td>
                        <td>{{$delivery['day_period']}}</td>
                        <td>{{$delivery['first_name']}} {{$delivery['last_name']}}</td>
                        <td>@if($delivery['order_pdf'])<a href="{{asset('assets/images')}}/{{$delivery['store_name']}}/{{$delivery['order_pdf']}}" target="_blank"><i class="fa fa-2x fa-file-pdf-o pdf-font"></i></a>@endif {{$delivery['order_id']}}</td>
                        <td><a href="{{asset('assets/images')}}/{{$delivery['store_name']}}/{{$delivery['delivery_pdf']}}" target="_blank" id="addPdfLink"><i class="fa fa-2x fa-file-pdf-o pdf-font"></i></a> {{$delivery['delivery_number']}}</td>
                        <td>{{$delivery['mobile_number']}}</td>
                        <td>{{$delivery['address']}}</td>
                        <td>{{$delivery['city']}}</td>
                        <td>{{$delivery['postal_code']}}</td>
                        <td>{{$delivery['service']}}</td>
                        <td>{{$delivery['product_type']}}</td>
                        <td>{{$price}}</td>
                        <td>
                          <div class="checkboxDiv"><input type="checkbox" name="delivery_id" value="{{$delivery['id']}}"></div>
                        </td>
                      </tr>
                      @endforeach
                    @else
                      <tr><td colspan="11">Records not found</td></tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center tbl-btns">
              <button class="button-styling" type="submit">Valider ma sélection <i class="fa fa-save"></i></button>
            </div>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
