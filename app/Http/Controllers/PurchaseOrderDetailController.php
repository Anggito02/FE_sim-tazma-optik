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
        $response_po = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);
        $response_vendor = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);
        $reponse_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/all', $api_request);


        $pod = $response->json();
        // dd($pod);
        $po_all = $response_po->json();
        $employee = $response_employee->json();
        // dd($employee);
        $vendor = $response_vendor->json();
        // dd($vendor);
        $item = $reponse_item->json();
        // dd($item);
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
                'po_all' => $po_all['data'],
                'pod' => $pod['data'],
                'data' => $user['data'],
                'employee' => $employee['data'],
                'vendor' => $vendor['data'],
                'item' => $item['data']
            ]);
        }else{
            return redirect('/dashboard');
        }
    }

    public function addPODetail(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'pre_order_qty' => intval($request->pre_order_qty),
            'unit' => $request->unit,
            'harga_beli_satuan' => intval($request->harga_beli_satuan),
            'harga_jual_satuan' => intval($request->harga_jual_satuan),
            'diskon' => intval($request->diskon),
            'purchase_order_id' => intval($request->purchase_order_id),
            'item_id' => intval($request->item_id)
        ];
        // dd($api_request);

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order-detail/add', $api_request);
        $response_po = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/all', $api_request);
        // dd($response);
        $result = $response->json();
        // dd($result);

        if($result['status'] == 'success'){
            toastr()->info('Purchase order detail added successfully!', 'Purchase Order Detail', ['timeOut' => 3000]);
            return redirect('/PO/detail')->with(
                'po', [
                    'nomor_po' => $request->nomor_po,
                    'status_pembayaran' => $request->status_pembayaran,
                    'status_penerimaan' => $request->status_penerimaan,
                    'tanggal_dibuat' => $request->tanggal_dibuat,
                    'status_po' => $request->status_po,
                    'nama_vendor' => $request->nama_vendor,
                    'made_by_name' => $request->made_by_name,
                    'approved_by_name' => $request->approved_by_name,
                    'checked_by_name' => $request->checked_by_name
                ]
            );
        } else {
            toastr()->error($result['message'], 'Purchase Order Detail', ['timeOut' => 3000]);
            return redirect('/PO/detail');
        }
    }
    
    public function deletePODetail(Request $request){
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->po_id
        ];
        // dd($api_request);

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order-detail/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Purchase order detail deleted successfully!', 'Purchase Order Detail', ['timeOut' => 3000]);
            return redirect('/PO/detail');
        } else {
            toastr()->error($result['message'], 'Purchase Order Detail', ['timeOut' => 3000]);
            return redirect('/PO/detail');
        }
    }
}
