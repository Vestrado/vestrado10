<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;


class storeController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index($id)
    {
        $productInfo = DB::connection('vestrado')->table('product')->where('prod_id', $id)->first();

        if (!$productInfo) {
            return redirect()->back()->with('error', 'Product not found');
        }

        // Split sizes and handle empty/null case
        $sizes = $productInfo->size ? array_map('trim', explode(',', $productInfo->size)) : [];

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

            if ($data) {
                return view('storeInside', [
                    'product' => $productInfo,
                    'sizes' => $sizes,
                    'datauser' => $data,
                    'totalVolume' => $totalVolume,
                    'loginID' => $loginID,
                    'balance' => $balance,
                    'islogin' => true,
                ]);
            } else {
                return redirect()->route('login')->with('error', 'Failed to fetch user details');
            }
        } else {
            return view('storeInside', [
                'product' => $productInfo,
                'sizes' => $sizes,
            ]);
        }
    }
}
