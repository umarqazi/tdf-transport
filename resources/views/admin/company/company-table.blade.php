<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> Company</h3>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9">
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
        <a href="{!! URL::route('company.edit') !!}" class="btn btn-info"><i class="fa fa-plus"></i> Add New Company</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        @if(! $stores->isEmpty() )
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Nom de la compagnie</th>
              <th>Magasins</th>
              <th>Des produits</th>
              <th>Operations</th>
            </tr>
          </thead>
          <tbody>
            @foreach($stores as $store)
            <tr>
              <td>{!! $store->company_name !!}</td>
              <td>
                <a href="{!! URL::route('store.list', ['companyId' => $store->id]) !!}" title="Add Employee" class="btn btn-primary">View Stores</a> &nbsp;
              </td>
              <td>
                <a href="{!! URL::route('product.list', ['companyId' => $store->id]) !!}" title="Add Employee" class="btn btn-primary">View Products</a> &nbsp;
              </td>
              <td>
                <a href="{!! URL::route('company.edit', ['id' => $store->id]) !!}" title="Edit Store"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                <a href="{!! URL::route('company.delete',['id' => $store->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete" title="Delete Store"><i class="fa fa-trash-o fa-2x"></i></a>
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
