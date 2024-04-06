<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class BranchOutgoingDetailController extends Controller
{
    public function getAllBranchOutgoingDetail(Request $request, int $branch_outgoing_id) {
        $token = $_COOKIE['token'];

        $page = 1;
        $limit = 100;

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request_branch_outgoing = [
            "id" => $branch_outgoing_id
        ];

        $api_request_branch_outgoing_detail = [
            "branch_outgoing_id" => $branch_outgoing_id
        ];

        $api_request = [
            "page" => $page,
            "limit" => $limit
        ];

        $response_branch_outgoing = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch-outgoing/one', $api_request_branch_outgoing);
        $response_branch_outgoing_detail = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch-outgoing-detail/all', $api_request_branch_outgoing_detail);
        $response_item = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/item/filtered', $api_request);
        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);
        $response_employee = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);

        $branch_outgoing = $response_branch_outgoing->json();
        $branch_outgoing_detail = $response_branch_outgoing_detail->json();
        $item = $response_item->json();
        $branch = $response_branch->json();
        $employee = $response_employee->json();

        $user = GetUserInfo::getUserInfo();
        if ($branch_outgoing_detail['status'] == 'success' && $item['status'] == 'success' && $branch['status'] == 'success' && $employee['status'] == 'success'){
            return view('inventory.branchOutgoingDetail', [
                'branch_outgoing' => $branch_outgoing['data'],
                'branch_outgoing_detail' => $branch_outgoing_detail['data'],
                'item' => $item['data'],
                'branch' => $branch['data'],
                'employee' => $employee['data'],
                'data' => $user['data']
            ]);
        } 
        else {
            return redirect('/dashboard');
        }
    }

    public function addBranchOutgoingDetail(Request $request) {
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $api_request = [
            'branch_outgoing_id' => $request->branch_outgoing_id,
            'item_id' => $request->item_id,
            'delivered_qty' => $request->delivered_qty,
            'verified_by' => $request->verified_by
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/branch-outgoing-detail/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            toastr()->info('Branch Outgoing Detail added successfully!', 'Branch Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/branch-outgoing/detail/'.$request->branch_outgoing_id);
        } else {
            toastr()->error($result['message'], 'Branch Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/branch-outgoing/detail/'.$request->branch_outgoing_id);
        }
    }

    public function updateBranchOutgoingDetail(Request $request) {
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
            'branch_from_id' => $request->branch_from_id,
            'branch_to_id' => $request->branch_to_id
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/branch-outgoing-detail/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            // dd($request->outgoing_id);
            toastr()->info('Branch Outgoing Detail updated successfully!', 'Branch Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/branch-outgoing/detail/'.$request->branch_outgoing_id);
        } else {
            toastr()->error($result['message'], 'Branch Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/branch-outgoing/detail/'.$request->branch_outgoing_id);
        }
    }

    public function verifyBranchOutgoingDetail(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id,
            'delivered_qty' => $request->delivered_qty,
            'item_id' => $request->item_id,
            'branch_outgoing_id' => $request->branch_outgoing_id,
        ];
        // dd($api_request);

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/branch-outgoing-detail/verify', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            toastr()->info('Branch Outgoing Detail verified successfully!', 'Branch Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/branch-outgoing/detail/'.$request->branch_outgoing_id);
        } else {
            toastr()->error($result['data'], 'Branch Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/branch-outgoing/detail/'.$request->branch_outgoing_id);
        }
    }

    public function deleteBranchOutgoingDetail(Request $request) {
        
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id,
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/branch-outgoing-detail/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success') {
            toastr()->info('Branch Outgoing Detail deleted successfully!', 'Branch Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/branch-outgoing/detail/'.$request->branch_outgoing_id);
        } else {
            toastr()->error($result['message'], 'Branch Outgoing Detail', ['timeOut' => 3000]);
            return redirect('/branch-outgoing/detail/'.$request->branch_outgoing_id);
        }
    }
}
