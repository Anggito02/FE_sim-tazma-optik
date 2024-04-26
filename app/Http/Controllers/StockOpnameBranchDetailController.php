<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class StockOpnameBranchDetailController extends Controller {
    public function getAllStockOpnameBranchDetail (Request $request, int $sobid) {
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 50;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $tanggal_so_from = $request->tanggal_so_from;
        $tanggal_so_until = $request->tanggal_so_until;
        $adjustment_type = $request->adjustment_type;
        $adjustment_date_from = $request->adjustment_date_from;
        $adjustment_date_until = $request->adjustment_date_until;
        $adjustment_status = $request->adjustment_status;
        $jenis_item = $request->jenis_item;
        $closed_by = $request->closed_by;
        $open_by = $request->open_by;
        $adjustment_by = $request->adjustment_by;

        $api_request = [
            "page" => $page,
            "limit" => $limit
        ];
        $response_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/filtered', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $item = $response_item->json();
        $employee = $response_employee->json();
        $user = GetUserInfo::getUserInfo();

        return view('inventory.stokopBranchDetail', [
            'data' => $user['data'],
            'item' => $item['data'],
            'employee' => $employee['data'],
            'stock_opname_branch_id' => $sobid,
            'tanggal_so_from' => $request->tanggal_so_from,
            'tanggal_so_until' => $request->tanggal_so_until,
            'adjustment_type' => $request->adjustment_type,
            'adjustment_date_from' => $request->adjustment_date_from,
            'adjustment_date_until' => $request->adjustment_date_until,
            'adjustment_status' => $request->adjustment_status,
            'jenis_item' => $request->jenis_item,
            'open_by' => $request->open_by,
            'adjustment_by' => $request->adjustment_by
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
        $so_start = new \DateTime($request->so_start);
        $so_end = new \DateTime($request->so_end);
        $api_request = [
            'stock_opname_id' => $request->stock_opname_branch_id,
            'item_id' => $request->item_id,
            'actual_qty' => $request->actual_qty,
            'so_start' => $so_start->format('Y-m-d H:i:s'),
            'so_end' => $so_end->format('Y-m-d H:i:s'),
            'open_by' => $request->open_by,
            'close_by' => $request->close_by,
            'branch_id' => $request->branch_id
        ];
        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/add', $api_request);

        $result = $response->json();
        if($result['message'] == 'success'){
            $row['message']="The data has been successfully added";
        }else{
            $row['message']="Add data failed ";
        }
        return response()->json($result);
    }

    public function loadDataMaster(Request $request)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $data = $request->all();
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/all', $data);
        $stock_opname_branch_detail = $response->json();
        return response()->json($stock_opname_branch_detail);
    }

    public function loadDataDetailOnly(Request $request)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $data = $request->all();
        
        $api_request_sod = [
            'stock_opname_branch_detail_id' => $data['sob_detail_id'],
            "page" => 1,
            "limit" => 10000
        ];

        $api_request = [
            "page" => 1,
            "limit" => 10000
        ];

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/one', $api_request_sod);
        $response_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/filtered', $api_request);

        $stock_opname_branch_detail = $response->json();
        $item = $response_item->json();
        return view('inventory.stokopBranchDetailEdit', [
            'stock_opname_branch_detail' => $stock_opname_branch_detail['data'],
            'items' => $item['data'],
            'sob_detail_id' => $data['sob_detail_id'],
            'branch_id' => $data['branch_id']
        ]);
    }

    public function updateStockOpnameBranchDetail(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $row=$request;

        $api_request = [
            'id' => $request->sob_detail_id,
            'so_start' => $request->so_start,
            'so_end' => $request->so_end,
            'actual_qty' => $request->actual_qty,
            'item_id' => $request->item_id,
            'branch_id' => $request->branch_id,
            'open_by' => $request->open_by,
            'close_by' => $request->close_by
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/edit', $api_request);
        $result = $response->json();

        if($result['message'] == 'success'){
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
            'id' => $request->stock_opname_branch_detail_id,
            'adjustment_date' => $request->adjustment_date,
            'adjustment_followup_note' => $request->adjustment_followup_note,
            "adjustment_by" => $request->adjustment_by
        ];
        
        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/init-adjustment', $api_request);

        $result = $response->json();
        if($result['message'] == 'success'){
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
            'so_branch_detail_id' => $request->stock_opname_branch_detail_id,
            'adjustment_type' => $request->adjustment_type,
            'adjustment_by' => $request->adjustment_by,
            'items_id' => $request->item_id,
            'in_out_qty' => abs($request->in_out_qty),
            'branch_id' => $request->branch_id
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/make-adjustment', $api_request);
        // dd($response);
        
        $result = $response->json();

        if($result['message'] == 'success'){
            $row['message']="The data has been successfully updated";
        } else {
            $row['message']="Update data failed ";
        }
        return response()->json($result);
    }

    public function checkQRCode(Request $request) {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $api_request = [
            'kode_qr_po_detail' => $request->kode_qr_po_detail
        ];
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/one/qr', $api_request);
        $result = $response->json();
        return response()->json($result);
    }

    public function checkQRCodeBranch(Request $request) {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request_stok_branch = [
            'item_id' => $request->item_id,
            'branch_id' => $request->branch_id
        ];

        $response_stok_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch-item/one', $api_request_stok_branch);
        $result_stok_branch = $response_stok_branch->json();

        return response()->json($result_stok_branch);
    }

    public function loadAdjustmentNote(Request $request) {
        $token = $_COOKIE['token'];
        // $headers = [
        //     'Accept' => 'application/json',
        //     'Authorization' => 'Bearer '.$token
        // ];
        $data = $request->all();
        // print_r($data);
        // $api_request = [
        //     "page" => 1,
        //     "limit" => 10000
        // ];
        $user = GetUserInfo::getUserInfo();


        return view('inventory.stokopBranchDetailAdjustmentNote', [
            'data' => $user['data'],
            'sob_detail_id' => $data['sob_detail_id'],
            'sob_id' => $data['sob_id'],
        ]);

    }

    public function loadMakeAdjustment(Request $request) {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        
        $data = $request->all();
        $api_request = [
            "stock_opname_branch_detail_id" => $data['sob_detail_id'],
            "page" => 1,
            "limit" => 10000
        ];
        $user = GetUserInfo::getUserInfo();
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/stock-opname-branch-detail/one', $api_request);

        $result = $response->json();

        return view('inventory.stokopBranchDetailMakeAdjustment', [
            'data' => $user['data'],
            'sob_detail_id' => $data['sob_detail_id'],
            'sob_id' => $data['sob_id'],
            'sob_detail' => $result['data']
        ]);

    }
}