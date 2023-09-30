<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class PurchaseOrderDetailController extends Controller
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
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);
        $response_vendor = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);

        $po = $response->json();
        $employee = $response_employee->json();
        $vendor = $response_vendor->json();

        $user = GetUserInfo::getUserInfo();

        if ($po['status'] == 'success'){
            return view('master.po', [
                'po' => $po['data'], 
                'data' => $user['data'],
                'employee' => $employee['data'],
                'vendor' => $vendor['data']
            ]);
        }else{
            return redirect('/dashboard');
        }
    }
}
