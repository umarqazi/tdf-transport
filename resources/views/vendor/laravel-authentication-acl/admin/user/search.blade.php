<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i> User search</h3>
    </div>
    <div class="panel-body">
        {!! Form::open(['route' => 'users.list','method' => 'get']) !!}
        <!-- email text field -->
        <div class="form-group">
            {!! Form::label('email','Email: ') !!}
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'user email']) !!}
        </div>
        <span class="text-danger">{!! $errors->first('email') !!}</span>
        <!-- first_name text field -->
        <div class="form-group">
            {!! Form::label('email','Fonction: ') !!}
            {!! Form::select('type', Config::get('constants.Users'), $request->get('type',''), ["class"=> "form-control"] ) !!}
        </div>
        <div class="form-group">
            {!! Form::label('first_name','First name: ') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'first name']) !!}
        </div>
        <span class="text-danger">{!! $errors->first('first_name') !!}</span>
        <!-- last_name text field -->
        <div class="form-group">
            {!! Form::label('last_name','Last name:') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'last name']) !!}
        </div>
        <span class="text-danger">{!! $errors->first('last_name') !!}</span>
        <!-- zip text field -->
        <!-- code text field -->
        
        <div class="form-group">
            {!! Form::label('activated', 'Active: ') !!}
            {!! Form::select('activated', ['' => 'Any', 1 => 'Yes', 0 => 'No'], $request->get('activated',''), ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('banned', 'Banned: ') !!}
            {!! Form::select('banned', ['' => 'Any', 1 => 'Yes', 0 => 'No'], $request->get('banned',''), ["class" => "form-control"]) !!}
        </div>
        
        
        <div class="form-group">
            <a href="{!! URL::route('users.list') !!}" class="btn btn-default search-reset">Reset</a>
            {!! Form::submit('Search', ["class" => "btn btn-info", "id" => "search-submit"]) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>