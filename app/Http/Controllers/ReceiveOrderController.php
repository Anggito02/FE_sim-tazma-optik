<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class ReceiveOrderController extends Controller
{
    //
    public function getAllReceiveOrder() {
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

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/receive-order/all', $api_request);
        $response_po = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $ro = $response->json();
        $po = $response_po->json();
        $employee = $response_employee->json();
        $user = GetUserInfo::getUserInfo();

        if ($ro['status'] == 'success'){
            return view('master.ro', [
                'ro' => $ro['data'], 
                'data' => $user['data'],
                'po' => $po['data'],
                'employee' => $employee['data']
            ]);
        }else{
            return redirect('/dashboard');
        }
    }

    public function addReceiveOrder(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'tanggal_penerimaan' => $request->tanggal_penerimaan,
            'purchase_order_id' => $request->purchase_order_id,
            'received_by' => $request->received_by,
            'checked_by' => $request->checked_by,
            'approved_by' => $request->approved_by
        ];

        // dd($api_request);

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/receive-order/add', $api_request);
        // dd($response);
        $result = $response->json();
        // dd($result);

        if($result['status'] == 'success'){
            toastr()->info('Receive order added successfully!', 'Receive Order', ['timeOut' => 3000]);
            return redirect('/receive-order');
        }else{
            toastr()->error($result['message'], 'Receive Order', ['timeOut' => 3000]);
            return redirect('/receive-order');
        }
    }
}
