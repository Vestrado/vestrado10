<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        // Restrict access to admins only
        //$this->middleware('auth'); // Adjust based on your admin authentication
        // Add admin check, e.g., $this->middleware('role:admin');
    }

    public function listing()
    {
        $orders = DB::connection('vestrado')->table('orders')->get();
        //$orders = DB::connection('vestrado')->table('orders')->where('status', 'pending')->get();

        return view('admin.orderlist', [
            'orders' => $orders,
        ]);

    }
}
