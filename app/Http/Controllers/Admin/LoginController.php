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
        if(Auth::check()) {
            return redirect()->route('admin.home');
        }
        return view('admin.login');
    }

    public function login(Request $request) {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Sai định dạng email',
                'password.required' => 'Vui lòng nhập mật khẩu',
            ]
        );
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            return redirect()->route('admin.home')->with('alert-success', 'Đăng nhập thành công');
        }
        //Đăng nhập thất bại
        return redirect()->back()->with('alert-fail', 'Đăng nhập thất bại');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login');
    }
} 
