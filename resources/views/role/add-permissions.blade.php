@extends('layouts.admin.app')

@section('content')

    <div class="container-fluid page-body-wrapper">

      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row" style="font-family: 'Tajawal', sans-serif;">
        
            <div class="col-lg-12 grid-margin stretch-card">

              <div class="card" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">

        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card">
                <div class="card-header">
                         <div class="p-2 flex-grow-1">
                            <h3>Role : {{ $role->name }}</h3>
                        </div>
                   <div class="p-2">
                         <button onclick="history.back()" class="btn back" title="Back">&larr; Back</button>
                    </div>
              </div>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <label for="">Permissions</label>

                                <div class="row">
                                    @foreach ($permissions as $permission)
                                    <div class="col-md-2">
                                        <label>
                                            <input
                                                type="checkbox"
                                                name="permission[]"
                                                value="{{ $permission->name }}"
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                            />
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection