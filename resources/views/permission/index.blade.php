
@extends('layouts.admin.app')

@section('content')


<div class="container-fluid page-body-wrapper">


  <div class="content-wrapper">

    <div class="row" style="font-family: 'Tajawal', sans-serif;">
  
      <div class="col-lg-12 grid-margin stretch-card">

        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card ">
                    <div class="card-header">
                       <div class="p-2 flex-grow-1">
                            <h3>Permissions</h3>
                        </div>
                  <div class="p-2">
                  @can('create permission')
                  <a href="{{ url('permissions/create') }}" class="btn btn-primary float-end">Add Permission</a>
                  @endcan
                  </div>
              </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th width="40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        @can('update permission')
                                        <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="btn btn-success">Edit</a>
                                        @endcan

                                        @can('delete permission')
                                        <a href="{{ url('permissions/'.$permission->id.'/delete') }}" class="btn btn-danger mx-2">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection