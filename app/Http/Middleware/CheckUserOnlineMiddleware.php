<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserOnlineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if the user is logged in
         if (!Auth::check()) {
            return redirect('/login');
        }

        // Get the user's session
        $session = Session::get('client_id');

        // Check if the user is online
        if (!$session) {
            // The user is not online, so store his status as offline
            Session::put('client_status', 'offline');
        } else {
            // The user is online, so update his status as online
            Session::put('client_status', 'online');
        }
        return $next($request);
    }
}
