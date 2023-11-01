<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class ItemOutgoingDetailController extends Controller 
{
    public function getAllItemOutgoingDetail (Request $request, int $item_outgoing_id) {
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 100;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request_item_outgoing = [
            "id" => $item_outgoing_id
        ];

        $api_request_item_outgoing_detail = [
            "outgoing_id" => $item_outgoing_id
        ];

        // dd($api_request_item_outgoing_detail);

        $api_request = [
            "page" => $page,
            "limit" => $limit
        ];

        $response_item_outgoing = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item-outgoing/one', $api_request_item_outgoing);
        $response_item_outgoing_detail = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/outgoing-detail/all', $api_request_item_outgoing_detail);
        $response_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/all', $api_request);
        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $item_outgoing = $response_item_outgoing->json();
        // dd($item_outgoing);
        $item_outgoing_detail = $response_item_outgoing_detail->json();
        // dd($item_outgoing_detail);
        $item = $response_item->json();
        $branch = $response_branch->json();
        $employee = $response_employee->json();

        $user = GetUserInfo::getUserInfo();
        if ($item_outgoing_detail['status'] == 'success' && $item['status'] == 'success' && $branch['status'] == 'success' && $employee['status'] == 'success'){
            return view('master.itemOutgoingDetail', [
                'item_outgoing' => $item_outgoing['data'],
                'item_outgoing_detail' => $item_outgoing_detail['data'],
                'item' => $item['data'],
                'branch' => $branch['data'],
                'employee' => $employee['data'],
                'data' => $user['data']
            ]);
        } else {
            return redirect('/dashboard');
        }
    }

    public function addItemOutgoingDetail (Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'outgoing_id' => $request->outgoing_id,
            'item_id' => $request->item_id,
            'delivered_qty' => $request->delivered_qty,
            'verified_by' => $request->verified_by,
        ];
        // dd($api_request);

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/outgoing-detail/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            toastr()->info('Item Outgoing Detail added successfully!', 'Item Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/item-outgoing/detail/'.$request->outgoing_id);
        } else {
            toastr()->error($result['message'], 'Item Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/item-outgoing/detail/'.$request->outgoing_id);
        }
        
    }

    public function updateItemOutgoingDetail (Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id,
            'delivered_qty' => $request->delivered_qty,
            'item_id' => $request->item_id,
            'verified_by' => $request->verified_by,
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/outgoing-detail/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            // dd($request->outgoing_id);
            toastr()->info('Item Outgoing Detail updated successfully!', 'Item Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/item-outgoing/detail/'.$request->outgoing_id);
        } else {
            toastr()->error($result['message'], 'Item Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/item-outgoing/detail/'.$request->outgoing_id);
        }
    }

    public function verifyItemOutgoingDetail(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id,
            'delivered_qty' => $request->delivered_qty,
            'item_id' => $request->item_id,
            'outgoing_id' => $request->outgoing_id,
        ];
        // dd($api_request);

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/outgoing-detail/verify', $api_request);

        $result = $response->json();
        // dd($result);

        if($result['status'] == 'success') {
            toastr()->info('Item Outgoing Detail verified successfully!', 'Item Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/item-outgoing/detail/'.$request->outgoing_id);
        } else {
            toastr()->error($result['data'], 'Item Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/item-outgoing/detail/'.$request->outgoing_id);
        }
    }

    public function deleteItemOutgoingDetail(Request $request) {
        
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id,
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/outgoing-delete/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            toastr()->info('Item Outgoing Detail deleted successfully!', 'Item Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/item-outgoing/detail/'.$request->outgoing_id);
        } else {
            toastr()->error($result['message'], 'Item Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/item-outgoing/detail/'.$request->outgoing_id);
        }
    }
}