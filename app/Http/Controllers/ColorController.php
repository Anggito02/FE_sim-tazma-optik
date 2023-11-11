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
    public function getAllColor(){
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

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/color/all', $api_request);
        

        $color = $response->json();

        $user = GetUserInfo::getUserInfo();

        if ($color['status'] == 'success'){
            return view('master.color', ['color' => $color['data'], 'data' => $user['data']]);

        }else{
            return redirect('/dashboard');
        }
    }

    public function addColor(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $color_name = $request->color_name;

        $api_request = [
            'color_name' => $color_name
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/color/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Color '. $color_name .' added successfully!', 'Color', ['timeOut' => 3000]);
            return redirect('/color');
        }else{
            toastr()->error($result['message'], 'Color', ['timeOut' => 3000]);
            return redirect('/color');
        }
    }

    public function updateColor(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $color_name = $request->color_name;

        $api_request = [
            'id' => $request->color_id,
            'color_name' => $color_name
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/color/edit', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            toastr()->info('Color '. $color_name .' updated successfully!', 'Color', ['timeOut' => 3000]);
            return redirect('/color');
        }else{
            toastr()->error($result['message'], 'Color', ['timeOut' => 3000]);
            return redirect('/color');
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
            'id' => $request->color_id
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/color/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Color deleted successfully!', 'Color', ['timeOut' => 3000]);
            return redirect('/color');
        }else{
            toastr()->error($result['message'], 'Color', ['timeOut' => 3000]);
            return redirect('/color');
        }
    }

}
