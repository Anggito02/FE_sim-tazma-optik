<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class BranchOutgoingController extends Controller
{
    //
    public function getAllBranchOutgoing() {
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

        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $branch = $response_branch->json();
        $employee = $response_employee->json();

        $user = GetUserInfo::getUserInfo();
            return view('inventory.branchOutgoing', [
                'data' => $user['data'],
                'branch' => $branch['data'],
                'employee' => $employee['data']
            ]);
    }

    public function loadDataMaster(Request $request) {
        {
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];
            $data = $request->all(); // Retrieve all input data from the request
            $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch-outgoing/all', $data);
            $branch_outgoing = $response->json();
            return response()->json($branch_outgoing);
        }
    }

    public function loadDataDetailOnly(Request $request) {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $data = $request->all();
        $api_request = [
            "page" => 1,
            "limit" => 10000
        ];
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch-outgoing/one', $data);
        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $branch_outgoing = $response->json();
        $branch = $response_branch->json();
        $employee = $response_employee->json();
        return view('inventory.branchOutgoingEdit', [
            'vals'=>$branch_outgoing['data'],
            'branch' => $branch['data'],
            'employee' => $employee['data']
        ]);
    }

    public function addBranchOutgoing(Request $request) {
        $row = "";
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token,
        ];

        $api_request = [
            "tanggal_pengiriman" => $request->tanggal_pengiriman,
            "branch_from_id" => $request->branch_from_id,
            "branch_to_id" => $request->branch_to_id,
            "known_by" => $request->known_by,
            "approved_by" => $request->approved_by,
            "delivered_by" => $request->delivered_by,
            "checked_by" => $request->checked_by
        ];

        $row = $request;
        
        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/branch-outgoing/add', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            $row['message']="Data has been successfully inserted";
        }else{
            $row['message']="Insert data failed ";
        }
        return response()->json($result);
    }

    public function updateBranchOutgoing(Request $request) {
        $token = $_COOKIE['token'];
        
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token,
        ];
        $row = $request;

        $api_request = [
            "id" => $request->id,
            "tanggal_pengiriman" => $request->tanggal_pengiriman,
            "branch_from_id" => $request->branch_from_id,
            "branch_to_id" => $request->branch_to_id,
            "known_by" => $request->known_by,
            "approved_by" => $request->approved_by,
            "delivered_by" => $request->delivered_by,
            "checked_by" => $request->checked_by,
            "received_by" => $request->received_by
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/branch-outgoing/edit', $api_request);
        $result = $response->json();

        if($result['status'] == 'success'){
            $row['message']="Data has been successfully updated";
        } else {
            $row['message']="Update data failed ";
        }
        return response()->json($result);
    }

    public function deleteBranchOutgoing(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            "id" => $request->id
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/branch-outgoing/delete', $api_request);
        $result = $response->json();

        if($result['message'] == 'success'){
            $row['message']="The data has been successfully deleted";
        }else{
            $row['message']="Delete data failed ";
        }
        return response()->json($result);
    }

}