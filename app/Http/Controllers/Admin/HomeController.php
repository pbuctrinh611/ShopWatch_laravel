<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request) {
        DB::statement("SET SQL_MODE=''");
        $total_manage = User::where('id_role', 2)->count();
        $total_saler = User::where('id_role', 3)->count();
        $total_shipper = User::where('id_role', 4)->count();
        $total_employee = $total_manage + $total_saler + $total_shipper;
        $total_customer = User::where('id_role', 5)->count();
        $total_order_pay = Order::count();
        $total_money = Order::sum('total_money');
        $total_order = Order::select(
            'users.name',
            DB::raw('COUNT(order.id_customer) AS total_order')
        )
        ->join('users', 'users.id', 'order.id_customer')
        ->limit(3)
        ->groupBy('order.id_customer')
        ->get();
        $data = "";
        foreach($total_order as $val) {
            $data.="['".$val->name."', ".$val->total_order."],";
        }
        $chartData = $data;

        $order = Order::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at',date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $months = Order::select(DB::raw("Month(created_at) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck("month");
        $data_month =  [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($months as $index =>$month){
            --$month;
            $data_month[$month] = $order[$index];
        }

        return view('admin.home', compact('total_order', 'chartData', 'total_employee', 'total_customer', 'total_order_pay', 'total_money', 'months', 
        'data_month'));
    }
}
