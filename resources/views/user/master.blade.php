<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description"><!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('user/img/icon.png') }}"><!-- Title -->
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- ************************* CSS Files ************************* -->
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}"><!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}"><!-- Elegent Icon CSS -->
    <link rel="stylesheet" href="{{ asset('user/css/elegent-icons.css') }}"><!-- All Plugins CSS css -->
    <link rel="stylesheet" href="{{ asset('user/css/plugins.css') }}"><!-- style css -->
    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/custom.css') }}">
    @yield('link_css')
    <!-- modernizr JS    ============================================ -->
    <script src="{{ asset('user/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <!--[if lt IE 9]><script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
<!-- Main Wrapper Start -->
<div class="wrapper bg--shaft">
    @include('user.components.header')
    <!-- Main Content Wrapper Start -->
    <div class="main-content-wrapper">
        @yield('content')
    </div><!-- Main Content Wrapper Start -->
    @include('user.components.footer')
</div><!-- Main Wrapper End -->
<!-- ************************* JS Files ************************* -->
<!-- jQuery JS -->
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('user/js/vendor/jquery.min.js') }}"></script><!-- Bootstrap and Popper Bundle JS -->
<script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script><!-- All Plugins Js -->
<script src="{{ asset('user/js/plugins.js') }}"></script><!-- Ajax Mail Js -->
<script src="{{ asset('user/js/ajax-mail.js') }}"></script><!-- Main JS -->
<script src="{{ asset('user/js/main.js') }}"></script>
<script src="{{ asset('user/js/home-page.js') }}"></script>
<script src="{{ asset('user/js/product-page.js') }}"></script>
<script src="{{ asset('user/js/product-detail.js') }}"></script>
<script src="{{ asset('user/js/cart-management.js') }}"></script>
<script src="{{ asset('user/js/blog-page.js') }}"></script>
<script src="{{ asset('user/js/user-register.js') }}"></script>
<script src="{{ asset('user/js/user-information.js') }}"></script>
<script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>


@yield('script')
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
</body>

</html>
