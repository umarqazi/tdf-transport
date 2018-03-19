@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: Create/Edit Store
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
                        <h3 class="panel-title bariol-thin">{!! isset($store->id) ? '<i class="fa fa-pencil"></i> Edit' : '<i class="fa fa-user"></i> Create' !!} Store</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-6 col-xs-12">
                    <h4>Store data</h4>
                    {!! Form::model($store, [ 'url' => URL::route('post.store.edit')] )  !!}
                    {{-- Field hidden to fix chrome and safari autocomplete bug --}}
                    {!! Form::password('__to_hide_password_autocomplete', ['class' => 'hidden']) !!}
                    <!-- Store Name text field -->
                    <div class="form-group">
                        {!! Form::label('Store Name','Store Name: *') !!}
                        {!! Form::text('store_name', null, ['class' => 'form-control', 'placeholder' => 'Store Name', 'autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('store_name') !!}</span>
                    <!-- Store Email text field -->
                    <div class="form-group">
                        {!! Form::label('email','Store Email: *') !!}
                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Store email', 'autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('email') !!}</span>
                    <!-- Phone number text field -->
                    <div class="form-group">
                        {!! Form::label('Phone Number', 'Phone Number') !!}
                        {!! Form::text('phone_number', null,['class' => 'form-control', 'placeholder' => 'Enter Store Phone Number','autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('phone_number') !!}</span>
                    <!-- address text field -->
                    <div class="form-group">
                        {!! Form::label('address', 'Address') !!}
                        {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Enter Store Address','autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('address') !!}</span>
                    <!-- city text field -->
                    <div class="form-group">
                        {!! Form::label('address', 'City') !!}
                        {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Enter Store City','autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('city') !!}</span>

                    <!-- zip Code text field -->
                    <div class="form-group">
                        {!! Form::label('Zip Code', 'Zip Code') !!}
                        {!! Form::text('zip_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Zip Code','autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('zip_code') !!}</span>
                    <div class="form-group">
                        {!! Form::label("activated","Store Status: ") !!}
                        {!! Form::select('status', ["1" => "Yes", "0" => "No"], (isset($store->status) && $store->status) ? $store->activated : "0", ["class"=> "form-control"] ) !!}
                    </div>
                    {!! Form::hidden('company_id', $companyId) !!}
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