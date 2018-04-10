@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: Create/Edit Product
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
                        <h3 class="panel-title bariol-thin">{!! isset($company->id) ? '<i class="fa fa-pencil"></i> Edit' : '<i class="fa fa-user"></i> Create' !!} Product</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-6 col-xs-12">
                    {!! Form::model($product, [ 'url' => URL::route('post.product.edit')] )  !!}
                    {{-- Field hidden to fix chrome and safari autocomplete bug --}}
                    {!! Form::password('__to_hide_password_autocomplete', ['class' => 'hidden']) !!}
                    <!-- Store Name text field -->
                    <div class="form-group">
                        {!! Form::label('Company Name','Product Family: *') !!}
                        {!! Form::text('product_family', null, ['class' => 'form-control', 'placeholder' => 'Product Family', 'autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('product_family') !!}</span>
                    <div class="form-group">
                        {!! Form::label('Product Fonction','Product Fonction: *') !!}
                        {!! Form::text('product_type', null, ['class' => 'form-control', 'placeholder' => 'Product Fonction', 'autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('product_type') !!}</span>
                    <div class="form-group">
                        {!! Form::label('Product Fonction','Delivery Charges: *') !!}
                        {!! Form::number('delivery_charges', null, ['class' => 'form-control', 'placeholder' => 'Delivery Charges', 'autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('delivery_charges') !!}</span>
                    <div class="form-group">
                        {!! Form::label('Product Fonction','Commission: *') !!}
                        {!! Form::number('comission', null, ['class' => 'form-control', 'placeholder' => 'Comission', 'autocomplete' => 'off']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('comission') !!}</span>
                    
                    {!! Form::hidden('id') !!}
                    {!! Form::hidden('company_id', $companyId) !!}
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