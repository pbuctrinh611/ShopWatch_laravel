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
    public function index(Request $request)
    {
       $roles = Role::whereNotIn('id', [1])->orderBy('id', 'asc')->get();
       return view('admin.user.index', compact('roles'));
    }

    public function fetchUser(Request $request)
    {
        $users = User::whereNotIn('id_role', [1])->with('role')->orderBy('id', 'desc');
        $roles = Role::whereNotIn('id', [1])->orderBy('id', 'asc')->get();
        $searchKey = !empty($request->searchKey) ? $request->searchKey : '';
        if(!empty($searchKey)) {
            $users->where(function ($query) use ($searchKey) {
                $query->where('users.name', 'LIKE', '%' . $searchKey . '%');
                $query->orWhere('users.email', 'LIKE', '%' . $searchKey . '%');
            });
        }
        $data = $users->get();
        return response()->json([
            'users' => $data,
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'     =>  'required',
                'tel'      =>  'required|regex:/(0)[0-9]{9}/|max:10|unique:users,tel',
                'email'    =>  'required|email|unique:users,email',
                'password' =>  'required|min:8'
            ],
            [
                'name.required'     =>  'Họ tên là bắt buộc',
                'tel.required'      =>  'Số điện thoại là bắt buộc',
                'tel.regex'         =>  'Số điện thoại sai định dạng',
                'tel.max'           =>  'Số điện thoại phải từ :max ký tự',
                'tel.unique'        =>  'Số điện thoại này đã tồn tại',
                'email.required'    =>  'Email là bắt buộc',
                'email.email'       =>  'Email nhập chưa đúng định dạng',
                'email.unique'      =>  'Email này đã tồn tại',
                'password.required' =>  'Mật khẩu là bắt buộc',
                'password.min'      =>  'Mật khẩu phải từ :min ký tự'
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $password = Hash::make(request('password'));
            $data = [
                'name' => $request->name,
                'tel' => $request->tel,
                'email' => $request->email,
                'password' => $password,
                'id_role' => $request->id_role
            ];
            $user = User::create($data);
            if ($user) {
                return response()->json([
                    'status' => 200,
                    'message' => "Thêm thành công"
                ]);
            }
        }
    }

    public function edit($id)
    {
        $user_edit = User::where('id', $id)->with('role')->first();
        if ($user_edit) {
            return response()->json([
                'status' => 200,
                'user_edit'   => $user_edit,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message'   => 'Không tìm thấy người dùng',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'     =>  'required',
                'tel'      =>  'required|regex:/(0)[0-9]{9}/|max:10',
                'email'    =>  'required|email',
            ],
            [
                'name.required'     =>  'Họ tên là bắt buộc',
                'tel.required'      =>  'Số điện thoại là bắt buộc',
                'tel.regex'         =>  'Số điện thoại sai định dạng',
                'tel.max'           =>  'Số điện thoại phải từ :max ký tự',
                'email.required'    =>  'Email là bắt buộc',
                'email.email'       =>  'Email nhập chưa đúng định dạng',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $user = User::find($id);
            if ($user) {
                $user->name = $request->name;
                $user->tel = $request->tel;
                $user->email = $request->email;
                $user->id_role = $request->id_role;
                $user->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Cập nhật thành công.'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'error' => 'Không tìm thấy người dùng.'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $user_delete = User::find($id);
        if($user_delete) {
            $user_delete->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Xóa người dùng thành công'
            ]);
        }
        return response()->json([
            'status' => 404,
            'error' => 'Không tìm thấy người dùng'
        ]);
    }

}
