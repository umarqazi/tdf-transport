<div class="modal fade" id="editDelivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <a href="{{url('/admin/users/dashboard')}}">
          <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </a>
      </div>
      {!! Form::model(null, [ 'url' => URL::route('delivery.note.edit'), "enctype"=>"multipart/form-data",] )  !!}
      <div class="modal-body">
        <div class="row">
          @if (session('error_msg'))
          <div class="alert alert-danger">
            {{ session('error_msg') }}
          </div>
          @endif
          <div class="col-lg-12">
            <h1 class="page-header text-center">
              Modifier une livraison
            </h1>
          </div>
          <div class="col-lg-12 calendar-control">
            <div class="content_wrapper clearfix">
              <div class="form-inline tdf-form">
                <h3>Ajout du bon de livraison</h3>
                <div class="form-group">
                  {!! Form::label('Numéro du bon de livraison', 'Numéro de livraison') !!}
                  <div class="">
                    {!! Form::text('delivery_note', null, ['class' => 'form-control', 'placeholder' => 'Numéro du bon de livraison', 'autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('vehicle_name') !!}</span>
                </div>
                <div class="form-group">
                  {!! Form::label('number_plate', 'Bon de livraison') !!}
                  <label class="btn btn-default btn-info btn-file">
                      Chosir un fichier <input type="file" name="pdf" id="file-upload" style="display: none;">
                  </label>
                  <label id="fileName"></label>
                  <span class="text-danger">{!! $errors->first('number_plate') !!}</span>
                </div>
              </div>


              <div class="clearfix popuup_submit">
                <button type="submit" class="btn btn-success">
                  Ajouter
                  <i class="fa fa-plus"></i>
                </button>
                {{Form::hidden('id',null, ['id'=>'delivery_id'])}}
                <a data-dismiss="modal" aria-label="Close" class="modal-close btn btn-danger">Annuler <i class="fa fa-undo"></i></a>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>

    </div>
  </div>
</div>
