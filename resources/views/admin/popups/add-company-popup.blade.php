<div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <a href="{{url('/admin/company/list')}}">
                    <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </a>
            </div>
            {!! Form::model($company, [ 'url' => URL::route('company.edit')] )  !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header text-center">
                            @if(is_null($company['id']))
                                Ajouter une société
                            @else
                                Modifier une société
                            @endif
                        </h1>
                    </div>
                    <div class="col-lg-12 calendar-control">
                        <div class="content_wrapper clearfix">
                            <div class="form-inline tdf-form">
                                <h3>Informations sur la société </h3>
                                <div class="form-group">
                                    {!! Form::label('company_name', 'Nom de la société') !!}
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-building fa-fw"></i></div>
                                        {!! Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Nom de la société', 'autocomplete' => 'off']) !!}
                                        {!! Form::hidden('id') !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('company_name') !!}</span>
                                </div>
                            </div>
                            <div class="col-lg-12 clearfix popuup_submit">
                                <button type="submit" class="btn btn-success">
                                    @if(is_null($company['id']))
                                        Ajouter
                                    @else
                                        Modifier
                                    @endif
                                    <i class="fa fa-save"></i>
                                </button>
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
