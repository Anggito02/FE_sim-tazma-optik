<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\GetUserInfo;
use Carbon\Carbon;

class CustomerDiagnoseController extends Controller
{
    public function getAllCustomerDiagnose(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            "page" => 1,
            "limit" => 10000
        ];

        $customer_nama = $request->customer_nama;
        $tahun = $request->tahun;
        $customer_nomor_telepon = $request->customer_nomor_telepon;
        $branch_id = $request->branch_id;
        $diagnosed_by = $request->diagnosed_by;
        $bulan = $request->bulan;


        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/customer/all', $api_request);
        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);
        $user = GetUserInfo::getUserInfo();

        $customer = $response->json();
        $employee = $response_employee->json();
        $branch = $response_branch->json();

        return view('master.customerDiagnose', [
            'data' => $user['data'],
            'customer' => $customer['data'],
            'employee' => $employee['data'],
            'branch' => $branch['data'],
            'customer_nama' => $customer_nama,
            'customer_nomor_telepon' => $customer_nomor_telepon,
            'branch_id' => $branch_id,
            'diagnosed_by' => $diagnosed_by,
            'bulan' => $bulan,
            'tahun' => $tahun
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
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/customer-diagnose/one', $data)->json();
        $response_customer = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/customer/all', $api_request);
        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        return view(
            'master.customerDiagnoseEdit',
            ['vals'=>$response['data'],
            'customer' => $response_customer['data'],
            'branch' => $response_branch['data'],
            ]
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
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/customer-diagnose/filtered', $data);
        $customer = $response->json();
        foreach($customer['data'] as $key => $value){
            $customer['data'][$key]['tanggal_diagnosa'] = Carbon::parse($value['tanggal_diagnosa'])->format('d-m-Y');
        }
        return response()->json($customer);
    }

    public function addCustomerDiagnose(Request $request){
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'customer_id' => $request->customer_id,
            'branch_check_location_id' => $request->branch_check_location_id,
            'keluhan' => $request->keluhan
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/customer-diagnose/add', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            $row['message']="Data has been successfully inserted";
        }else{
            $row['message']="Insert data failed ";
        }
        return response()->json($result);
    }

    public function updateCustomerDiagnose(Request $request){
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'customer_diagnose_id' => $request->customer_diagnose_id,
            'keluhan' => $request->keluhan,
            'visus_tanpa_koreksi_R' => $request->visus_tanpa_koreksi_R,
            'visus_tanpa_koreksi_L' => $request->visus_tanpa_koreksi_L,
            'oculus_dextra_sph_R' => $request->oculus_dextra_sph_R,
            'oculus_dextra_cyl_R' => $request->oculus_dextra_cyl_R,
            'axis_R' => $request->axis_R,
            'oculus_dextra_add_R' => $request->oculus_dextra_add_R,
            'oculus_dextra_visus_R' => $request->oculus_dextra_visus_R,
            'oculus_sinistra_sph_L' => $request->oculus_sinistra_sph_L,
            'oculus_sinistra_cyl_L' => $request->oculus_sinistra_cyl_L,
            'axis_L' => $request->axis_L,
            'oculus_sinistra_add_L' => $request->oculus_sinistra_add_L,
            'oculus_sinistra_visus_L' => $request->oculus_sinistra_visus_L,
            'PD' => $request->PD,
            'diagnosa' => $request->diagnosa,
            'catatan' => $request->catatan,
            'customer_id' => $request->customer_id,
            'branch_check_location_id' => $request->branch_check_location_id
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/customer-diagnose/edit', $api_request);
        
        $result = $response->json();

        if($result['message'] == 'success'){
            $row['message']="The data has been successfully updated";
        }else{
            $row['message']="Update data failed ";
        }
        return response()->json($result);
    }
}
