<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class ItemOutgoingController extends Controller
{
    //
    public function getAllItemOutgoing() {
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

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item-outgoing/all', $api_request);
        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $item_outgoing = $response->json();
        $branch = $response_branch->json();
        $employee = $response_employee->json();

        $user = GetUserInfo::getUserInfo();

        if($item_outgoing['status'] == 'success') {
            return view('inventory.itemOutgoing', [
                'item_outgoing' => $item_outgoing['data'],
                'data' => $user['data'],
                'branch' => $branch['data'],
                'employee' => $employee['data']
                ]);
        } else {
            return redirect('/dashboard');
        }
    }

    public function addItemOutgoing(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'branch_id' => $request->branch_id,
            'known_by' => $request->known_by,
            'checked_by' => $request->checked_by,
            'approved_by' => $request->approved_by,
            'delivered_by' => $request->delivered_by,
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/item-outgoing/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            toastr()->info('Item Outgoing added successfully!', 'Item Outgoing', ['timeOut' => 3000]);
            return redirect('/item-outgoing');
        } else {
            toastr()->error($result['message'], 'Item Outgoing', ['timeOut' => 3000]);
            return redirect('/item-outgoing');
        }
        
    }

    public function updateItemOutgoing(Request $request) {
        $token = $_COOKIE['token'];
        $headers = [
          'Accept' => 'application\json',
          'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
          'id' => $request->id,
          'tanggal_pengiriman' => $request->tanggal_pengiriman,
          'branch_id' => $request->branch_id,
          'known_by' => $request->known_by,
          'checked_by' => $request->checked_by,
          'approved_by' => $request->approved_by,
          'delivered_by' => $request->delivered_by,
          'received_by' => $request->received_by
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/item-outgoing/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            toastr()->info('Item Outgoing updated successfully!', 'Item Outgoing', ['timeOut' => 3000]);
            return redirect('/item-outgoing');
        } else {
            toastr()->error($result['message'], 'Item Outgoing', ['timeOut' => 3000]);
            return redirect('/item-outgoing');
        }
    }

    public function deleteItemOutgoing(Request $request) {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id
        ];
        
        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/item-outgoing/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            toastr()->info('Item Outgoing deleted successfully!', 'Item Outgoing', ['timeOut' => 3000]);
            return redirect('/item-outgoing');
        } else {
            toastr()->error($result['message'], 'Item Outgoing', ['timeOut' => 3000]);
            return redirect('/item-outgoing');
        }
    }
}
