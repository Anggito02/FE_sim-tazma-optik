<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

            $headers = [
                'Accept' => "application\json",
                'Authorization' => 'Bearer '.$token
            ];

            $response = Http::withHeaders($headers)->post('http://localhost:8001/api/token-test');

            $result = $response->json();

            if($result['status'] == 'success'){
                return $next($request);
            }else{
                throw new Exception('Token Not Registered');
            }
        } catch(Exception $error) {
            toastr()->error('Please login first!', 'Authentication', ['timeOut' => 3000]);
            return redirect('/login');
        }
    }
}
