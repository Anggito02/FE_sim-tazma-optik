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

        $page = 1;
        $limit = 25;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            "page" => $page,
            "limit" => $limit
        ];

        $response = Http::withHeaders($headers)->post('http://localhost:8001/api/color/all', $api_request);

        dd($response);

        $color = $response->json();

        if ($color['status'] == 'success'){
            return view('master.warna', ['data' => $color['data']]);;
        }else{
            return view('/', ['data' => $color['message']]);
        }
    }
}
