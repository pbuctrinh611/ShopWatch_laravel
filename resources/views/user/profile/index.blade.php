@extends('user.master')
@section('title')
Cập nhật thông tin
@endsection
@section('content')
<div class="login-register-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 mb-md--40">
                <h2 class="heading-secondary mb--30 text-center">Cập nhật thông tin</h2>
                <div class="login-reg-box p-4 bg--2">
                    <form action="{{route('user.update_profile')}}" method="POST" id="profileInfoUserForm">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                        <div class="form__group mb--20"><label class="form__label" for="username_name">
                            Họ tên<span>*</span></label>
                            <input type="text" name="name" id="name" class="form__input form__input--2" value="{{$user->name}}">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form__group mb--20"><label class="form__label" for="username_tel">
                            Số điện thoại<span>*</span></label>
                            <input type="text" name="tel" id="tel" class="form__input form__input--2" value="{{$user->tel}}">
                            <span class="text-danger error-text tel_error"></span>
                        </div>
                        <div class="form__group mb--20"><label class="form__label" for="username_email">
                            Email <span>*</span></label>
                            <input type="text" name="email" id="email" class="form__input form__input--2" value="{{$user->email}}">
                            <span class="text-danger error-text email_error"></span>
                        </div>
                        <div class="btn-submit__login d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-5 btn-style-1 color-1" id="update_information">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection