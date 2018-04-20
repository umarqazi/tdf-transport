
<div class="modal fade" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <a href="{{url('/admin/store/employee/list/')}}/{{$storeId}}"><span aria-hidden="true">&times;</span></a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        </button>
      </div>
      {!! Form::model($store, [ 'url' => URL::route('save.employee')] )  !!}
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header text-center">
              @if(is_null($store['id']))
                Ajouter un utilisateur
              @else
                Modifier un utilisateur
              @endif
            </h1>
          </div>
          <div class="col-lg-12 calendar-control">
            <div class="content_wrapper clearfix">
              <div class="form-inline">
                <h3>Informations sur l’utilisateur</h3>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom', 'autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('name') !!}</span>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></div>
                    {!! Form::text('email_address', null, ['class' => 'form-control', 'placeholder' => 'E-mail', 'autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('email_address') !!}</span>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-phone fa-fw"></i></div>
                    {!! Form::text('landline', null,['class' => 'form-control', 'placeholder' => 'Téléphone fixe ','autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('landline') !!}</span>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></div>
                    {!! Form::text('mobile_number', null,['class' => 'form-control', 'placeholder' => 'Téléphone : mobile ','autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('mobile_number') !!}</span>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i></div>
                    {!! Form::select('type', ['Director'=>'Director', 'Accountant'=>'Accountant', 'TDF Contact'=>'TDF Contact'],null, ['class' => 'form-control', 'placeholder' => 'Choisir la fonction','autocomplete' => 'off']) !!}
                  </div>
                </div>
                <div class="form-group">

                </div>
                <div class="form-group">
                  <div class="input-group">
                    {!! Form::hidden('store_id', $storeId) !!}
                    {!! Form::hidden('id') !!}
                    {!! Form::hidden('form_name','user') !!}
                  </div>
                </div>
              </div>

              <div class="clearfix popuup_submit">
                <button type="submit" class="btn btn-success">
                  @if(is_null($store['id']))
                    Ajouter
                  @else
                    Modifier
                  @endif
                  <i class="fa fa-save"></i>
                </button>
                <a href="{{url('/admin/store/employee/list/')}}/{{$storeId}}" class="btn btn-danger">Annuler <i class="fa fa-undo"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
