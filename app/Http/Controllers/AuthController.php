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
        $headers = [
            'Accept' => 'application/json'
        ];

        $email = $request->email;
        $password = $request->password;

        $api_request = [
            'email' => $email,
            'password' => $password
        ];

        $response = Http::withHeaders($headers)->post('http://localhost:8001/api/login', $api_request);
        $data = $response->json();

        if ($data['status'] == 'success'){
            setcookie('token', $data['data']['token'], time()+60*60*24, '/', '', false, true);

            toastr()->info('Login successfully!', 'Authentication', ['timeOut' => 3000]);

            return redirect('/dashboard');
        }else{
            toastr()->error('Invalid email or password!', 'Authentication', ['timeOut' => 3000]);
            return view('/login', ['data' => $data['message']]);
        }
    }

    public function logout(){
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $response = Http::withHeaders($headers)->post('http://localhost:8001/api/logout');

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
}
