@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: Create/Edit Employee
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        {{-- successful message --}}
        <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
        @if($errors->has('model') )
            <div class="alert alert-danger">{!! $errors->first('model') !!}</div>
        @endif
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title bariol-thin">{!! isset($store->id) ? '<i class="fa fa-pencil"></i> Edit' : '<i class="fa fa-user"></i> Create' !!} Employee</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-6 col-xs-12">
                    <h4>Employee data</h4>
                    {!! Form::model($store, [ 'url' => URL::route('save.employee')] )  !!}
                    {{-- Field hidden to fix chrome and safari autocomplete bug --}}
                    {!! Form::password('__to_hide_password_autocomplete', ['class' => 'hidden']) !!}
                    <!-- Store Name text field -->
                    <div class="form-group">
                        {!! Form::label('Employee Name','Employee Name: *') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Employee Name', 'autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('name') !!}</span>
                    <!-- Store Email text field -->
                    <div class="form-group">
                        {!! Form::label('email','Employee Email: *') !!}
                        {!! Form::text('email_address', null, ['class' => 'form-control', 'placeholder' => 'Employee email', 'autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('email_address') !!}</span>
                    <!-- Phone number text field -->
                    <div class="form-group">
                        {!! Form::label('Landline Number', 'Landline Number') !!}
                        {!! Form::text('landline', null,['class' => 'form-control', 'placeholder' => 'Enter Employee Landline','autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('landline') !!}</span>
                    <!-- Phone number text field -->
                    <div class="form-group">
                        {!! Form::label('Mobile Number', 'Mobile Number') !!}
                        {!! Form::text('mobile_number', null,['class' => 'form-control', 'placeholder' => 'Enter Employee Mobile Number','autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('mobile_number') !!}</span>
                    <!-- address text field -->
                    <div class="form-group">
                        {!! Form::label('type', 'Type') !!}
                        {!! Form::select('type', ['Director'=>'Director', 'Accountant'=>'Accountant', 'TDF Contact'=>'TDF Contact'],null, ['class' => 'form-control', 'placeholder' => 'Select Employee Type','autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('type') !!}</span>
                    <!-- city text field -->                   
                    {!! Form::hidden('id') !!}
                    {!! Form::hidden('store_id', $storeId) !!}
                    {!! Form::hidden('form_name','user') !!}
                    {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
      </div>
</div>
@stop

@section('footer_scripts')
<script>
    $(".delete").click(function(){
        return confirm("Are you sure to delete this item?");
    });
    function showPassword(u)
    {
        if($(u).prop("checked") == true){
            $("#password-section").show();
        }
        else if($(u).prop("checked") == false){
            $("#password-section").hide();
        }
    }
</script>
@stop