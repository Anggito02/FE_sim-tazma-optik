<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class PurchaseOrderDetailController extends Controller
{
    //
    public function getAllPODetail (Request $request) {
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 100;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            "purchase_order_id" => $request->po_id,
            "page" => $page,
            "limit" => $limit
        ];

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order-detail/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);
        $response_vendor = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);

        $pod = $response->json();
        $employee = $response_employee->json();
        $vendor = $response_vendor->json();

        $user = GetUserInfo::getUserInfo();
        if ($employee['status'] == 'success' && $vendor['status'] == 'success'){
            return view('master.poDetail', [
                'po' => [
                    'nomor_po' => $request->nomor_po,
                    'status_pembayaran' => $request->status_pembayaran,
                    'status_penerimaan' => $request->status_penerimaan,
                    'tanggal_dibuat' => $request->tanggal_dibuat,
                    'status_po' => $request->status_po,
                    'nama_vendor' => $request->nama_vendor,
                    'made_by_name' => $request->made_by_name,
                    'approved_by_name' => $request->approved_by_name,
                    'checked_by_name' => $request->checked_by_name
                ],
                // 'pod' => $pod['data'],
                'data' => $user['data'],
                'employee' => $employee['data'],
                'vendor' => $vendor['data']
            ]);
        }else{
            return redirect('/dashboard');
        }
    }
}
