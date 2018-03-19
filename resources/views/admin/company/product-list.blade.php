@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Product List
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-md-11">
            {{-- print messages --}}
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
                <div class="alert alert-success">{!! $message !!}</div>
            @endif
            {{-- print errors --}}
            @if($errors && ! $errors->isEmpty() )
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{!! $error !!}</div>
                    @endforeach
                @endif
                {{-- user lists --}}
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> Product</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-9 col-sm-9">
                                {!! Form::open(['method' => 'get', 'class' => 'form-inline']) !!}
                                    <div class="form-group">
                                        {!! Form::text('name', $request->name, ['class' =>'form-control', 'placeholder'=> "Search by Name"]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                              <button class="btn btn-primary" data-toggle="modal" data-target="#contactUsModal">  Bulk Upload</button>
                              </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                    <a href="{!! URL::route('product.edit', ['companyId'=>$companyId]) !!}" class="btn btn-info"><i class="fa fa-plus"></i> Add New Product</a>
                            </div>
                        </div>
                      <div class="row">
                          <div class="col-md-12">
                              @if(! $product->isEmpty() )
                              <table class="table table-hover">
                                      <thead>
                                          <tr>
                                              <th>Product Family</th>
                                              <th>Product Type</th>
                                              <th>Delivery Charges</th>
                                              <th>Commission</th>
                                              <th>Operations</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach($product as $store)
                                          <tr>
                                              <td>{!! $store->product_family !!}</td>
                                              <td>{!! $store->product_type !!}</td>
                                              <td>{!! $store->delivery_charges !!}</td>
                                              <td>{!! $store->comission !!}</td>
                                              
                                              <td>
                                                  <a href="{!! URL::route('product.edit', ['id' => $store->id]) !!}" title="Edit Store"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                  <a href="{!! URL::route('product.delete',['id' => $store->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete" title="Delete Store"><i class="fa fa-trash-o fa-2x"></i></a>
                                              </td>
                                          </tr>
                                      </tbody>
                                      @endforeach
                              </table>
                              <div class="paginator">
                                  {!! $product->links() !!}
                              </div>
                              @else
                                  <span class="text-warning"><h5>No results found.</h5></span>
                              @endif
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
    <div class="modal fade" id="contactUsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Upload Excel File</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          {!! Form::open(array('url' => URL::route("import"), 'method' => 'post', "enctype"=>"multipart/form-data") ) !!}
            <div class="modal-body">
                <div class="">
                    <div class="row">
                      <label class="btn btn-default btn-info btn-file">
                        Choose Excel File <input type="file" name="bulk_upload" style="display: none;">
                      </label>
                      {!! Form::hidden('company_id', $companyId) !!}
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" value="Upload" class="btn btn-info">
          </div>
          {!! Form::close() !!}
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