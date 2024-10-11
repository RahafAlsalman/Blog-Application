<!DOCTYPE html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Lavish Ride Tech</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('admin/images/logo/favicon.ico')}}" />
 

  <meta name="csrf-token" content="{{ csrf_token()}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> 
  <!-- Applying the Font -->
  <style>
    /* Apply Tajawal font to headings and paragraphs */
    h1, h2, h3, h4, h5, h6, p {
      font-family: 'Tajawal', sans-serif;
    }
    
  </style>
</head>


<body>

<div class="container-scroller d-flex">

@include('layouts.admin.sidebar')
@yield('content')

</div>

  <!-- base:js -->
  <script src="{{asset('admin/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('admin/vendors/chart.js/Chart.min.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('admin/js/off-canvas.js')}}"></script>
  <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('admin/js/template.js')}}"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="{{asset('admin/js/dashboard.js')}}"></script>
  <!-- End custom js for this page-->
</body>

</html>