<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserMemberController extends Controller
{
    public function showProfile() {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        return view('user.profile.index', compact('user'));
    }

    public function updateProfile(Request $request) {
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
        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }else {
            $id = Auth::user()->id;
            $user = User::find($id)->update([
                'name'  =>  $request->name,
                'tel'   =>  $request->tel,
                'email' =>  $request->email
            ]);
            if($user) {
                return response()->json([
                    'status' => 200,
                    'message' => "Cập nhật thông tin thành công"
                ]);
            }else {
                return response()->json([
                    'status' => 404,
                    'error' => "Không tìm thấy"
                ]);
            }
        }
    }

    public function showPassword() {
        return view('user.password.index');
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(),
        [
            'old_password'=>[
                'required', function($attribute, $value, $fail){
                    if( !Hash::check($value, Auth::user()->password) ){
                        return $fail(__('Mật khẩu cũ là không đúng. Mời nhập lại'));
                    }
                },
                'min:8',
                'max:30'
             ],
            'new_password'         => 'required|min:8|max:30',
            'confirm-new__password' => 'required|same:new_password'
        ],
        [
            'old_password.required' => 'Mời nhập mật khẩu cũ',
            'new_password.required' => 'Mật khẩu mới là bắt buộc',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất :min ký tự',
            'new_password.max' => 'Mật khẩu mới không được quá :max ký tự',
            'confirm-new__password.required' => 'Nhập lại mật khẩu mới là bắt buộc',
            'confirm-new__password.same' => 'Không khớp với mật khẩu mới. Mời nhập lại' 
        ]
        );
        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->toArray()
            ]);
        }else {
            $id = Auth::user()->id;
            $user = User::find($id)->update(
                ['password' => Hash::make($request->new_password)]
            );
            if($user) {
                return response()->json([
                    'status' => 200,
                    'message' => "Đổi mật khẩu thành công"
                ]);
            }
        }
    }
}
