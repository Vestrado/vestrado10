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

            $totalVolume = collect($datatrade)->sum('volume');
            $totalVolume = round(collect($datatrade)->sum('volume'), 2);

            $loginID = collect($datatrade)->pluck('login')->first();

            $databalance = $this->userService->fetchbalance(session('loadid'),$loginID);
            $balance = collect($databalance)->pluck('tradeBalance')->first();

            $id = session('loadid');
            // Fetch products
            $products = DB::connection('vestrado')->table('product')->get();

            // Fetch cart items for the current user
            $orders = DB::connection('vestrado')->table('orders')
                ->where('user_id', $id)
                ->select('*')
                ->get();

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
