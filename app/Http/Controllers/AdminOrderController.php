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

    public function pendinglisting()
    {
        $orders = DB::connection('vestrado')->table('orders')
        ->whereIn('status', ['Pending', 'Ordered', 'Processing', 'Shipping'])
        ->get();

        return view('admin.orderlist', [
            'orders' => $orders,
        ]);

    }

    public function view($orderid)
    {
        $orders = DB::connection('vestrado')->table('orders')
            ->where('id', $orderid)
            ->select('*')
            ->first();
        //return view('admincreate');

        $orderItems = DB::connection('vestrado')->table('order_items')
            ->join('product', 'order_items.prod_id', '=', 'product.prod_id')
            ->select('order_items.*', 'product.prod_name', 'product.prod_img')
            ->where('order_id', $orderid) // Use id from orders, order_id from order_items
            ->orderBy('order_items.id', 'asc') // Ensures consistent "first" item
            ->get();

        return view('admin.adminordview', [
            'orders' => $orders,
            'orderItems' => $orderItems,
        ]);

    }

    public function ordupdate(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'order_id' => 'required|numeric|min:0',
            'status' => 'required',
        ]);



        // Update the product
        $updateData = [
            'status' => $validated['status'],

        ];

        // Update the product
        DB::connection('vestrado')->table('orders')
            ->where('id', $validated['order_id'])
            ->update($updateData);

        // return redirect()->route('admin.products.listing')->with('success', 'Product update successfully!');
        // Redirect to the edit page for the updated product
        return redirect()->route('admin.orders.view', ['orderid' => $validated['order_id']])
            ->with('success', 'Product updated successfully!');
    }
}
