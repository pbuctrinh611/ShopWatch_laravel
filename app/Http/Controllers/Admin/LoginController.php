<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Login\LoginRequest;
use App\Models\Role;

class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
       return view('admin.login');
    }

    public function login(Request $request) {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'password.required' => 'Vui lòng nhập mật khẩu',
            ]
        );
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            return redirect()->route('admin.home');
        }
        //Đăng nhập thất bại
        return redirect()->route('admin.show_login');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login');
    }

} 