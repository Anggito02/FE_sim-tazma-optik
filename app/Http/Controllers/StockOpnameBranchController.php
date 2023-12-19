<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;


class StockOpnameBranchController extends Controller
{
    public function getAllStockOpnameBranch(Request $request){
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
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch/all', $api_request);
        $branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        $stock_opname_branch = $response->json();
        $branch = $branch->json();
        
        $user = GetUserInfo::getUserInfo();
        // if ($item['status'] == 'success'){
            return view('inventory.stokopBranch', [
                'data' => $user['data'],
                'stock_opname_branch' => $stock_opname_branch['data'],
                'branch' => $branch['data']
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
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch/all', $data);
        $so = $response->json();
        return response()->json($so);
    }
    public function addStockOpnameBranch(Request $request)
    {
        $row = "";
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token,
        ];

        $api_request = [
            "branch_id" => $request->branch_id
        ];

        $row = $request;
        
        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch/add', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            $row['message']="Data has been successfully inserted";
        }else{
            $row['message']="Insert data failed ";
        }
        return response()->json($result);
    }

}
