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
        $total_employee = User::whereNotIn('id', [1,5])->count();
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

        $user = User::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at',date('Y'))
            ->where('id_role', 5)
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $months = User::select(DB::raw("Month(created_at) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck("month");
        $data_month =  [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($months as $index =>$month){
            --$month;
            $data_month[$month] = $user[$index];
        }
        return view('admin.home', compact('total_order', 'chartData', 'total_employee', 'total_customer', 'total_order_pay', 'total_money', 'months', 
        'data_month', 'user'));
    }
}
