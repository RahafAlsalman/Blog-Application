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

                @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Edit User
                            <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('users/'.$user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" />
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" readonly value="{{ $user->email }}" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="text" name="password" class="form-control" />
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Roles</label>
                                <select name="roles[]" class="form-control" multiple>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option
                                        value="{{ $role }}"
                                        {{ in_array($role, $userRoles) ? 'selected':'' }}
                                    >
                                        {{ $role }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
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