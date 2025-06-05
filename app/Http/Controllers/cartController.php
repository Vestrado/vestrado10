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
            // Use first() to get a single record, then access total_lots
            $userInfo = DB::connection('vestrado')->table('users_info')
            ->where('user_id', $id)
            ->select('total_lots')
            ->first();

            // Extract total_lots or default to 0 if no record is found
            $totalVolume2= $userInfo ? $userInfo->total_lots : 0;
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
                'totalVolume' => $totalVolume2,
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

    public function cartaddress()
    {
        if (session('loadid')) {
            $data = $this->userService->fetchUserDetails(session('loadid'));
            $datatrade = $this->userService->fetchtrade(session('loadid'));
            $id = session('loadid');

            // $totalVolume = collect($datatrade)->sum('volume');
            // $totalVolume = round(collect($datatrade)->sum('volume'), 2);
            // $totalVolume = collect($datatrade)->map(function ($item) {
            //     if ($item['currency'] === 'USC') {
            //         return $item['volume'] / 1000;
            //     }
            //     return $item['volume'];
            // })->sum();
            // $totalVolume = round($totalVolume, 2);
            $totalVolume2 = DB::connection('vestrado')->table('users_info')
            ->where('user_id', $id)
            ->select('total_lots')
            ->first();

            // Extract total_lots or default to 0 if no record is found
            $totalVolume= $totalVolume2 ? $totalVolume2->total_lots : 0;

            $loginID = collect($datatrade)->pluck('login')->first();

            $databalance = $this->userService->fetchbalance(session('loadid'),$loginID);
            $balance = collect($databalance)->pluck('tradeBalance')->first();


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

            return view('cartaddress', [
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

    public function cartreview(Request $request)
    {
        if (session('loadid')) {
            $data = $this->userService->fetchUserDetails(session('loadid'));
            $datatrade = $this->userService->fetchtrade(session('loadid'));
            $id = session('loadid');

            // $totalVolume = collect($datatrade)->sum('volume');
            // $totalVolume = round(collect($datatrade)->sum('volume'), 2);
            // $totalVolume = collect($datatrade)->map(function ($item) {
            //     if ($item['currency'] === 'USC') {
            //         return $item['volume'] / 1000;
            //     }
            //     return $item['volume'];
            // })->sum();
            // $totalVolume = round($totalVolume, 2);

            $totalVolume2 = DB::connection('vestrado')->table('users_info')
            ->where('user_id', $id)
            ->select('total_lots')
            ->first();

            // Extract total_lots or default to 0 if no record is found
            $totalVolume= $totalVolume2 ? $totalVolume2->total_lots : 0;

            $loginID = collect($datatrade)->pluck('login')->first();

            $databalance = $this->userService->fetchbalance(session('loadid'),$loginID);
            $balance = collect($databalance)->pluck('tradeBalance')->first();


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

            $fullname = $request->input('fullname');
            $address = $request->input('address');
            $city = $request->input('city');
            $postcode = $request->input('postcode');
            $state = $request->input('state');
            $country = $request->input('country');
            $email = $request->input('email');
            $phone = $request->input('phone');


            return view('cartreview', [
                'datauser' => $data,
                'totalVolume' => $totalVolume,
                'loginID' => $loginID,
                'balance' => $balance,
                'islogin' => true,
                'products' => $products,
                'cartItems' => $cartItems, // Pass cart items to view
                'totalPts' => $totalPts,
                'totalLots' => $totalLots,
                'fullname' => $fullname,
                'address' => $address,
                'city' => $city,
                'postcode' => $postcode,
                'state' => $state,
                'country' => $country,
                'email' => $email,
                'phone' => $phone,
            ]);
        }
        else
        {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        }
    }

    public function processCheckout(Request $request)
    {
        if (!session('loadid')) {
            return redirect()->route('login')->with('error', 'Please log in to checkout.');
        }

        $userId = session('loadid');
        $redemptionType = $request->input('redemption_type'); // 'points' or 'lots'

        // Fetch cart items
        $cartItems = DB::connection('vestrado')->table('carts')
            ->where('user_id', $userId)
            ->join('product', 'carts.prod_id', '=', 'product.prod_id')
            ->select('carts.*', 'product.prod_name', 'product.lots', 'product.pts', 'product.prod_img')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        // Calculate totals
        $totalPts = $cartItems->sum(function ($item) {
            return $item->pts * $item->quantity;
        });
        $totalLots = $cartItems->sum(function ($item) {
            return $item->lots * $item->quantity;
        });

        // Fetch user balance
        $datatrade = $this->userService->fetchtrade($userId);
        $totalVolume = collect($datatrade)->map(function ($item) {
            if ($item['currency'] === 'USC') {
                return $item['volume'] / 1000;
            }
            return $item['volume'];
        })->sum();
        $totalVolume = round($totalVolume, 2);


        $loginID = collect($datatrade)->pluck('login')->first();
        $databalance = $this->userService->fetchbalance($userId, $loginID);
        $balance = collect($databalance)->pluck('tradeBalance')->first();

        // Validate balance
        if ($redemptionType === 'points' && $balance < $totalPts) {
            return redirect()->route('checkout')->with('error', 'Insufficient points to complete the purchase.');
        } elseif ($redemptionType === 'lots' && $totalVolume < $totalLots) {
            return redirect()->route('checkout')->with('error', 'Insufficient lots to complete the purchase.');
        }

        $fullname = $request->input('fullname');
        $address = $request->input('address');
        $postcode = $request->input('postcode');
        $country = $request->input('country');
        $email = $request->input('email');
        $city = $request->input('city');
        $state = $request->input('state');
        $phone = $request->input('phone');

        // Create the order
        $orderId = DB::connection('vestrado')->table('orders')->insertGetId([
            'user_id' => $userId,
            'total_pts' => $redemptionType === 'points' ? $totalPts : 0,
            'total_lots' => $redemptionType === 'lots' ? $totalLots : 0,
            'redemption_type' => $redemptionType,
            'status' => 'Ordered',
            'created_at' => now(),
            'updated_at' => now(),
            'fullname' => $fullname,
            'address' => $address,
            'postcode' => $postcode,
            'country' => $country,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'phone' => $phone,
        ]);

        DB::connection('vestrado')->table('user_trans')->insert([
            'user_id' => $userId,
            'trans_type' => 'Redeem',
            'lots' => $totalLots,
        ]);

        // Save order items
        foreach ($cartItems as $item) {
            DB::connection('vestrado')->table('order_items')->insert([
                'order_id' => $orderId,
                'prod_id' => $item->prod_id,
                'size' => $item->size,
                'quantity' => $item->quantity,
                'pts' => $item->pts,
                'lots' => $item->lots,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Deduct balance (assuming you have an API/method to update this)
        // For now, this is a placeholder; implement based on your userService
        if ($redemptionType === 'points') {
            // $this->userService->deductPoints($userId, $totalPts);
            DB::connection('vestrado')->table('users_info')
            ->where('user_id', $userId)
            ->decrement('total_lots', $totalPts);
        } else {
            // $this->userService->deductLots($userId, $totalLots);
            DB::connection('vestrado')->table('users_info')
            ->where('user_id', $userId)
            ->decrement('total_lots', $totalLots);
        }

        // Clear the cart
        DB::connection('vestrado')->table('carts')->where('user_id', $userId)->delete();

        return redirect()->route('store')->with('success', 'Order placed successfully!');
    }

}
