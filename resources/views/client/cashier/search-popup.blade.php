
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
  <div class="modal-dialog validateMessagePopup" role="document">
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
              <span>Etes-vous sur de vouloir valider les livraisons sélectionnées ?</span>
              <br>
              <span>Une fois validées, les informations seront communiquées à la société TDF.</span>
            </div>
          </div>
        </div>

        <div class=" text-center">
          <button type="button" class="btn btn-primary validate-check green-color">OUI</button>
          <button type="button" class="btn btn-secondary red-color" data-dismiss="modal">NON</button>
        </div>
      </div>

    </div>
  </div>
</div>
