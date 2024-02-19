<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ServiceController extends Controller
{
    public function delete($id)
    {
        try {
            // Replace 'YOUR_BEARER_TOKEN' with your actual bearer token
            $bearerToken = session('token');

            // Check if the token exists in the session
            if (!$bearerToken) {
                return back()->withErrors(['error' => 'Token not found']);
            }

            $apiUrl = Config::get('app.service_delete_api_url');
            $client = new Client();

            $response = $client->delete("{$apiUrl}?id={$id}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $bearerToken,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Check if the request was successful
            if ($response->getStatusCode() == 200) {
                return redirect()->route('home')->with('success', 'Service deleted successfully');
            } else {
                return response()->json(['error' => 'Error deleting barber'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., connection error)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function showAddPage()
    {
        return view('admin.add');
    }

    public function create(Request $request)
    {
        try {
            // Replace 'YOUR_BEARER_TOKEN' with your actual bearer token
            $bearerToken = session('token');

            // Check if the token exists in the session
            if (!$bearerToken) {
                return back()->withErrors(['error' => 'Token not found']);
            }
            // Retrieve service name from the request
            
           $apiUrl = Config::get('app.service_save_api_url');
            $serviceName = $request->input('serviceName');

            $client = new Client();

            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $bearerToken,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'id' => 0,
                    'serviceName' => $serviceName,
                ],
            ]);

            // Check if the request was successful
            if ($response->getStatusCode() == 200) {
                return redirect()->route('home')->with('success', 'Service added successfully');
            } else {
                return response()->json(['error' => 'Error adding service'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., connection error)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
