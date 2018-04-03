



<div class="custom_search">
<input type="text" class="form-control search_dropdown" placeholder="search here">
<a href="#" class="dropdown_btn"><i class="fa fa-chevron-down"></i></a>
<button type="button" class="btn btn_search"><i class="fa fa-search"></i></button>
<div class="toggle_div">
        <div class="form-group">
          <div class="checkbox">
  <label>
    <input type="checkbox" value="">
  </label>
</div>
          <div class="input-group">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            {{Form::text('customer_name', Input::get('customer_name'), ['class'=>'form-control', 'placeholder'=>'Rechercher un client', 'id'=>'customer'])}}
          </div>
        </div>

        <div class="form-group">
          <div class="checkbox">
  <label>
    <input type="checkbox" value="">
  </label>
</div>
          <div class="input-group">
            {{Form::text('order_id', Input::get('order_id'), ['class'=>'form-control', 'placeholder'=>'Rechercher une commande', 'id'=>'orderId'])}}
          </div>

        </div>

      <div class="form-group">
        <div class="checkbox">
  <label>
    <input type="checkbox" value="">
  </label>
</div>
        <div class='input-group date' id='datetimepicker5'>
          {{ Form::text('datetime', Input::get('datetime'), ['class'=>'form-control', 'id'=>'datetime'])}}
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>

      </div>

  <div class="form-group">
      <div class="input-group text-center tbl-btns">
        {{Form::submit('Search', ['class'=>'btn btn-primary button-padding'])}}
      </div>

    </div>
</div>
</div>
