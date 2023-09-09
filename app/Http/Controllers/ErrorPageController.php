<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;
class ErrorPageController extends Controller
{
    public function PageError404(){
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 100;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            "page" => $page,
            "limit" => $limit
        ];

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/user/info', $api_request);

        $frame = $response->json();

        $user = GetUserInfo::getUserInfo();

        if ($frame['status'] == 'success'){
            return view('error_page.404', ['data' => $user['data']]);

        }else{
            return view('/dashboard');
        }
    }
}
