<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Admin - @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  @yield('link_css')
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">
    {{-- Header --}}
    @include('admin.components.header')

    {{-- Sidebar --}}
    @include('admin.components.sidebar')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">@yield('title')</h1>
            </div>
          </div>
          
        </div>
      </div>
      <!-- /.content-header -->

      {{-- Main Content here --}}
      @yield('content')
    </div>

    {{-- Footer --}}
    @include('admin.components.footer')

  </div>
  <div class="box-spinner d-none">
    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  {{-- Active Link --}}
  <script src="{{ asset('admin/js/active-link.js') }}"></script>
  <script src="{{ asset('admin/js/user-management.js') }}"></script>
  <script src="{{ asset('admin/js/product-management.js') }}"></script>
  <!-- AdminLTE -->
  <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>

  <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
  
  @php
    if (session('alert-success'))
    {
      echo '<script>toastr.success("'.session('alert-success').'")</script>';
    }
    if (session('alert-fail'))
    {
      echo '<script>toastr.error("'.session('alert-fail').'")</script>';
    }
  @endphp 

  @yield('script')
</body>

</html>