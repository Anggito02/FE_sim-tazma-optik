<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class PurchaseOrder extends Controller
{
    //
    public function getAllPO () {
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

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/all', $api_request);

        $po = $response->json();

        $user = GetUserInfo::getUserInfo();

        if ($po['status'] == 'success'){
            return view('master.preorder', ['po' => $po['data'], 'data' => $user['data']]);
        }else{
            return view('/dashboard');
        }
    }
}
