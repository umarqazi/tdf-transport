<div class="col-lg-12 calendar-control">
  <table class="align-center">
    <tr>
      <td>
        <div class="form-group">
          <div class="input-group">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            {{Form::text('customer_name', Input::get('customer_name'), ['class'=>'form-control', 'placeholder'=>'Rechercher un client', 'id'=>'customer'])}}
          </div>
          <span class="text-danger">{!! $errors->first('order_id') !!}</span>
        </div></td>
        <td>&nbsp;</td>
        <td><div class="form-group">
          <div class="input-group">
            {{Form::text('order_id', Input::get('order_id'), ['class'=>'form-control', 'placeholder'=>'Rechercher une commande', 'id'=>'orderId'])}}
          </div>
          <span class="text-danger">{!! $errors->first('order_id') !!}</span>
        </div>
      </td>
      <td>&nbsp;</td>
      <td><div class="form-group">
        <div class='input-group date' id='datetimepicker5'>
          {{ Form::text('datetime', Input::get('datetime'), ['class'=>'form-control', 'id'=>'datetime'])}}
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
        <span class="text-danger">{!! $errors->first('datetime') !!}</span>
      </div>
    </td>
    <td>&nbsp;</td>
    <td><div class="form-group">
      <div class="input-group text-center tbl-btns">
        {{Form::submit('Search', ['class'=>'btn btn-primary button-padding'])}}
      </div>
      <span class="text-danger">{!! $errors->first('order_id') !!}</span>
    </div>
  </td>
</tr>
</table>
</div>
