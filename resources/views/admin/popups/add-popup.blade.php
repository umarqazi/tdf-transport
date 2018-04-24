
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
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
                        <h1 class="page-header text-center">
                            @if(is_null($user['id']))
                                Ajouter un utilisateur
                            @else
                                Modifier un utilisateur
                            @endif
                        </h1>
                    </div>
                    <div class="col-lg-12 calendar-control">
                        <div class="content_wrapper clearfix">
                            <div class="form-inline user-form-row" style="max-width: 600px; margin: 0 auto;">
                                <div class="row">
                                    <h3>Informations sur l’utilisateur</h3>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                {!! Form::text('user_first_name', null, ["class"=> "form-control", "placeholder"=>"Prénom"] ) !!}
                                            </div>
                                            <span class="text-danger">{!! $errors->first('user_first_name') !!}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                {!! Form::text('user_last_name', null, ["class"=> "form-control", "placeholder"=>"Nom"] ) !!}
                                            </div>
                                            <span class="text-danger">{!! $errors->first('user_last_name') !!}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                {!! Form::select('activated', [""=>"statut","1" => "Actif", "0" => "Inactif"], (isset($user->activated) && $user->activated) ? $user->activated : "", ["class"=> "form-control"] ) !!}

                                                {!! Form::hidden('banned', "1", ["class"=> "form-control"] ) !!}
                                                {!! Form::hidden('id') !!}
                                                {!! Form::hidden('form_name','user') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                {!! Form::select('type', Config::get('constants.User Type'), null, ["class"=> "form-control", "onchange"=>"showStoreName(this)"] ) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group" id="companyName" style=display:{{(($user->type== Config::get('constants.Users.TDF Manager') || $user->type== Config::get('constants.Users.Driver')) || $user->type==NULL) && Input::old('company_id') == '' ? "none":""}}>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                                {!! Form::select('company_id', $companies, isset($user->store->company_id) ? $user->store->company_id : null, ["class"=> "form-control", 'onchange' =>'getStores(this)']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group" id="storeName" style=display:{{(($user->type== Config::get('constants.Users.TDF Manager') || $user->type== Config::get('constants.Users.Driver')) || $user->type==NULL)  && Input::old('store_id') == '' ? "none":""}}>
                                            <div class="input-group" id="CompanyStores">
                                                <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                                {!! Form::select('store_id', $stores, null, ["class"=> "form-control", "id" =>"store_dropdown"] ) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-phone-square"></i></div>
                                                {!! Form::text('phone_number', null, ["class"=> "form-control", "placeholder"=>"Téléphone"] ) !!}
                                            </div>
                                            <span class="text-danger">{!! $errors->first('phone_number') !!}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                                {!! Form::text('mobile_number', null, ["class"=> "form-control", "placeholder"=>"Mobile"] ) !!}
                                            </div>
                                            <span class="text-danger">{!! $errors->first('mobile_number') !!}</span>
                                        </div>
                                    </div>

                                    <div class="form-group driverFields" id="driverRecord" style=display:{{($user->type==Config::get('constants.Users.Driver')) ? "":"none"}}>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-id-card fa-fw"></i></div>
                                                    {!! Form::text('vehicle_name', null, ['class' => 'form-control', 'placeholder' => 'Type de véhicule', 'autocomplete' => 'off']) !!}
                                                </div>
                                                <span class="text-danger">{!! $errors->first('vehicle_name') !!}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-id-card fa-fw"></i></div>
                                                    {!! Form::text('number_plate', null, ['class' => 'form-control', 'placeholder' => "Immatriculation", 'autocomplete' => 'off']) !!}
                                                </div>
                                                <span class="text-danger">{!! $errors->first('number_plate') !!}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></div>
                                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Adresse mail', 'autocomplete' => 'off']) !!}
                                            </div>
                                            <span class="text-danger">{!! $errors->first('email') !!}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
                                                {!! Form::password('password', ['class' => 'form-control','autocomplete' => 'off', "placeholder"=>"Mot de passe"]) !!}
                                            </div>
                                            <span class="text-danger">{!! $errors->first('password') !!}</span>
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="confirmPasswordText">Confirmer de mot de passe</div>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
                                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmer le mot de passe','autocomplete' => 'off']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix popuup_submit">
                                        <button type="submit" class="btn btn-success">
                                            @if(is_null($user['id']))
                                                Ajouter
                                            @else
                                                Modifier
                                            @endif
                                            <i class="fa fa-save"></i>
                                        </button>
                                        <a href="{{url('/admin/users/list')}}" class="btn btn-danger">Annuler <i class="fa fa-undo"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
