<div class="modal fade" id="addStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::model($store, [ 'url' => URL::route('post.store.edit'), 'enctype'=>'multipart/form-data'] )  !!}
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header text-center">
              @if(is_null($store['id']))
                Ajouter un magasin
              @else
                Modifier un magasin
              @endif
            </h1>
          </div>
          <div class="col-lg-12 calendar-control">
            <div class="content_wrapper clearfix">
              <div class="form-inline">
                <h3> Informations sur le magasin</h3>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-building fa-fw"></i></div>
                    {!! Form::text('store_name', null, ['class' => 'form-control', 'placeholder' => 'Magasin', 'autocomplete' => 'off']) !!}
                    {!! Form::hidden('id') !!}
                    {!! Form::hidden('company_id', $companyId) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('store_name') !!}</span>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></div>
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail', 'autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('email') !!}</span>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-phone fa-fw"></i></div>
                    {!! Form::text('phone_number', null,['class' => 'form-control', 'placeholder' => 'Téléphone','autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('phone_number') !!}</span>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-map-pin fa-fw"></i></div>
                    {!! Form::text('address', null, ['rows'=>'2','class' => 'form-control', 'placeholder' => 'Adresse','autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('address') !!}</span>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-map-pin fa-fw"></i></div>
                    {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Ville','autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('city') !!}</span>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-map-pin fa-fw"></i></div>
                    {!! Form::text('zip_code', null, ['class' => 'form-control', 'placeholder' => 'Code postal','autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('zip_code') !!}</span>
                </div>
                <div class="form-group text-center">
                  <div class="input-group">
                    {!! Form::file('store_logo', null, ['class' => 'form-control', 'placeholder' => 'Enter Zip Code','autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('store_logo') !!}</span>
                </div>
              </div>
              <div class="clearfix popuup_submit">
                <button type="submit" class="btn btn-success">Ajouter <i class="fa fa-save"></i></button>
                <a href="{{url('/admin/company/list')}}" class="btn btn-danger">Annuler <i class="fa fa-undo"></i></a>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>

    </div>
  </div>
</div>
