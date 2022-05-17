<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
session_start();

class UserCartController extends Controller
{
    public function showCart() {
        return view('user.cart.index');
    }

    public function cartCount() {
        $cartCount = count(session()->get('cart'));
        return response()->json(['cartCount' => $cartCount]);
    }

    public function addCart(Request $request) {
        $data = $request->all();
        //Mỗi spham thêm vào sẽ tạo ra một session id
        $session_id = substr(md5(microtime()), rand(0, 26),5);
        $cart = session()->get('cart');
        if($cart == true) {
            $is_available = 0;
            foreach($cart as $key => $item) {
                if($item['id']==$data['cart_product_id']) {
                    $is_available++;
                }
            }
            if($is_available == 0) {
                $cart[] = array(
                    'session_id' =>  $session_id,
                    'id' =>  $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_name' =>  $data['cart_product_name'],
                    'product_price' => $data['cart_product_price'],
                    'product_color' => $data['cart_product_color'],
                    'product_qty' => $data['cart_product_qty']
                );
                session()->put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' =>  $session_id,
                'id' =>  $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_name' =>  $data['cart_product_name'],
                'product_price' => $data['cart_product_price'],
                'product_color' => $data['cart_product_color'],
                'product_qty' => $data['cart_product_qty']
            );
        }
        session()->put('cart', $cart);
        session()->save();
    }

    public function deleteCart(Request $request) {
        // $id = $request->input('cart_product_id');
        // return dd($id);
        // $cart = session()->get('cart');
        // if($cart) {
        //     foreach($cart as $key => $item) {
        //         if($item["id"] == $id) {
        //             unset($cart[$key]);
        //         }
        //     }
        //     session()->put('cart', $cart);
        // }
    }
}
