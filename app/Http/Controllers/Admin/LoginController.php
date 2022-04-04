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
        if (Auth::check() && Auth::user()->role->id != Role::CUSTOMER) {
            return redirect(route('admin.index'));
        }
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        $crendentials = $request->only('email', 'password');
        $bool = $request->has('remember') ? true : false;
        if (Auth::attempt($crendentials, $bool)) {
            return redirect(route('admin.index'));
        }
        return back()->with('alert-fail', 'Đăng nhập thất bại!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('admin.login'));
    }
}
