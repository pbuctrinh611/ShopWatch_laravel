<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\UserPromotion;
use Illuminate\Support\Facades\Auth;

class UserCheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('user.checkout.index');
        }
        return redirect()->route('user.show_login');
    }

    public function fetchCheckoutPage()
    {
        $cart = session()->get('cart');
        return response()->json([
            'cart' => $cart
        ]);
    }

    public function checkPromotion(Request $request)
    {
        $code = $request->code;
        if ($code) {
            $check = Promotion::with('user_promotion')->where('code', $code)->first();
            if ($check) {
                $id_user = Auth::user()->id;
                $check_user = UserPromotion::where('id_user', $id_user)
                    ->where('id_promotion', $check->id)
                    ->count();
                if ($check_user == 0) {
                    UserPromotion::insert([
                        'id_user' => $id_user,
                        'id_promotion' => $check->id
                    ]);
                    $cart = session()->get('cart');
                    if ($cart == true) {
                        $total = 0;
                        foreach ($cart as $key => $item) {
                            $total = $total + ($item['product_price'] * $item['product_qty']);
                        }
                        $discount_price = ($total/100)*$check->discount;
                        $total = $total - $discount_price;
                        session()->put('cart', $cart);
                        return response()->json([
                            'status' => 200,
                            'message' => 'Sử dụng mã giảm giá thành công',
                            'cart' => $cart,
                            'discount_price' => $discount_price,
                            'total' => $total
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Bạn đã sử dụng mã này rồi'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Không tồn tại mã giảm giá'
                ]);
            }
        } else {
            return response()->json([
                'status' => 204,
                'message' => 'Bạn chưa nhập mã giảm giá'
            ]);
        }
    }
}
