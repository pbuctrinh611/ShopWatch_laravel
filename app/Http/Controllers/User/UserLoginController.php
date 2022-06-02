<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function loginForm() {
        if(Auth::check()) {
            return redirect()->route('user.index');
        }
        return view('user.login.index');
    }

    public function login(Request $request) {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Nhập sai định dạng email',
                'password.required' => 'Vui lòng nhập mật khẩu',
            ]
        );
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            return redirect()->route('user.index')->with('alert-success', 'Đăng nhập thành công!');;
        }
        return redirect()->back()->with('alert-fail', 'Đăng nhập thất bại!');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('user.index');
    }


}
