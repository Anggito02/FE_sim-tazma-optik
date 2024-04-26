<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class ReturController extends Controller
{
    //
    function getAllRetur() {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $page = 1;
        $limit = 10;

        $api_request = [
            'page' => $page,
            'limit' => $limit
        ];

        // $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/retur/all', $api_request);
        // $retur = $response->json();
        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $branch = $response_branch->json();
        $employee = $response_employee->json();

        $user = GetUserInfo::getUserInfo();
        return view('inventory.retur', [
            'data' => $user['data'],
            'branch' => $branch['data'],
            'employee' => $employee['data']
            // 'retur' => $retur['data']
        ]);
    }

    function loadDataMaster(Request $request) {
        {
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];
            $data = $request->all(); // Retrieve all input data from the request
            $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/retur/all', $data);
            $retur = $response->json();
            return response()->json($retur);
        }
    }

    function loadDataDetailOnly(Request $request) {
        {
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];

            $api_request = [
                "page" => 1,
                "limit" => 10
            ];

            $data = $request->all(); // Retrieve all input data from the request
            $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/retur/one', $data);
            $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
            $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);
            
            $retur = $response->json();
            $branch = $response_branch->json();
            $employee = $response_employee->json();
            return view('inventory.returEdit', [
                'data' => $retur['data'],
                'branch' => $branch['data'],
                'employee' => $employee['data']
            ]);
        }
    }

    function addRetur(Request $request) {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $data = $request->all(); // Retrieve all input data from the request
        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/retur/add', $data);
        $retur = $response->json();
        return response()->json($retur);
    }

    function updateRetur(Request $request) {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $row = $request;
        $api_request = [
            "id" => $request->id,
            "tanggal_pengiriman" => $request->tanggal_pengiriman,
            "branch_id" => $request->branch_id,
            "received_by" => $request->received_by,
            "checked_by" => $request->checked_by,
            "approved_by" => $request->approved_by,
            "delivered_by" => $request->delivered_by
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/retur/edit', $api_request);
        $result = $response->json();
        if($result['message'] == "success") {
            $row['message']="Data has been successfully updated";
        } else {
            $row['message']="Data failed to update";
        }
        return response()->json($result);
    }

    function deleteRetur(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $data = $request->all(); // Retrieve all input data from the request

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/retur/delete', $data);
        $result = $response->json();

        if($result['status'] == 'success'){
            $row['message']="The data has been successfully deleted";
        }else{
            $row['message']="Delete data failed ";
        }
        return response()->json($result);
    }
}
