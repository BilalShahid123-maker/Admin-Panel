<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function login2(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    try {

        $apiBaseUrl = env('AUTH_API_URL');  

        $client = new Client();

        $response = $client->post($apiBaseUrl, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'confirmPassword' => $request->input('password'),
            ],
        ]);

        $responseBody = $response->getBody()->getContents();

        $responseData = json_decode($responseBody, true);

        if ($response->getStatusCode() == 200 && isset($responseData['succeeded']) && $responseData['succeeded']) {
            
            session(['user' => $responseData['data']['user']]);
            session(['token' => $responseData['data']['token']]);
            return redirect()->route('home');
        } else {
            $errorMessage = $responseData['message'] ?? 'Invalid credentials';
            return back()->withErrors(['error' => $errorMessage]);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}

public function logout2(Request $request)
{
    $request->session()->regenerate(); // Regenerate the session ID
    session()->forget('user'); 
    session()->forget('token');
    // Remove the 'user' key from the session
    session()->flush(); // Clear the entire session data

    return redirect()->route('login2')->withHeaders([
        'Cache-Control' => 'no-cache, no-store, must-revalidate',
        'Pragma' => 'no-cache',
        'Expires' => '0',
    ]);
}



public function adminedit()
    {
        $userDetails = session('user');

        return view('admin.edituserprofile', ['userDetails' => $userDetails]);
    }    
    
    public function editUserProfile(Request $request)
    {
        $request->validate([
            'userName' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string',
            'genderId' => 'nullable|integer',
        ]);
    
        try {
            $apiBaseUrl = env('EDIT_ADMIN_API_URL');
            $client = new Client();
    
            $userDetails = session('user');
    
            // Check if the 'user' session key exists and is not null
            if (!$userDetails || !isset($userDetails['userId'])) {
                return back()->withErrors(['error' => 'User details not found in session']);
            }
    
            $userId = $userDetails['userId'];
    
            // Use the correct endpoint for updating user profiles
            $response = $client->post("{$apiBaseUrl}/editAdmin", [
                'json' => [
                    'id' => $userId,
                    'userName' => $request->input('userName'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'genderId' => $request->input('genderId'),
                ],
            ]);
    
            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true);
    
            if ($response->getStatusCode() == 200 && isset($responseData['succeeded']) && $responseData['succeeded']) {
                // Update the user information in the session if needed
                session(['user' => $responseData['data']['user']]);
    
                return redirect()->route('home')->with('success', 'User profile updated successfully');
            } else {
                return back()->withErrors(['error' => $responseData['message'] ?? 'Error updating user profile']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
}
