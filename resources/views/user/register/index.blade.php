@extends('user.master')
@section('title')
Đăng ký
@endsection
@section('content')
<div class="login-register-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 mb-md--40">
                <h2 class="heading-secondary mb--30 text-center">Đăng ký</h2>
                <div class="login-reg-box p-4 bg--2">
                    <form action="{{route('user.register')}}" method="POST" id="registerForm">
                        @csrf
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form__group mb--20"><label class="form__label" for="username_email">
                            Họ tên <span>*</span></label>
                            <input type="text" name="name" id="name" class="form__input form__input--2" value="{{ old('name') }}">
                            <span class="text text-danger error-text name_error"></span>
                        </div>
                        <div class="form__group mb--20"><label class="form__label" for="username_email">
                            Số điện thoại <span>*</span></label>
                            <input type="text" name="tel" id="tel" class="form__input form__input--2" value="{{ old('tel') }}">
                            <span class="text text-danger error-text tel_error"></span>
                        </div>
                        <div class="form__group mb--20"><label class="form__label" for="username_email">
                            Email <span>*</span></label>
                            <input type="text" name="email" id="email" class="form__input form__input--2" value="{{ old('email') }}">
                            <span class="text text-danger error-text email_error"></span>
                        </div>
                        <div class="form__group mb--20">
                            <label class="form__label" for="password">Mật khẩu
                                <span>*</span></label>
                            <input type="password" name="password" id="password" class="form__input form__input--2" value="{{ old('password') }}">
                            <span class="text text-danger error-text password_error"></span>
                        </div>
                        <input type="hidden" id="id_role" name="id_role" value="5">
                        <div class="btn-submit__login d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-5 btn-style-1 color-1 btn-save">Đăng ký</button>
                        </div>
                        <p class="text-center mt-3">Bạn đã có tài khoản?
                            <a href="{{route('user.show_login')}}">Đăng nhập</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection