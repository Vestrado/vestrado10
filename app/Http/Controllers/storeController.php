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

            if ($data) {
                return view('storeInside', [
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
            return view('storeInside');
        }
    }
}
