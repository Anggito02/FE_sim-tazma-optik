<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class BranchController extends Controller
{
    public function getAllBranch(){
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

        $response = Http::withHeaders($headers)->get('http://localhost:8001/api/branchWith/employee/all', $api_request);
        $response_sup = Http::withHeaders($headers)->get('http://localhost:8001/api/employee/all', $api_request);

        $branch = $response->json();
        $employee = $response_sup->json();

        $user = GetUserInfo::getUserInfo();

        if ($branch['status'] == 'success'){
            return view('master.branch', ['branch' => $branch['data'], 'data' => $user['data'], 'employee' => $employee['data']]);

        }else{
            return view('/dashboard');
        }
    }

    public function addBranch(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'kode_branch' => $request->kode_branch,
            'nama_branch' => $request->nama_branch,
            'alamat' => $request->alamat_branch,
            'employee_id_pic_branch' => $request->employee_id_branch
        ];

        $response = Http::withHeaders($headers)->post('http://localhost:8001/api/branch/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Branch added successfully!', 'Branch', ['timeOut' => 3000]);
            return redirect('/branch');
        }else{
            toastr()->error($result['message'], 'Branch', ['timeOut' => 3000]);
            return redirect('/branch');
        }
    }

    public function updateBranch(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id_branch,
            'kode_branch' => $request->kode_branch,
            'nama_branch' => $request->nama_branch,
            'alamat' => $request->alamat_branch,
            'employee_id_pic_branch' => $request->employee_id_branch
        ];

        $response = Http::withHeaders($headers)->put('http://localhost:8001/api/branch/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Branch updated successfully!', 'Branch', ['timeOut' => 3000]);
            return redirect('/branch');
        }else{
            toastr()->error($result['message'], 'Branch', ['timeOut' => 3000]);
            return redirect('/branch');
        }
    }

    public function deleteBranch(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->branch_id
        ];

        $response = Http::withHeaders($headers)->get('http://localhost:8001/api/branch/delete', $api_request);
        dd($response);
        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Branch deleted successfully!', 'Branch', ['timeOut' => 3000]);
            return redirect('/branch');
        }else{
            toastr()->error($result['message'], 'Branch', ['timeOut' => 3000]);
            return redirect('/branch');
        }
    }

}
