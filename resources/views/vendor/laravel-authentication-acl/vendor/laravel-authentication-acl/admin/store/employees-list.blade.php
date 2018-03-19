@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Employees list
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
                        <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> Store's Employees</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-10 col-md-9 col-sm-9">
                                {!! Form::open(['method' => 'get', 'class' => 'form-inline']) !!}
                                    <div class="form-group">
                                        {!! Form::select('stores', $stores, $request->get('stores',''), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::select('type', [''=>"Select Type",'Director'=>'Director', 'Accountant'=>'Accountant', 'TDF Contact'=>'TDF Contact'], $request->get('type',''), ['class' => 'form-control', "Placeholder"=>"Select Type"]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::text('name', $request->name, ['class' =>'form-control', 'Placeholder'=>'Search by Name']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::text('email', $request->email, ['class' =>'form-control', 'Placeholder'=>'Search by Email']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if(! $employees->isEmpty() )
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Store Name</th>
                                            <th>Employee Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th class="hidden-xs">Landline</th>
                                            <th class="hidden-xs">Type</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                        <tr>
                                            <td>{!! $employee->store_name !!}</td>
                                            <td>{!! $employee->name !!}</td>
                                            <td>{!! $employee->email_address !!}</td>
                                            <td>{!! $employee->mobile_number !!}</td>
                                            <td class="hidden-xs">{!! $employee->landline !!}</td>
                                            <td class="hidden-xs">{!! $employee->type !!}</td>
                                            <td>
                                                @if(! $employee->protected)
                                                <a href="{!! URL::route('edit.employee', ['id' => $employee->id]) !!}" title="Edit Store"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                <a href="{!! URL::route('employee.delete',['id' => $employee->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete" title="Delete Store"><i class="fa fa-trash-o fa-2x"></i></a>
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
                                    {!! $employees->links() !!}
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
@stop

@section('footer_scripts')
    <script>
        $(".delete").click(function(){
            return confirm("Are you sure to delete this item?");
        });
    </script>
@stop