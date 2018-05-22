<div class="modal fade" id="deliveries" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <a href="{{ URL::route('tour.plan',['id' => $user_id]) }}">
                    <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header text-center">Choix de la livraison <i class="fa fa-cubes fa-fw"></i></h1>
                    </div>

                    <div class="col-lg-12">
                        <div class="row">
                            <form action="{{ URL::route('tour.plan.filter',['id' => $user_id]) }}" method="post">
                                <div class="form-inline">
                                    <div class="col-md-3">
                                        <div class="city-filter">
                                            <i class="fa fa-filter"></i>
                                            <select class="form-control" name="filterCity">
                                                <option value="default">VILLE</option>
                                                @if(!empty($deliveryCities))
                                                    @foreach($deliveryCities as $deliveryCity)
                                                        <option value="{{$deliveryCity}}" @if(!empty($oldValues['filterCity']) && $oldValues['filterCity'] == $deliveryCity) selected @endif>
                                                            {{$deliveryCity}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <?php $services = Config::get('constants.Services') ?>
                                            <select class="form-control selectpicker" name="filterServices">
                                                @foreach($services as $key =>$service)
                                                    <option value="{{empty($key)? 'default': $key}}" @if(!empty($oldValues['filterServices']) && $oldValues['filterServices'] == $service) selected @endif>{{$service}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <select class="form-control selectpicker" name="filterStores">
                                                <option value="default">Sélectionnez un magasin</option>
                                                @if(!empty($deliveryStores))
                                                    @foreach($deliveryStores as $deliveryStore)
                                                        <option value="{{$deliveryStore['id']}}" @if(!empty($oldValues['filterStores']) && $oldValues['filterStores'] == $deliveryStore['id']) selected @endif>{{$deliveryStore['store_name']}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class=" product-family-search">
                                            <input type="text" class="form-control product-family-search-input" placeholder="Choisissez une famille de produits" disabled>
                                            <a href="#" class="delivery_dropdown_btn"><i class="fa fa-chevron-down"></i></a>
                                            <div class="delivery_toggle_div">
                                                <span class="text-center" id="product-family-search-heading">Rechercher par</span>
                                                @if(!empty($deliveryFamilies))
                                                    @foreach($deliveryFamilies as $deliveryFamily)
                                                        <div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="customerCheck" name="filterProducts[]" value="{{$deliveryFamily['id']}}" @if(!empty($oldValues['filterProducts']) && in_array($deliveryFamily['id'],$oldValues['filterProducts'])) checked @endif> {{$deliveryFamily['product_family']}}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="user_id" value="{{$user_id}}">
                                        <input type="hidden" name="date" value="{{$nextDate}}">
                                        <input type="hidden" name="filter_time_slot" class="time_slot" value="{{empty($oldValues['filter_time_slot']) ? '': $oldValues['filter_time_slot']}}">
                                        <button type="submit" class="btn delivery_search"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-12">
                        {!! Form::model(null, [ 'url' => URL::route('tour.plan')] )  !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <input type="hidden" name="date" value="{{$nextDate}}">
                                    <input type="hidden" name="time_slot" class="time_slot" value="{{empty($oldValues['filter_time_slot']) ? '': $oldValues['filter_time_slot']}}">
                                    {{Form::hidden('user_id', $user_id, [])}}
                                    <table class="table table-striped table-bordered text-center heading-font">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Date de la livraison</th>
                                            <th class="text-center">Tranche horaire</th>
                                            <th class="text-center">Nom du magasin</th>
                                            <th class="text-center">Client</th>
                                            <th class="text-center">Numero de commande</th>
                                            <th class="text-center">Numero du bon de livraison</th>
                                            <th class="text-center">Téléphone fixe</th>
                                            <th class="text-center">Téléphone mobile</th>
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
                                                if($delivery['sub_product_id']==''){
                                                    $type="Multi-produits";
                                                }else{
                                                    $type=$delivery['product_type'];
                                                }
                                                ?>
                                                <tr>
                                                    <td>{{date('d/m/Y', strtotime($delivery['datetime']))}}</td>
                                                    <td>{{$delivery['day_period']}}</td>
                                                    <td>{{$delivery->store->store_name}}</td>
                                                    <td>{{$delivery['first_name']}} {{$delivery['last_name']}}</td>
                                                    <td>@if($delivery['order_pdf'])<a href="{{asset('assets/images')}}/{{$delivery['stores_id']}}/{{$delivery['order_pdf']}}" target="_blank"><i class="fa fa-2x fa-file-pdf-o pdf-font"></i></a>@endif {{$delivery['order_id']}}</td>
                                                    <td>@if($delivery['delivery_pdf'])<a href="{{asset('assets/images')}}/{{$delivery['stores_id']}}/{{$delivery['delivery_pdf']}}" target="_blank" id="addPdfLink"><i class="fa fa-2x fa-file-pdf-o pdf-font"></i></a>@endif {{$delivery['delivery_number']}}</td>
                                                    <td>{{$delivery['landline']}}</td>
                                                    <td>{{str_replace("+33","0",$delivery['mobile_number'])}}</td>
                                                    <td>{{$delivery['address']}}</td>
                                                    <td>{{$delivery['city']}}</td>
                                                    <td>{{$delivery['postal_code']}}</td>
                                                    <td>{{$delivery['service']}}</td>
                                                    <td>{{$type}}</td>
                                                    <td>{{$price}}</td>
                                                    <td>
                                                        <div class="checkboxDiv"><input type="checkbox" name="delivery_id[]" value="{{$delivery['id']}}"></div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr><td colspan="11">Enregistrements non trouvés.</td></tr>
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
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
