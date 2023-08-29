<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller{
    public function login(Request $request){
        $headers = [
            'Content-Type' => 'application/json'
        ];

        $email = $request->email;
        $password = $request->password;

        $api_request = [
            'email' => $email,
            'password' => $password
        ];

        $response = Http::withHeaders($headers)->post('http://localhost:8001/api/login', $api_request);
        $data = $response->json();

        setcookie('token', $data['data']['token'], 60, '/', '', FALSE, TRUE);
        return redirect('/dashboard');
    }

    public function getUserInfo(){
        $token = $_COOKIE['XSRF-TOKEN'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $response = Http::withHeaders($headers)->post('http://localhost:8001/api/user/info');
        $user = $response->json();
        // dd($response);
        return view('dashboard', ['data' => $user]);
    }
}
