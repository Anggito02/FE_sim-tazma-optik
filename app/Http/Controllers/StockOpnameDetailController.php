<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class StockOpnameDetailController extends Controller {
    public function getAllStockOpnameDetail (Request $request, int $id) {
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 50;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            "page" => $page,
            "limit" => $limit
        ];

        $api_request_so = [
            "page" => $page,
            "limit" => $limit,
            "stock_opname_id" => $id
        ];

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-detail/all/', $api_request_so);
        $response_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/filtered', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $stock_opname_detail = $response->json();
        $item = $response_item->json();
        $employee = $response_employee->json();
        // dd($employee);
        
        $user = GetUserInfo::getUserInfo();
        return view('inventory.stokopdetail', [
            'data' => $user['data'],
            'stock_opname_detail' => $stock_opname_detail['data'],
            'item' => $item['data'],
            'employee' => $employee['data'],
            'stock_opname_id' => $id
        ]);
    }

    public function addStockOpnameDetail(Request $request) {
        $row ="";
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $row=$request;
        $api_request = [
            'stock_opname_id' => $request->stock_opname_id,
            'item_id' => $request->item_id,
            'actual_qty' => $request->actual_qty,
            'so_start' => $request->so_start,
            'so_end' => $request->so_end,
            'open_by' => $request->open_by,
            'close_by' => $request->close_by
        ];
        // dd($api_request);
        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-detail/add', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            $row['message']="The data has been successfully added";
        }else{
            $row['message']="Add data failed ";
        }
        return response()->json($result);
    }
}