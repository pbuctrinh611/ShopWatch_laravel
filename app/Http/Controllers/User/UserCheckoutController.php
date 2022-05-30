<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\UserPromotion;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function fetchPromotionCode() {
        $id_user = Auth::user()->id;
        //Lấy ra các mã người dùng đã sử dụng để render ra html
        $promotion_used = UserPromotion::with('promotion')->where('id_user', $id_user)->get();
        return response()->json([
            'promotion_used' => $promotion_used
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
                        $promotion_used = UserPromotion::with('promotion')->where('id_user', $id_user)->get();
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
                            'promotion_used' => $promotion_used,
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

    public function deletePromotion(Request $request) {
        $id = $request->id;
        if($id) {
            $user_promotion = UserPromotion::with('promotion')->where('id', $id)->first();
            if($user_promotion) {
                $user_promotion->delete();
                $cart = session()->get('cart');
                if($cart == true) {
                    $total = 0;
                    foreach ($cart as $key => $item) {
                        $total = $total + ($item['product_price'] * $item['product_qty']);
                    }
                    $discount_price = ($total/100)*$user_promotion->promotion->discount;
                    $total = $total + $discount_price;
                }
                return response()->json([
                    'status' => 200,
                    'message' => 'Xóa mã giảm giá thành công',
                    'discount_price' => $discount_price,
                    'total' => $total
                ]);
            }
        }
    }

    public function addOrder(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'name'     =>  'required',
                'address'  =>  'required',
                'tel'      =>  'required|regex:/(0)[0-9]{9}/|max:10',
                'email'    =>  'required|email',
            ],
            [
                'name.required'     =>  'Họ tên là bắt buộc',
                'address.required'  =>  'Địa chỉ là bắt buộc',
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
                'error'  => $validator->errors()->toArray()
            ]);
        }else {
            $data = [
                date_default_timezone_set('Asia/Ho_Chi_Minh'),
                'id_customer' => Auth::id(),
                'name' => $request->name,
                'address' => $request->address,
                'tel' =>  $request->tel,
                'email' => $request->email,
                'note' => $request->note,
                'status' => $request->status,
                'order_at' => now(),
                'total_money' => $request->total_money,
                'payment_method' => $request->payment_method
            ];
            $order = Order::create($data);
           
            if($order) {
                $id_order = $order->id;
                $cart = session()->get('cart');
                if($cart) {
                    foreach($cart as $key => $item) {
                        $order_detail = new OrderDetail;
                        $order_detail->id_order = $id_order;
                        $order_detail->id_product = $item['id'];
                        $order_detail->id_color = $item['product_id_color'];
                        $order_detail->color = $item['product_color'];
                        $order_detail->qty = $item['product_qty'];
                        $order_detail->unit_cost = $item['product_price'];
                        $order_detail->save();
                    }
                    session()->forget('cart');
                    return response()->json([
                        'status' => 200,
                        'message' => 'Đặt hàng thành công'
                    ]);
                }
            }else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Đặt hàng thất bại'
                ]);
            }
        }
    }
}
