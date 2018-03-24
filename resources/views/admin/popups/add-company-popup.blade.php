<div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
      {!! Form::model($company, [ 'url' => URL::route('company.edit')] )  !!}
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header text-center">Ajouter un nouveau vehicule </h1>
          </div>      
        <div class="col-lg-12 calendar-control">
          <div class="content_wrapper clearfix">
            <div class="form-inline">
              <h3>Informations sur le vehicule</h3>
                <div class="form-group">
                  <div class="input-group">
                                  <div class="input-group-addon"><i class="fa fa-truck fa-fw"></i></div>
                                  {!! Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Store Name', 'autocomplete' => 'off']) !!}
                                  {!! Form::hidden('id') !!}
                                </div>
                                <span class="text-danger">{!! $errors->first('vehicle_name') !!}</span>
                            </div>
                            
                        </div>
                       <div class="clearfix popuup_submit">
                                <button type="submit" class="btn btn-success">Ajouter une nouvelle compagnie <i class="fa fa-save"></i></button>
                                <a href="{{url('/admin/company/list')}}" class="btn btn-danger">Annuler Ma Demande <i class="fa fa-trash"></i></a>
                            </div>
                </div>
                </div>
               {!! Form::close() !!}
            </div>
      </div>
      
    </div>
  </div>
</div>