<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;


class KasController extends Controller {
    public function prosesKasBranch (Request $request) {
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

        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);

        $branch_all = $response_branch->json();

        $user = GetUserInfo::getUserInfo();

        return view('dito', [
            'data' => $user['data'],
            'branch_all' => $branch_all['data']
        ]);
    }


    public function getAllKas (Request $request) {
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 50;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request_kas = [
            "page" => $page,
            "limit" => $limit,
            "branch_id" => $request->branch_id,
        ];

        $api_request = [
            "page" => $page,
            "limit" => $limit,
        ];

        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        $response_kas = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/kas/all', $api_request_kas);

        $branch_all = $response_branch->json();
        $kas_all = $response_kas->json();

        // dd($kas_all, $branch_all, $request->branch_id);
        $user = GetUserInfo::getUserInfo();

        return view('dito', [
            'data' => $user['data'],
            'kas_all' => $kas_all['data'],
            'branch_all' => $branch_all['data'],
            'idx_branch' => $request->branch_id
        ]);
    }

    public function loadDataMaster(Request $request, int $branch_id)
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
            "branch_id" => $branch_id,
        ];

        $response_kas = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/kas/all', $api_request);

        $kas = $response_kas->json();
        dd($kas);
        return response()->json($kas);
    }

    public function addStockOpnameDetail(Request $request) {
        $row ="";
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $row=$request;
        $so_start = new \DateTime($request->so_start);
        $so_end = new \DateTime($request->so_end);
        $api_request = [
            'stock_opname_id' => $request->stock_opname_id,
            'item_id' => $request->item_id,
            'actual_qty' => $request->actual_qty,
            'so_start' => $so_start->format('Y-m-d H:i:s'),
            'so_end' => $so_end->format('Y-m-d H:i:s'),
            'open_by' => $request->open_by,
            'close_by' => $request->close_by
        ];
        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-detail/add', $api_request);

        $result = $response->json();
        if($result['message'] == 'success'){
            $row['message']="The data has been successfully added";
        }else{
            $row['message']="Add data failed ";
        }
        return response()->json($result);
    }

    public function loadDataDetailOnly(Request $request, int $soid)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $data = $request->all();
        $detail_id = $request->detail_id;
        $api_request_so = [
            "page" => 1,
            "limit" => 10000,
            'stock_opname_id' => $soid
        ];

        $api_request = [
            "page" => 1,
            "limit" => 10000
        ];

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-detail/all', $api_request_so);
        $response_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/filtered', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $stock_opname_detail = $response->json();
        $item = $response_item->json();
        $employee = $response_employee->json();
        // print_r($stock_opname_detail['data']);
        return view('inventory.stokopDetailEdit', [
            'stock_opname_detail' => $stock_opname_detail['data'],
            'item' => $item['data'],
            'employee' => $employee['data'],
            'detail_id' => $detail_id
        ]);
    }

    public function updateStockOpnameDetail(Request $request, $soid) {
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
            'stock_opname_id' => $soid
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-detail/edit', $api_request);
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
        $adjustment_date = new \DateTime($request->adjustment_date);
        $api_request = [
            'id' => $request->id,
            'adjustment_date' => $adjustment_date->format('Y-m-d H:i:s'),
            'adjustment_followup_note' => $request->adjustment_followup_note,
            "adjustment_by" => $request->adjustment_by
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-detail/init-adjustment', $api_request);

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
        print_r($api_request);

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-detail/make-adjustment', $api_request);
        // dd($response);

        $result = $response->json();

        if($result['message'] == 'success'){
            $row['message']="The data has been successfully updated";
        } else {
            $row['message']="Update data failed ";
        }
        return response()->json($result);
    }
}