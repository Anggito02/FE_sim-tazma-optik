<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $_COOKIE['token'];

            toastr()->error('Already Logged In', 'Authentication', ['timeOut' => 3000]);
            return redirect('/dashboard');
        } catch(Exception $error) {
            return $next($request);
        }
    }
}
