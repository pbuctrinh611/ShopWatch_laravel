@extends('user.master')
@section('title')
Đổi mật khẩu
@endsection
@section('content')
<div class="login-register-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 mb-md--40">
                <h2 class="heading-secondary mb--30 text-center">Đổi mật khẩu</h2>
                <div class="login-reg-box p-4 bg--2">
                    <form action="{{route('user.change_password')}}" method="POST" id="changePasswordUserForm">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                        <div class="form__group mb--20">
                            <label class="form__label">Mật khẩu cũ<span>*</span></label>
                            <input type="password" name="old_password" id="old_password" class="form__input form__input--2" placeholder="Nhập mật khẩu cũ...">
                            <span class="text-danger error-text old_password_error"></span>
                        </div>
                        <div class="form__group mb--20">
                            <label class="form__label">Mật khẩu mới<span>*</span></label>
                            <input type="password" name="new_password" id="new_password" class="form__input form__input--2" placeholder="Nhập mật khẩu mới...">
                            <span class="text-danger error-text new_password_error"></span>
                        </div>
                        <div class="form__group mb--20">
                            <label class="form__label">Nhập lại mật khẩu mới<span>*</span></label>
                            <input type="password" name="confirm-new__password" id="email" class="form__input form__input--2" placeholder="Nhập lại mật khẩu mới...">
                            <span class="text-danger error-text confirm-new__password_error"></span>
                        </div>
                        <div class="btn-submit__login d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-5 btn-style-1 color-1" id="update_information">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection