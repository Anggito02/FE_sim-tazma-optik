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
    public function getReceiveOrder(Request $request, int $po_id) {
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

        $api_request_ro = [
            "po_id" => $po_id
        ];
        // dd($api_request_ro);

        $api_request = [
            "page" => $page,
            "limit" => $limit
        ];

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/receive-orderWith/info/one', $api_request_ro);
        $response_po = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order/one', $api_request_po);
        $response_pod = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order-detail/all', $api_request_pod);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);
        $response_vendor = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/vendor/all', $api_request);
        $response_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/all', $api_request);

        $ro = $response->json();
        // dd($ro);
        $po = $response_po->json();
        $pod = $response_pod->json();
        // dd($pod);
        $employee = $response_employee->json();
        $vendor = $response_vendor->json();
        $item = $response_item->json();

        $user = GetUserInfo::getUserInfo();

        if ($ro['status'] == 'success' && $vendor['status'] == 'success'){
            return view('purchase.receiveorder', [
                'ro' => $ro['data'],
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

    public function addReceiveOrder(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
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
            return redirect('/PO/detail/'.$request->purchase_order_id);
        }else{
            toastr()->error($result['data'], 'Receive Order', ['timeOut' => 3000]);
            return redirect('/PO/detail/'.$request->purchase_order_id);
        }
    }

    public function updateReceiveOrder(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id,
            'pre_order_qty' => $request->pre_order_qty,
            'received_qty' => $request->received_qty,
            'not_good_qty' => $request->not_good_qty,
            'item_id' => $request->item_id,
            'purchase_order_id' => $request->purchase_order_id,
            'receive_order_id' => $request->receive_order_id
        ];
        // dd($api_request);

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/purchase-order-detail/update-stok', $api_request);

        $result = $response->json();
        // dd($result);

        if($result['status'] == 'success'){
            toastr()->info('Quantity updated successfully!', 'Receive Order', ['timeOut' => 3000]);
            return redirect('/receive-order/'.$request->purchase_order_id);
        } else {
            toastr()->error($result['data'], 'Receive Order', ['timeOut' => 3000]);
            return redirect('/receive-order/'.$request->purchase_order_id);
        }
    }
}
