<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BarberController extends Controller
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
            // Create a Guzzle client
            $apiUrl = Config::get('app.barber_delete_api_url');
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
                return redirect()->route('home')->with('success', 'Barber deleted successfully');
            } else {
                return response()->json(['error' => 'Error deleting barber'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., connection error)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function approve($userId)
    {
        try {
            // Replace 'YOUR_BEARER_TOKEN' with your actual bearer token
            $bearerToken = session('token');

            // Check if the token exists in the session
            if (!$bearerToken) {
                return back()->withErrors(['error' => 'Token not found']);
            }
            // Create a Guzzle client
            $apiUrl = Config::get('app.barber_approve_api_url');
            $client = new Client();

            $response = $client->post("{$apiUrl}?userId={$userId}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $bearerToken,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Check if the request was successful
            if ($response->getStatusCode() == 200) {
                return redirect()->route('home')->with('success', 'Barber approved successfully');
            } else {
                return response()->json(['error' => 'Error approving barber'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., connection error)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function block(Request $request, $userId)
    {
        try {
            // Replace 'YOUR_BEARER_TOKEN' with your actual bearer token
            $bearerToken = session('token');

            // Check if the token exists in the session
            if (!$bearerToken) {
                return back()->withErrors(['error' => 'Token not found']);
            }
            
            $apiUrl = Config::get('app.barber_block_api_url');
            $client = new Client();

            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $bearerToken,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'userId' => $userId,
                    'block' => true,
                ],
            ]);

            // Check if the request was successful
            if ($response->getStatusCode() == 200) {
                return redirect()->route('home')->with('success', 'Barber blocked successfully');
            } else {
                return response()->json(['error' => 'Error blocking barber'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., connection error)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
