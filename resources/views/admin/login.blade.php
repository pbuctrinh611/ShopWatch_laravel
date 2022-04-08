<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Admin | Log in</title>
 

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">
</head>

<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Trang quản trị</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg ">Đăng nhập để tiếp tục</p>

          <form action="{{route('admin.login')}}" method="POST">
            @csrf
            <div class="input-group mb-2">
              <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            @if($errors->has('email'))
              <span class="text text-danger">{{$errors->first('email')}}</span>
            @endif
            <div class="input-group mb-2">
              <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            @if($errors->has('password'))
              <span class="text text-danger">{{$errors->first('password')}}</span>
            @endif
            <div class="form-group form-check d-flex justify-content-between mt-2">
              <div>
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Nhớ tài khoản</label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
        </div>
      </div>
    </div>
  </div>

</body>
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>

@php
if (session('alert-fail'))
{
echo '<script>
  toastr.error("'.session('alert-fail').'")
</script>';
}
@endphp

</html>