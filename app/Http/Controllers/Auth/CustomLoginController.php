<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CustomLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'confirmPassword' => 'required|string', // Add validation rule for confirmPassword
        ]);

        $client = new Client();

        try {
            $response = $client->post('https://api.doorcutapp.com/api/auth/login', [
                'form_params' => [
                    'email' => $request->email,
                    'password' => $request->password,
                    'confirmPassword' => $request->confirmPassword,
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                // Authentication successful, handle accordingly
                return $this->sendLoginResponse($request);
            } else {
                // Authentication failed
                return $this->sendFailedLoginResponse($request);
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., connection error)
            return $this->sendFailedLoginResponse($request);
        }
    }
}

