<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index() {
        return view('user.order-history.index');
    }

    public function fetchOrderHistoryPage() {
        $id = Auth::user()->id;
        $orders = Order::where('id_customer', $id)->orderBy('id', 'desc');
        $data = $orders->get();
        return response()->json([
            'orders' => $data,
        ]);
    }
}
