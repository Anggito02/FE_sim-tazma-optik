<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class PurchaseOrderController extends Controller
{
    //
    public function getAllPO () {
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

        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);
        $response_vendor = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);
        $employee = $response_employee->json();
        $vendor = $response_vendor->json();

        $user = GetUserInfo::getUserInfo();

        // if ($po['status'] == 'success'){
            return view('purchase.po', [
                'data' => $user['data'],
                'employee' => $employee['data'],
                'vendor' => $vendor['data']
            ]);
        // }else{
        //     return redirect('/dashboard');
        // }
    }

    public function loadDataDetailOnly(Request $request)
    {
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
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/one', $data)->json();
        $response_withInfo = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-orderWith/info/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);
        $response_vendor = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);
        return view(
            'purchase.poEdit',
            [
            'vals'=>$response['data'],
            'withInfo' => $response_withInfo['data'],
            'employee' => $response_employee['data'],
            'vendor' => $response_vendor['data']
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
        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/all', $data);
        $po = $response->json();
        
        return response()->json($po);
    }

    public function addPO(Request $request) {
        $row="";
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $row=$request;
        $status_penerimaan = $request->status_penerimaan;
        $status_pembayaran = $request->status_pembayaran;
        $status_po = $request->status_po;

        if ($status_penerimaan == 'Belum Diterima') {
            $status_penerimaan = 0;
        } else {
            $status_penerimaan = 1;
        }

        if ($status_pembayaran == 'Belum Dibayar') {
            $status_pembayaran = 0;
        } else {
            $status_pembayaran = 1;
        }

        if ($status_po == 'OPEN') {
            $status_po = 1;
        } else {
            $status_po = 0;
        }

        $api_request = [
            'nomor_po' => $request->nomor_po,
            'tanggal_dibuat' => $request->tanggal_dibuat,
            'status_penerimaan' => $status_penerimaan,
            'status_pembayaran' => $status_pembayaran,
            'status_po' => $status_po,
            'checked_by' => $request->checked_by,
            'made_by' => $request->made_by,
            'approved_by' => $request->approved_by,
            'vendor_id' => $request->vendor_id
        ];
        // dd($api_request);

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/add', $api_request);

        $result = $response->json();
        // dd($result);

        if($result['status'] == 'success'){
            $row['message']="Data has been successfully inserted";
        }else{
            $row['message']="Insert data failed ";
        }
        return response()->json($result);
    }

    public function updatePO(Request $request){
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id,
            'status_penerimaan' => $request->status_penerimaan,
            'status_pembayaran' => $request->status_pembayaran,
            'status_po' => $request->status_po,
            'checked_by' => $request->checked_by,
            'made_by' => $request->made_by,
            'approved_by' => $request->approved_by,
            'vendor_id' => $request->vendor_id
        ];
        // dd($api_request);

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Purchase Order updated successfully!', 'Purchase Order', ['timeOut' => 3000]);
            return redirect('/PO');
        }else{
            toastr()->error($result['data'], 'Purchase Order', ['timeOut' => 3000]);
            return redirect('/PO');
        }
    }

    public function deletePO(Request $request){
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->po_id
        ];
        // dd($api_request);
        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Purchase Order deleted successfully!', 'Purchase Order', ['timeOut' => 3000]);
            return redirect('/PO');
        }else{
            toastr()->error($result['message'], 'Purchase Order', ['timeOut' => 3000]);
            return redirect('/PO');
        }
    }
}
