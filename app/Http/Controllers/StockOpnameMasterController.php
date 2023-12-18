<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;


class StockOpnameMasterController extends Controller
{
    public function getAllStockOpnameMaster(Request $request){
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
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-master/all', $api_request);
        $stock_opname_master = $response->json();
        
        $user = GetUserInfo::getUserInfo();
        // if ($item['status'] == 'success'){
            return view('inventory.stokop', [
                'data' => $user['data'],
                'stock_opname_master' => $stock_opname_master['data']
            ]);
        // } else {
            // return redirect('/dashboard');
        // }
        // dd($item);

    }

    public function loadDataMaster(Request $request)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $data = $request->all(); // Retrieve all input data from the request
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-master/all', $data);
        $so = $response->json();
        return response()->json($so);
    }
    public function addStockOpnameMaster(Request $request)
    {
        $row = "";
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $row = $request;
        
        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-master/add');

        $result = $response->json();
        if($result['status'] == 'success'){
            $row['message']="Data has been successfully inserted";
        }else{
            $row['message']="Insert data failed ";
        }
        return response()->json($result);
    }

}
