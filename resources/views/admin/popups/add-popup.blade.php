
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      {!! Form::model($user, [ 'url' => URL::route('users.edit')] )  !!}
      <div class="modal-body">
        <div class="row">
          @if($errors && ! $errors->isEmpty() )
          @foreach($errors->all() as $error)
          <div class="alert alert-danger">{!! $error !!}</div>
          @endforeach
          @endif
          <div class="col-lg-12">
            <h1 class="page-header text-center">Ajouter un nouveau utilisateurs </h1>
          </div>
          <div class="col-lg-12 calendar-control">
            <div class="content_wrapper clearfix">
              <div class="form-inline">
                <h3>Informations sur le utilisateurs</h3>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-users fa-fw"></i></div>
                    {!! Form::text('user_first_name', null, ["class"=> "form-control", "placeholder"=>"Prénom"] ) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('user_first_name') !!}</span>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-users fa-fw"></i></div>
                    {!! Form::text('user_last_name', null, ["class"=> "form-control", "placeholder"=>"nom de famille"] ) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('user_last_name') !!}</span>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></div>
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'user email', 'autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('email') !!}</span>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '','autocomplete' => 'off', "placeholder"=>"Password"]) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('password') !!}</span>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'confirm Password','autocomplete' => 'off']) !!}
                  </div>
                </div>
              </div>
              <div class="form-inline">

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user-md fa-fw"></i></div>
                    {!! Form::select('type', Config::get('constants.Users'), null, ["class"=> "form-control", "onchange"=>"showStoreName(this)"] ) !!}
                  </div>
                </div>
                <div class="form-group" style=display:{{($user->type=="TDF Manager" || $user->type=="Driver") ? "none":""}} id="storeName">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-id-card fa-fw"></i></div>
                    {!! Form::select('store_id', $stores, null, ["class"=> "form-control"] ) !!}
                  </div>
                </div>
                <div class="form-group" style=display:{{($user->type=="Driver") ? "":"none"}} id="driverRecord">
                  <div class="">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-truck fa-fw"></i></div>
                      {!! Form::text('vehicle_name', null, ['class' => 'form-control', 'placeholder' => 'Type de véhicule', 'autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('vehicle_name') !!}</span>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-truck fa-fw"></i></div>
                      {!! Form::text('number_plate', null, ['class' => 'form-control', 'placeholder' => "Plaque d'immatriculation", 'autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('number_plate') !!}</span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-id-card fa-fw"></i></div>
                    {!! Form::select('activated', [""=>"statut","1" => "Yes", "0" => "No"], (isset($user->activated) && $user->activated) ? $user->activated : "", ["class"=> "form-control"] ) !!}

                    {!! Form::hidden('banned', "1", ["class"=> "form-control"] ) !!}
                    {!! Form::hidden('id') !!}
                    {!! Form::hidden('form_name','user') !!}
                  </div>
                </div>
              </div>
              <div class="clearfix popuup_submit">
                <button type="submit" class="btn btn-success">Ajouter un nouveau utilisateurs <i class="fa fa-save"></i></button>
                <a href="{{url('/admin/users/list')}}" class="btn btn-danger">Annuler <i class="fa fa-undo"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
