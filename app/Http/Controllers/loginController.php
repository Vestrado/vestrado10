<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;

class loginController extends Controller
{
    /***************** DECLARE SERIVICE ***********/
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /***************** START HERE ***********/
    public function index()
    {
        if (session('loadid')) {
            $data = $this->userService->fetchUserDetails(session('loadid'));
            $datatrade = $this->userService->fetchtrade(session('loadid'));

            $totalVolume = collect($datatrade)->sum('volume');
            $totalVolume = round(collect($datatrade)->sum('volume'), 2);


            if ($data) {
                return view('store', [
                    'datauser' => $data, // User details
                    'totalVolume' => $totalVolume,
                    'islogin' => true,
                ]);
            } else {
                return redirect()->route('login')->with('error', 'Failed to fetch user details');
            }
        } else {
            return view('store');
        }
    }

    public function store()
    {
        if (session('loadid')) {
            $id=session('loadid');

            $data = $this->userService->fetchUserDetails(session('loadid'));
            $datatrade = $this->userService->fetchtrade(session('loadid'));




            $totalVolume = collect($datatrade)->map(function ($item) {
                // If currency is "USC", divide volume by 1000
                if ($item['currency'] === 'USC') {
                    return $item['volume'] / 1000;
                }
                // Otherwise, return the volume as is
                return $item['volume'];
            })->sum(); // Sum all volumes

            $totalVolume = round($totalVolume, 2); // Round to 2 decimal places
            $lastCloseDate = collect($datatrade)->pluck('closeDate')->first();
            $userID = collect($datatrade)->pluck('userId')->first();
            $loginID = collect($datatrade)->pluck('login')->first();
            $userID = $userID ?? $id; // If $userID is not available, use the $id passed to the method

            // $userInfo = DB::table('users_info')->where('user_id', $id)->first();
            // if ($userInfo) {
            //     // Data exists, update the record
            //     DB::table('users_info')
            //         ->where('user_id', $userID)
            //         ->update([
            //             'total_lots' => $totalVolume,
            //             'last_trans' => $lastCloseDate,
            //         ]);
            // } else {
            //     // Data does not exist, insert a new record
            //     DB::table('users_info')->insert([
            //         'name' => 'Jane Doe',
            //         'user_id' => $userID,
            //         'total_lots' => $totalVolume,
            //         'last_trans' => $lastCloseDate,
            //     ]);
            // }

            $databalance = $this->userService->fetchbalance(session('loadid'),$loginID);
            $balance = collect($databalance)->pluck('tradeBalance')->first();

            if ($data) {
                return view('store', [
                    'datauser' => $data, // User details
                    'totalVolume' => $totalVolume,
                    'loginID' => $loginID,
                    'balance' => $balance,
                    'islogin' => true,
                ]);
            } else {
                return redirect()->route('login')->with('error', 'Failed to fetch user details');
            }
        } else {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        }
    }

    public function loginprocess(Request $request)
    {


        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6', // Change the rules as needed
        ]);

        // Process the data (for example, authenticate the user)
        $token = '9083b30e232b13336f9f6aa64bb753221d6d5d4ba1ebe441d4d78c521522f78d145110b7bc30a23016a5bbd12f561fb6225b10438bf428d0888d5b13';

        // Prepare the API request
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post('https://my.vestrado.com/rest/user/check_credentials', [
            'email' => $request->email,
            'password' => $request->password,
        ]);


        // Check if the response is successful
        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['id']) && $data['id'] > 0) {
                // Start the session if it is not already started
                if (!session()->isStarted()) {
                    session_start();
                }

                // Set the session variable
                session(['loadid' => '19294']);     //manual set
                //session(['loadid' => $data['id']]);


                $loadid = $data['id'];

                $response2 = Http::withHeaders([
                    'accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ])->get('https://my.vestrado.com/rest/users/' . $loadid);

                return redirect()->route('store');
            } else {
                // Handle authentication failure
                return redirect()->route('login')->with('error', 'Invalid ID');
            }
        } else {
            // Handle authentication failure
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
    }

    public function logout()
    {
        // Get the loadid from the session
        $loadid = session('loadid');

        // Clear the cache for this user's data
        if ($loadid) {
            $cacheKey = 'user_details_' . $loadid;
            Cache::forget($cacheKey); // Remove the cached data for this user
        }

        // Clear the session
        session()->flush();

        // Redirect with a success message
        return redirect()->route('store')->with('success', 'You have been logged out successfully.');
    }

    public function details($id)
    {
        // Logic to show a specific trade
        if (session('loadid')) {
            //$loadid = session('loadid');

            // Define the API URL for accounts
            $urlTrades = 'https://my.vestrado.com/rest/trades';

            // Set the headers
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer 9083b30e232b13336f9f6aa64bb753221d6d5d4ba1ebe441d4d78c521522f78d145110b7bc30a23016a5bbd12f561fb6225b10438bf428d0888d5b13',
            ];

            // Set the body for accounts
            $body = [
                'userId' => $id,
                'openDate' => [

                    'begin' => '2025-01-01 00:00:00'
                ],
                'closeDate' => [
                    'end' => '2025-01-31 23:59:59'
                ],
                // 'ticketType' => [
                //     'buy','sell'
                // ],
                'orders' => [
                [
                    'field' => 'closeDate',
                    'direction' => 'DESC'
                ]
                ],
                'segment' => [
                'limit' => 10000
                ]
            ];

            // Send the POST request for accounts
            $responseAccounts = Http::withHeaders($headers)->post($urlTrades, $body);

            if ($responseAccounts->successful()) {
                $data = $responseAccounts->json();
                $totalVolume = collect($data)->sum('volume');
                $totalVolume = round(collect($data)->sum('volume'), 2);
                $lastCloseDate = collect($data)->pluck('closeDate')->first();
                $userID = collect($data)->pluck('userId')->first();

                // INSERT INTO TABLE users_info
                // DB::table('users_info')->insert([
                //     'name' => 'Jane Doe',
                //     'user_id' => $userID,
                //     'total_lots' => $totalVolume,
                //     'last_trans' => $lastCloseDate,
                // ]);

                return view('tradedetails_view', [
                    'data' => $data,
                    'totalVolume' => $totalVolume,
                    'lastCloseDate' => $lastCloseDate,
                ]);

            } else {
                $error = [
                    'status' => $responseAccounts->status(),
                    'message' => $responseAccounts->body(),
                ];
                return redirect()->back()->with('error', $error['message']);
            }
        } else {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        }
    }


}
