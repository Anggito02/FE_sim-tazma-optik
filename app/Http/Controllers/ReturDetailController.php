<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class ReturDetailController extends Controller
{
    //
    function getAllReturDetail(Request $request, int $retur_id) {

        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $page = 1;
        $limit = 10;

        $api_request_retur = [
          "id" => $retur_id 
        ];

        $api_request_retur_detail = [
            "retur_id" => $retur_id
        ];

        $api_request = [
            "page" => $page,
            "limit" => $limit
        ];

        $response_retur = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/retur/one', $api_request_retur);
        $response_retur_detail = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/retur-detail/all', $api_request_retur_detail);
        $response_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/filtered', $api_request);
        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $retur = $response_retur->json();
        $retur_detail = $response_retur_detail->json();
        $item = $response_item->json();
        $branch = $response_branch->json();
        $employee = $response_employee->json();

        $user = GetUserInfo::getUserInfo();
        if ($retur_detail['status'] == 'success' && $item['status'] == 'success' && $branch['status'] == 'success' && $employee['status'] == 'success'){
            return view('inventory.returDetail', [
                'retur' => $retur['data'],
                'retur_detail' => $retur_detail['data'],
                'item' => $item['data'],
                'branch' => $branch['data'],
                'employee' => $employee['data'],
                'data' => $user['data']
            ]);
        }
        else {
            return redirect('dashboard');
        }
    }

    public function addReturDetail(Request $request) {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $api_request = [
            'retur_id' => $request->retur_id,
            'item_id' => $request->item_id,
            'delivered_qty' => $request->delivered_qty,
            'verified_by' => $request->verified_by
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/retur-detail/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            toastr()->info('Retur Detail added successfully!', 'Retur Detail', ['timeOut' => 3000]);
            return redirect('/retur/detail/'.$request->retur_id);
        } else {
            toastr()->error($result['message'], 'Retur Detail', ['timeOut' => 3000]);
            return redirect('/retur/detail/'.$request->retur_id);
        }
    }

    public function verifyReturDetail(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id,
            'delivered_qty' => $request->delivered_qty,
            'item_id' => $request->item_id,
            'retur_id' => $request->retur_id,
        ];
        // dd($api_request);

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/retur-detail/verify', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            toastr()->info('Retur Detail verified successfully!', 'Retur Detail', ['timeOut' => 3000]);
            return redirect('/retur/detail/'.$request->retur_id);
        } else {
            toastr()->error($result['data'], 'Retur Detail', ['timeOut' => 3000]);
            return redirect('/retur/detail/'.$request->retur_id);
        }
    }

    public function updateReturDetail(Request $request) {
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

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/retur-detail/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            // dd($request->outgoing_id);
            toastr()->info('Retur Detail updated successfully!', 'Retur Detail', ['timeOut' => 3000]);
            return redirect('/retur/detail/'.$request->retur_id);
        } else {
            toastr()->error($result['message'], 'Retur Detail', ['timeOut' => 3000]);
            return redirect('/retur/detail/'.$request->retur_id);
        }
    }

    public function deleteReturDetail(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id,
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/retur-detail/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            toastr()->info('Retur Detail deleted successfully!', 'Retur Detail', ['timeOut' => 3000]);
            return redirect('/retur/detail/'.$request->retur_id);
        } else {
            toastr()->error($result['message'], 'Retur Detail', ['timeOut' => 3000]);
            return redirect('/retur/detail/'.$request->retur_id);
        }
    }
}
