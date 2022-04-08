<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
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
        if(!$user || !Hash::check($request->password, $user->password) || $user->status != User::USER_STATUS) {
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

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return [
            'message' => 'Đăng xuất thành công'
        ];
    }
}
