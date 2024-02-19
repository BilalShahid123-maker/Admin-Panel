<?php

// app/Http/Middleware/ExternalApiAuthentication.php

namespace App\Http\Middleware;

use Closure;

class ExternalApiAuthentication
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated with the external API
        // You might need to modify this based on how your external API handles authentication
        if (auth()->check()) {
            return $next($request);
        }

        // If not authenticated, attempt authentication using the CustomLoginController
        try {
            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'confirmPassword' => $request->input('confirmPassword'),
            ];

            // Create an instance of the CustomLoginController
            $loginController = app(\App\Http\Controllers\Auth\CustomLoginController::class);

            // Call the login method of CustomLoginController
            $response = $loginController->login($request->merge($credentials));

            // If the login attempt is successful, proceed
            if ($response->getStatusCode() == 200) {
                return $next($request);
            } else {
                // If login fails, redirect to the login page
                return redirect('/login');
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., connection error)
            return redirect('/login');
        }
    }
}

