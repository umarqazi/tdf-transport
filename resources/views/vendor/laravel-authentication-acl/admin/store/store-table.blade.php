<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> Stores</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-10 col-md-9 col-sm-9">
                {!! Form::open(['method' => 'get', 'class' => 'form-inline']) !!}
                    <div class="form-group">
                        {!! Form::text('name', $request->name, ['class' =>'form-control', 'placeholder'=> "Search by Name"]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3">
                    <a href="{!! URL::route('store.edit', ['companyId'=>$companyId]) !!}" class="btn btn-info"><i class="fa fa-plus"></i> Add New Store</a>
            </div>
        </div>
      <div class="row">
          <div class="col-md-12">
              @if(! $stores->isEmpty() )
              <table class="table table-hover">
                      <thead>
                          <tr>
                              <th>Store Name</th>
                              <th>Email</th>
                              <th>Phone Number</th>
                              <th class="hidden-xs">Address</th>
                              <th class="hidden-xs">City</th>
                              <th>Zip Code</th>
                              <th>Active</th>
                              <th>Operations</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($stores as $store)
                          <tr>
                              <td>{!! $store->store_name !!}</td>
                              <td>{!! $store->email !!}</td>
                              <td>{!! $store->phone_number !!}</td>
                              <td class="hidden-xs">{!! $store->address !!}</td>
                              <td class="hidden-xs">{!! $store->city !!}</td>
                              <td class="hidden-xs">{!! $store->zip_code !!}</td>
                              <td>{!! $store->status ? '<i class="fa fa-circle green"></i>' : '<i class="fa fa-circle-o red"></i>' !!}</td>
                              <td>
                                  @if(! $store->protected)
                                      <a href="{!! URL::route('add.employee', ['storeId' => $store->id]) !!}" title="Add Employee"><i class="fa fa-plus fa-2x"></i></a> &nbsp;
                                      <a href="{!! URL::route('store.update', ['id' => $store->id]) !!}" title="Edit Store"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                      <a href="{!! URL::route('store.delete',['id' => $store->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete" title="Delete Store"><i class="fa fa-trash-o fa-2x"></i></a>

                                  @else
                                      <i class="fa fa-times fa-2x light-blue"></i>
                                      <i class="fa fa-times fa-2x margin-left-12 light-blue"></i>
                                  @endif
                              </td>
                          </tr>
                      </tbody>
                      @endforeach
              </table>
              <div class="paginator">
                  {!! $stores->links() !!}
              </div>
              @else
                  <span class="text-warning"><h5>No results found.</h5></span>
              @endif
          </div>
      </div>
    </div>
</div>
