<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

}
