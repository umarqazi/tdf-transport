<div class="modal fade" id="updateDriver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      {!! Form::model($vehicle, [ 'url' => URL::route('driver.edit')] )  !!}
      <div class="modal-body">
        <div class="row">
          @if (session('error_msg'))
          <div class="alert alert-danger">
            {{ session('error_msg') }}
          </div>
          @endif
          <div class="col-lg-12">
            <h1 class="page-header text-center">
              @if(is_null($vehicle['id']))
              Ajouter un véhicule
              @else
              Modifier un véhicule
              @endif
            </h1>
          </div>
          <div class="col-lg-12 calendar-control">
            <div class="content_wrapper clearfix">
              <div class="form-inline tdf-form">
                <h3>Informations sur le chauffeur</h3>
                <div class="form-group">
                  {!! Form::label('activated', 'Chauffeur') !!}
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
                    {!! Form::select('driver', $nonActive, "", ["class"=> "form-control"] ) !!}
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label('activated', 'statut') !!}
                  <div class="input-group">
                    {!! Form::select('activated', [""=>"statut","1" => "Actif", "0" => "Inactif"], (isset($vehicle->activated) && $vehicle->activated) ? $vehicle->activated : "", ["class"=> "form-control"] ) !!}
                  </div>
                </div>
              </div>
              <div class="form-inline tdf-form">
                <h3>Informations sur le vehicule</h3>
                <div class="form-group">
                  {!! Form::label('vehicle_name', 'Type de véhicule') !!}
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-truck fa-fw"></i></div>
                    {!! Form::text('vehicle_name', null, ['class' => 'form-control', 'placeholder' => 'Type de véhicule', 'autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('vehicle_name') !!}</span>
                </div>
                <div class="form-group">
                  {!! Form::label('number_plate', 'Immatriculation') !!}
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-id-card"></i></div>
                    {!! Form::text('number_plate', null, ['class' => 'form-control', 'placeholder' => "Immatriculation", 'autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('number_plate') !!}</span>
                </div>

                <div class="form-group">
                  {!! Form::label('password', 'Mot de Passe') !!}
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de Passe', 'autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('password') !!}</span>
                </div>
              </div>


              <div class="clearfix popuup_submit">
                <button type="submit" class="btn btn-success">
                  @if(is_null($vehicle['id']))
                  Ajouter
                  @else
                  Modifier
                  @endif
                  <i class="fa fa-save"></i>
                </button>
                {{Form::hidden('id',$vehicle['id'], [])}}
                <a href="{{url('/admin/users/dashboard')}}" class="btn btn-danger">Annuler <i class="fa fa-undo"></i></a>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>

    </div>
  </div>
</div>