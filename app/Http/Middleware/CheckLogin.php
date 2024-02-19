<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   // CheckLoginCredentials.php
   public function handle($request, Closure $next)
   {
       // Check if the user has successfully authenticated via external API
       if (session()->has('user')) {
           return $next($request);
       }

       // If the user is not authenticated, redirect to the login page with an error message
       return redirect()->route('login2')->withErrors(['error' => 'Invalid credentials']);
   }

}
