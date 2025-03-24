<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;

class orderController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        if (session('loadid')) {
            $data = $this->userService->fetchUserDetails(session('loadid'));
            $datatrade = $this->userService->fetchtrade(session('loadid'));

            // $totalVolume = collect($datatrade)->sum('volume');
            // $totalVolume = round(collect($datatrade)->sum('volume'), 2);
            $totalVolume = collect($datatrade)->map(function ($item) {
                if ($item['currency'] === 'USC') {
                    return $item['volume'] / 1000;
                }
                return $item['volume'];
            })->sum();
            $totalVolume = round($totalVolume, 2);

            $loginID = collect($datatrade)->pluck('login')->first();

            $databalance = $this->userService->fetchbalance(session('loadid'),$loginID);
            $balance = collect($databalance)->pluck('tradeBalance')->first();

            $id = session('loadid');
            // Fetch products
            $products = DB::connection('vestrado')->table('product')->get();

            // Fetch cart items for the current user
            // Fetch all orders
            $orders = DB::connection('vestrado')->table('orders')
            ->where('user_id', $id)
            ->select('*')
            ->get();

            // Fetch only the first item for each order using order_number
            $orderItems = DB::connection('vestrado')->table('order_items')
            ->join('product', 'order_items.prod_id', '=', 'product.prod_id')
            ->select('order_items.*', 'product.prod_name', 'product.prod_img')
            ->whereIn('order_id', $orders->pluck('id')) // Use id from orders, order_id from order_items
            ->orderBy('order_items.id', 'asc') // Ensures consistent "first" item
            ->get()
            ->groupBy('order_id') // Group by order_id
            ->map(function ($items) {
                return $items->first();
            });

            // Calculate total points and lots
            // $totalPts = $cartItems->sum(function ($item) {
            //     return $item->pts * $item->quantity;
            // });

            // $totalLots = $cartItems->sum(function ($item) {
            //     return $item->lots * $item->quantity;
            // });

            return view('order', [
                'datauser' => $data,
                'totalVolume' => $totalVolume,
                'loginID' => $loginID,
                'balance' => $balance,
                'islogin' => true,
                'products' => $products,
                'orders' => $orders,
                'orderItems' => $orderItems,
                // 'cartItems' => $cartItems, // Pass cart items to view
                // 'totalPts' => $totalPts,
                // 'totalLots' => $totalLots,
            ]);
        }
        else
        {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        }
    }

    public function history()
    {
        return view('order');
    }
}
