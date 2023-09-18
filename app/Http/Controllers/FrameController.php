<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class FrameController extends Controller
{
    public function getAllFrameCategory(){
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

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/frame-category/all', $api_request);

        $frame = $response->json();

        $user = GetUserInfo::getUserInfo();

        if ($frame['status'] == 'success'){
            return view('master.frame', ['frame' => $frame['data'], 'data' => $user['data']]);

        }else{
            return view('/dashboard');
        }
    }

    public function addFrameCategory(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'nama_kategori' => $request->frame_nama
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/frame-category/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Frame category added successfully!', 'Frame', ['timeOut' => 3000]);
            return redirect('/frame-category');
        }else{
            toastr()->error($result['message'], 'Frame', ['timeOut' => 3000]);
            return redirect('/frame-category');
        }
    }

    public function updateFrameCategory(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->frame_id,
            'nama_kategori' => $request->frame_nama
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/frame-category/edit', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            toastr()->info('Frame category updated successfully!', 'Frame', ['timeOut' => 3000]);
            return redirect('/frame-category');
        }else{
            toastr()->error($result['message'], 'Frame', ['timeOut' => 3000]);
            return redirect('/frame-category');
        }
    }

    public function deleteFrameCategory(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->frame_id
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/frame-category/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Frame category deleted successfully!', 'Frame', ['timeOut' => 3000]);
            return redirect('/frame-category');
        }else{
            toastr()->error($result['message'], 'Frame', ['timeOut' => 3000]);
            return redirect('/frame-category');
        }
    }

}
