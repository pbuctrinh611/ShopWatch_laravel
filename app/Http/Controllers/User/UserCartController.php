<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

session_start();

class UserCartController extends Controller
{
    public function showCart()
    {
        return view('user.cart.index');
    }

    public function cartCount()
    {
        $cartCount = count(session()->get('cart'));
        return response()->json(['cartCount' => $cartCount]);
    }

    public function fetchCartPage() {
        $cart = session()->get('cart');
        return response()->json(['cart' => $cart]);
    }

    public function fetchMiniCart() {
        $cart = session()->get('cart');
        return response()->json(['cart' => $cart]);
    }

    public function addCart(Request $request)
    {
        $data = $request->all();
        //Mỗi spham thêm vào sẽ tạo ra một session id
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = session()->get('cart');
        if ($cart == true) {
            $is_available = 0;
            foreach ($cart as $key => $item) {
                if ($item['id'] == $data['cart_product_id']) {
                    $is_available++;
                }
            }
            if ($is_available == 0) {
                $cart[] = array(
                    'session_id' =>  $session_id,
                    'id' =>  $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_name' =>  $data['cart_product_name'],
                    'product_price' => $data['cart_product_price'],
                    'product_id_color' => $data['cart_product_id_color'],
                    'product_color' => $data['cart_product_color'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_qty_stock' => $data['cart_product_qty_stock'],
                );
                session()->put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' =>  $session_id,
                'id' =>  $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_name' =>  $data['cart_product_name'],
                'product_price' => $data['cart_product_price'],
                'product_id_color' => $data['cart_product_id_color'],
                'product_color' => $data['cart_product_color'],
                'product_qty' => $data['cart_product_qty'],
                'product_qty_stock' => $data['cart_product_qty_stock'],
            );
        }
        session()->put('cart', $cart);
        session()->save();
    }

    public function updateCart(Request $request) {
       $id = $request->id;
       $product_qty = $request->product_qty;
       if($request->id && $request->product_qty) {
           $cart = session()->get('cart');
           if($cart == true) {
               foreach($cart as $key => $item) {
                   if($cart[$key]['id'] == $id) {
                       $cart[$key]['product_qty'] = $product_qty;
                   }
               }
               session()->put('cart', $cart);
           }
       }
    }

    public function deleteCart(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            // echo "<pre>"; print_r($id); die;
            $cart = session()->get('cart');
            if ($cart == true) {
                foreach ($cart as $key => $item) {
                    if ($item['id'] == $id) {
                        unset($cart[$key]);
                    }
                }
                session()->put('cart', $cart);
            }
        }
    }
}
