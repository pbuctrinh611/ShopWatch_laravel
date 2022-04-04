<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserRequest;

class LoginController extends Controller
{
    public function showLoginForm() {
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
        //Check email
        $user = User::where('email', $request->email)->first();
        //Check password
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Đăng nhập thất bại'
            ], 401);
        }else {
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token,
                'message' => 'Đăng nhập thành công'
            ];
            return response($response, 201);
        }
    }
}
