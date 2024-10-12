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
                    <div class="card-header">

        <h3>Profile</h3>
  
</div>
                        
                    </div>
                    <div class="card-body">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

           
        </div>
    </div>
@endsection