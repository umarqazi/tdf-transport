



<div class="custom_search">
  <input type="text" value="{{Input::get('search_field')}}" class="form-control search_dropdown" name="search_field" placeholder="Rechercher un client, une commande..">
  <a href="#" class="dropdown_btn"><i class="fa fa-chevron-down"></i></a>
  <button type="submit" class="btn btn_search"><i class="fa fa-search"></i></button>
  <div class="toggle_div">
    <span>Rechercher par</span>
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="customerCheck">
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
          <input type="checkbox" name="orderCheck">
        </label>
      </div>
      <div class="input-group">
        {{Form::text('order_id', Input::get('order_id'), ['class'=>'form-control', 'placeholder'=>'Rechercher une commande', 'id'=>'orderId'])}}
      </div>

    </div>

    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="dateCheck">
        </label>
      </div>
      <div class='input-group date' id='datetimepicker7'>
        {{ Form::text('datetime', Input::get('datetime'), ['placeholder'=>"Rechercher par date",'class'=>'form-control', 'id'=>'datetime'])}}
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
        </span>
      </div>

    </div>

    <div class="form-group">
      <div class="input-group text-center tbl-btns">
          <button type="submit" class='btn btn-primary button-padding'>
            RECHERCHER <i class="fa fa-search"></i>
          </button>
      </div>

    </div>
  </div>
</div>
