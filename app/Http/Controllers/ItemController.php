<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class ItemController extends Controller
{
    //
    public function getAllItem(Request $request){
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 100;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            "jenis_item" => $request->jenis_item,
            "page" => $page,
            "limit" => $limit
        ];
        
        
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item-jenis/all', $api_request);
    
        $item = $response->json();
        dd($item);

        $user = GetUserInfo::getUserInfo();

        if ($item['status'] == 'success'){
            return view('master.item', ['item' => $item['data'], 'data' => $user['data']]);
        } else {
            return view('/dashboard');
        }

    }
}

