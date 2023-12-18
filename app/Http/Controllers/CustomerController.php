<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Utils\GetUserInfo;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function getAllCustomer(Request $request) {
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
        $response_kabkota = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/kabkota/all', $api_request);
        $branch = $response_branch->json();
        $kabkota = $response_kabkota->json();

        $user = GetUserInfo::getUserInfo();

        return view('sales.customer', [
            'data' => $user['data'],
            'branch' => $branch['data'],
            'kabkota' => $kabkota['data'],
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'usia_from' => $request->usia_from,
            'usia_until' => $request->usia_until,
            'gender' => $request->gender,
            'branch_id' => $request->branch_id,
            'kabkota_id' => $request->kabkota_id
        ]);
    }

    public function loadDataDetailOnly(Request $request){
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
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/customer/one', $data)->json();
        $response_customer = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/customer/all', $api_request);
        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        $response_kabkota = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/kabkota/all', $api_request);
        return view(
            'sales.customerEdit',
            ['vals'=>$response['data'],
            'customer' => $response_customer['data'],
            'branch' => $response_branch['data'],
            'kabkota' => $response_kabkota['data']]
        );
    }

    public function loadDataMaster(Request $request)
    {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $data = $request->all(); // Retrieve all input data from the request
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/customer/all', $data);
        $customer = $response->json();
        return response()->json($customer);
    }

    public function addCustomer(Request $request){
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $tanggal_lahir = Carbon::createFromFormat('Y-m-d', $request->tanggal_lahir);
        $usia = $tanggal_lahir->diffInYears(Carbon::now());

        $api_request = [
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'usia' => $usia,
            'tanggal_lahir' => $request->tanggal_lahir,
            'gender' => $request->gender,
            'branch_id' => $request->branch_id,
            'kabkota_id' => $request->kabkota_id,
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/customer/add', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            $row['message']="Data has been successfully inserted";
        }else{
            $row['message']="Insert data failed ";
        }
        return response()->json($result);
    }
}
