<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class ColorController extends Controller
{
    public function getAllColor(Request $request){
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

        $response = Http::withHeaders($headers)->get('http://localhost:8001/api/color/all', $api_request);

        $color = $response->json();

        $user = GetUserInfo::getUserInfo();

        if ($color['status'] == 'success'){
            return view('master.warna', ['color' => $color['data'], 'data' => $user['data']]);

        }else{
            return view('/dashboard');
        }
    }

    public function addColor(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'color_name' => $request->color_name
        ];

        $response = Http::withHeaders($headers)->post('http://localhost:8001/api/color/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Color added successfully!', 'Color', ['timeOut' => 3000]);
            return redirect('/warna');
        }else{
            toastr()->error($result['message'], 'Color', ['timeOut' => 3000]);
            return redirect('/warna');
        }
    }

    public function updateColor(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id,
            'color_name' => $request->color_name
        ];

        $response = Http::withHeaders($headers)->put('http://localhost:8001/api/color/edit', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Color updated successfully!', 'Color', ['timeOut' => 3000]);
            return redirect('/warna');
        }else{
            toastr()->error($result['message'], 'Color', ['timeOut' => 3000]);
            return redirect('/warna');
        }
    }

    public function deleteColor(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->id
        ];

        $response = Http::withHeaders($headers)->delete('http://localhost:8001/api/color/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Color deleted successfully!', 'Color', ['timeOut' => 3000]);
            return redirect('/warna');
        }else{
            toastr()->error($result['message'], 'Color', ['timeOut' => 3000]);
            return redirect('/warna');
        }
    }

}
