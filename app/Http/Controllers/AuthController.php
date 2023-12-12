<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Utils\GetUserInfo;
use Exception;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller{
    public function login(Request $request){
        try{
            $headers = [
                'Accept' => 'application/json'
            ];

            $email = $request->email;
            $password = $request->password;

            $api_request = [
                'email' => $email,
                'password' => $password
            ];

            $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/login', $api_request);
            $data = $response->json();


            if ($data['status'] == 'success'){
                setcookie('token', $data['data']['token'], time() + 60*60*24, '/', '', false, true);
                toastr()->info('Login successfully!', 'Authentication', ['timeOut' => 3000]);

                return redirect('/dashboard');
            }else{
                toastr()->error('Invalid email or password!', 'Authentication', ['timeOut' => 3000]);
                return view('/login', ['data' => $data['message']]);
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }

    }

    public function logout(){
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/logout');

        $result = $response->json();

        if($result['status'] == 'success'){
            setcookie('token', '', time()-60*60*24, '/', '', false, true);
            toastr()->info('Logout successfully!', 'Authentication', ['timeOut' => 3000]);
            return redirect('/login');
        }else{
            return view('/dashboard', ['data' => $result['message']]);
        }
    }

    public function getUserInfo(){
        $user = GetUserInfo::getUserInfo();

        return view('dashboard', ['data' => $user['data']]);
    }

    public function register(Request $request){
        $token = $_COOKIE['token'];
        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'email' => $request->email,
            'password' => $request->password,
            'username' => $request->username,
            'nik' => $request->nik,
            'nip' => $request->nip,
            'employee_name' => $request->employee_name,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'department' => $request->department,
            'section' => $request->section,
            'position' => $request->position,
            'role' => $request->role,
            'status' => $request->status,
            'group' => $request->group,
            'domicile' => $request->domicile,
            'branch_id' => $request->branch_id
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/register', $api_request);

        // $token = $_COOKIE['token'];
        // $headers = [
        //     'Accept' => 'application\json',
        //     'Authorization' => 'Bearer '.$token
        // ];
        // //semua di tolower, symbol dihilanhin, whitespace ganti _
        // $api_request = [
        //     'email' => $request->email,
        //     'password' => $request->password,
        //     'username' => $request->username,
        //     'nik' => $request->nik,
        //     'employee_name' => $request->employee_name,
        //     'photo' => $request->photo,
        //     'gender' => $request->gender,
        //     'address' => $request->address,
        //     'phone' => $request->phone,
        //     'department' => $request->department,
        //     'section' => $request->section,
        //     'position' => $request->position,
        //     'role' => $request->role,
        //     'plant' => $request->plant,
        //     'status' => $request->status,
        //     'group' => $request->group,
        //     'domicile' => $request->domicile

        //     // 'username' => $request->username,
        //     // 'nik' => $request->nik,
        //     // 'photo' => $request->photo,
        //     // 'employee_name' => $request->employee_name,
        //     // 'department' => $request->department,
        //     // 'section' => $request->section,
        //     // 'position' => $request->position,
        //     // 'role' => $request->role,
        //     // 'plant' => $request->plant,
        //     // 'status' => $request->status
        // ];


        // $response = Http::withHeaders($headers)
        //     ->attach('photo', $request->file('photo'))
        //     ->post('http://localhost:8001/api/register', $api_request);
        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Employee added successfully!', 'Employee', ['timeOut' => 3000]);
            return redirect('/employee');
        }else{
            toastr()->error($result['message'], 'Employee', ['timeOut' => 3000]);
            return redirect('/employee');
        }

    }
}
