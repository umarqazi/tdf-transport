<div class="modal fade" id="addVehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
      {!! Form::model($vehicle, [ 'url' => URL::route('vehicle.edit')] )  !!}
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header text-center">Ajouter un nouveau vehicule </h1>
          </div>      
        <div class="col-lg-12 calendar-control">
          <div class="content_wrapper clearfix">
            <div class="form-inline">
              <h3>Informations sur le vehicule</h3>
                <div class="form-group">
                  <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-truck fa-fw"></i></div>
                                  {!! Form::text('vehicle_name', null, ['class' => 'form-control', 'placeholder' => 'Type de Vehicule', 'autocomplete' => 'off']) !!}
                                </div>
                                <span class="text-danger">{!! $errors->first('vehicle_name') !!}</span>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-truck fa-fw"></i></div>
                                  {!! Form::text('number_plate', null, ['class' => 'form-control', 'placeholder' => 'N plaque d`immatriculation', 'autocomplete' => 'off']) !!}
                                </div>
                                <span class="text-danger">{!! $errors->first('number_plate') !!}</span>

                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
                                  {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de Passe', 'autocomplete' => 'off']) !!}
                                </div>
                                <span class="text-danger">{!! $errors->first('password') !!}</span>
                            </div>
                        </div>

                        <div class="form-inline">
                        <h3>Informations sur le chauffeur</h3>
                            <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
                                  {!! Form::text('user_first_name', null, ['class' => 'form-control', 'placeholder' => 'Nom', 'autocomplete' => 'off']) !!}
                                </div>
                                <span class="text-danger">{!! $errors->first('first_name') !!}</span>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
                                  {!! Form::text('user_last_name', null, ['class' => 'form-control', 'placeholder' => 'Prenom', 'autocomplete' => 'off']) !!}
                                </div>
                                <span class="text-danger">{!! $errors->first('last_name') !!}</span>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-id-card fa-fw"></i></div>
                                  {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Adresse e-mail du chauffeur', 'autocomplete' => 'off']) !!}
                                </div>
                                <span class="text-danger">{!! $errors->first('email') !!}</span>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-phone fa-fw"></i></div>
                                  {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Numero de telephone chauffeur', 'autocomplete' => 'off']) !!}
                                </div>
                                <span class="text-danger">{!! $errors->first('phone_number') !!}</span>
                                {!! Form::hidden('id') !!}
                            </div>
                        </div>
                       <div class="clearfix popuup_submit">
                                <button type="submit" class="btn btn-success">Ajouter un nouveau vehicule <i class="fa fa-save"></i></button>
                                <a href="{{url('/admin/users/dashboard')}}" class="btn btn-danger">Annuler Ma Demande <i class="fa fa-trash"></i></a>
                            </div>
                </div>
                </div>
               {!! Form::close() !!}
            </div>
      </div>
      
    </div>
  </div>
</div>