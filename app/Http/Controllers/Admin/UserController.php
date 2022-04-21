<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        $users = User::whereNotIn('id_role', [1])->orderBy('id', 'desc')->get();
        $roles = Role::whereNotIn('id', [1])->orderBy('id', 'asc')->get();
        return view('admin.user.index', compact('users', 'roles'));
    }

    public function fetchUser() {
        $users = User::whereNotIn('id_role', [1])->with('role')->orderBy('id', 'desc')->get();
        $roles = Role::whereNotIn('id', [1])->orderBy('id', 'asc')->get();
        return response()->json([
            'users'=>$users,
            'roles'=>$roles
        ]);

    }

    public function edit($id) {
        $user_edit = User::where('id', $id)->with('role')->first();      
        if($user_edit) {
            return response()->json([
                'status' => 200,
                'user_edit'   => $user_edit,
            ]);
        }else {
            return response()->json([
                'status' => 404,
                'message'   => 'User Not Found',
            ]);
        }
    }
    
    public function store(Request $request) {
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
