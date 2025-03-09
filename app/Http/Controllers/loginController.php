<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class loginController extends Controller
{
    /***************** START HERE ***********/


    private function fetchUserDetails($loadid)
    {
        // Define a unique cache key for the user data
        $cacheKey = 'user_details_' . $loadid;

        // Check if the data is already cached
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // If not cached, fetch the data from the API
        $token = '9083b30e232b13336f9f6aa64bb753221d6d5d4ba1ebe441d4d78c521522f78d145110b7bc30a23016a5bbd12f561fb6225b10438bf428d0888d5b13';
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://my.vestrado.com/rest/users/' . $loadid);

        if ($response->successful()) {
            $data = $response->json();

            // Cache the data for a specific duration (e.g., 60 minutes)
            Cache::put($cacheKey, $data, now()->addMinutes(60));

            return $data;
        }

        return null;
    }

    public function index()
    {
        if (session('loadid')) {
            $data = $this->fetchUserDetails(session('loadid'));

            if ($data) {
                return view('store', [
                    'data' => $data, // User details
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
            $data = $this->fetchUserDetails(session('loadid'));

            if ($data) {
                return view('store', [
                    'data' => $data, // User details
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
                session(['loadid' => $data['id']]);

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


}
