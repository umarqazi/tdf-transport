<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::model($newProduct, [ 'url' => URL::route('post.product.edit'), 'enctype'=>'multipart/form-data'] )  !!}
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header text-center">Ajouter </h1>
          </div>
          <div class="col-lg-12 calendar-control">
            <div class="content_wrapper clearfix">
              <div class="form-inline">
                <h3>Informations sur le vehicule</h3>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-truck fa-fw"></i></div>
                    {!! Form::text('product_family', null, ['class' => 'form-control', 'placeholder' => 'Product Family', 'autocomplete' => 'off']) !!}
                    {!! Form::hidden('id') !!}
                    {!! Form::hidden('company_id', $companyId) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('store_name') !!}</span>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></div>
                    {!! Form::text('product_type', null, ['class' => 'form-control', 'placeholder' => 'Product Fonction', 'autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('email') !!}</span>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-phone fa-fw"></i></div>
                    {!! Form::number('delivery_charges', null, ['class' => 'form-control', 'placeholder' => 'Delivery Charges', 'autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('phone_number') !!}</span>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-truck fa-fw"></i></div>
                    {!! Form::number('comission', null, ['class' => 'form-control', 'placeholder' => 'Comission', 'autocomplete' => 'off']) !!}
                  </div>
                  <span class="text-danger">{!! $errors->first('city') !!}</span>
                </div>
              </div>
              <div class="clearfix popuup_submit">
                <button type="submit" class="btn btn-success">Ajouter une nouvelle compagnie <i class="fa fa-save"></i></button>
                <a href="{{url('/admin/company/list')}}" class="btn btn-danger">Annuler <i class="fa fa-undo"></i></a>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>

    </div>
  </div>
</div>
