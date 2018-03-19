{{-- add Product --}}
{!! Form::open(["route" => "add.product.company","role"=>"form", 'class' => 'form-add-perm']) !!}
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon form-button button-add-perm"><span class="glyphicon glyphicon-plus-sign add-input"></span></span>
        {!! Form::select('product', $products, '', ["class"=>"form-control permission-select"]) !!}
    </div>
    <span class="text-danger">{!! $errors->first('product') !!}</span>
    {!! Form::hidden('id', $company->id) !!}
    {{-- add permission operation --}}
    {!! Form::hidden('operation', 1) !!}
</div>
@if(! $company->exists)
<div class="form-group">
    <span class="text-danger"><h5>You need to create the Company first.</span>
</div>
@endif
{!! Form::close() !!}

{{-- remove permission --}}
@if($companyProduct)
@foreach($companyProduct as $product)
{!! Form::open(["route" => "add.product.company", "name" => $product->id, "role"=>"form"]) !!}
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon form-button button-del-perm" name="{!! $product->id !!}"><span class="glyphicon glyphicon-minus-sign add-input"></span></span>
        {!! Form::text('permission_desc', $product->product_family, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        {!! Form::hidden('companyProducts', $product->id) !!}
        {!! Form::hidden('id', $company->id) !!}
        {{-- add permission operation --}}
        {!! Form::hidden('operation', 0) !!}
    </div>
</div>
{!! Form::close() !!}
@endforeach
@elseif($company->exists)
<span class="text-warning"><h5>There is no permission associated to the user.</h5></span>
@endif
@section('footer_scripts')
@parent
<script>
    $(".button-add-perm").click(function () {
        <?php if($company->exists): ?>
        $('.form-add-perm').submit();
        <?php endif; ?>
    });
    $(".button-del-perm").click(function () {
        // submit the form with the same name
        name = $(this).attr('name');
        $('form[name='+name+']').submit();
    });
</script>
@stop