<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsTokenValid
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

            return $next($request);
        } catch(Exception $error) {
            toastr()->error('Please login first!', 'Authentication', ['timeOut' => 3000]);
            return redirect('/login');
        }
    }
}
