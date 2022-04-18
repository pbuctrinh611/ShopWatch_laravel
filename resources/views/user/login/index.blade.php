@extends('user.master')
@section('title')
Đăng nhập
@endsection
@section('content')
<div class="login-register-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 mb-md--40">
                <h2 class="heading-secondary mb--30 text-center">Đăng nhập</h2>
                <div class="login-reg-box p-4 bg--2">
                    <form action="{{route('user.login')}}" method="POST">
                        @csrf
                        <div class="form__group mb--20"><label class="form__label" for="username_email">
                            Email <span>*</span></label>
                            <input type="text" name="email" id="email" class="form__input form__input--2" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <span class="text text-danger">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form__group mb--20">
                            <label class="form__label" for="password">Mật khẩu
                                <span>*</span></label>
                            <input type="password" name="password" id="password" class="form__input form__input--2" value="{{ old('password') }}">
                            @if($errors->has('password'))
                                <span class="text text-danger">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                        <div class="form__group d-flex justify-content-between align-items-center">
                            <div class="">
                                <input type="checkbox" name="sessionStore" id="sessionStore" class="form__checkbox">
                                <label for="sessionStore" class="form__checkbox--label">Nhớ tài khoản</label>
                            </div>
                            <a href="" class="forgot-pass">Quên mật khẩu ?</a>
                        </div>
                        <div class="btn-submit__login d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-5 btn-style-1 color-1">Đăng nhập</button>
                        </div>
                        <p class="text-center mt-3">Nếu bạn chưa là thành viên hãy 
                            <a href="{{route('user.show_register')}}">Đăng ký</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection