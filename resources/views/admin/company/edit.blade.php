@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: Create/Edit Company
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
                        <h3 class="panel-title bariol-thin">{!! isset($company->id) ? '<i class="fa fa-pencil"></i> Edit' : '<i class="fa fa-user"></i> Create' !!} Company</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-6 col-xs-12">
                    {!! Form::model($company, [ 'url' => URL::route('company.edit')] )  !!}
                    {{-- Field hidden to fix chrome and safari autocomplete bug --}}
                    {!! Form::password('__to_hide_password_autocomplete', ['class' => 'hidden']) !!}
                    <!-- Store Name text field -->
                    <div class="form-group">
                        {!! Form::label('Company Name','Company Name: *') !!}
                        {!! Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Company Name', 'autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('company_name') !!}</span>
                    
                    {!! Form::hidden('id') !!}
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
</script>
@stop