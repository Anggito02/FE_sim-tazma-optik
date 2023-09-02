<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ColorController extends Controller
{
    public function getAllColor(Request $request){
        $token = $_COOKIE['token'];

        $email = $request->email;
        $password = $request->password;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'email' => $email,
            'password' => $password
        ];

        $response = Http::withHeaders($headers)->post('http://localhost:8001/api/color/all');
        $color = $response->json();

        dd($color);
        if ($color['status'] == 'success'){
            return view('master.warna', ['data' => $color['data']]);;
        }else{
            return view('/', ['data' => $color['message']]);
        }
    }
}
