<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\UserPromotion;
use Illuminate\Support\Facades\Auth;

class UserCheckoutController extends Controller
{
    public function index() {
        return view('user.checkout.index');
    }

    public function fetchCheckoutPage() {
        $cart = session()->get('cart');
        return response()->json([
            'cart' => $cart
        ]);
    }

    public function checkPromotion(Request $request) {
        $code = $request->code;
        if($code) {
            $check = Promotion::with('user_promotion')->where('code', $code)->first();
            if($check) {
                $id_user = Auth::user()->id;
                $check_user = UserPromotion::where('id_user', $id_user)
                                           ->where('id_promotion', $check->id)
                                           ->count();
                if($check_user == 0){
                    $promotion = session()->get('promotion');
                    if($promotion == true) {
                        $is_available = 0;
                        if($is_available == 0) {
                            $promotion[] = array(
                                'id' => $check->id,
                                'promotion_code' => $check->code,
                                'promotion_discount' => $check->discount
                            );
                            session()->put('promotion', $promotion);
                            UserPromotion::insert([
                                'id_user' => $id_user,
                                'id_promotion' => $check->id
                            ]);
                            return response()->json([
                                'status' => 200,
                                'message' => 'Sử dụng mã giảm giá thành công'
                            ]);
                        }
                    }else {
                        $promotion[] = array(
                            'id' => $check->id,
                            'promotion_code' => $check->code,
                            'promotion_discount' => $check->discount
                        );
                    }
                    session()->put('promotion', $promotion);
                    session()->save();
                   
                }else{
                    return response()->json([
                        'status' => 400,
                        'message' => 'Bạn đã sử dụng mã này rồi'
                    ]);
                }
            }else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Không tồn tại mã giảm giá'
                ]);
            }
        }else {
            return response()->json([
                'status' => 204,
                'message' => 'Bạn chưa nhập mã giảm giá'
            ]);
        }
    }

}
