<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class UserService
{
    private $token = '9083b30e232b13336f9f6aa64bb753221d6d5d4ba1ebe441d4d78c521522f78d145110b7bc30a23016a5bbd12f561fb6225b10438bf428d0888d5b13';

    /**
     * Fetch user details from the API.
     *
     * @param string $loadid
     * @return array|null
     */
    public function fetchUserDetails($loadid)
    {
        $cacheKey = 'user_details_' . $loadid;

        // Check if the data is already cached
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ])->get('https://my.vestrado.com/rest/users/' . $loadid);

        if ($response->successful()) {
            //return $response->json();
            $data = $response->json();
            // Cache the data for a specific duration (e.g., 60 minutes)
            Cache::put($cacheKey, $data, now()->addMinutes(60));

            return $data;
        }

        return null;
    }

    public function fetchtrade($id)
    {
        $cacheKey = 'trade_details_' . $id;

        // Check if the data is already cached
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        // Define the API URL for accounts
        $urlTrades = 'https://my.vestrado.com/rest/trades';

        // Set the headers
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ];

        // Set the body for accounts
        $todayDate = now()->format('Y-m-d H:i:s');
        $body = [
            'userId' => $id,
            'openDate' => [
                'begin' => '2025-01-01 00:00:00'
            ],
            'closeDate' => [
                'end' => $todayDate
            ],
            'closeDate' => [
                'end' => $todayDate
            ],
            'ticketType' => [ // Add the ticketType array here
                'buy',
                'sell'
            ],
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
            $datatrade = $responseAccounts->json();

            Cache::put($cacheKey, $datatrade, now()->addMinutes(10));

            return $datatrade;
        }

        return null;
    }

    public function fetchbalance($id,$loginid)
    {
        $cacheKey = 'fetch_balance_' . $loginid;

        // Check if the data is already cached
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        // Define the API URL for accounts
        $urlTrades = 'https://my.vestrado.com/rest/accounts/trade-statistic';

        // Set the headers
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token,
        ];

        // Set the body for accounts
        //$todayDate = now()->format('Y-m-d H:i:s');
        $body = [
            'userId' => $id,
            'login' => $loginid
        ];

        // Send the POST request for accounts
        $responseBalance = Http::withHeaders($headers)->post($urlTrades, $body);

        if ($responseBalance->successful()) {
            $dataBalance = $responseBalance->json();

            Cache::put($cacheKey, $dataBalance, now()->addMinutes(10));

            return $dataBalance;
        }

        return null;
    }

    /**
     * Example of another method in the service class.
     *
     * @param array $data
     * @return array
     */
    public function processUserData(array $data)
    {
        // Perform some processing on the data
        return [
            'processed_data' => $data,
        ];
    }
}
