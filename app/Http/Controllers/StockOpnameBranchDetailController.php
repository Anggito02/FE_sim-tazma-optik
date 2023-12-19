<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class StockOpnameBranchDetailController extends Controller {
    public function getAllStockOpnameBranchDetail (Request $request, int $soid) {
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
            "stock_opname_branch_id" => $soid
        ];

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/all/', $api_request_so);
        $response_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/filtered', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $stock_opname_branch_detail = $response->json();
        $item = $response_item->json();
        $employee = $response_employee->json();
        // dd($employee);
        
        $user = GetUserInfo::getUserInfo();
        // dd($user['data']);
        return view('inventory.stokopBranchDetail', [
            'data' => $user['data'],
            'stock_opname_branch_detail' => $stock_opname_branch_detail['data'],
            'item' => $item['data'],
            'employee' => $employee['data'],
            'stock_opname_branch_id' => $soid
        ]);
    }

    public function addStockOpnameBranchDetail(Request $request) {
        $row ="";
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $row=$request;
        $api_request = [
            'stock_opname_branch_id' => $request->stock_opname_branch_id,
            'item_id' => $request->item_id,
            'actual_qty' => $request->actual_qty,
            'so_start' => $request->so_start,
            'so_end' => $request->so_end,
            'open_by' => $request->open_by,
            'close_by' => $request->close_by
        ];
        // dd($api_request);
        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/add', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            $row['message']="The data has been successfully added";
        }else{
            $row['message']="Add data failed ";
        }
        return response()->json($result);
    }

    public function loadDataMaster(Request $request, int $soid)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $page = 1;
        $limit = 50;

        $api_request = [
            "page" => $page,
            "limit" => $limit,
            'stock_opname_branch_id' => $soid,
        ];
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/all', $api_request);
        $stock_opname_branch_detail = $response->json();
        return response()->json($stock_opname_branch_detail);
    }

    public function loadDataDetailOnly(Request $request, int $soid)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $data = $request->all();
        
        $api_request_so = [
            "page" => 1,
            "limit" => 10000,
            'stock_opname_branch_id' => $soid
        ];

        $api_request = [
            "page" => 1,
            "limit" => 10000
        ];

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/all', $api_request_so);
        $response_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/filtered', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $stock_opname_branch_detail = $response->json();
        $item = $response_item->json();
        $employee = $response_employee->json();
        return view('inventory.stokopDetailEdit', [
            'stock_opname_branch_detail' => $stock_opname_branch_detail['data'],
            'item' => $item['data'],
            'employee' => $employee['data']
        ]);
    }

    public function updateStockOpnameBranchDetail(Request $request, $soid) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $row=$request;

        $api_request = [
            'id' => $request->id,
            'so_start' => $request->so_start,
            'so_end' => $request->so_end,
            'actual_qty' => $request->actual_qty,
            'item_id' => $request->item_id,
            'open_by' => $request->open_by,
            'close_by' => $request->close_by,
            'stock_opname_branch_id' => $soid
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/edit', $api_request);
        $result = $response->json();

        if($result['status'] == 'success'){
            $row['message']="The data has been successfully updated";
        }else{
            $row['message']="Update data failed ";
        }
        return response()->json($result);
    }

    public function initAdjustment(Request $request) {
        $row ="";
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $row=$request;
        $api_request = [
            'id' => $request->id,
            'adjustment_date' => $request->adjustment_date,
            'adjustment_followup_note' => $request->adjustment_followup_note,
            "adjustment_by" => $request->adjustment_by
        ];
        
        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/init-adjustment', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            $row['message']="The data has been successfully updated";
        }else{
            $row['message']="Update data failed ";
        }
        return response()->json($result);
    }
    
    public function makeAdjustment(Request $request) {
        $row ="";
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $row=$request;
        $api_request = [
            'adjustment_type' => $request->adjustment_type,
            'adjustment_by' => $request->adjustment_by,
            'item_id' => $request->item_id,
            'in_out_qty' => $request->in_out_qty
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/make-adjustment', $api_request);
        // dd($response);
        
        $result = $response->json();

        if($result['status'] == 'success'){
            $row['message']="The data has been successfully updated";
        } else {
            $row['message']="Update data failed ";
        }
        return response()->json($result);
    }
}