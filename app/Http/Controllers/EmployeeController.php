<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class EmployeeController extends Controller
{
    //
    public function getAllEmployee(){
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

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/employee/all', $api_request);
        $response_branch = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/branch/all', $api_request);

        $employee = $response->json();
        $branch = $response_branch->json();
        
        $user = GetUserInfo::getUserInfo();

        if ($employee['status'] == 'success'){
            return view('master.employee', ['employee' => $employee['data'], 'data' => $user['data'], 'branch' => $branch['data']]);
        }else{
            return redirect('/dashboard');
        }
    }

    public function addEmployee(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];
        $api_request = [
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'employee_name' => $request->employee_name,
            'nik' => $request->nik,
            'nip' => $request->nip,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'domicile' => $request->domicile,
            'department' => $request->department,
            'section' => $request->section,
            'position' => $request->position,
            'group' => $request->group,
            'branch_id' => $request->branch_id,
            'status' => $request->status,
            'role' => $request->role
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/register', $api_request);
        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Employee added successfully!', 'Employee', ['timeOut' => 3000]);
            return redirect('/employee');
        }else{
            toastr()->error($result['message'], 'Employee', ['timeOut' => 3000]);
            return redirect('/employee');
        }
    }

    public function updateEmployee(Request $request) {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->employee_id,
            'username' => $request->username,
            'nik' => $request->nik,
            'employee_name' => $request->employee_name,
            'department' => $request->department,
            'section' => $request->section,
            'position' => $request->position,
            'role' => $request->role,
            'domicile' => $request->domicile,
            'status' => $request->status
        ];
        dd($api_request);
        

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/employee/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Employee updated successfully!', 'Employee', ['timeOut' => 3000]);
            return redirect('/employee');
        }else{
            toastr()->error($result['message'], 'Employee', ['timeOut' => 3000]);
            return redirect('/employee');
        }
    }

    public function deleteEmployee(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/employee/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Employee deleted successfully!', 'Employee', ['timeOut' => 3000]);
            return redirect('/employee');
        }else{
            toastr()->error($result['message'], 'Employee', ['timeOut' => 3000]);
            return redirect('/employee');
        }
    }
}
