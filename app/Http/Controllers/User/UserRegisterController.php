<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserRegisterController extends Controller
{
    public function registerForm() {
        if(Auth::check()) {
            return redirect()->route('user.index');
        }
        return view('user.register.index');
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), 
        [
            'name'     =>  'required',
            'tel'      =>  'required|numeric',
            'email'    =>  'required|email|unique:users,email',
            'password' =>  'required|min:8'
        ], 
        [
            'name.required'     =>  'Họ tên là bắt buộc',
            'tel.required'      =>  'Số điện thoại là bắt buộc',
            'tel.numeric'       =>  'Số điện thoại phải là số',
            'email.required'    =>  'Email là bắt buộc',
            'email.email'       =>  'Email nhập chưa đúng định dạng',
            'email.unique'      =>  'Email này đã tồn tại',
            'password.required' =>  'Mật khẩu là bắt buộc',
            'password.min'      =>  'Mật khẩu phải từ :min ký tự'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400, 
                'error'=> $validator->errors()->toArray()
            ]);
        }else{
            $password = Hash::make(request('password'));
            $data = [
                'name' => $request->name,
                'tel' => $request->tel,
                'email' => $request->email,
                'password' => $password,
                'id_role' => $request->id_role
            ];
            $user = User::create($data);
            if($user) {
                return response()->json([
                    'status' => 200,
                    'message' => "Thêm thành công"
                ]);
            }     
        }
    }
}
