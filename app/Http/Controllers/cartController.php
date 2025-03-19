<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;

class cartController extends Controller
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
            $cartItems = DB::connection('vestrado')->table('carts')
                ->where('user_id', $id)
                ->join('product', 'carts.prod_id', '=', 'product.prod_id')
                ->select('carts.*', 'product.prod_name', 'product.lots', 'product.pts', 'product.prod_img')
                ->get();

            // Calculate total points and lots
            $totalPts = $cartItems->sum(function ($item) {
                return $item->pts * $item->quantity;
            });

            $totalLots = $cartItems->sum(function ($item) {
                return $item->lots * $item->quantity;
            });

            return view('cartview', [
                'datauser' => $data,
                'totalVolume' => $totalVolume,
                'loginID' => $loginID,
                'balance' => $balance,
                'islogin' => true,
                'products' => $products,
                'cartItems' => $cartItems, // Pass cart items to view
                'totalPts' => $totalPts,
                'totalLots' => $totalLots,
            ]);
        }
        else
        {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        }
    }

    public function addToCart(Request $request)
    {
        if (!session('loadid')) {
            return redirect()->route('login')->with('error', 'Please log in to add items to your cart.');
        }

        $userId = session('loadid');
        $prodId = $request->input('prod_id');
        $size = $request->input('size');
        $cart_pts = $request->input('cart_pts');
        $cart_lots = $request->input('cart_lots');

        // Check if the product exists
        $product = DB::connection('vestrado')->table('product')->where('prod_id', $prodId)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Check if the product is already in the cart
        $cartItem = DB::connection('vestrado')->table('carts')
            ->where('user_id', $userId)
            ->where('prod_id', $prodId)
            ->where('size', $size)
            ->first();

        if ($cartItem) {
            // Increment quantity if it exists
            DB::connection('vestrado')->table('carts')
                ->where('user_id', $userId)
                ->where('prod_id', $prodId)
                ->where('size', $size)
                ->increment('quantity');
        } else {
            // Add new item to cart
            DB::connection('vestrado')->table('carts')->insert([
                'user_id' => $userId,
                'prod_id' => $prodId,
                'quantity' => 1,
                'size' => $size,
                'cart_pts' => $cart_pts,
                'cart_lots' => $cart_lots,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function removeFromCart(Request $request)
    {
        if (!session('loadid')) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        $userId = session('loadid');
        $prodId = $request->input('prod_id');

        DB::connection('vestrado')->table('carts')
            ->where('user_id', $userId)
            ->where('prod_id', $prodId)
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

}
