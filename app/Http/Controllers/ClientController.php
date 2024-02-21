<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ClientController extends Controller
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
            $apiUrl = config('app.client_delete_api_url');
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
                return redirect()->route('home')->with('success', 'Client deleted successfully');
            } else {
                return response()->json(['error' => 'Error deleting barber'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., connection error)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
