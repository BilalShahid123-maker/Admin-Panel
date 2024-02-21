<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bearerToken = session('token');

        // Check if the token exists in the session
        if (!$bearerToken) {
            return back()->withErrors(['error' => 'Token not found']);
        }
        
        $barberUrl = env('BARBER_API_URL');
        $clientUrl = env('CLIENT_API_URL');
        $servicesUrl = env('SERVICES_API_URL');
        
        $requestBody = [
            'pageNo' => 1,
            'size' => 20,
            'isPagination' => true,
        ];

        $servicesRequestBody = [
            "pageNo" => 1,
            "size" => 20,
            "isPagination" => true
            
        ];

        $client = new Client();

        try {
            $barberResponse = $client->post($barberUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $bearerToken,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => $requestBody,
            ]);

            $clientResponse = $client->post($clientUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $bearerToken,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => $requestBody,
            ]);

            // Get service profiles
            $serviceResponse = $client->post($servicesUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $bearerToken,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => $servicesRequestBody,
            ]);

            // Parse the JSON response for barber profiles
            $barberData = json_decode($barberResponse->getBody(), true);

            // Parse the JSON response for client profiles
            $clientData = json_decode($clientResponse->getBody(), true);

            // Parse the JSON response for service profiles
            $serviceData = json_decode($serviceResponse->getBody(), true);

            // Check for success or handle the response as needed
            if ($barberResponse->getStatusCode() == 200 && $clientResponse->getStatusCode() == 200 &&
                $serviceResponse->getStatusCode() == 200 && $barberData['succeeded'] && $clientData['succeeded'] &&
                $serviceData['succeeded']) {
                
                // Successful response for barber profiles
                $barberProfiles = $barberData['data'];

                // Successful response for client profiles
                $clientProfiles = $clientData['data'];

                // Successful response for service profiles
                $serviceProfiles = $serviceData['data'];

                // Pass the data to the view
                return view('admin.dashboard', compact('barberProfiles', 'clientProfiles', 'serviceProfiles'));
            } else {
                // Handle error response
                return response()->json(['error' => 'Error fetching data'], 500);
            }

        } catch (\Exception $e) {
            // Handle any exceptions (e.g., connection error, API error)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
