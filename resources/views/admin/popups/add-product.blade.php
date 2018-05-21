<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <a href="{{url('/admin/product/list/')}}/{{$company->id}}">
                    <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </a>
            </div>
            {!! Form::model($newProduct, [ 'url' => URL::route('post.product.edit'), 'enctype'=>'multipart/form-data'] )  !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header text-center">
                            @if(is_null($newProduct['id']))
                                Ajouter des produits
                            @else
                                Modifier un produit
                            @endif
                        </h1>
                    </div>
                    <div class="col-lg-12 calendar-control">
                        <div class="content_wrapper clearfix">
                            <div class="form-inline tdf-form">
                                <h3>Informations sur les produits</h3>
                                <div class="form-group">
                                    {!! Form::label('product_family', 'Famille de produit') !!}
                                    <div class="input-group">
                                        {!! Form::text('product_family', null, ['class' => 'form-control', 'placeholder' => 'Famille de produit', 'id'=>'product_family' ,'autocomplete' => 'off']) !!}
                                        {!! Form::hidden('id') !!}
                                        {!! Form::hidden('company_id', $companyId) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('store_name') !!}</span>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('product_type', 'Produit') !!}
                                    <div class="input-group">
                                        {!! Form::text('product_type', null, ['class' => 'form-control', 'placeholder' => 'Produit', 'autocomplete' => 'off']) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('email') !!}</span>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('sav', 'Prix SAV') !!}
                                    <div class="input-group">
                                        {!! Form::number('sav', null, ['class' => 'form-control', 'placeholder' => 'Prix SAV', 'autocomplete' => 'off']) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('sav') !!}</span>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('livraison', 'Prix livraison') !!}
                                    <div class="input-group">
                                        {!! Form::number('livraison', null, ['class' => 'form-control', 'placeholder' => 'Prix livraison', 'autocomplete' => 'off']) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('livraison') !!}</span>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('livraison_montage', 'Livraison + montage') !!}
                                    <div class="input-group">
                                        {!! Form::number('livraison_montage', null, ['class' => 'form-control', 'placeholder' => 'Prix livraison + montage', 'autocomplete' => 'off']) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('livraison_montage') !!}</span>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('montage', 'Prix Montage') !!}
                                    <div class="input-group">
                                        {!! Form::number('montage', null, ['class' => 'form-control', 'placeholder' => 'Prix Montage', 'autocomplete' => 'off']) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('montage') !!}</span>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('rétrocession', 'Prix Rétrocession') !!}
                                    <div class="input-group">
                                        {!! Form::number('rétrocession', null, ['class' => 'form-control', 'placeholder' => 'Prix Rétrocession', 'autocomplete' => 'off']) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('rétrocession') !!}</span>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('prestataire', 'Prix Livraison prestataire') !!}
                                    <div class="input-group">
                                        {!! Form::number('prestataire', null, ['class' => 'form-control', 'placeholder' => 'Prix Livraison prestataire', 'autocomplete' => 'off']) !!}
                                    </div>
                                    <span class="text-danger">{!! $errors->first('prestataire') !!}</span>
                                </div>
                            </div>
                            <div class="clearfix popuup_submit">
                                <button type="submit" class="btn btn-success">
                                    @if(is_null($newProduct['id']))
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
