
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header text-center">Listes des résultats</h1>
          </div>
          <div class="col-lg-12 calendar-control">
            <table class="align-center">
              <tr>
                <td>
                  <div class="form-group">
                    <div class="input-group">
                      <meta name="csrf-token" content="{{ csrf_token() }}" />
                      {{Form::text('customer_name', null, ['class'=>'form-control', 'placeholder'=>'Rechercher un client', 'id'=>'customer2'])}}
                    </div>
                    <span class="text-danger">{!! $errors->first('order_id') !!}</span>
                  </div></td>
                  <td>&nbsp;</td>
                  <td><div class="form-group">
                    <div class="input-group">
                      {{Form::text('order_id', null, ['class'=>'form-control', 'placeholder'=>'Rechercher une commande', 'id'=>'orderId2'])}}
                    </div>
                    <span class="text-danger">{!! $errors->first('order_id') !!}</span>
                  </div>
                </td>
                <td>&nbsp;</td>
                <td><div class="form-group">
                  <div class="input-group">
                    {{Form::text('date', null, ['class'=>'form-control', 'placeholder'=>'Rechercher par date', 'id'=>'dateTime2'])}}
                  </div>
                  <span class="text-danger">{!! $errors->first('order_id') !!}</span>
                </div>
              </td>
              <td>&nbsp;</td>
              <td>
              </td>
            </tr>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered text-center" id="searchResult">

            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>

<!-- validate Popup -->

<div class="modal fade" id="valdiateMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="">
            <div class="page-header text-center col-lg-12">
              <span>Etes-vous sur de vouloir valider les livraisons selectionnees?</span>
              <br>
              <span>une fois validees, les informations seront communiquees a la societe TDF</span>
            </div>
            <div class="page-header text-center col-lg-12">

            </div>


          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
          <button type="button" class="btn btn-primary validate-check">OUI</button>
        </div>
      </div>

    </div>
  </div>
</div>
