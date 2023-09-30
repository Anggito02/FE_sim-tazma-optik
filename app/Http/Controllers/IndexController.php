<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\AuthController;
use App\Utils\GetUserInfo;

class IndexController extends Controller
{
    public function getAllIndexCategory(){
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

        $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/index/all', $api_request);

        $index = $response->json();

        $user = GetUserInfo::getUserInfo();

        if ($index['status'] == 'success'){
            return view('master.index', ['index' => $index['data'], 'data' => $user['data']]);

        }else{
            return redirect('/dashboard');
        }
    }

    public function addIndexCategory(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'value' => $request->index_size
        ];

        $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/index/add', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Index added successfully!', 'Index', ['timeOut' => 3000]);
            return redirect('/index');
        }else{
            toastr()->error($result['message'], 'Index', ['timeOut' => 3000]);
            return redirect('/index');
        }
    }

    public function updateIndexCategory(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->index_id,
            'value' => $request->index_size
        ];

        $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/index/edit', $api_request);

        $result = $response->json();
        if($result['status'] == 'success'){
            toastr()->info('Index updated successfully!', 'Index', ['timeOut' => 3000]);
            return redirect('/index');
        }else{
            toastr()->error($result['message'], 'Index', ['timeOut' => 3000]);
            return redirect('/index');
        }
    }

    public function deleteIndexCategory(Request $request)
    {
        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application\json',
            'Authorization' => 'Bearer '.$token
        ];

        $api_request = [
            'id' => $request->index_id
        ];

        $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/index/delete', $api_request);

        $result = $response->json();

        if($result['status'] == 'success'){
            toastr()->info('Index deleted successfully!', 'Index', ['timeOut' => 3000]);
            return redirect('/index');
        }else{
            toastr()->error($result['message'], 'Index', ['timeOut' => 3000]);
            return redirect('/index');
        }
    }

}
