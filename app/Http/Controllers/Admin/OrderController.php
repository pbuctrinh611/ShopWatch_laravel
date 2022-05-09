<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class OrderController extends Controller
{
    protected $limit;

    public function __construct()
    {
        $this->limit = Config::get('constants.limit_page');
    }

    public function index(Request $request)
    {
        $orders = Order::orderby('order_at', 'asc')->paginate($this->limit);
        return view('admin.order.list', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == Order::CONFIRMING) {
            return view('admin.order.confirm', compact('order'));
        }
        return view('admin.order.detail', compact('order'));
    }

    public function confirm(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            if ($order->canceled_at || $order->confirm_at) {
                return back()->with('alert-fail', 'Đơn hàng đã được xử lý');
            }
            if ($request->status == 'true') {
                $data['confirm_at'] = now();
                $data['status'] = Order::DELIVERING;
            } else {
                $data['cancel_at'] = now();
                $data['status'] = Order::CANCELED;
            }
            $data['id_saler'] = Auth::user()->id;
            $order->update($data);
        } catch (\Throwable $th) {
            return response()->json(['message', 'Xử lý thất bại!'], 404);
        }
        return response()->json(['message', 'Xử lý thành công!']);
    }

    public function print($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.print', compact('order'));
    }
}
