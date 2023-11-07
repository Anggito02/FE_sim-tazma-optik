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
    public function getAllPODetail (Request $request, int $po_id) {
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 100;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request_po = [
            "id" => $po_id
        ];

        $api_request_pod = [
            "purchase_order_id" => $po_id,
            "page" => $page,
            "limit" => $limit
        ];

        $api_request = [
            "page" => $page,
            "limit" => $limit
        ];

        $response_po = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/one', $api_request_po);
        $response_pod = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order-detail/all', $api_request_pod);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);
        $response_vendor = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);
        $response_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/all', $api_request);

        $po = $response_po->json();
        // dd($po);
        $pod = $response_pod->json();
        // dd($pod);
        $employee = $response_employee->json();
        // dd($employee);
        $vendor = $response_vendor->json();
        $item = $response_item->json();


        $user = GetUserInfo::getUserInfo();
        if ($employee['status'] == 'success' && $vendor['status'] == 'success'){
            return view('purchase.poDetail', [
                'po' => $po['data'],
                'pod' => $pod['data'],
                'data' => $user['data'],
                'employee' => $employee['data'],
                'vendor' => $vendor['data'],
                'items' => $item['data']
            ]);
        }else{
            return redirect('/dashboard');
        }
    }

    public function addPODetail(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'pre_order_qty' => $request->pre_order_qty,
            'unit' => $request->unit,
            'harga_beli_satuan' => $request->harga_beli_satuan,
            'harga_jual_satuan' => $request->harga_jual_satuan,
            'diskon' => $request->diskon,
            'item_id' => $request->item_id,
            'purchase_order_id' => $request->purchase_order_id
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order-detail/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Purchase Order Detail added successfully!', 'Purchase Order Detail', ['timeOut' => 3000]);
            return redirect('/PO/detail/'.$request->purchase_order_id);
        } else {
            toastr()->error($result['message'], 'Purchase Order Detail', ['timeOut' => 3000]);
            return redirect('/PO/detail/'.$request->purchase_order_id);
        }

    }

    public function updatePODetail(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id,
            'pre_order_qty' => $request->pre_order_qty,
            'unit' => $request->unit,
            'harga_beli_satuan' => $request->harga_beli_satuan,
            'harga_jual_satuan' => $request->harga_jual_satuan,
            'diskon' => $request->diskon,
            'item_id' => $request->item_id
        ];
        // dd($api_request);

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order-detail/edit', $api_request);
        $result = $response->json();
        // dd($result);

        if($result['status'] == 'success'){
            toastr()->info('Purchase Order Detail updated successfully!', 'Purchase Order Detail', ['timeOut' => 3000]);
            return redirect('/PO/detail/'.$request->purchase_order_id);
        } else {
            toastr()->error($result['message'], 'Purchase Order Detail', ['timeOut' => 3000]);
            return redirect('/PO/detail/'.$request->purchase_order_id);
        }
    }

    public function deletePODetail(Request $request){
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->po_detail_id
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order-detail/delete', $api_request);

        $result = $response->json();
        // dd($result);

        if($result['status'] == 'success'){
            toastr()->info('Purchase Order Detail deleted successfully!', 'Purchase Order Detail', ['timeOut' => 3000]);
            return redirect('/PO/detail/'.$request->purchase_order_id);
        }else{
            toastr()->error($result['data'], 'Purchase Order Detail', ['timeOut' => 3000]);
            return redirect('/PO/detail/'.$request->purchase_order_id);
        }
    }
}
