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

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-orderWith/info/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);
        $response_vendor = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);

        $po = $response->json();
        $employee = $response_employee->json();
        $vendor = $response_vendor->json();

        $user = GetUserInfo::getUserInfo();

        if ($po['status'] == 'success'){
            return view('master.po', [
                'po' => $po['data'],
                'data' => $user['data'],
                'employee' => $employee['data'],
                'vendor' => $vendor['data']
            ]);
        }else{
            return redirect('/dashboard');
        }
    }

    public function addPO(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'nomor_po' => $request->nomor_po,
            'tanggal_dibuat' => $request->tanggal_dibuat,
            'status_penerimaan' => $request->status_penerimaan,
            'status_pembayaran' => $request->status_pembayaran,
            'status_po' => $request->status_po,
            'checked_by' => $request->checked_by,
            'made_by' => $request->made_by,
            'approved_by' => $request->approved_by,
            'vendor_id' => $request->vendor_id
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Purchase order added successfully!', 'Purchase Order', ['timeOut' => 3000]);
            return redirect('/PO');
        }else{
            toastr()->error($result['message'], 'Purchase Order', ['timeOut' => 3000]);
            return redirect('/PO');
        }
    }

    public function updatePO(Request $request){
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'nomor_po' => $request->nomor_po,
            'tanggal_dibuat' => $request->tanggal_dibuat,
            'status_penerimaan' => $request->status_penerimaan,
            'status_pembayaran' => $request->status_pembayaran,
            'status_po' => $request->status_po,
            'checked_by' => $request->checked_by,
            'made_by' => $request->made_by,
            'approved_by' => $request->approved_by,
            'vendor_id' => $request->vendor_id
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Purchase Order updated successfully!', 'Purchase Order', ['timeOut' => 3000]);
            return redirect('/PO');
        }else{
            toastr()->error($result['message'], 'Purchase Order', ['timeOut' => 3000]);
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
